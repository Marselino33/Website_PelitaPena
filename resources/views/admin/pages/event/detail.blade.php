@extends('admin.layouts.admin_master')

@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                Detail Acara
            </h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <!-- Event Details -->
            <div class="row">
                <!-- Image Column (smaller) -->
                <div class="col-lg-4 mb-4">
                    <div class="text-center">
                        <img src="{{ $eventDetail['thumbnail_event'] }}" alt="{{ $eventDetail['nama_event'] }}" 
                             class="img-fluid rounded-lg shadow-sm" style="max-height: 250px; width: 100%; object-fit: cover;">
                    </div>
                </div>
                
                <!-- Content Column (larger) -->
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h2 class="fw-bold">{{ $eventDetail['nama_event'] }}</h2>
                        <div class="d-flex align-items-center text-muted mb-3">
                            <i class="bx bx-calendar me-2"></i>
                            <span>
                                {{ \Carbon\Carbon::parse($eventDetail['tanggal_pelaksanaan'])->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="border-top pt-3">
                            <h5 class="fw-bold mb-3">Deskripsi Acara</h5>
                            <div class="content-description">
                                {!! $eventDetail['deskripsi_event'] !!}
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="bg-light rounded p-4">
                        <h5 class="fw-bold mb-3">Informasi Tambahan</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex mb-3">
                                    <i class="bx bx-time-five me-2 mt-1"></i>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">Waktu</h6>
                                        <p class="mb-0 text-muted">
                                            {{ \Carbon\Carbon::parse($eventDetail['tanggal_pelaksanaan'])->format('H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Add more information fields as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .content-description {
        line-height: 1.8;
    }
    .content-description p {
        margin-bottom: 1rem;
    }
</style>
@endsection