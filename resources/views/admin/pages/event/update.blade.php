@extends('admin.layouts.admin_master')

@section('content')
<h1 class="mb-4">Edit Event</h1>

<div class="card">
    <div class="card-body">
        <form id="edit-form" action="{{ route('event.update', ['event' => $event['id']]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-8 mb-3">
                    <label for="nama_event" class="form-label fw-semibold">Nama Event</label>
                    <input type="text" class="form-control" id="nama_event" name="nama_event" 
                        value="{{ old('nama_event', $event['nama_event']) }}" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tanggal_pelaksanaan" class="form-label fw-semibold">
                        Tanggal & Waktu Pelaksanaan
                    </label>
                    <input type="datetime-local" class="form-control" name="tanggal_pelaksanaan" 
                        id="tanggal_pelaksanaan"
                        value="{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('Y-m-d\TH:i') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="editor" class="form-label fw-semibold">Deskripsi Event</label>
                <textarea id="editor" name="deskripsi_event" rows="10" 
                    class="form-control" placeholder="Tulis deskripsi kegiatan di sini..." required>{{ old('deskripsi_event', $event['deskripsi_event']) }}</textarea>
            </div>

            <div class="row align-items-center mb-4">
                <div class="col-md-3 text-center">
                    <img src="{{ $event['thumbnail_event'] }}" alt="Thumbnail Event" 
                        class="img-fluid rounded" id="img-preview" style="max-height: 250px;">
                </div>
                <div class="col-md-9">
                    <label for="upload" class="form-label fw-semibold">Ganti Gambar Thumbnail</label>
                    <div class="d-flex gap-2">
                        <label class="btn btn-primary">
                            <input type="file" name="thumbnail_event" id="upload" hidden accept="image/*">
                            <i class="bx bx-upload me-1"></i> Unggah Gambar Baru
                        </label>
                        <button type="button" class="btn btn-outline-secondary" id="reset">
                            <i class="bx bx-reset me-1"></i> Reset Gambar
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success" id="save-changes-btn">
                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
