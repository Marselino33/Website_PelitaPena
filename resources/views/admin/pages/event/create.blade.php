@extends('admin.layouts.admin_master')

@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Buat Event</h4>
            <a href="{{ route('event.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>

        <form id="event-form" action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="nama_event" class="form-label fw-bold">Nama Event</label>
                    <input class="form-control" type="text" name="nama_event" id="nama_event"
                        value="{{ old('nama_event') }}" placeholder="Masukkan nama event" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pelaksanaan" class="form-label fw-bold">Tanggal Pelaksanaan</label>
                    <input class="form-control" type="datetime-local" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan"
                        value="{{ old('tanggal_pelaksanaan') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi Kegiatan</label>
                    <textarea id="editor" class="form-control" placeholder="Masukkan deskripsi kegiatan" name="deskripsi_event" rows="10">{{ old('deskripsi_event') }}</textarea>
                </div>

                <div class="row align-items-center mb-4">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}" alt="event-thumbnail"
                            class="img-fluid rounded shadow-sm border" style="height: 250px; object-fit: cover;" id="img-preview">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold mb-2">Upload Thumbnail</label>
                        <div class="d-flex flex-wrap gap-3">
                            <label for="upload" class="btn btn-outline-primary">
                                <i class="bx bx-upload me-1"></i> Pilih Gambar
                                <input type="file" id="upload" name="thumbnail_event" class="d-none" accept="image/png, image/jpeg" required>
                            </label>
                            <button type="button" class="btn btn-outline-danger" id="reset">
                                <i class="bx bx-reset me-1"></i> Reset
                            </button>
                        </div>
                        <small class="text-muted d-block mt-2">Format yang diterima: JPG, PNG. Maks 2MB.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-save me-1"></i> Tambah Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });

        let imgPreview = document.getElementById('img-preview');
        let inputFile = document.getElementById('upload');
        let resetBtn = document.getElementById('reset');

        inputFile.addEventListener('change', function(e) {
            if (inputFile.files && inputFile.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                };
                reader.readAsDataURL(inputFile.files[0]);
            }
        });

        resetBtn.addEventListener('click', function() {
            imgPreview.src = '{{ asset('asset-admin/assets/img/avatars/upload.png') }}';
            inputFile.value = '';
        });

        const form = document.getElementById('event-form');
        form.addEventListener('submit', function(event) {
            // Update textarea with content from CKEditor
            if (window.editor) {
                window.editor.updateSourceElement();
            }

            // Perform additional validation if needed
            const editorContent = window.editor.getData().trim();
            if (editorContent === '') {
                alert('Deskripsi Kegiatan tidak boleh kosong');
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>
@endsection
