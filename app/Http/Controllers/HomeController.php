<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Total pemasukan dari order yang sudah dibayar
        $totalPemasukan = Order::where('order_status', 'paid')->sum('order_amount');

        // Jumlah transaksi
        $jumlahTransaksi = Order::where('order_status', 'paid')->count();

        // Pemasukan hari ini
        $pemasukanHariIni = Order::where('order_status', 'paid')
            ->whereDate('order_date', Carbon::today())
            ->sum('order_amount');

        // Pemasukan bulan ini
        $pemasukanBulanIni = Order::where('order_status', 'paid')
            ->whereMonth('order_date', Carbon::now()->month)
            ->whereYear('order_date', Carbon::now()->year)
            ->sum('order_amount');

        // Data untuk chart (7 hari terakhir)
        $chartLabels = [];
        $chartData = [];

        $periode = collect(range(6, 0)); // 7 hari mundur
        foreach ($periode as $hari) {
            $tanggal = Carbon::today()->subDays($hari);
            $chartLabels[] = $tanggal->format('d M');
            $chartData[] = Order::where('order_status', 'paid')
                ->whereDate('order_date', $tanggal)
                ->sum('order_amount');
        }

        return view('pages.dashboard', compact(
            'totalPemasukan',
            'jumlahTransaksi',
            'pemasukanHariIni',
            'pemasukanBulanIni',
            'chartLabels',
            'chartData'
        ));
    }
}
