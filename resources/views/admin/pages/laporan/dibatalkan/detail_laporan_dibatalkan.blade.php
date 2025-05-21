@extends('admin.layouts.admin_master')
@section('content')
    <div class="col-xl-12">
        <h4 class="fw-bold py-3 mb-4">
            Laporan, Data Pelaku, Data Pelapor
        </h4>
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
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($laporanDetailDibatalkan['korban']) }}</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pelaku" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i>
                        Pelaku
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($laporanDetailDibatalkan['pelaku']) }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-laporan" role="tabpanel">

                    <h3 class="card-header">Isi Laporan {{ $laporanDetailDibatalkan['no_registrasi'] }}
                        <span class="badge bg-label-danger me-1">{{ $laporanDetailDibatalkan['status'] }}</span>
                    </h3>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="basic-default-message">Alasan Laporan Dibatalkan</label>
                        <textarea id="basic-default-message" class="form-control" disabled>{{ $laporanDetailDibatalkan['alasan_dibatalkan'] }}</textarea>
                    </div>
                    <h5 class="card-header">Dokumentasi</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @foreach ($laporanDetailDibatalkan['dokumentasi']['urls'] as $key => $url)
                                @php
                                    $pathInfo = pathinfo($url);
                                    $extension = strtolower($pathInfo['extension']);
                                @endphp
                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif']))
                                    <img src="{{ $url }}" alt="dokumentasi" class="d-block rounded document-img"
                                        height="100" width="100" data-bs-toggle="modal" data-bs-target="#modalCenter"
                                        data-type="image" data-image-url="{{ $url }}">
                                @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mkv', 'webm']))
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
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nomor Registrasi</label>
                            <input class="form-control" type="text" id="firstName" name="firstName"
                                value="{{ $laporanDetailDibatalkan['no_registrasi'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Kategori Kekerasan</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="{{ $laporanDetailDibatalkan['ViolenceCategory']['category_name'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Tanggal Pelaporan</label>
                            <input class="form-control"
                                value="{{ \Carbon\Carbon::parse($laporanDetailDibatalkan['tanggal_pelaporan'])->format('d M Y, H:i') }}"
                                placeholder="{{ \Carbon\Carbon::parse($laporanDetailDibatalkan['tanggal_pelaporan'])->format('d M Y, H:i') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Tanggal Kejadian</label>
                            <input class="form-control"
                                value="{{ \Carbon\Carbon::parse($laporanDetailDibatalkan['tanggal_kejadian'])->format('d M Y') }}"
                                placeholder="{{ \Carbon\Carbon::parse($laporanDetailDibatalkan['tanggal_kejadian'])->format('d M Y') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Kategori Lokasi Kekerasan</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="{{ $laporanDetailDibatalkan['kategori_lokasi_kasus'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Daerah Alamat TKP</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="{{ $laporanDetailDibatalkan['alamat_tkp'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Alamat Detail</label>
                            <textarea class="form-control" type="text">{{ $laporanDetailDibatalkan['alamat_detail_tkp'] }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="basic-default-message">Kronologi Kasus yang terjadi</label>
                            <textarea id="basic-default-message" class="form-control">{{ $laporanDetailDibatalkan['kronologis_kasus'] }}</textarea>
                        </div>

                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-pelapor" role="tabpanel">
                    <h3 class="card-header">Data Pelapor</h3>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ !empty($laporanDetailDibatalkan['Data']['User']['photo_profile']) ? $laporanDetailDibatalkan['Data']['User']['photo_profile'] : asset('asset-admin/assets/img/avatars/no_photo.png') }}"
                                alt="user-avatar" class="d-block rounded" height="200" width="200"
                                id="uploadedAvatar">
                        </div>
                    </div>
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
                                            value="{{ $laporanDetailDibatalkan['User']['full_name'] }}"
                                            aria-label="{{ $laporanDetailDibatalkan['User']['full_name'] }}"
                                            aria-describedby="basic-icon-default-fullname2">
                                    </div>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $laporanDetailDibatalkan['User']['username'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">NIK</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $laporanDetailDibatalkan['User']['nik'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="text" id="basic-icon-default-email" class="form-control"
                                            value="{{ $laporanDetailDibatalkan['User']['email'] }}"
                                            aria-label="{{ $laporanDetailDibatalkan['User']['email'] }}"
                                            aria-describedby="basic-icon-default-email2">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Tempat, tanggal Lahir</label>
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ $laporanDetailDibatalkan['User']['tempat_lahir'] }}, {{ $laporanDetailDibatalkan['User']['tanggal_lahir'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Nomor Handphone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            value="{{ $laporanDetailDibatalkan['User']['phone_number'] }}">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control"
                                        value="{{ $laporanDetailDibatalkan['User']['jenis_kelamin'] }}"
                                        id="jenis_kelamin" name="jenis_kelamin">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">Alamat</label>
                                    <input class="form-control" type="text" id="state" name="state"
                                        value="Alamat">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode"
                                        placeholder="231465" maxlength="6">
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-korban" role="tabpanel">

                    @forelse ($laporanDetailDibatalkan['korban'] as $korban)
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ $korban['dokumentasi_korban'] }}" alt="user-avatar" class="d-block rounded"
                                    height="150" width="150" id="uploadedAvatar">
                            </div>
                        </div>
                        <br>
                        <hr class="my-0">
                        <br>
                        <div class="card-body">
                            <form>
                                <input type="text" name="{{ $korban['no_registrasi'] }}" hidden>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="nik" class="form-label">NIK (Nomor Induk kependudukan)</label>
                                        <input class="form-control" type="number" value="{{ $korban['nik_korban'] }}"
                                            name="nik" disabled>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="nama_korban" class="form-label">Nama Korban</label>
                                        <input class="form-control" type="text" value="{{ $korban['nama_korban'] }}"
                                            name="nama_korban" id="nama_korban">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="usia_korban" class="form-label">Usia Korban</label>
                                        <input class="form-control" type="text" value="{{ $korban['usia_korban'] }}"
                                            id="usia_korban" name="usia_korban" placeholder="contoh 21">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                        <input type="text" class="form-control"
                                            value="{{ $korban['jenis_kelamin'] }}" id="jenis_kelamin"
                                            name="jenis_kelamin">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="agama" class="form-label">Agama</label>
                                        <input type="text" class="form-control" value="{{ $korban['agama'] }}"
                                            id="agama" name="agama" placeholder="Contoh Kristen">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="no_telepon">Nomor Telepon</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">ID (+62)</span>
                                            <input type="text" id="no_telepon" name="no_telepon" class="form-control"
                                                value="{{ $korban['no_telepon'] }}" placeholder="0812 ">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="pendidikan" class="form-label">Pendidikan</label>
                                        <input class="form-control" type="text" value="{{ $korban['pendidikan'] }}"
                                            id="pendidikan" name="pendidikan" placeholder="California">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="status_perkawinan">Status Perkawinan</label>
                                        <select id="status_perkawinan" class="select2 form-select"
                                            name="status_perkawinan">
                                            <option value="">Select</option>
                                            <option value="Belum Kawin"
                                                {{ $korban['status_perkawinan'] == 'Belum Kawin' ? 'selected' : '' }}>Belum
                                                Kawin</option>
                                            <option value="Sudah Kawin"
                                                {{ $korban['status_perkawinan'] == 'Sudah Kawin' ? 'selected' : '' }}>Sudah
                                                Kawin</option>
                                            <option value="Cerai"
                                                {{ $korban['status_perkawinan'] == 'Cerai' ? 'selected' : '' }}>Cerai
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="kebangsaan" class="form-label">Kebangsaan</label>
                                        <input type="text" class="form-control" value="{{ $korban['kebangsaan'] }}"
                                            id="kebangsaan" name="kebangsaan" placeholder="Contoh Indonesia">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="hubungan_dengan_pelaku" class="form-label">Hubungan dengan
                                            Pelaku</label>
                                        <input type="text" class="form-control"
                                            value="{{ $korban['hubungan_dengan_pelaku'] }}" id="hubungan_dengan_pelaku"
                                            name="hubungan_dengan_pelaku" placeholder="Contoh Paman">
                                    </div>
                                    <div class="mb-6">
                                        <label class="form-label" for="keterangan_lainnya">Keterangan lainnya</label>
                                        <textarea id="keterangan_lainnya" name="keterangan_lainnya" class="form-control"
                                            placeholder="adakah keterangan lain mengenai korban ini?">{{ $korban['keterangan_lainnya'] }}</textarea>
                                    </div>
                                    <h5 class="card-header text-center">Alamat Korban</h5>
                                    <div class="mb-3 col-md-6">
                                        <label for="provinsi" class="form-label">Provinsi</label>
                                        <input class="form-control" type="text"
                                            value="{{ $korban['alamat_korban'] }}" name="provinsi" id="provinsi">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="kabupaten" class="form-label">Kabupaten</label>
                                        <input class="form-control" type="text"
                                            value="{{ $korban['alamat_detail'] }}" name="kabupaten" id="kabupaten">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="kecamatan" class="form-label">Kecamatan</label>
                                        <input class="form-control" type="text"
                                            value="{{ $korban['alamat_korban'] }}" name="kecamatan" id="kecamatan">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="desa" class="form-label">Desa/Kelurahan</label>
                                        <input class="form-control" type="text"
                                            value="{{ $korban['alamat_detail'] }}" name="desa" id="desa">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="alamat_detail">Alamat Detail</label>
                                        <textarea id="alamat_detail" name="alamat_detail" class="form-control" placeholder="">{{ $korban['alamat_detail'] }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @empty
                        <div class="container-xxl container-p-y d-flex justify-content-center align-items-center">
                            <div class="misc-wrapper">
                                <h2 class="mb-2 mx-2 ">Pelapor Tidak menambahkan Data Korban </h2>
                                <div class="mt-4">
                                    <img src="asset-admin\assets\img\backgrounds/nodata.png" alt="girl-doing-yoga-light"
                                        width="500" class="img-fluid" data-app-dark-img="illustrations/nodata.png"
                                        data-app-light-img="illustrations/nodata.png" />
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-pelaku" role="tabpanel">
                    <div class="col-md mb-4 mb-md-0">
                        <div class="accordion mt-3" id="accordionExample">
                            @forelse ($laporanDetailDibatalkan['pelaku'] as $index => $pelaku)
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#accordion{{ $index }}"
                                            aria-expanded="false" aria-controls="accordion{{ $index }}">
                                            Data Pelaku {{ $index + 1 }}
                                        </button>
                                    </h2>
                                    <div id="accordion{{ $index }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <h5 class="card-header">Data Pelaku</h5>
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
                                                        name="{{ $laporanDetailDibatalkan['no_registrasi'] }}" hidden>
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
                                                            <select id="status_perkawinan" class="select2 form-select">
                                                                <option value="">Select</option>
                                                                <option value="Belum Kawin"
                                                                    {{ $pelaku['status_perkawinan'] == 'Belum Kawin' ? 'selected' : '' }}>
                                                                    Belum Kawin</option>
                                                                <option value="Sudah Kawin"
                                                                    {{ $pelaku['status_perkawinan'] == 'Sudah Kawin' ? 'selected' : '' }}>
                                                                    Sudah Kawin</option>
                                                                <option value="Cerai"
                                                                    {{ $pelaku['status_perkawinan'] == 'Cerai' ? 'selected' : '' }}>
                                                                    Cerai</option>
                                                            </select>
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
                                                            <input class="form-control" type="text" name="kabupaten"
                                                                id="kabupaten" value="{{ $alamatPelaku[1] }}">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="kecamatan" class="form-label">Kecamatan</label>
                                                            <input class="form-control" type="text" name="kecamatan"
                                                                id="kecamatan" value="{{ $alamatPelaku[2] }}">
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label for="desa"
                                                                class="form-label">Desa/Kelurahan</label>
                                                            <input class="form-control" type="text" name="desa"
                                                                id="desa" value="{{ $alamatPelaku[3] }}">
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
                                        <h2 class="mb-2 mx-2 ">Pelapor Tidak Menambahkan Pelaku</h2>

                                        <div class="mt-4">
                                            <img src="asset-admin\assets\img\backgrounds/nodata.png"
                                                alt="girl-doing-yoga-light" width="500" class="img-fluid"
                                                data-app-dark-img="illustrations/nodata.png"
                                                data-app-light-img="illustrations/nodata.png" />
                                        </div>
                                    </div>
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
