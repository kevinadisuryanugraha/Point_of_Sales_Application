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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="card-title">Daftar {{ $title }}</h4>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                            + Tambah Kategori
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $row->category_name }}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $row->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>

                                            <form id="delete-form-{{ $row->id }}"
                                                action="{{ route('categories.destroy', $row->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteConfirmation({{ $row->id }})">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada kategori</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data kategori akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    icon: 'swal2-icon-margin',
                    title: 'swal2-title-dark',
                    popup: 'swal2-popup-rounded'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        // ✅ SweetAlert untuk create / update / delete
        @if (session('Berhasil'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('Berhasil') }}",
                showConfirmButton: false,
                timer: 2000
            })
        @endif
    </script>


    <style>
        /* Tambahan styling supaya lebih rapi */
        .swal2-icon.swal2-warning.swal2-icon-margin {
            margin-top: 50px !important;
            /* kasih jarak biar ga mepet */
        }

        .swal2-title-dark {
            color: #333 !important;
            margin-top: -30px !important;
            /* judul jadi hitam, jelas terbaca */
            font-size: 20px;
            font-weight: 600;
        }

        .swal2-popup-rounded {
            border-radius: 12px;
            /* biar lebih modern */
        }
    </style>
@endpush
