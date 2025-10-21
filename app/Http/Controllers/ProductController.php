<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $title = 'Management Produk';
        return view('pages.product.index', compact('products', 'title'));
    }

    public function create()
    {
        $categories = Categories::all();
        $title = 'Form Tambah Produk';
        return view('pages.product.create', compact('categories', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required|numeric',
            'product_photo' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $photo = null;
        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('products', 'public');
        }

        Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'product_photo' => $photo,
            'is_active' => 1,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Categories::all();
        $title = 'Form Edit Produk';
        return view('pages.product.edit', compact('product', 'categories', 'title'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required|numeric',
        ]);

        if ($request->hasFile('product_photo')) {
            $photo = $request->file('product_photo')->store('products', 'public');
            $product->product_photo = $photo;
        }

        $product->update([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'is_active' => $request->is_active ?? 1,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
