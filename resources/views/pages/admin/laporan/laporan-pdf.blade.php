<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        /* ===== Reset dasar ===== */
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        h2, h4 {
            margin: 0;
            padding: 0;
        }

        /* ===== Header ===== */
        .header {
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .header h2 {
            color: #0d6efd;
            font-weight: bold;
        }

        .header p {
            font-size: 12px;
            color: #666;
        }

        /* ===== Tabel Laporan ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* ===== Ringkasan ===== */
        .summary {
            margin-top: 20px;
            text-align: right;
        }

        .summary h4 {
            color: #0d6efd;
        }

        /* ===== Footer ===== */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <h2>Laporan Keuangan</h2>
        <p>Periode: Januari - Maret 2025</p>
    </div>

    {{-- ISI LAPORAN --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Tipe Transaksi</th>
                <th>Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            {{-- Data statis sementara (dummy) --}}
            <tr>
                <td>1</td>
                <td>01/01/2025</td>
                <td>Penjualan Produk A</td>
                <td>Penjualan</td>
                <td><span style="color:green;">Pemasukan</span></td>
                <td>5.000.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td>05/01/2025</td>
                <td>Pembelian Bahan Baku</td>
                <td>Operasional</td>
                <td><span style="color:red;">Pengeluaran</span></td>
                <td>1.500.000</td>
            </tr>
            <tr>
                <td>3</td>
                <td>10/01/2025</td>
                <td>Perawatan Mesin</td>
                <td>Maintenance</td>
                <td><span style="color:red;">Pengeluaran</span></td>
                <td>750.000</td>
            </tr>
            <tr>
                <td>4</td>
                <td>12/01/2025</td>
                <td>Penjualan Produk B</td>
                <td>Penjualan</td>
                <td><span style="color:green;">Pemasukan</span></td>
                <td>3.500.000</td>
            </tr>
        </tbody>
    </table>

    {{-- RINGKASAN --}}
    <div class="summary">
        <h4>Total Pemasukan: Rp 8.500.000</h4>
        <h4>Total Pengeluaran: Rp 2.250.000</h4>
        <h4><strong>Saldo Akhir: Rp 6.250.000</strong></h4>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <p>Dicetak otomatis oleh sistem pada: {{ date('d/m/Y H:i') }}</p>
    </div>

</body>
</html>
