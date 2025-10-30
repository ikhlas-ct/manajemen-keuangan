@extends('layouts.app')

@section('title','Laporan Keuangan')

@section('content')

<div class="page-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Laporan Keuangan</h3>
        <button class="btn btn-danger d-flex align-items-center" data-toggle="modal" data-target="#laporanModal" style="border-radius: 8px;">
            <i class="bi bi-file-earmark-pdf-fill mr-2"></i>
             Unduh Laporan
        </button>

    </div>

    <div class="row">
        {{-- card total pemasukan --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background: linear-gradient(135deg, #e8f5e9, #ffffff);">
                <div class="card-body text-center">
                    <div class="mb-2" style="font-size: 30px; color: #1b642c;">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <br>
                    <h6 class="fw-semibold text-muted mb-1">Total Pemasukan</h6>
                    <h3 class="fw-bold" style="color: #1b642c;">
                        Rp {{ number_format($total_income, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
        {{-- card total pengeluaran --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background: linear-gradient(135deg, #ffebee, #ffffff);">
                <div class="card-body text-center">
                    <div class="mb-2" style="font-size: 30px; color: #dc3545;">
                        <i class="bi bi-graph-down-arrow"></i>
                    </div>
                    <br>
                    <h6 class="fw-semibold text-muted mb-1">Total Pengeluaran</h6>
                    <h3 class="fw-bold" style="color: #dc3545;">
                        Rp {{ number_format($total_expense, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
        {{-- card saldo akhir --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0" style="border-radius: 15px; background: linear-gradient(135deg, #e3f2fd, #ffffff);">
                <div class="card-body text-center">
                    <div class="mb-2" style="font-size: 30px; color: #133c68;">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <br>
                    <h6 class="fw-semibold text-muted mb-1">Saldo Akhir</h6>
                    <h3 class="fw-bold" style="color: #133c68;">
                        Rp {{ number_format($saldo_akhir, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- tabel transaksi --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">Detail Transaksi</h6>
            <div class="table-responsive">
            <table id="datatable" class="table table-hover">
                <thead style="background-color: #1B1B29; color: #FFFFFF;">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
                </thead>
                <tbody>
                @forelse($transactions as $index => $transaction)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y') }}</td>
                    <td>{{ $transaction->category->name ?? '-' }}</td>
                    <td>
                        @if ($transaction->type == 'income')
                        <span class="badge" style="background-color:#669466; color:#ffffff; border:1px solid #b2e6b2;">Pemasukan</span>
                        @else
                        <span class="badge" style="background-color:#b6343f; color:#fffefe; border:1px solid #f1aeb5;">Pengeluaran</span>
                        @endif
                    </td>
                    <td>{{ $transaction->description ?? '-' }}</td>
                    <td>Rp{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data transaksi</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>

@include('pages.admin.laporan.modal-download')

@endsection

