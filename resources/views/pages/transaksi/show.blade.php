@extends('app')
@section('title', $title)

@section('content')
    <div class="container py-4">
        <div class="card shadow-lg border-0 rounded-3">
            <!-- Header -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="mdi mdi-receipt-text"></i> Detail Transaksi</h5>
                <span class="small">#{{ $order->order_code }}</span>
            </div>

            <!-- Body -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Kasir:</strong> {{ $order->user->name }}</p>
                        <p><strong>Tanggal:</strong> {{ $order->order_date }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><strong>Status:</strong>
                            @if ($order->order_status == 'paid')
                                <span class="badge bg-success px-3 py-2">Lunas</span>
                            @else
                                <span class="badge bg-danger px-3 py-2">Belum Bayar</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Tabel Produk -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $detail)
                                <tr>
                                    <td>{{ $detail->product->product_name }}</td>
                                    <td class="text-center">{{ $detail->qty }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                    <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th class="text-end text-primary fw-bold">
                                    Rp {{ number_format($order->order_amount, 0, ',', '.') }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
                    <i class="mdi mdi-arrow-left"></i> Kembali
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="mdi mdi-printer"></i> Cetak Struk
                </button>
            </div>
        </div>
    </div>
@endsection
