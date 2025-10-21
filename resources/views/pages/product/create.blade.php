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

                    {{-- form tambah produk --}}
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Nama Produk</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                id="product_name" name="product_name" value="{{ old('product_name') }}"
                                placeholder="Masukkan nama produk" required autofocus>
                            @error('product_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_price">Harga Produk</label>
                            <input type="number" class="form-control @error('product_price') is-invalid @enderror"
                                id="product_price" name="product_price" value="{{ old('product_price') }}"
                                placeholder="Masukkan harga produk">
                            @error('product_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_description">Deskripsi Produk</label>
                            <textarea class="form-control @error('product_description') is-invalid @enderror" id="product_description"
                                name="product_description" rows="3" placeholder="Masukkan deskripsi produk">{{ old('product_description') }}</textarea>
                            @error('product_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_photo">Foto Produk</label>
                            <input type="file" class="form-control @error('product_photo') is-invalid @enderror"
                                id="product_photo" name="product_photo">
                            @error('product_photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('products.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
