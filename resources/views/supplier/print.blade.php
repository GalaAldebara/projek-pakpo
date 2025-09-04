<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Order</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        .text-right { text-align: right; }
        .no-border { border: none; }
    </style>
</head>
<body onload="window.print()">
    <h3 style="text-align:center;">PURCHASE ORDER CV. SEJAHTERA</h3>
    <p>
        <strong>No.PO:</strong> {{ $laporan->no_bukti }} <br>
        <strong>Tanggal:</strong> {{ $laporan->created_at->format('d-m-Y') }} <br>
        <strong>Supplier:</strong> {{ $laporan->supplier->nama_supplier }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama }}<br>{{ $item->kode }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }} {{ $item->satuan }}</td>
                <td class="text-right">{{ number_format($item->harga, 2, ',', '.') }}</td>
                <td class="text-right">{{ number_format($item->total, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table style="margin-top:10px; width:50%; float:right;">
        <tr>
            <td class="no-border text-right">SUBTOTAL</td>
            <td class="text-right">{{ number_format($subtotal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="no-border text-right">DISCOUNT</td>
            <td class="text-right">{{ number_format(($subtotal * $discount) / 100, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="no-border text-right">PPN {{ $ppn }}%</td>
            <td class="text-right">{{ number_format(($subtotal * $ppn) / 100, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="no-border text-right">TOTAL</td>
            <td class="text-right">{{ number_format($grandTotal, 2, ',', '.') }}</td>
        </tr>
    </table>

    <div style="margin-top:80px; text-align:center;">
        <table style="width:100%; border:none;">
            <tr>
                <td class="no-border">Perjualan</td>
                <td class="no-border">Accounting</td>
                <td class="no-border">Mengetahui</td>
            </tr>
            <tr>
                <td class="no-border">(...................)</td>
                <td class="no-border">(...................)</td>
                <td class="no-border">(...................)</td>
            </tr>
        </table>
    </div>
</body>
</html>
