@extends('app')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        {{-- Total Pemasukan --}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h3>
                            <h6 class="text-muted">Total Pemasukan</h6>
                        </div>
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-cash-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Jumlah Transaksi --}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">{{ $jumlahTransaksi }}</h3>
                            <h6 class="text-muted">Jumlah Transaksi</h6>
                        </div>
                        <div class="icon icon-box-info">
                            <span class="mdi mdi-cash-register"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pemasukan Hari Ini --}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Rp {{ number_format($pemasukanHariIni, 0, ',', '.') }}</h3>
                            <h6 class="text-muted">Pemasukan Hari Ini</h6>
                        </div>
                        <div class="icon icon-box-primary">
                            <span class="mdi mdi-calendar-today icon-item"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pemasukan Bulan Ini --}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="mb-0">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h3>
                            <h6 class="text-muted">Pemasukan Bulan Ini</h6>
                        </div>
                        <div class="icon icon-box-warning">
                            <span class="mdi mdi-calendar-month icon-item"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart Transaksi --}}
    <div class="row mt-4">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Grafik Transaksi</h4>
                    <canvas id="transactionChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('transactionChart').getContext('2d');
        const labels = @json($chartLabels);
        const data = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
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
