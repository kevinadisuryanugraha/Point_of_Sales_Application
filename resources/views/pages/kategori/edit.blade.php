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
                    <a href="{{ route('categories.index') }}">Kategori Produk</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $title }}
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8 grid-margin stretch-card">
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

                    {{-- form edit kategori --}}
                    <form action="{{ route('categories.update', $edit->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="category_name">Nama Kategori</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                id="category_name" name="category_name"
                                value="{{ old('category_name', $edit->category_name) }}"
                                placeholder="Masukkan nama kategori">

                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
