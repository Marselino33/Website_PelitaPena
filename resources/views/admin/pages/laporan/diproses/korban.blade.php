@extends('admin.layouts.admin_master')

@section('content')
<div class="tab-pane fade" id="navs-pills-korban" role="tabpanel">
  @forelse ($korbans as $korban)
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex gap-4">
          <img src="{{ $korban['dokumentasi_pelaku'] }}"
               alt="Foto Korban" class="rounded" width="150" height="150">
          <div>
            <h5>{{ $korban['nama'] }} ({{ $korban['usia'] }} thn)</h5>
            <p><strong>NIK:</strong> {{ $korban['nik_korban'] }}</p>
            <p><strong>JK:</strong> {{ $korban['jenis_kelamin'] }}</p>
            <p><strong>Alamat:</strong> {{ $korban['alamat_korban'] }}</p>
            {{-- tambahkan field lain sesuai kebutuhan --}}
          </div>
        </div>
      </div>
    </div>
  @empty
    <div class="text-center py-5">
      <h4>Belum ada data korban</h4>
      <button class="btn btn-success"
              data-bs-toggle="modal"
              data-bs-target="#modalTambahKorban">
        Tambah Korban
      </button>
    </div>
  @endforelse

  <!-- Modal Tambah Korban -->
  <div class="modal fade" id="modalTambahKorban" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('korban.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="no_registrasi" value="{{ $no_registrasi }}">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Korban</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label class="form-label">NIK Korban</label>
                <input type="text" name="nik_korban" class="form-control" required>
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">Nama Korban</label>
                <input type="text" name="nama" class="form-control" required>
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">Usia</label>
                <input type="number" name="usia" class="form-control" required>
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                  <option value="">Pilih…</option>
                  <option value="Laki-laki">Laki‑laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
              <div class="mb-3 col-md-12">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat_korban" class="form-control" required>
              </div>
              <div class="mb-3 col-md-12">
                <label class="form-label">Foto Korban</label>
                <input type="file" name="dokumentasi_pelaku" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
