<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
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
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>{{ $title }}</h2>

    @if ($startDate && $endDate)
        <p>Periode: {{ $startDate }} s/d {{ $endDate }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $order->order_date }}</td>
                    <td>Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right; margin-top: 20px;">
        Total Pemasukan: Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
    </h3>
</body>

</html>
