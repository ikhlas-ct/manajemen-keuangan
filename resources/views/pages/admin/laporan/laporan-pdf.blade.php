<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        th {
            font-weight: bold;
        }

        .summary-table {
            margin-top: 30px;
            width: 50%;
            border-collapse: collapse;
            float: right;
        }

        .summary-table td {
            border: 1px solid black;
            padding: 8px;
            font-size: 14px;
        }

        .signature {
            margin-top: 100px;
            text-align: right;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h2>LAPORAN KEUANGAN</h2>
    <h4>Periode: Oktober 2025</h4>

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
            <tr>
                <td>1</td>
                <td>01/10/2025</td>
                <td>Pembayaran proyek A</td>
                <td>Pemasukan</td>
                <td>5.000.000</td>
                <td>Pemasukan</td>
            </tr>
            <tr>
                <td>2</td>
                <td>10/10/2025</td>
                <td>Pembelian peralatan</td>
                <td>Pengeluaran</td>
                <td>1.500.000</td>
                <td>Pengeluaran</td>
            </tr>
            <tr>
                <td>3</td>
                <td>18/10/2025</td>
                <td>Pembayaran jasa klien B</td>
                <td>Pemasukan</td>
                <td>3.500.000</td>
                <td>Pemasukan</td>
            </tr>
            <tr>
                <td>4</td>
                <td>25/10/2025</td>
                <td>Biaya operasional</td>
                <td>Pengeluaran</td>
                <td>750.000</td>
                <td>Pengeluaran</td>
            </tr>
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td><strong>Total Pemasukan</strong></td>
            <td>Rp 8.500.000</td>
        </tr>
        <tr>
            <td><strong>Total Pengeluaran</strong></td>
            <td>Rp 2.250.000</td>
        </tr>
        <tr>
            <td><strong>Saldo Akhir</strong></td>
            <td><strong>Rp 6.250.000</strong></td>
        </tr>
    </table>

    <div style="clear: both;"></div>

    <div class="signature">
        <p>Mengetahui,</p>
        <p style="margin-top: 60px;"><strong>Manajer Keuangan</strong></p>
    </div>
</body>
</html>
