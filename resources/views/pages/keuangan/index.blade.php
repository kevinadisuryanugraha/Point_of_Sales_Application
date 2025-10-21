@extends('app')
@section('title', $title)

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">{{ $title }}</h3>

        {{-- Filter tanggal --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('keuangan.index') }}" class="btn btn-success">
                    Refresh
                </a>
                <a href="{{ route('keuangan.exportPdf', ['start_date' => $startDate, 'end_date' => $endDate]) }}"
                    class="btn btn-danger">
                    Export PDF
                </a>
            </div>
        </form>

        {{-- Ringkasan --}}
        <div class="alert alert-success">
            <strong>Total Pemasukan:</strong> Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
        </div>

        {{-- Tabel transaksi --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->order_code }}</td>
                                <td>{{ $order->order_date }}</td>
                                <td>Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Chart --}}
        <div class="card shadow-sm mt-4">
            <div class="card-body">
                <h5 class="card-title">Grafik Pemasukan</h5>
                <canvas id="keuanganChart" height="120"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('keuanganChart').getContext('2d');

        const labels = @json($orders->pluck('order_date'));
        const data = @json($orders->pluck('order_amount'));

        new Chart(ctx, {
            type: 'line', // Bisa diganti 'bar'
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: data,
                    fill: true,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 0.3,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
@endpush
