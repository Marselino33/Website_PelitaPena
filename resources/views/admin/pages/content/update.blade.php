@extends('admin.layouts.admin_master')

@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header">
            <h4 class="mb-0">Edit Konten</h4>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{ route('content.update', ['content' => $content['id']]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="judul" class="form-label fw-bold">Judul Konten</label>
                    <input type="text" name="judul" id="judul"
                        class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $content['judul']) }}"
                        placeholder="Masukkan judul konten" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="mb-3">
                    <label for="editor" class="form-label fw-bold">Isi Konten</label>
                    <textarea id="editor" name="isi_content" rows="10"
                        class="form-control @error('isi_content') is-invalid @enderror"
                        placeholder="Buat deskripsi yang menarik" required>{{ old('isi_content', $content['isi_content']) }}</textarea>
                    @error('isi_content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ $content['image_content'] }}" alt="Preview"
                            class="img-fluid rounded shadow-sm border"
                            style="height: 250px; object-fit: cover;" id="img-preview">
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Upload Gambar</label>
                        <div class="d-flex flex-wrap gap-3">
                            <label for="upload" class="btn btn-outline-primary">
                                <i class="bx bx-upload me-1"></i> Pilih Gambar
                                <input type="file" id="upload" name="image_content" class="d-none"
                                    accept="image/png, image/jpeg">
                            </label>
                            <button type="button" class="btn btn-outline-danger" id="reset">
                                <i class="bx bx-reset me-1"></i> Reset
                            </button>
                        </div>
                        <small class="text-muted d-block mt-2">Format: JPG, PNG. Maks 2MB.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-success" id="save-changes-btn">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan
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
        // Initialize CKEditor
        CKEDITOR.replace('editor');

        const imgPreview = document.getElementById('img-preview');
        const inputFile = document.getElementById('upload');
        const resetBtn = document.getElementById('reset');
        const saveBtn = document.getElementById('save-changes-btn');
        const form = document.getElementById('edit-form');

        // Preview selected image
        inputFile.addEventListener('change', function () {
            if (inputFile.files && inputFile.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imgPreview.src = e.target.result;
                };
                reader.readAsDataURL(inputFile.files[0]);
            }
        });

        // Reset image preview
        resetBtn.addEventListener('click', function () {
            imgPreview.src = '{{ $content['image_content'] }}';
            inputFile.value = '';
        });

        // Confirmation and form submission
        saveBtn.addEventListener('click', function () {
            Swal.fire({
                title: 'Yakin ingin menyimpan perubahan?',
                text: "Pastikan data yang diubah sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update CKEditor textarea
                    for (let instance in CKEDITOR.instances) {
                        CKEDITOR.instances[instance].updateElement();
                    }

                    const editorContent = CKEDITOR.instances.editor.getData().trim();
                    if (editorContent === '') {
                        Swal.fire('Error', 'Isi Konten tidak boleh kosong', 'error');
                    } else {
                        form.submit();
                    }
                }
            });
        });
    });
</script>
@endsection
