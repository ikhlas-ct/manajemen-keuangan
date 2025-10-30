<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_income = Transaction::where('type', 'income')->sum('amount');
        $total_expense = Transaction::where('type', 'expense')->sum('amount');
        $saldo_akhir = $total_income - $total_expense;
        $transactions = Transaction::with(['category', 'admin'])
            ->orderBy('date', 'desc')
            ->get();

        return view('pages.admin.laporan.index', compact(
            'total_income',
            'total_expense',
            'saldo_akhir',
            'transactions'
        ));
    }

    public function cetakLaporan(Request $request)
    {
        $jenis = $request->jenis;

        if ($jenis === 'bulanan') {
            $bulan = $request->bulan;
            $tahun = $request->tahun;

            $data = Transaction::whereMonth('date', $bulan)
                            ->whereYear('date', $tahun)
                            ->get();

            $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1));
            $judul = "Laporan Keuangan Bulanan";
            $periode = "$namaBulan $tahun";
            $namaFile = "Laporan Keuangan-Bulanan-{$namaBulan}-{$tahun}.pdf";
        } else {
            $tahun = $request->tahun;

            $data = Transaction::whereYear('date', $tahun)->get();

            $judul = "Laporan Keuangan Tahunan";
            $periode = "$tahun";
            $namaFile = "Laporan Keuangan-Tahunan-{$tahun}.pdf";
        }

        $pdf = Pdf::loadView('pages.admin.laporan.laporan-pdf', compact('data', 'judul', 'periode'));
        return $pdf->stream($namaFile);
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
        //
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
        //
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
