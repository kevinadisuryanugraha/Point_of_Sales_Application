<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Daftar Pesanan';
        $orders = Order::with('details.product', 'user')->get();
        $search = $request->get('search');

        $products = Product::query()
            ->where('is_active', 1)
            ->when($search, function ($query, $search) {
                $query->where('product_name', 'LIKE', "%{$search}%");
            })
            ->get();

        return view('pages.orders.index', compact('orders', 'products', 'title'));
    }

    public function store(Request $request)
    {
        // Log semua input untuk debug
        Log::info('Order Store Request:', $request->all());

        try {
            $request->validate([
                'products' => 'required|string',
                'order_amount' => 'required|numeric|min:1',
                'order_change' => 'nullable|numeric|min:0',
            ]);

            // Validasi JSON
            $productsData = json_decode($request->products, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Format produk tidak valid');
            }

            if (empty($productsData)) {
                throw new \Exception('Keranjang kosong');
            }

            DB::beginTransaction();

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_code' => 'ORD-' . time() . '-' . Auth::id(),
                'order_date' => now(),
                'order_amount' => $request->order_amount,
                'order_change' => $request->order_change ?? 0,
                'order_status' => 'unpaid',
            ]);

            foreach ($productsData as $item) {
                if (!isset($item['product_id'], $item['qty'], $item['price'])) {
                    throw new \Exception('Data produk tidak lengkap');
                }

                $product = Product::find($item['product_id']);
                if (!$product) {
                    throw new \Exception("Produk dengan ID {$item['product_id']} tidak ditemukan");
                }

                $subtotal = $item['qty'] * $product->product_price;

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $product->product_price,
                    'subtotal' => $subtotal,
                ]);
            }

            DB::commit();

            return redirect()->route('orders.invoice', $order->id)
                ->with('success', 'Order berhasil dibuat!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Store Error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Gagal membuat order: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $order = Order::with('details.product', 'user')->findOrFail($id);
        return view('pages.orders.show', compact('order'));
    }

    public function invoice($id)
    {
        $title = 'Struk Pembayaran';
        $order = Order::with('details.product', 'user')->findOrFail($id);
        return view('pages.orders.invoice', compact('order', 'title'));
    }

    public function markAsPaid($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['order_status' => 'paid']);

        return redirect()->route('orders.invoice', $order->id)
            ->with('success', 'Pesanan sudah ditandai sebagai LUNAS.');
    }
}
