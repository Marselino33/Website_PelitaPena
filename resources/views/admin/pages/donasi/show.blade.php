@extends('admin.layouts.admin_master')

@section('title', $title)

@section('content')
<div class="container py-3">
    <div class="bg-white p-3 rounded shadow-sm">

        {{-- Header dan Tombol Kembali --}}
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
            <h4 class="fw-bold text-primary mb-0">
                <i class="bi bi-gift-fill me-2"></i> {{ $donation->title }}
            </h4>
            <a href="{{ route('admin.pages.donasi.index') }}" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>

        {{-- Deskripsi Donasi --}}
        <div class="mb-3">
            <h6 class="text-secondary fw-semibold mb-2">Deskripsi</h6>
            <div class="p-2 border rounded bg-light">
                <p class="mb-0">{{ $donation->description }}</p>
            </div>
        </div>

        {{-- QR Code --}}
        <div>
            <h6 class="text-secondary fw-semibold mb-2">QR Code</h6>
            <div class="p-2 border rounded bg-light text-center">
                @if($donation->qr_image)
                    <img src="{{ asset('storage/' . $donation->qr_image) }}" 
                         alt="QR Code" 
                         class="img-thumbnail rounded" 
                         style="max-width: 250px;">
                @else
                    <p class="text-muted mb-0">Tidak ada gambar QR.</p>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
