@extends('admin.layouts.admin_master')
@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                Buat Kategori Kekerasan
            </h4>
            <a href="{{ route('category-violence.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>

        <form action="{{ route('category-violence.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row align-items-center mb-4">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}" alt="Preview"
                            class="img-fluid rounded shadow-sm border" style="height: 250px; object-fit: cover;" id="img">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold mb-2">Upload Gambar</label>
                        <div class="d-flex flex-wrap gap-3">
                            <label for="upload" class="btn btn-outline-primary">
                                <i class="bx bx-upload me-1"></i> Pilih Gambar
                                <input type="file" id="upload" name="image" class="d-none" accept="image/png, image/jpeg">
                            </label>
                            <button type="button" class="btn btn-outline-danger" id="reset">
                                <i class="bx bx-reset me-1"></i> Reset
                            </button>
                        </div>
                        <small class="text-muted d-block mt-2">Format yang diterima: JPG, PNG. Maks 2MB.</small>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <label for="category_name" class="form-label fw-bold">Nama Kategori</label>
                    <input class="form-control @error('category_name') is-invalid @enderror"
                        type="text" id="category_name" name="category_name" placeholder="Masukkan nama kategori" required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-save me-1"></i> Simpan Kategori
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
        let img = document.getElementById('img');
        let input = document.getElementById('upload');
        let resetBtn = document.getElementById('reset');

        input.addEventListener('change', function() {
            if (input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        resetBtn.addEventListener('click', function() {
            img.src = "{{ asset('asset-admin/assets/img/avatars/upload.png') }}";
            input.value = '';
        });
    });
</script>
@endpush
