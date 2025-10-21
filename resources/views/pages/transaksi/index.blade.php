@extends('app')
@section('title', $title)

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">{{ $title }}</h3>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('transaksi.exportPdf') }}" class="btn btn-danger me-2">
                <i class="mdi mdi-file-pdf"></i> Export PDF
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Kasir</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>
                                    @if ($order->order_status == 'paid')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.show', $order->id) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="mdi mdi-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-warning">
                                        <i class="mdi mdi-file-document"></i> Invoice
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
