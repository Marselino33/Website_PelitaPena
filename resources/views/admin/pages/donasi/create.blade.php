@extends('admin.layouts.admin_master')
@section('title', $title)

@section('content')
<div class="container-fluid px-2"> <!-- px dikurangi -->
    <div class="card shadow-sm mb-3 border-0"> <!-- mb dikurangi -->
        <div class="card-header py-2 px-3 d-flex justify-content-between align-items-center"> <!-- py dikurangi -->
            <h5 class="mb-0">{{ $title }}</h5>
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.pages.donasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body py-3 px-3"> <!-- py dikurangi -->
                @if($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="mb-2">
                    <label for="title" class="form-label fw-semibold">Judul Donasi</label>
                    <input type="text" name="title" id="title" 
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" placeholder="Masukkan judul donasi" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="description" class="form-label fw-semibold">Deskripsi Donasi</label>
                    <textarea name="description" id="description" 
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4" placeholder="Masukkan deskripsi donasi" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-3">

                <div class="row g-3 align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}" alt="Preview QR Code"
                            class="img-fluid rounded border" style="height: 200px; object-fit: cover;" id="qr-preview">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold mb-1">Upload QR Code</label>
                        <div class="d-flex flex-wrap gap-2">
                            <label for="qr_image" class="btn btn-sm btn-outline-primary">
                                <i class="bx bx-upload me-1"></i> Pilih Gambar
                                <input type="file" id="qr_image" name="qr_image" class="d-none" accept="image/png, image/jpeg" required>
                            </label>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="reset-qr">
                                <i class="bx bx-reset me-1"></i> Reset
                            </button>
                        </div>
                        <small class="text-muted d-block mt-1">Format yang diterima: JPG, PNG. Maks 2MB.</small>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-success">
                        <i class="bx bx-save me-1"></i> Simpan Donasi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let qrPreview = document.getElementById('qr-preview');
        let qrInput = document.getElementById('qr_image');
        let resetBtn = document.getElementById('reset-qr');

        qrInput.addEventListener('change', function() {
            if (qrInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    qrPreview.src = e.target.result;
                };
                reader.readAsDataURL(qrInput.files[0]);
            }
        });

        resetBtn.addEventListener('click', function() {
            qrPreview.src = "{{ asset('asset-admin/assets/img/avatars/upload.png') }}";
            qrInput.value = '';
        });
    });
</script>
@endpush
