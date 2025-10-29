@extends('layouts.app')

{{-- ==================== PAGE TITLE ==================== --}}
@section('title','Laporan Keuangan')

{{-- ==================== STYLES ==================== --}}
@section('styles')
@endsection

{{-- ==================== CONTENT ==================== --}}
@section('content')
<div class="page-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Laporan Keuangan</h4>
    <button class="btn btn-primary" data-toggle="modal" data-target="#downloadModal">
      <i class="mdi mdi-download me-1"></i> Unduh Laporan
    </button>
    {{-- <a href="{{ url('/laporan/pdf') }}" target="_blank" class="btn btn-primary">
        <i class="mdi mdi-download me-1"></i> Unduh Laporan --}}
    </a>

  </div>

  {{-- Ringkasan Keuangan --}}
  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h6 class="fw-semibold text-muted">Total Pemasukan</h6>
          <h4 class="fw-bold text-success">Rp 12.500.000</h4>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h6 class="fw-semibold text-muted">Total Pengeluaran</h6>
          <h4 class="fw-bold text-danger">Rp 8.250.000</h4>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-body text-center">
          <h6 class="fw-semibold text-muted">Saldo Akhir</h6>
          <h4 class="fw-bold text-primary">Rp 4.250.000</h4>
        </div>
      </div>
    </div>
  </div>

  {{-- Grafik --}}
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
      <h6 class="fw-semibold mb-3">Grafik Keuangan Bulanan</h6>
      <canvas id="chartLaporan" height="120"></canvas>
    </div>
  </div>

  {{-- Tabel Transaksi --}}
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h6 class="fw-semibold mb-3">Detail Transaksi</h6>
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kategori</th>
              <th>Jenis</th>
              <th>Deskripsi</th>
              <th>Jumlah (Rp)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>01-10-2025</td>
              <td>Penjualan</td>
              <td><span class="badge bg-success">Pemasukan</span></td>
              <td>Penjualan Produk A</td>
              <td>2.000.000</td>
            </tr>
            <tr>
              <td>2</td>
              <td>05-10-2025</td>
              <td>Operasional</td>
              <td><span class="badge bg-danger">Pengeluaran</span></td>
              <td>Pembelian bahan baku</td>
              <td>1.500.000</td>
            </tr>
            <tr>
              <td>3</td>
              <td>10-10-2025</td>
              <td>Penjualan</td>
              <td><span class="badge bg-success">Pemasukan</span></td>
              <td>Penjualan Produk B</td>
              <td>3.000.000</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

{{-- Modal Filter Unduh Laporan --}}
@include('pages.admin.laporan.modal-download')

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('chartLaporan');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
      datasets: [
        {
          label: 'Pemasukan',
          data: [1200000, 1500000, 1800000, 1600000, 2000000, 2500000],
          backgroundColor: 'rgba(75, 192, 192, 0.6)'
        },
        {
          label: 'Pengeluaran',
          data: [800000, 1000000, 950000, 1100000, 900000, 1200000],
          backgroundColor: 'rgba(255, 99, 132, 0.6)'
        }
      ]
    },
    options: {
      responsive: true,
      scales: { y: { beginAtZero: true } }
    }
  });
</script>
@endpush
