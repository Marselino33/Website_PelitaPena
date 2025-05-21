@extends('admin.layouts.admin_master')

@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header">
            <h4 class="mb-0">Buat Konten</h4>
        </div>

        <div class="card-body">
            <form id="content-form" action="{{ route('content.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Konten</label>
                    <input type="text" name="judul" id="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul') }}" placeholder="Masukkan judul konten" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="violence_category_id" class="form-label fw-bold">Kategori Kekerasan</label>
                    <select name="violence_category_id" id="violence_category_id"
                        class="form-select @error('violence_category_id') is-invalid @enderror" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($category_violences as $category)
                            <option value="{{ $category['id'] }}" {{ old('violence_category_id') == $category['id'] ? 'selected' : '' }}>
                                {{ $category['category_name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('violence_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="mb-3">
                    <label for="editor" class="form-label fw-bold">Isi Konten</label>
                    <textarea id="editor" name="isi_content" rows="10" class="form-control" placeholder="Buat deskripsi yang menarik">{{ old('isi_content') }}</textarea>
                </div>

                <hr>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}" alt="Preview"
                            class="img-fluid rounded shadow-sm border" style="height: 250px; object-fit: cover;" id="img-preview">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Upload Gambar</label>
                        <div class="d-flex flex-wrap gap-3">
                            <label for="upload" class="btn btn-outline-primary">
                                <i class="bx bx-upload me-1"></i> Pilih Gambar
                                <input type="file" id="upload" name="image_content" class="d-none"
                                    accept="image/png, image/jpeg" required>
                            </label>
                            <button type="button" class="btn btn-outline-danger" id="reset">
                                <i class="bx bx-reset me-1"></i> Reset
                            </button>
                        </div>
                        <small class="text-muted d-block mt-2">Format: JPG, PNG. Maks 2MB.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-check-circle me-1"></i> Tambah Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('editor');

        let imgPreview = document.getElementById('img-preview');
        let inputFile = document.getElementById('upload');
        let resetBtn = document.getElementById('reset');

        inputFile.addEventListener('change', function () {
            if (inputFile.files && inputFile.files[0]) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    imgPreview.src = event.target.result;
                };
                reader.readAsDataURL(inputFile.files[0]);
            }
        });

        resetBtn.addEventListener('click', function () {
            imgPreview.src = '{{ asset('asset-admin/assets/img/avatars/upload.png') }}';
            inputFile.value = '';
        });

        document.getElementById('content-form').addEventListener('submit', function (event) {
            for (let instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            const editorContent = CKEDITOR.instances.editor.getData().trim();
            if (editorContent === '') {
                alert('Isi Konten tidak boleh kosong');
                event.preventDefault();
            }
        });
    });
</script>
@endsection
