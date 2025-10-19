<!DOCTYPE html>
<html>
<head>
    <title>Struk Barang Masuk</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        .header { text-align: center; font-weight: bold; font-size: 14px; }
        .items { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">STRUK BARANG MASUK</div>
    <table>
        <tr>
            <th>No Bukti</th>
            <td>{{ $barangMasuk->no_bukti }}</td>
        </tr>
        <tr>
            <th>Kode Supplier</th>
            <td>{{ $barangMasuk->supplier->kode_supplier ?? '-' }}</td>
        </tr>
        <tr>
            <th>Nama Supplier</th>
            <td>{{ $barangMasuk->supplier->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Gudang</th>
            <td>{{ $barangMasuk->gudang ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Terima</th>
            <td>{{ \Carbon\Carbon::parse($barangMasuk->tanggal_terima)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Surat Jalan</th>
            <td>{{ $barangMasuk->surat_jalan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $barangMasuk->status }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $barangMasuk->keterangan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Input</th>
            <td>{{ $barangMasuk->created_at->format('d-m-Y H:i') }}</td>
        </tr>
    </table>

    <div class="items">
        <strong>Detail Barang:</strong>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Order</th>
                    <th>Jumlah Terima</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangMasuk->details as $i => $detail)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $detail->nama_barang }}</td>
                    <td>{{ $detail->jumlah_order }}</td>
                    <td>{{ $detail->jumlah_terima }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
