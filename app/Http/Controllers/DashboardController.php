<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1️⃣ Total Pemasukan
        $TotalPemasukan = Transaction::where('type', 'income')->sum('amount');

        // 2️⃣ Total Pengeluaran
        $TotalPengeluaran = Transaction::where('type', 'expense')->sum('amount');

        // 3️⃣ Saldo Akhir
        $SaldoAkhir = $TotalPemasukan - $TotalPengeluaran;

        // 4️⃣ Data Grafik per Bulan
        $bulanSekarang = Carbon::now()->month;
        $tahunSekarang = Carbon::now()->year;

        // Ambil total pemasukan dan pengeluaran per hari di bulan ini
        $grafik = DB::table('transactions')
            ->selectRaw('DAY(date) as hari, 
                        SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as total_pemasukan, 
                        SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as total_pengeluaran')
            ->whereMonth('date', $bulanSekarang)
            ->whereYear('date', $tahunSekarang)
            ->groupBy('hari')
            ->orderBy('hari')
            ->get();

        // 5️⃣ Ambil 5 Transaksi Terbaru
        $transaksiTerbaru = Transaction::orderBy('date', 'desc')->take(5)->get();

        // 6️⃣ Kirim semua data ke View Dashboard
        return view('pages.admin.dashboard.index', compact(
            'TotalPemasukan',
            'TotalPengeluaran',
            'SaldoAkhir',
            'grafik',
            'transaksiTerbaru'
        ));
    }
}
