@extends('app')
@section('title', $title)

@section('content')
    <div class="container d-flex justify-content-center mt-4">
        <div class="receipt shadow-lg p-4 bg-white rounded-3" style="max-width: 460px; width: 100%; border: 1px solid #ddd;">

            <!-- Header -->
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark mb-1">🛒 MA-VINS POS</h3>
                <p class="mb-0 text-muted small">Jl. Contoh No. 123, Jakarta</p>
                <p class="mb-0 text-muted small">Telp: 0812-3456-7890</p>
            </div>

            <hr class="border-dashed mb-3">

            <!-- Info Transaksi -->
            <div class="mb-3">
                <div class="d-flex justify-content-between small mb-1">
                    <span class="fw-semibold">No Transaksi</span>
                    <span>{{ $order->order_code }}</span>
                </div>
                <div class="d-flex justify-content-between small mb-1">
                    <span class="fw-semibold">Kasir</span>
                    <span>{{ $order->user->name }}</span>
                </div>
                <div class="d-flex justify-content-between small mb-1">
                    <span class="fw-semibold">Tanggal</span>
                    <span>{{ $order->order_date }}</span>
                </div>
                <div class="d-flex justify-content-between small">
                    <span class="fw-semibold">Status Pembayaran</span>
                    @if ($order->order_status == 'paid')
                        <span class="badge bg-success">LUNAS</span>
                    @else
                        <span class="badge bg-danger">BELUM BAYAR</span>
                    @endif
                </div>
            </div>

            <hr class="border-dashed mb-3">

            <!-- Detail Item -->
            <table class="table table-sm receipt-table mb-3">
                <thead class="border-bottom text-dark">
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $detail)
                        <tr>
                            <td>{{ $detail->product->product_name }}</td>
                            <td class="text-center">{{ $detail->qty }}</td>
                            <td class="text-end">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr class="border-dashed mb-3">

            <!-- Total -->
            <div class="d-flex justify-content-between align-items-center fw-bold fs-5 text-dark mb-3">
                <span>Total</span>
                <span class="text-success">Rp {{ number_format($order->order_amount, 0, ',', '.') }}</span>
            </div>

            <hr class="border-dashed mb-3">

            <!-- Footer -->
            <div class="text-center">
                <p class="small text-muted mb-1 fst-italic">Terima kasih sudah berbelanja 🙏</p>
                <p class="small fw-semibold mb-0">MA-VINS Point of Sales</p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center flex-wrap gap-3 mt-4 no-print">

                @if ($order->order_status != 'paid')
                    <form action="{{ route('orders.markPaid', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-md action-btn">
                            <i class="mdi mdi-check-circle me-1"></i> Tandai Lunas
                        </button>
                    </form>
                @endif

                <button onclick="window.print()" class="btn btn-primary btn-md action-btn">
                    <i class="mdi mdi-printer me-1"></i> Cetak Struk
                </button>

                <a href="{{ url()->previous() }}" onclick="event.preventDefault(); window.history.back();"
                    class="btn btn-outline-secondary btn-md action-btn">
                    <i class="mdi mdi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <style>
        .action-btn {
            border-radius: 8px;
            margin: 8px;
            padding: 8px 16px;
            font-weight: 500;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease-in-out;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .border-dashed {
            border-top: 1px dashed #aaa;
        }

        .receipt {
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            color: #333;
        }

        .receipt-table th,
        .receipt-table td {
            font-size: 13px;
            padding: 6px 4px;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .receipt,
            .receipt * {
                visibility: visible;
            }

            .receipt {
                margin: 0 auto;
                border: none !important;
                box-shadow: none !important;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
@endsection
