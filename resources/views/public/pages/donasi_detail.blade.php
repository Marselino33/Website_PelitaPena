@extends('public.layouts.public_master')

@section('title', $title)

@section('content')
<div class="container my-4">
    <h1>{{ $donation->title }}</h1>
    <div class="card">
        <div class="card-body">
            <p>{{ $donation->description }}</p>
            <hr>
            <h5>Scan QR Code</h5>
            @if($donation->qr_image)
                <img src="{{ asset('storage/' . $donation->qr_image) }}" alt="QR Code" style="max-width:300px;">
            @else
                <p>Tidak ada QR Code.</p>
            @endif
        </div>
    </div>
    <a href="{{ route('donasi') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Donasi</a>
</div>
@endsection
