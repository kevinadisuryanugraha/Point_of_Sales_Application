@extends('app')
@section('title', $title)
@section('content')
    <div class="page-header">
        <h3 class="page-title">{{ $title }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('products.index') }}">Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $title }}
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>

                    {{-- tampilkan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- form edit produk --}}
                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Produk --}}
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                id="product_name" name="product_name"
                                value="{{ old('product_name', $product->product_name) }}"
                                placeholder="Masukkan nama produk">
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Harga Produk --}}
                        <div class="form-group">
                            <label for="product_price">Harga</label>
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror"
                                id="product_price" name="product_price"
                                value="{{ old('product_price', $product->product_price) }}"
                                placeholder="Masukkan harga produk">
                            @error('product_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stock Awal / Stock Saat Ini --}}
                        <div class="form-group">
                            <label for="stock_awal">Stock</label>
                            <input type="number" class="form-control @error('stock_awal') is-invalid @enderror"
                                id="stock_awal" name="stock_awal"
                                value="{{ old('stock_awal', $product->stock->stock_balance ?? 0) }}" min="0"
                                placeholder="Masukkan stock produk">
                            @error('stock_awal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status Produk --}}
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select class="form-control @error('is_active') is-invalid @enderror" id="is_active"
                                name="is_active">
                                <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>
                                    Nonaktif</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Foto Produk --}}
                        <div class="form-group">
                            <label for="product_photo">Foto Produk</label><br>
                            @if ($product->product_photo)
                                <img src="{{ asset('storage/' . $product->product_photo) }}" alt="Foto Produk"
                                    class="mb-2" width="100">
                            @endif
                            <input type="file" class="form-control @error('product_photo') is-invalid @enderror"
                                id="product_photo" name="product_photo">
                            @error('product_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
