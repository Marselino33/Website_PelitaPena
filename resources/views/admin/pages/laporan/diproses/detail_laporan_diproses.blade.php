@extends('admin.layouts.admin_master')
@section('content')
    <link rel="stylesheet" href="asset-admin/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="asset-admin/assets/vendor/libs/dropzone/dropzone.css" />

    <div class="col-xl-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-laporan" aria-controls="navs-pills-justified-home"
                        aria-selected="true">
                        <i class="tf-icons bx bx-home"></i>
                        Laporan
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pelapor" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i>
                        Pelapor
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-korban" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i>
                        Korban
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($laporanDetailDiproses['korban']) }}</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pelaku" aria-controls="navs-pills-justified-pelaku"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i>
                Pelaku
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($laporanDetailDiproses['pelaku']) }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-laporan" role="tabpanel">


                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-header">Tracking dan Isi Laporan {{ $laporanDetailDiproses['no_registrasi'] }}
                            &nbsp;<span class="badge bg-label-primary me-1">{{ $laporanDetailDiproses['status'] }}</span>
                        </h3>
                        <form
                            action="{{ route('laporan.selesaikan', ['no_registrasi' => $laporanDetailDiproses['no_registrasi']]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">
                                Kasus Selesai
                            </button>
                        </form>


                    </div>
                    <br>
                    <hr class="my-0">
                    <br>
                    <div class="row">
                        <div class="col-xl">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-header">Dokumentasi</h5>
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        @foreach ($laporanDetailDiproses['dokumentasi']['urls'] as $key => $url)
    @php
        $pathInfo = pathinfo($url);
        $extension = isset($pathInfo['extension']) ? strtolower($pathInfo['extension']) : null;
    @endphp
    @if ($extension && in_array($extension, ['png', 'jpg', 'jpeg', 'gif']))
        <img src="{{ $url }}" alt="dokumentasi" class="d-block rounded document-img"
             height="100" width="100" data-bs-toggle="modal" data-bs-target="#modalCenter"
             data-type="image" data-image-url="{{ $url }}">
    @elseif ($extension && in_array($extension, ['mp4', 'mov', 'avi', 'mkv', 'webm']))
        <video controls class="d-block rounded document-video" height="100" width="100"
               data-bs-toggle="modal" data-bs-target="#modalCenter" data-type="video"
               data-video-url="{{ $url }}">
            <source src="{{ $url }}" type="video/{{ $extension }}">
            Your browser does not support the video tag.
        </video>
    @endif
