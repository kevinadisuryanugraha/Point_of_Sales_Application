<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Categories::all();
        $title = 'Kategori Produk';

        return view('pages.kategori.index', compact('title', 'datas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie = Categories::all();
        $title = 'Tambah Kategori Produk';
        return view('pages.kategori.create', compact('title', 'categorie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categories::create([
            'category_name' => $request->category_name
        ]);

        return redirect()->route('categories.index')->with('Berhasil', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Categories::find($id);
        $title = 'Ubah Kategori Produk';
        return view('pages.kategori.edit', compact('edit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = ([
            'category_name' => ['required']
        ]);

        $validators = Validator::make($request->all(), $rules);

        if ($validators->fails()) {
            return back()->withErrors($validators)->withInput();
        }

        $data = [
            'category_name' => $request->category_name
        ];

        Categories::where('id', $id)->update($data);
        return redirect()->route('categories.index')->with('Berhasil', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Categories::find($id);
        $location->delete();
        return redirect()->route('categories.index')->with('Berhasil', 'Kategori berhasil dihapus!');
    }
}
