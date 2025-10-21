<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // asumsi pakai model Order
use Barryvdh\DomPDF\Facade\Pdf;

class KeuanganController extends Controller
{
    /**
     * Tampilkan laporan keuangan.
     */
    public function index(Request $request)
    {
        // Ambil filter tanggal (opsional)
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $query = Order::where('order_status', 'paid');

        if ($startDate && $endDate) {
            $query->whereBetween('order_date', [$startDate, $endDate]);
        }

        $orders = $query->orderBy('order_date', 'desc')->get();

        // Hitung total pemasukan
        $totalPemasukan = $orders->sum('order_amount');

        return view('pages.keuangan.index', [
            'title'          => 'Laporan Keuangan',
            'orders'         => $orders,
            'totalPemasukan' => $totalPemasukan,
            'startDate'      => $startDate,
            'endDate'        => $endDate,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');

        $query = Order::where('order_status', 'paid');

        if ($startDate && $endDate) {
            $query->whereBetween('order_date', [$startDate, $endDate]);
        }

        $orders = $query->orderBy('order_date', 'desc')->get();
        $totalPemasukan = $orders->sum('order_amount');

        $pdf = PDF::loadView('pages.keuangan.pdf', [
            'title'          => 'Laporan Keuangan',
            'orders'         => $orders,
            'totalPemasukan' => $totalPemasukan,
            'startDate'      => $startDate,
            'endDate'        => $endDate,
        ])->setPaper('A4', 'portrait');

        return $pdf->download('laporan_keuangan.pdf');
    }
}
