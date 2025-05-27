@extends('admin.layouts.admin_master')

@section('title', $title)

@section('content')
<div class="container-fluid py-4">
  <div class="card shadow border-0 rounded-lg">
    <div class="card-header bg-gradient-primary text-white">
      <h2 class="mb-0">{{ $title }}</h2>
    </div>
    <div class="card-body">
      @include('partials.alerts') {{-- untuk SweetAlert --}}
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('admin.laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="kategori_kekerasan_id">Kategori Kekerasan</label>
          <select name="kategori_kekerasan_id" id="kategori_kekerasan_id" class="form-control">
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $c)
              <option value="{{ $c['id'] }}"
                {{ old('kategori_kekerasan_id') == $c['id'] ? 'selected' : '' }}>
                {{ $c['name'] }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="tanggal_kejadian">Tanggal Kejadian</label>
              <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" class="form-control"
                     value="{{ old('tanggal_kejadian') }}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="kategori_lokasi_kasus">Kategori Lokasi Kasus</label>
              <input type="text" name="kategori_lokasi_kasus" id="kategori_lokasi_kasus" class="form-control"
                     value="{{ old('kategori_lokasi_kasus') }}" placeholder="Misal: Sekolah, Rumah">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="alamat_tkp">Alamat TKP</label>
          <input type="text" name="alamat_tkp" id="alamat_tkp" class="form-control"
                 value="{{ old('alamat_tkp') }}">
        </div>

        <div class="form-group">
          <label for="alamat_detail_tkp">Detail Alamat TKP</label>
          <textarea name="alamat_detail_tkp" id="alamat_detail_tkp" class="form-control"
                    rows="2">{{ old('alamat_detail_tkp') }}</textarea>
        </div>

        <div class="form-group">
          <label for="kronologis_kasus">Kronologis Kasus</label>
          <textarea name="kronologis_kasus" id="kronologis_kasus" class="form-control"
                    rows="4">{{ old('kronologis_kasus') }}</textarea>
        </div>

        <div class="form-group">
          <label for="dokumentasi">Dokumentasi (Foto)</label>
          <input type="file" name="dokumentasi[]" id="dokumentasi" class="form-control-file" multiple>
          <small class="form-text text-muted">JPG/PNG, max 2MB per file.</small>
        </div>

        <button type="submit" class="btn btn-success">
          <i class="fas fa-plus-circle mr-1"></i> Simpan
        </button>
        <a href="{{ route('admin.laporan.daftar') }}" class="btn btn-secondary ml-2">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
