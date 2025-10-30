<?php

namespace App\Http\Controllers\Transactions;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LargeTransactionNotification;



class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::where('type', 'income')
                        ->with('category')
                        ->orderBy('date', 'desc')
                        ->get();

        $categories = Categorie::where('type', 'income')->get();

        return view('pages.admin.transactions-income.index', compact('transactions', 'categories'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric|min:0',
            'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'description' => 'nullable|string',
        ]);





        $admin = Admin::where('id_user', auth()->id())->first();

        $receiptPath = $request->hasFile('receipt_file')
            ? $request->file('receipt_file')->store('receipts', 'public')
            : null;

        $transaction = Transaction::create([
            'category_id' => $request->category_id,
            'type' => 'income',
            'date' => Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
            'amount' => $request->amount,
            'description' => $request->description,
            'receipt_file' => $receiptPath,
            'admin_id' => $admin ? $admin->id : null,
        ]);

         if ($transaction->amount > 10000000) {
        $manajers = User::where('role', 'manajer')->get();
        if ($manajers->count() > 0) {
            Notification::send($manajers, new LargeTransactionNotification($transaction));
            Log::info('Notification::send called for large transaction', ['transaction_id' => $transaction->id]);

        }else {
        Log::warning('No manajers found to notify');
    }


    }

        return redirect()->back()->with('success', 'Income berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $income = Transaction::findOrFail($id);
        $categories = Categorie::where('type', 'income')->get();

        return view('pages.admin.transactions-income.edit', compact('income', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric|min:0',
            'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        $income = Transaction::findOrFail($id);

        $totalPengeluaran = Transaction::where('type', 'expense')->sum('amount');
        $totalPemasukkanLain = Transaction::where('type', 'income')
            ->where('id', '!=', $id)
            ->sum('amount');

        $totalPemasukkanBaru = $totalPemasukkanLain + $request->amount;

        if ($totalPemasukkanBaru < $totalPengeluaran) {
            return redirect()->back()->with('error', 'Update gagal: total pemasukkan lebih kecil dari total pengeluaran.');
        }


        $formattedDate = Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d');

        if ($request->hasFile('receipt_file')) {
            if ($income->receipt_file && Storage::exists('public/' . $income->receipt_file)) {
                Storage::delete('public/' . $income->receipt_file);
            }

            $file = $request->file('receipt_file');
            $path = $file->store('receipts', 'public');
        } else {
            $path = $income->receipt_file;
        }

        $income->update([
            'category_id' => $request->category_id,
            'date' => $formattedDate,
            'amount' => $request->amount,
            'receipt_file' => $path,
            'description' => $request->description,
        ]);

        return redirect()->route('income.index')->with('success', 'Income already update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $income)
    {
        $income->delete();
        return redirect()->route('income.index')->with('success', 'Income successfully deleted!');
    }
}