@endforeach

                                        </div>
                                    </div>
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Dokumentasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center" id="modalContent">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">Nomor Registrasi</label>
                                            <input class="form-control" type="text" id="firstName" name="firstName"
                                                value="{{ $laporanDetailDiproses['no_registrasi'] }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Kategori Kekerasan</label>
                                            <input class="form-control" type="text" name="lastName" id="lastName"
                                                value="{{ $laporanDetailDiproses['ViolenceCategory']['category_name'] }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Tanggal Pelaporan</label>
                                            <input class="form-control"
                                                value="{{ \Carbon\Carbon::parse($laporanDetailDiproses['tanggal_pelaporan'])->format('d M Y, H:i') }}"
                                                placeholder="{{ \Carbon\Carbon::parse($laporanDetailDiproses['tanggal_pelaporan'])->format('d M Y, H:i') }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="organization" class="form-label">Tanggal Kejadian</label>
                                            <input class="form-control"
                                                value="{{ \Carbon\Carbon::parse($laporanDetailDiproses['tanggal_kejadian'])->format('d M Y') }}"
                                                placeholder="{{ \Carbon\Carbon::parse($laporanDetailDiproses['tanggal_kejadian'])->format('d M Y') }}"
                                                disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Kategori Lokasi Kekerasan</label>
                                            <input class="form-control" type="text" name="lastName" id="lastName"
                                                value="{{ $laporanDetailDiproses['kategori_lokasi_kasus'] }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Daerah Alamat TKP</label>
                                            <input class="form-control" type="text" name="lastName" id="lastName"
                                                value="{{ $laporanDetailDiproses['alamat_tkp'] }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Alamat Detail</label>
                                            <textarea class="form-control" type="text" disabled>{{ $laporanDetailDiproses['alamat_detail_tkp'] }}</textarea>
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="basic-default-message">Kronologi Kasus yang
                                                terjadi</label>
                                            <textarea id="basic-default-message" class="form-control" disabled>{{ $laporanDetailDiproses['kronologis_kasus'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Tracking Laporan</h5>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTracking">
                                    Tambah Tracking
                                </button>
                            </div>

                            <div class="modal fade" id="addTracking" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addTrackingTitle">Buat Tracking Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="{{ route('tracking.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
<input type="hidden" name="no_registrasi" value="{{ $laporanDetailDiproses['no_registrasi'] }}">
                                                <div class="mb-3">
                                                    <label for="keterngan">Keterangan</label>
                                                    <input type="text" class="form-control" name="keterangan">
                                                </div>
                                                <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
                                                    <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}" alt="user-avatar"
                                                        class="d-block rounded" height="250" width="250" id="img">
                                                    <div class="button-wrapper">
                                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                            <span class="d-none d-sm-block">Upload Dokumentasi</span>
                                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                                            <input type="file" id="upload" name="document" class="account-file-input" hidden
                                                                accept="image/png,image/jpeg" required>
                                                        </label>
                                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" id="reset">
                                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block">Reset</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <ul class="timeline pt-3">
                                    @foreach ($laporanDetailDiproses['tracking_laporan'] as $tracking)
                                        <li class="timeline-item pb-4 timeline-item-danger border-left-dashed">
                                            <span class="timeline-indicator-advanced timeline-indicator-danger">
                                                <i class="bx bx-shopping-bag"></i>
                                            </span>
                                            <div class="timeline-event">
                                                <div class="d-flex flex-sm-row flex-column justify-content-between">
                                                    <div>
                                                        <div class="timeline-header flex-wrap mb-2 mt-3 mt-sm-0">
                                                            <h6 class="mb-0">{{ $tracking['keterangan'] }}</h6>
                                                            <span>{{ \Carbon\Carbon::parse($tracking['created_at'])->format('d M Y') }}</span>
                                                        </div>
                                                        <p>
                                                            @foreach ($tracking['document']['urls'] as $url)
                                                                <a href="{{ $url }}" target="_blank">Document</a><br>
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="mt-3 mt-sm-0">
                                                        <button type="button" class="btn btn-icon btn-label-primary btn-sm me-2" data-bs-toggle="modal"
                                                            data-bs-target="#updateTracking{{ $tracking['id'] }}" title="Edit">
                                                            <span class="tf-icons bx bx-edit"></span>
                                                        </button>
                                                        <!-- Tombol Delete -->
                                                        <button type="button" class="btn btn-icon btn-label-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#deleteTracking{{ $tracking['id'] }}" title="Hapus">
                                                            <span class="tf-icons bx bx-trash"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <!-- Modal Update Tracking -->
                                        <div class="modal fade" id="updateTracking{{ $tracking['id'] }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Tracking Laporan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('tracking.update', $tracking['id']) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-body">
                                                            <input type="text" name="no_registrasi" value="{{ $tracking['no_registrasi'] }}"
                                                                hidden>
                                                            <div class="mb-3">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" class="form-control" name="keterangan"
                                                                    value="{{ $tracking['keterangan'] }}">
                                                            </div>
                                                            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
                                                                <!-- Tampilkan gambar placeholder jika URL salah -->
                                                                @if (!empty($tracking['document']['urls']) && count($tracking['document']['urls']) > 0)
                                                                    <img src="{{ $tracking['document']['urls'][0] }}"
                                                                        alt="Document" class="d-block rounded" height="250" width="250"
                                                                        id="imgUpdate{{ $tracking['id'] }}"
                                                                        onerror="this.src='{{ asset('asset-admin/assets/img/avatars/upload.png') }}'">
                                                                @else
                                                                    <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}"
                                                                        alt="No Document" class="d-block rounded" height="250" width="250"
                                                                        id="imgUpdate{{ $tracking['id'] }}">
                                                                @endif
                                                                <div class="button-wrapper">
                                                                    <label for="uploadUpdate{{ $tracking['id'] }}"
                                                                        class="btn btn-primary me-2 mb-4" tabindex="0">
                                                                        <span class="d-none d-sm-block">Ganti Dokumentasi</span>
                                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                                        <input type="file" id="uploadUpdate{{ $tracking['id'] }}"
                                                                            name="document" class="account-file-input" hidden
                                                                            accept="image/png,image/jpeg">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Delete Tracking -->
                                        <div class="modal fade" id="deleteTracking{{ $tracking['id'] }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus Tracking</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST" action="{{ route('tracking.destroy', $tracking['id']) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus tracking dengan keterangan
                                                                "<strong>{{ $tracking['keterangan'] }}</strong>"?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Timeline lainnya tetap sama -->
                                    <li class="timeline-item pb-4 timeline-item-info border-left-dashed">
                                        <span class="timeline-indicator-advanced timeline-indicator-info">
                                            <i class="bx bx-user-circle"></i>
                                        </span>
                                        <div class="timeline-event">
                                            <div class="timeline-header">
                                                <h6 class="mb-0">Laporan Di lihat Oleh Admin</h6>
                                                <span>{{ \Carbon\Carbon::parse($laporanDetailDiproses['waktu_dilihat'])->format('d M Y') }}
                                                    jam
                                                    {{ \Carbon\Carbon::parse($laporanDetailDiproses['waktu_dilihat'])->format('H:i') }}</span>
                                            </div>
                                            <hr />
                                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                                <div class="d-flex flex-wrap">
                                                    <div class="avatar me-3">
                                                        <img src="{{ !empty($laporanDetailDiproses['User']['photo_profile']) ? $laporanDetailDiproses['User']['photo_profile'] : asset('asset-admin/assets/img/avatars/no_photo.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">{{ $laporanDetailDiproses['user_melihat']['full_name'] }}</p>
                                                        <span>{{ $laporanDetailDiproses['user_melihat']['role'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item pb-4 timeline-item-dark border-left-dashed">
                                        <span class="timeline-indicator-advanced timeline-indicator-dark">
                                            <i class="bx bx-bell"></i>
                                        </span>
                                        <div class="timeline-event">
                                            <div class="timeline-header">
                                                <h6 class="mb-0">Laporan Masuk</h6>
                                                <span>{{ \Carbon\Carbon::parse($laporanDetailDiproses['created_at'])->format('d M Y') }}
                                                    jam
                                                    {{ \Carbon\Carbon::parse($laporanDetailDiproses['created_at'])->format('H:i') }}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-end-indicator">
                                        <i class="bx bx-check-circle"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-pelapor" role="tabpanel">
                    <h3 class="card-header">Data Pelapor</h3>
                    <!-- <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ !empty($laporanDetailDiproses['Data']['User']['photo_profile']) ? $laporanDetailDiproses['Data']['User']['photo_profile'] : asset('asset-admin/assets/img/avatars/no_photo.png') }}"
                                alt="user-avatar" class="d-block rounded" height="200" width="200"
                                id="uploadedAvatar">
                        </div>
                    </div> -->
                    <br>
                  
                    <hr class="my-0">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Nama Lengkap</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text">
                                            <i class="bx bx-user">
                                            </i>
                                        </span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            value="{{ $laporanDetailDiproses['User']['full_name'] }}"
                                            aria-label="{{ $laporanDetailDiproses['User']['full_name'] }}"
                                            aria-describedby="basic-icon-default-fullname2">
                                    </div>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $laporanDetailDiproses['User']['username'] }}">
                                </div>
                                <!-- <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">NIK</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $laporanDetailDiproses['User']['nik'] }}">
                                </div> -->
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="text" id="basic-icon-default-email" class="form-control"
                                            value="{{ $laporanDetailDiproses['User']['email'] }}"
                                            aria-label="{{ $laporanDetailDiproses['User']['email'] }}"
                                            aria-describedby="basic-icon-default-email2">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Tempat, tanggal Lahir</label>
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ $laporanDetailDiproses['User']['tempat_lahir'] }}, {{ $laporanDetailDiproses['User']['tanggal_lahir'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Nomor Handphone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            value="{{ $laporanDetailDiproses['User']['phone_number'] }}">
                                    </div>
                                </div>
                                <!-- <div class="mb-3 col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control"
                                        value="{{ $laporanDetailDiproses['User']['jenis_kelamin'] }}" id="jenis_kelamin"
                                        name="jenis_kelamin">
                                </div> -->
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">Alamat</label>
                                    <input class="form-control" type="text" id="state" name="state"
                                        value="Alamat">
                                </div>
                                <!-- <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode"
                                        placeholder="231465" maxlength="6">
                                </div> -->

                            </div>
                        </form>
                    </div>
                </div>
<div class="tab-pane fade" id="navs-pills-justified-korban" role="tabpanel">
  @forelse ($laporanDetailDiproses['korban'] as $korban)
    {{-- KARTU INFO KORBAN --}}
    <div class="card mb-3">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h5>Korban: {{ $korban['nama_korban'] }}</h5>
          <div>
            {{-- Tombol Edit --}}
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                    data-bs-target="#editKorbanModal{{ $korban['id'] }}">
              <i class="bx bx-edit"></i> Edit
            </button>
            {{-- Tombol Hapus --}}
            <button class="btn btn-sm btn-danger delete-korban"
                    data-id="{{ $korban['id'] }}"
                    data-no="{{ $laporanDetailDiproses['no_registrasi'] }}">
              <i class="bx bx-trash"></i> Hapus
            </button>
          </div>
        </div>

        <hr class="my-3">

        {{-- Detail Korban --}}
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">NIK</label>
            <input type="text" class="form-control" value="{{ $korban['nik_korban'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Usia</label>
            <input type="text" class="form-control" value="{{ $korban['usia_korban'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <input type="text" class="form-control" value="{{ $korban['jenis_kelamin'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Agama</label>
            <input type="text" class="form-control" value="{{ $korban['agama'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">No. Telepon</label>
            <input type="text" class="form-control" value="{{ $korban['no_telepon'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Pendidikan</label>
            <input type="text" class="form-control" value="{{ $korban['pendidikan'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Status Perkawinan</label>
            <input type="text" class="form-control" value="{{ $korban['status_perkawinan'] }}" disabled>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Kebangsaan</label>
            <input type="text" class="form-control" value="{{ $korban['kebangsaan'] }}" disabled>
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Alamat</label>
            <input type="text" class="form-control" value="{{ $korban['alamat_korban'] }}" disabled>
          </div>
          <div class="col-md-12 mb-3">
            <label class="form-label">Alamat Detail</label>
            <textarea class="form-control" rows="2" disabled>{{ $korban['alamat_detail'] }}</textarea>
          </div>
        </div>
      </div>
    </div>

    {{-- MODAL EDIT KORBAN --}}
    <div class="modal fade" id="editKorbanModal{{ $korban['id'] }}" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="{{ route('korban.update', $korban['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="no_registrasi" value="{{ $laporanDetailDiproses['no_registrasi'] }}">
            <div class="modal-header">
              <h5 class="modal-title">Edit Korban</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="row">
            {{-- NIK --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">NIK</label>
                  <input type="number" name="nik_korban" class="form-control"
                         value="{{ $korban['nik_korban'] }}" required>
                </div>
                {{-- Nama --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Nama Korban</label>
                  <input type="text" name="nama_korban" class="form-control"
                         value="{{ $korban['nama_korban'] }}" required>
                </div>
                {{-- Usia --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Usia</label>
                  <input type="number" name="usia_korban" class="form-control"
                         value="{{ $korban['usia_korban'] }}" required>
                </div>
                {{-- Jenis Kelamin --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" {{ $korban['jenis_kelamin']=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                    <option value="Perempuan"  {{ $korban['jenis_kelamin']=='Perempuan'?'selected':'' }}>Perempuan</option>
                  </select>
                </div>
                {{-- Agama --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Agama</label>
                  <input type="text" name="agama" class="form-control"
                         value="{{ $korban['agama'] }}" required>
                </div>
                {{-- No Telepon --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">No. Telepon</label>
                  <div class="input-group">
                    <span class="input-group-text">+62</span>
                    <input type="text" name="no_telepon" class="form-control"
                           value="{{ $korban['no_telepon'] }}" required>
                  </div>
                </div>
                {{-- Pendidikan --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Pendidikan</label>
                  <input type="text" name="pendidikan" class="form-control"
                         value="{{ $korban['pendidikan'] }}" required>
                </div>
                {{-- Status Perkawinan --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Status Perkawinan</label>
                  <select name="status_perkawinan" class="form-control" required>
                    <option value="Belum Kawin" {{ $korban['status_perkawinan']=='Belum Kawin'?'selected':'' }}>Belum Kawin</option>
                    <option value="Sudah Kawin" {{ $korban['status_perkawinan']=='Sudah Kawin'?'selected':'' }}>Sudah Kawin</option>
                    <option value="Cerai"       {{ $korban['status_perkawinan']=='Cerai'?'selected':'' }}>Cerai</option>
                  </select>
                </div>
                {{-- Kebangsaan --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Kebangsaan</label>
                  <input type="text" name="kebangsaan" class="form-control"
                         value="{{ $korban['kebangsaan'] }}" required>
                </div>
                {{-- Hubungan dgn Pelaku --}}
                <div class="col-md-6 mb-3">
                  <label class="form-label">Hubungan dengan Pelaku</label>
                  <input type="text" name="hubungan_dengan_pelaku" class="form-control"
                         value="{{ $korban['hubungan_dengan_pelaku'] }}" required>
                </div>
                {{-- Alamat --}}
                <div class="col-md-12 mb-3">
                  <label class="form-label">Alamat</label>
                  <input type="text" name="alamat_korban" class="form-control"
                         value="{{ $korban['alamat_korban'] }}" required>
                </div>
                {{-- Alamat Detail --}}
                <div class="col-md-12 mb-3">
                  <label class="form-label">Alamat Detail</label>
                  <textarea name="alamat_detail" class="form-control" rows="2">{{ $korban['alamat_detail'] }}</textarea>
                </div>
                {{-- Dokumentasi (foto) --}}
                <div class="col-md-12 mb-3">
                  <label class="form-label">Foto Korban</label>
                  <input type="file" name="dokumentasi_korban" class="form-control">
                </div> 
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  @empty
    {{-- STATE KETIKA BELUM ADA KORBAN --}}
    <div class="text-center py-4">
<div class="misc-wrapper">
                                        <h2 class="mb-2 mx-2 ">Data Korban Belum Ditambahkan</h2>
                                        <h3 class="mb-4 mx-2">Apakah Dinas mendapatkan Korbannya?</h3>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahKorban">
        Tambah Data Korban
      </button>
                                        <div class="mt-4">
                                            <img src="asset-admin\assets\img\backgrounds/nodata.png"
                                                alt="girl-doing-yoga-light" width="500" class="img-fluid"
                                                data-app-dark-img="illustrations/nodata.png"
                                                data-app-light-img="illustrations/nodata.png" />
                                        </div>
                                    </div>
                <div class="mt-4">
                                            <img src="asset-admin\assets\img\backgrounds/nodata.png"
                                                alt="girl-doing-yoga-light" width="500" class="img-fluid"
                                                data-app-dark-img="illustrations/nodata.png"
                                                data-app-light-img="illustrations/nodata.png" />
                                        </div>  
    </div>
  @endforelse

  {{-- MODAL TAMBAH KORBAN --}}
                        <div class="modal fade" id="tambahKorban" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Data Korban</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('korban.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="mb-3 col-md-6">
                                                <label for="dokumentasi_korban" class="form-label">NIK (Nomor Induk
                                                    Kependudukan)</label>
                                                <input class="form-control" type="file" id="dokumentasi_korban"
                                                    name="dokumentasi_korban" autofocus required>
                                            </div>

                                            <hr class="my-3">
                                            <input type="hidden" name="no_registrasi"
                                                value="{{ $laporanDetailDiproses['no_registrasi'] }}">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="nik_korban" class="form-label">NIK (Nomor Induk
                                                        Kependudukan)</label>
                                                    <input class="form-control" type="number" id="nik_korban"
                                                        name="nik_korban" autofocus required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="nama_korban" class="form-label">Nama Korban</label>
                                                    <input class="form-control" type="text" name="nama_korban"
                                                        id="nama_korban" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="usia_korban" class="form-label">Usia Korban</label>
                                                    <input class="form-control" type="number" id="usia_korban"
                                                        name="usia_korban" placeholder="Contoh: 21" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                                        required>
                                                        <option value="">Pilih</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="agama" class="form-label">Agama</label>
                                                    <input type="text" class="form-control" id="agama"
                                                        name="agama" placeholder="Contoh: Kristen" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="no_telepon">Nomor Telepon</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">ID (+62)</span>
                                                        <input type="text" id="no_telepon" name="no_telepon"
                                                            class="form-control" placeholder="0812..." required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                                    <input class="form-control" type="text" id="pendidikan"
                                                        name="pendidikan" placeholder="Contoh: S1" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="pekerjaan">Pekerjaan</label>
                                                    <input class="form-control" type="text" id="pekerjaan"
                                                        name="pekerjaan" placeholder="Contoh: Guru" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="status_perkawinan">Status
                                                        Perkawinan</label>
                                                    <select id="status_perkawinan" class="form-control"
                                                        name="status_perkawinan" required>
                                                        <option value="">Pilih</option>
                                                        <option value="Belum Kawin">Belum Kawin</option>
                                                        <option value="Sudah Kawin">Sudah Kawin</option>
                                                        <option value="Cerai">Cerai</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="kebangsaan" class="form-label">Kebangsaan</label>
                                                    <input type="text" class="form-control" id="kebangsaan"
                                                        name="kebangsaan" placeholder="Contoh: Indonesia" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="hubungan_dengan_pelaku" class="form-label">Hubungan dengan
                                                        Pelaku</label>
                                                    <input type="text" class="form-control"
                                                        id="hubungan_dengan_pelaku" name="hubungan_dengan_pelaku"
                                                        placeholder="Contoh: Paman" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="alamat_korban" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" id="alamat_korban"
                                                        name="alamat_korban"
                                                        placeholder="Contoh : Parparean I, Porsea, Toba, Sumatera Utara"
                                                        required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="alamat_detail" class="form-label">Alamat Detail</label>
                                                    <textarea id="alamat_detail" name="alamat_detail" class="form-control"
                                                        placeholder="Apakah anda tau alamat detail korban?"></textarea>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="keterangan_lainnya">Keterangan
                                                        Lainnya</label>
                                                    <textarea id="keterangan_lainnya" name="keterangan_lainnya" class="form-control"
                                                        placeholder="Adakah keterangan lain mengenai korban ini?"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                <div class="tab-pane fade" id="navs-pills-justified-pelaku" role="tabpanel">
                    <div class="col-md mb-4 mb-md-0">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <!-- <h3>Data Pelaku</h3> -->
                            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exLargeModal">
                                Tambah Data Pelaku
                            </button> -->
                        </div>
                        <div class="accordion mt-3" id="accordionExample">
                            @forelse ($laporanDetailDiproses['pelaku'] as $index => $pelaku)
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#accordion{{ $index }}"
                                            aria-expanded="false" aria-controls="accordion{{ $index }}">
                                            Data Pelaku {{ $index + 1 }}
                                        </button>
                                    </h2>

        <div id="accordion{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" 
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-header">Data Pelaku</h5>
                    <div>
                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal{{ $pelaku['id'] }}">
                            Edit
                        </button>

                        <!-- Tombol Hapus -->
                        <form id="delete-form-{{ $pelaku['id'] }}" 
                            action="{{ route('pelaku.destroy', ['id' => $pelaku['id']]) }}" method="POST" 
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-2 delete-btn">
                                <span class="tf-icons bx bx-trash"></span> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                                <!-- Modal Edit Pelaku -->
                <div class="modal fade" id="editModal{{ $pelaku['id'] }}" tabindex="-1" aria-labelledby="editModalLabel" 
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Data Pelaku</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                                    aria-label="Close"></button>
                            </div>
<form action="{{ route('pelaku.update', ['id' => $pelaku['id']]) }}"
      method="POST"
      enctype="multipart/form-data">
  @csrf
  @method('PUT')

  {{-- Kirim juga no_registrasi --}}
  <input type="hidden" name="no_registrasi" value="{{ $laporanDetailDiproses['no_registrasi'] }}">

  <div class="row">
    <div class="mb-3 col-md-6">
      <label class="form-label">NIK</label>
      <input type="text" name="nik_pelaku" class="form-control"
             value="{{ $pelaku['nik_pelaku'] }}" required>
    </div>
    <div class="mb-3 col-md-6">
      <label class="form-label">Nama Pelaku</label>
      <input type="text" name="nama_pelaku" class="form-control"
             value="{{ $pelaku['nama_pelaku'] }}" required>
    </div>
    <div class="mb-3 col-md-4">
      <label class="form-label">Usia</label>
      <input type="number" name="usia_pelaku" class="form-control"
             value="{{ $pelaku['usia_pelaku'] }}" required>
    </div>
    <div class="mb-3 col-md-4">
      <label class="form-label">Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-control" required>
        <option value="Laki‑laki"   {{ $pelaku['jenis_kelamin']=='Laki‑laki' ? 'selected' : '' }}>Laki‑laki</option>
        <option value="Perempuan"    {{ $pelaku['jenis_kelamin']=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
      </select>
    </div>
    <div class="mb-3 col-md-4">
      <label class="form-label">Agama</label>
      <input type="text" name="agama" class="form-control"
             value="{{ $pelaku['agama'] }}" required>
    </div>

    {{-- Tambahkan semua field yang di‑validator --}}
    <div class="mb-3 col-md-6">
      <label class="form-label">No. Telepon</label>
      <input type="text" name="no_telepon" class="form-control"
             value="{{ $pelaku['no_telepon'] }}" required>
    </div>
    <div class="mb-3 col-md-6">
      <label class="form-label">Pendidikan</label>
      <input type="text" name="pendidikan" class="form-control"
             value="{{ $pelaku['pendidikan'] }}" required>
    </div>
    <div class="mb-3 col-md-6">
      <label class="form-label">Pekerjaan</label>
      <input type="text" name="pekerjaan" class="form-control"
             value="{{ $pelaku['pekerjaan'] }}" required>
    </div>
    <div class="mb-3 col-md-6">
      <label class="form-label">Status Perkawinan</label>
      <select name="status_perkawinan" class="form-control" required>
        <option value="Belum Kawin" {{ $pelaku['status_perkawinan']=='Belum Kawin' ? 'selected':'' }}>Belum Kawin</option>
        <option value="Sudah Kawin" {{ $pelaku['status_perkawinan']=='Sudah Kawin' ? 'selected':'' }}>Sudah Kawin</option>
        <option value="Cerai"       {{ $pelaku['status_perkawinan']=='Cerai'       ? 'selected':'' }}>Cerai</option>
      </select>
    </div>
    <div class="mb-3 col-md-6">
      <label class="form‑label">Kebangsaan</label>
      <input type="text" name="kebangsaan" class="form-control"
             value="{{ $pelaku['kebangsaan'] }}" required>
    </div>
    <div class="mb-3 col-md-6">
      <label class="form-label">Hubungan dengan Korban</label>
      <input type="text" name="hubungan_dengan_korban" class="form-control"
             value="{{ $pelaku['hubungan_dengan_korban'] }}" required>
    </div>

    <div class="mb-3 col-md-12">
      <label class="form‑label">Alamat Pelaku</label>
      <input type="text" name="alamat_pelaku" class="form-control"
             value="{{ $pelaku['alamat_pelaku'] }}" required>
    </div>
    <div class="mb-3 col-md-12">
      <label class="form-label">Alamat Detail</label>
      <textarea name="alamat_detail" class="form-control" rows="2">{{ $pelaku['alamat_detail'] }}</textarea>
    </div>
    <div class="mb-3 col-md-12">
      <label class="form-label">Keterangan Lainnya</label>
      <textarea name="keterangan_lainnya" class="form-control" rows="2">{{ $pelaku['keterangan_lainnya'] }}</textarea>
    </div>

    <div class="mb-3 col-md-12">
      <label class="form-label">Ganti Foto Pelaku</label>
      <input type="file" name="dokumentasi_pelaku" class="form-control">
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
  </div>
</form>

                        </div>
                    </div>
                </div>
      
                                            <div class="card-body">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                    <img src="{{ $pelaku['dokumentasi_pelaku'] }}" alt="user-avatar"
                                                        class="d-block rounded" height="150" width="150"
                                                        id="uploadedAvatar">
                                                </div>
                                            </div>
                                            <hr class="my-0">
                                            <div class="card-body">
                                                <form id="formAccountSettings" method="POST" onsubmit="return false">
                                                    <input type="text"
                                                        name="{{ $laporanDetailDiproses['no_registrasi'] }}" hidden>
                                                    <div class="row">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="nik" class="form-label">NIK (Nomor Induk
                                                                kependudukan)</label>
                                                            <input class="form-control" type="number" id="nik"
                                                                name="nik" value="{{ $pelaku['nik_pelaku'] }}"
                                                                disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="nama_pelaku" class="form-label">Nama
                                                                Pelaku</label>
                                                            <input class="form-control" type="text"
                                                                value="{{ $pelaku['nama_pelaku'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="usia_pelaku" class="form-label">Usia
                                                                Pelaku</label>
                                                            <input class="form-control" type="text"
                                                                value="{{ $pelaku['usia_pelaku'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="jenis_kelamin" class="form-label">Jenis
                                                                Kelamin</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $pelaku['jenis_kelamin'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="agama" class="form-label">Agama</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $pelaku['agama'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="agama">Nomor Telepon</label>
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text">ID (+62)</span>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $pelaku['no_telepon'] }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="pendidikan" class="form-label">Pendidikan</label>
                                                            <input class="form-control" type="text" name="pendidikan"
                                                                value="{{ $pelaku['pendidikan'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="status_perkawinan">Status
                                                                Perkawinan</label>
                                                            <input class="form-control" type="text" name="pendidikan"
                                                                value="{{ $pelaku['status_perkawinan'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="kebangsaan" class="form-label">Kebangsaan</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $pelaku['kebangsaan'] }}" disabled>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="hubungan_dengan_korban"
                                                                class="form-label">Hubungan dengan Korban</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $pelaku['hubungan_dengan_korban'] }}" disabled>
                                                        </div>
                                                        <div class="mb-6">
                                                            <label class="form-label"
                                                                for="basic-default-message">Keterangan lainnya</label>
                                                            <textarea id="basic-default-message" name="keterangan_lainnya" class="form-control" disabled>{{ $pelaku['keterangan_lainnya'] }}</textarea>
                                                        </div>
                                                        <h5 class="card-header text-center">Alamat Pelaku</h5>
                                                        @php
                                                            $alamatPelaku = explode(',', $pelaku['alamat_pelaku']);
                                                        @endphp
                                                        <div class="mb-3 col-md-6">
                                                            <label for="provinsi" class="form-label">Provinsi</label>
                                                            <input class="form-control" type="text" name="provinsi"
                                                                id="provinsi" value="{{ $alamatPelaku[0] }}">
                                                        </div>
            <div class="mb-3 col-md-6">
              <label for="kabupaten" class="form-label">Kabupaten</label>
              <input type="text" class="form-control" id="kabupaten"
                     name="kabupaten"
                     value="{{ $alamatPelaku[1] ?? '' }}">
            </div>
            <div class="mb-3 col-md-6">
              <label for="kecamatan" class="form-label">Kecamatan</label>
              <input type="text" class="form-control" id="kecamatan"
                     name="kecamatan"
                     value="{{ $alamatPelaku[2] ?? '' }}">
            </div>

            <div class="mb-3 col-md-6">
              <label for="alamat_pelaku" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat_pelaku"
                     name="alamat_pelaku"
                     placeholder="Contoh : Parparean I, Porsea…"
                     required>
            </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label" for="basic-default-message">Alamat
                                                                Detail</label>
                                                            <textarea id="basic-default-message" name="alamat_detail" class="form-control" placeholder="">{{ $pelaku['alamat_detail'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="container-xxl container-p-y d-flex justify-content-center align-items-center">
                                    <div class="misc-wrapper">
                                        <h2 class="mb-2 mx-2 ">Data Pelaku Belum Ditambahkan</h2>
                                        <h3 class="mb-4 mx-2">Apakah Dinas mendapatkan pelakunya?</h3>
                                        <center>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#exLargeModal">
                                            Tambah Data Pelaku
                                        </button>
</center>
                                        <div class="mt-4">
                                            <img src="asset-admin\assets\img\backgrounds/nodata.png"
                                                alt="girl-doing-yoga-light" width="500" class="img-fluid"
                                                data-app-dark-img="illustrations/nodata.png"
                                                data-app-light-img="illustrations/nodata.png" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Tambah Data Pelaku -->
<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data Pelaku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('pelaku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="d-flex align-items-start align-items-sm-center gap-4 mb-3">
            <!-- Preview Image dengan ID unik -->
            <img src="{{ asset('asset-admin/assets/img/avatars/upload.png') }}" 
                 alt="user-avatar" 
                 class="d-block rounded" 
                 height="250" width="250" 
                 id="imgPelaku">

            <div class="button-wrapper">
              <label for="uploadPelaku" class="btn btn-primary me-2 mb-4" tabindex="0">
                <span class="d-none d-sm-block">Upload foto pelaku</span>
                <i class="bx bx-upload d-block d-sm-none"></i>
                <input type="file"
                       id="uploadPelaku"
                       name="dokumentasi_pelaku"
                       class="account-file-input"
                       hidden
                       accept="image/png, image/jpeg"
                       required>
              </label>
              <button type="button"
                      class="btn btn-outline-secondary account-image-reset mb-4"
                      id="resetPelaku">
                <i class="bx bx-reset d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Reset</span>
              </button>
            </div>
          </div>

          <hr class="my-3">
          <input type="hidden" name="no_registrasi" value="{{ $laporanDetailDiproses['no_registrasi'] }}">

          <div class="row">
            <!-- Semua input lain tetap identik -->
            <div class="mb-3 col-md-6">
              <label for="nik_pelaku" class="form-label">NIK (Nomor Induk Kependudukan)</label>
              <input class="form-control" type="number" id="nik_pelaku" name="nik_pelaku" autofocus required>
            </div>
            <!-- kolom lainnya disini... -->
            <div class="mb-3 col-md-6">
              <label for="nama_pelaku" class="form-label">Nama Pelaku</label>
              <input class="form-control" type="text" id="nama_pelaku" name="nama_pelaku" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="usia_pelaku" class="form-label">Usia Pelaku</label>
              <input class="form-control" type="number" id="usia_pelaku" name="usia_pelaku" placeholder="Contoh: 21" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="agama" class="form-label">Agama</label>
              <input type="text" class="form-control" id="agama" name="agama" placeholder="Contoh: Kristen" required>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="no_telepon">Nomor Telepon</label>
              <div class="input-group">
                <span class="input-group-text">ID (+62)</span>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="0812..." required>
              </div>
            </div>
            <div class="mb-3 col-md-6">
              <label for="pendidikan" class="form-label">Pendidikan</label>
              <input class="form-control" type="text" id="pendidikan" name="pendidikan" placeholder="Contoh: S1" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="pekerjaan" class="form-label">Pekerjaan</label>
              <input class="form-control" type="text" id="pekerjaan" name="pekerjaan" placeholder="Contoh: Guru" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
              <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                <option value="">Pilih</option>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Sudah Kawin">Sudah Kawin</option>
                <option value="Cerai">Cerai</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="kebangsaan" class="form-label">Kebangsaan</label>
              <input type="text" class="form-control" id="kebangsaan" name="kebangsaan" placeholder="Contoh: Indonesia" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="hubungan_dengan_korban" class="form-label">Hubungan dengan Korban</label>
              <input type="text" class="form-control" id="hubungan_dengan_korban" name="hubungan_dengan_korban" placeholder="Contoh: Paman" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="alamat_pelaku" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat_pelaku" name="alamat_pelaku" placeholder="Contoh : Parparean I, Porsea, Toba, Sumatera Utara" required>
            </div>
            <div class="mb-3 col-md-6">
              <label for="alamat_detail" class="form-label">Alamat Detail</label>
              <textarea class="form-control" id="alamat_detail" name="alamat_detail" placeholder="Apakah anda tau alamat detail pelaku?"></textarea>
            </div>
            <div class="mb-3 col-md-6">
              <label for="keterangan_lainnya" class="form-label">Keterangan Lainnya</label>
              <textarea class="form-control" id="keterangan_lainnya" name="keterangan_lainnya" placeholder="Adakah keterangan lain mengenai pelaku ini?"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script Preview & Reset khusus modal Pelaku -->
<script>
  document.addEventListener('DOMContentLoaded', function(){
    const inputPelaku = document.getElementById('uploadPelaku');
    const imgPelaku   = document.getElementById('imgPelaku');
    const resetPelaku = document.getElementById('resetPelaku');
    const defaultSrc  = imgPelaku.src;

    if (!inputPelaku || !imgPelaku || !resetPelaku) return;

    inputPelaku.addEventListener('change', function(){
      const file = this.files[0];
      if (!file) return;
      if (!file.type.startsWith('image/')){
        alert('Hanya file gambar yang diperbolehkan.');
        this.value = '';
        return;
      }
      const reader = new FileReader();
      reader.onload = e => imgPelaku.src = e.target.result;
      reader.readAsDataURL(file);
    });

    resetPelaku.addEventListener('click', function(){
      inputPelaku.value = '';
      imgPelaku.src    = defaultSrc;
    });
  });
</script>
</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let img = document.getElementById('img');
        let input = document.getElementById('upload');
        let resetBtn = document.getElementById('reset');
        input.addEventListener('change', function(e) {
            if (input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    img.src = event.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
        resetBtn.addEventListener('click', function(e) {
            img.src = 'asset-admin/assets/img/avatars/upload.png';
            input.value = '';
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const documentImgs = document.querySelectorAll(".document-img");
        const documentVideos = document.querySelectorAll(".document-video");
        const modalContent = document.getElementById("modalContent");

        documentImgs.forEach(img => {
            img.addEventListener("click", function() {
                const imageUrl = this.getAttribute("data-image-url");
                modalContent.innerHTML =
                    `<img src="${imageUrl}" alt="dokumentasi" class="img-fluid">`;
            });
        });

        documentVideos.forEach(video => {
            video.addEventListener("click", function() {
                const videoUrl = this.getAttribute("data-video-url");
                modalContent.innerHTML = `
                    <video controls class="img-fluid">
                        <source src="${videoUrl}" type="video/{{ $extension }}">
                        Your browser does not support the video tag.
                    </video>`;
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button click event
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var eventId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus Data Pelaku ini?',
                    text: "Jika anda menghapus maka data tidak akan bisa kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + eventId).submit();
                    }
                });
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let img = document.getElementById('img');
        let input = document.getElementById('upload');
        let resetBtn = document.getElementById('reset');

        // Check if the elements exist
        if (img && input && resetBtn) {
            input.addEventListener('change', function(e) {
                if (input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        if (img) {
                            img.src = event.target.result;
                        }
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            });

            document.querySelector('label[for="upload"]').addEventListener('click', function(e) {
                input.click();
            });

            resetBtn.addEventListener('click', function(e) {
                img.src = '{{ asset('asset-admin/assets/img/avatars/upload.png') }}';
                input.value = '';
            });
        } else {
            console.error('Elements not found: img, input, resetBtn');
        }
    });
</script>
<script>
    document.querySelectorAll('.delete-korban').forEach(btn => {
        btn.addEventListener('click', function(){
            const id = this.dataset.id;
            const no = this.dataset.no;
            Swal.fire({
                title: 'Hapus Korban?',
                text: 'Data korban akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    // Buat form dinamis
const form = document.createElement('form');
form.method = 'POST';
form.action = `/admin/korban/${id}`;
form.innerHTML = `
  @csrf
  @method('DELETE')
  <input type="hidden" name="no_registrasi" value="${no}">
`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

