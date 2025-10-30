<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
            color: #333;
            font-size: 14px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: 1px;
        }
        .header h4 {
            margin-top: 5px;
            font-weight: normal;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px 6px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .summary {
            margin-top: 40px;
            width: 50%;
            float: right;
        }
        .summary table {
            border-collapse: collapse;
            width: 100%;
        }
        .summary td {
            border: 1px solid #444;
            padding: 8px;
        }
        .summary tr:nth-child(odd) {
            background-color: #f7f7f7;
        }
        .summary td:first-child {
            font-weight: bold;
        }

        .chart-section {
            clear: both;
            margin-top: 50px;
        }
        .chart-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .bar {
            height: 22px;
            color: white;
            font-weight: bold;
            text-align: right;
            padding-right: 6px;
            border-radius: 4px;
        }
        .bar-income {
            background-color: #2e7d32;
        }
        .bar-expense {
            background-color: #c62828;
        }

        .signature {
            margin-top: 100px;
            text-align: right;
            font-size: 14px;
        }
        .signature p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ strtoupper($judul) }}</h2>
        <h4>Periode: {{ $periode }}</h4>
    </div>
    @php
        $totalPemasukan = $data->where('type', 'income')->sum('amount');
        $totalPengeluaran = $data->where('type', 'expense')->sum('amount');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;
    @endphp

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Nominal (Rp)</th>
                <th>Jenis</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                <td style="text-align: left;">{{ $item->description }}</td>
                <td>{{ $item->category->name ?? '-' }}</td>
                <td style="text-align: right;">{{ number_format($item->amount, 0, ',', '.') }}</td>
                <td>{{ $item->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Tidak ada data transaksi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <table>
            <tr>
                <td>Total Pemasukan</td>
                <td style="text-align: right;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pengeluaran</td>
                <td style="text-align: right;">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Saldo Akhir</strong></td>
                <td style="text-align: right;"><strong>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="chart-section">
        <div class="chart-title">Grafik Perbandingan Pemasukan & Pengeluaran</div>

        <div style="margin-bottom:8px;">Pemasukan</div>
        <div style="background:#e0e0e0; border-radius:5px; height:25px;">
            <div style="width: {{ $totalPemasukan > 0 ? min(($totalPemasukan / max($totalPemasukan, $totalPengeluaran)) * 100, 100) : 0 }}%;
                        background:#2e7d32; height:100%; border-radius:5px; text-align:right; color:white; padding-right:6px;">
                Rp {{ number_format($totalPemasukan,0,',','.') }}
            </div>
        </div>

        <div style="margin:12px 0 8px 0;">Pengeluaran</div>
        <div style="background:#e0e0e0; border-radius:5px; height:25px;">
            <div style="width: {{ $totalPengeluaran > 0 ? min(($totalPengeluaran / max($totalPemasukan, $totalPengeluaran)) * 100, 100) : 0 }}%;
                        background:#c62828; height:100%; border-radius:5px; text-align:right; color:white; padding-right:6px;">
                Rp {{ number_format($totalPengeluaran,0,',','.') }}
            </div>
        </div>
    </div>

    <div class="signature">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>Manajer Keuangan</strong></p>
    </div>

</body>
</html>
