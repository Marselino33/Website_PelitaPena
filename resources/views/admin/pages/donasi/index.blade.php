@extends('admin.layouts.admin_master')

@section('title', $title)

@section('content')
<div class="container-fluid p-0">
    <div class="card shadow-sm border-0 rounded-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fw-bold">Daftar Donasi</h3>
            <a href="{{ route('admin.pages.donasi.create') }}" class="btn btn-primary px-4" style="background-color: #6c9aff; border-color: #5a8eff;">
                <i class="bx bx-plus me-1"></i> Tambah Donasi
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3 text-uppercase">ID</th>
                            <th class="py-3 text-uppercase">Judul Donasi</th>
                            <th class="py-3 text-uppercase">QR Code</th>
                            <th class="py-3 text-uppercase">Deskripsi</th>
                            <th class="py-3 text-uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                        <tr class="border-bottom">
                            <td class="py-3">{{ $donation->id }}</td>
                            <td class="py-3 fw-medium">{{ $donation->title }}</td>
                            <td class="py-3">
                                @if($donation->qr_image)
                                    <img src="{{ asset('storage/' . $donation->qr_image) }}" alt="QR Code" class="img-thumbnail" style="width:100px; height:100px; object-fit:contain;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="py-3">{{ \Illuminate\Support\Str::limit($donation->description, 50) }}</td>
                            <td class="py-3">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.pages.donasi.show', $donation->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bx bx-show me-1"></i> Lihat
                                    </a>
                                    <a href="{{ route('admin.pages.donasi.edit', $donation->id) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="bx bx-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.pages.donasi.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bx bx-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bx bx-donate-heart fs-1 text-muted opacity-50"></i>
                                <p class="mt-2 mb-0">Tidak ada donasi.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $donations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
    }
    
    .container-fluid {
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;
    }
    
    .card {
        border-radius: 0;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 0;
    }
    
    .btn-primary {
        border-radius: 8px;
    }
    
    .table th {
        font-weight: 600;
        color: #555;
        font-size: 13px;
        letter-spacing: 0.5px;
    }
    
    .table td {
        padding-top: 12px;
        padding-bottom: 12px;
    }
    
    .btn-sm {
        padding: 0.4rem 0.75rem;
        font-size: 0.85rem;
    }
    
    .btn-outline-primary {
        border-color: #6c9aff;
        color: #6c9aff;
    }
    
    .btn-outline-primary:hover {
        background-color: #6c9aff;
        border-color: #6c9aff;
    }
    
    .btn-outline-warning {
        border-color: #ffcc33;
        color: #ffcc33;
    }
    
    .btn-outline-warning:hover {
        background-color: #ffcc33;
        border-color: #ffcc33;
        color: #fff;
    }
    
    .btn-outline-danger {
        border-color: #ff3333;
        color: #ff3333;
    }
    
    .btn-outline-danger:hover {
        background-color: #ff3333;
        border-color: #ff3333;
    }
    
    .img-thumbnail {
        border-radius: 8px;
    }
    
    .alert {
        border-radius: 8px;
        border: none;
    }
    
    .pagination {
        justify-content: center;
    }
    
    /* Pastikan card mengambil lebar penuh */
    .content-wrapper, 
    .content, 
    .container-fluid, 
    .card {
        width: 100% !important;
    }
</style>
@endpush