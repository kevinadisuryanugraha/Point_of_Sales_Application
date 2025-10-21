<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Tampilkan daftar transaksi
     */
    public function index()
    {
        $orders = Order::with(['user', 'details.product'])
            ->orderBy('order_date', 'desc')
            ->paginate(10);

        $title = "Daftar Transaksi";

        return view('pages.transaksi.index', compact('orders', 'title'));
    }

    /**
     * Tampilkan detail transaksi
     */
    public function show($id)
    {
        // Ambil transaksi berdasarkan id + relasi user & detail produk
        $order = Order::with(['user', 'details.product'])->findOrFail($id);

        $title = "Detail Transaksi #" . $order->order_code;

        return view('pages.transaksi.show', compact('order', 'title'));
    }

    public function exportPdf()
    {
        $orders = Order::with(['user', 'details.product'])
            ->orderBy('order_date', 'desc')
            ->get();

        $pdf = PDF::loadView('pages.transaksi.export-pdf', compact('orders'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('daftar-transaksi.pdf');
    }
}
