@extends('layouts.app')

{{-- ==================== PAGE TITLE ==================== --}}
@section('title','Dashboard Keuangan')

{{-- ==================== CONTENT ==================== --}}
@section('content')
<div class="col-lg-12 grid-margin stretch-card mx-auto">
  <div class="card shadow-sm">
    <div class="card-body">

      {{-- Header --}}
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h4 class="card-title fw-bold mb-1">Dashboard Keuangan</h4>
          <p class="card-description mb-0">Ringkasan kondisi keuangan perusahaan secara keseluruhan.</p>
        </div>
      </div>

      {{-- ====== RINGKASAN KEUANGAN ====== --}}
      <div class="row mb-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
              <h6 class="text-muted mb-2">Total Pemasukan</h6>
              <h3 class="fw-bold text-success">Rp {{ number_format($TotalPemasukan, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
              <h6 class="text-muted mb-2">Total Pengeluaran</h6>
              <h3 class="fw-bold text-danger">Rp {{ number_format($TotalPengeluaran, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
              <h6 class="text-muted mb-2">Saldo Akhir</h6>
              <h3 class="fw-bold text-primary">Rp {{ number_format($SaldoAkhir, 0, ',', '.') }}</h3>
            </div>
          </div>
        </div>
      </div>

      {{-- ====== GRAFIK KEUANGAN ====== --}}
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          <h5 class="card-title mb-3">Grafik Keuangan Bulanan</h5>
          <canvas id="financeChart" height="100"></canvas>
        </div>
      </div>

    {{-- ====== TABEL TRANSAKSI TERBARU ====== --}}
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-body">
        <h5 class="card-title mb-3">Transaksi Terbaru</h5>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr class="text-center">
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Nominal</th>
                <th>Jenis</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transaksiTerbaru as $item)
                <tr class="text-center">
                  <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                  <td>{{ $item->description ?? '-' }}</td>
                  <td>{{ $item->category->name ?? '-' }}</td>
                  <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                  <td>
                    @if ($item->type === 'income')
                      <span class="badge bg-success">Pemasukan</span>
                    @else
                      <span class="badge bg-danger">Pengeluaran</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">Belum ada transaksi terbaru</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>


      {{-- ====== INFORMASI / CATATAN ====== --}}
      <div class="alert alert-info mt-4 mb-0">
        <i class="bi bi-info-circle"></i> Laporan keuangan bulan Oktober 2025 telah diperbarui.
        <a href="{{ url('/laporan') }}" class="alert-link">Lihat Laporan Lengkap</a>
      </div>
 
    </div>
  </div>
</div>
@endsection

{{-- ==================== SCRIPT GRAFIK ==================== --}}


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- <script>
  const ctx = document.getElementById('financeChart').getContext('2d');

  // Data dari Controller
  const grafikData = @json($grafik);

  // Ambil nama bulan
  const bulanLabels = grafikData.map(item => {
    const bulan = parseInt(item.bulan);
    const namaBulan = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return namaBulan[bulan - 1];
  });

  // Ambil total pemasukan dan pengeluaran
  const pemasukanData = grafikData.map(item => parseFloat(item.total_pemasukan));
  const pengeluaranData = grafikData.map(item => parseFloat(item.total_pengeluaran));

  // Buat grafik
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: bulanLabels,
      datasets: [
        {
          label: 'Pemasukan',
          data: pemasukanData,
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        },
        {
          label: 'Pengeluaran',
          data: pengeluaranData,
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          },
          title: {
            display: true,
            text: 'Jumlah (Rp)'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Bulan'
          }
        }
      },
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Pemasukan dan Pengeluaran Tahun {{ date("Y") }}'
        }
      }
    }
  });
</script> --}}

{{-- <script>
  const ctx = document.getElementById('financeChart').getContext('2d');

  // Data dari Controller (Laravel -> JSON)
  const grafikData = @json($grafik);

  // Ambil tanggal (hari) dari data grafik
  const hariLabels = grafikData.map(item => {
    return 'Tanggal ' + item.hari; // tampil di label X
  });

  // Ambil total pemasukan dan pengeluaran
  const pemasukanData = grafikData.map(item => parseFloat(item.total_pemasukan));
  const pengeluaranData = grafikData.map(item => parseFloat(item.total_pengeluaran));

  // Buat grafik
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: hariLabels,
      datasets: [
        {
          label: 'Pemasukan',
          data: pemasukanData,
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        },
        {
          label: 'Pengeluaran',
          data: pengeluaranData,
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          },
          title: {
            display: true,
            text: 'Jumlah (Rp)'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Hari dalam Bulan {{ date("F") }}'
          }
        }
      },
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Grafik Pemasukan dan Pengeluaran Bulan {{ date("F Y") }}'
        }
      }
    }
  });
</script> --}}

{{-- <script>
  const ctx = document.getElementById('financeChart').getContext('2d');

  // Ambil data dari controller
  const grafikData = @json($grafik);

  // Label = tanggal (hari ke-...)
  const hariLabels = grafikData.map(item => `Tanggal ${item.hari}`);

  const pemasukanData = grafikData.map(item => parseFloat(item.total_pemasukan));
  const pengeluaranData = grafikData.map(item => parseFloat(item.total_pengeluaran));

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: hariLabels,
      datasets: [
        {
          label: 'Pemasukan',
          data: pemasukanData,
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        },
        {
          label: 'Pengeluaran',
          data: pengeluaranData,
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: value => 'Rp ' + value.toLocaleString('id-ID')
          },
          title: {
            display: true,
            text: 'Jumlah (Rp)'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Tanggal'
          }
        }
      },
      plugins: {
        legend: { position: 'top' },
        title: {
          display: true,
          text: 'Grafik Keuangan Harian Bulan ' + new Date().toLocaleString('id-ID', { month: 'long', year: 'numeric' })
        }
      }
    }
  });
</script> --}}

<script>
  const ctx = document.getElementById('financeChart').getContext('2d');

  const grafikData = @json($grafik);

  // Label hari (misal: 1, 2, 3, dst)
  const hariLabels = grafikData.map(item => item.hari);

  const pemasukanData = grafikData.map(item => parseFloat(item.total_pemasukan));
  const pengeluaranData = grafikData.map(item => parseFloat(item.total_pengeluaran));

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: hariLabels,
      datasets: [
        {
          label: 'Pemasukan',
          data: pemasukanData,
          backgroundColor: 'rgba(75, 192, 192, 0.7)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        },
        {
          label: 'Pengeluaran',
          data: pengeluaranData,
          backgroundColor: 'rgba(255, 99, 132, 0.7)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          },
          title: {
            display: true,
            text: 'Jumlah (Rp)'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Hari dalam Bulan Ini'
          }
        }
      },
      plugins: {
        legend: { position: 'top' },
        title: {
          display: true,
          text: 'Grafik Pemasukan dan Pengeluaran Bulan ' + new Date().toLocaleString('id-ID', { month: 'long', year: 'numeric' })
        }
      }
    }
  });
</script>




