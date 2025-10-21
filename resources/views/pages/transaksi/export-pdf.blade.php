<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Daftar Transaksi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h3>Daftar Transaksi</h3>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($order->order_status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
