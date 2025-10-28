<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('admin.pages.transactions-income.index', compact('transactions', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date_format:d-m-Y',
            'amount' => 'required|numeric|min:0',
            'receipt_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'description' => 'nullable|string',
        ]);

        // Ambil admin_id dari user yang login
        $admin = Admin::where('id_user', auth()->id())->first();

        $receiptPath = $request->hasFile('receipt_file')
            ? $request->file('receipt_file')->store('receipts', 'public')
            : null;

        Transaction::create([
            'category_id' => $request->category_id,
            'type' => 'income',
            'date' => Carbon::createFromFormat('d-m-Y', $request->date)->format('Y-m-d'),
            'amount' => $request->amount,
            'description' => $request->description,
            'receipt_file' => $receiptPath,
            'admin_id' => $admin ? $admin->id : null,
        ]);

        return redirect()->back()->with('success', 'Income berhasil disimpan.');
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
        return view('admin.pages.transactions-income.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
