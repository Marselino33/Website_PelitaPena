@extends('admin.layouts.admin_master')
@section('content')
    <div class="col-xl-12">
        <h4 class="fw-bold py-3 mb-4">
            Laporan, Data Pelaku, Data Pelapor
        </h4>
        <div class="nav-align-top mb-4">
@php
    $tab = request('tab', 'laporan'); // default ke 'laporan' jika tidak ada
@endphp

<ul class="nav nav-pills mb-3 nav-fill" role="tablist">
    <li class="nav-item">
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'laporan']) }}"
            class="nav-link {{ $tab === 'laporan' ? 'active' : '' }}">
            <i class="tf-icons bx bx-home"></i> Laporan
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'pelapor']) }}"
            class="nav-link {{ $tab === 'pelapor' ? 'active' : '' }}">
            <i class="tf-icons bx bx-user"></i> Pelapor
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'korban']) }}"
            class="nav-link {{ $tab === 'korban' ? 'active' : '' }}">
            <i class="tf-icons bx bx-user"></i> Korban
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ request()->fullUrlWithQuery(['tab' => 'pelaku']) }}"
            class="nav-link {{ $tab === 'pelaku' ? 'active' : '' }}">
            <i class="tf-icons bx bx-user"></i> Pelaku
            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                {{ count($laporanDetail['pelaku']) }}
            </span>
        </a>
    </li>
</ul>

            <div class="tab-content">
<div class="tab-pane fade {{ $tab === 'laporan' ? 'show active' : '' }}" id="navs-pills-justified-laporan" role="tabpanel">

                    <h3 class="card-header">Isi Laporan {{ $laporanDetail['no_registrasi'] }}</h3>
                    <div class="card-body d-flex justify-content-start">
                        <form action="{{ route('laporan.proses', ['no_registrasi' => $laporanDetail['no_registrasi']]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-primary me-2">
                                Proses Sekarang
                            </button>
                        </form>
                    </div>

                    <h5 class="card-header">Dokumentasi</h5>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            @foreach ($laporanDetail['dokumentasi']['urls'] as $key => $url)
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
                                value="{{ $laporanDetail['no_registrasi'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Kategori Kekerasan</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="{{ $laporanDetail['ViolenceCategory']['category_name'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Tanggal Pelaporan</label>
                            <input class="form-control"
                                value="{{ \Carbon\Carbon::parse($laporanDetail['tanggal_pelaporan'])->format('d M Y, H:i') }}"
                                placeholder="{{ \Carbon\Carbon::parse($laporanDetail['tanggal_pelaporan'])->format('d M Y, H:i') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Tanggal Kejadian</label>
                            <input class="form-control"
                                value="{{ \Carbon\Carbon::parse($laporanDetail['tanggal_kejadian'])->format('d M Y') }}"
                                placeholder="{{ \Carbon\Carbon::parse($laporanDetail['tanggal_kejadian'])->format('d M Y') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Kategori Lokasi Kekerasan</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="{{ $laporanDetail['kategori_lokasi_kasus'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Daerah Alamat TKP</label>
                            <input class="form-control" type="text" name="lastName" id="lastName"
                                value="{{ $laporanDetail['alamat_tkp'] }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Alamat Detail</label>
                            <textarea class="form-control" type="text">{{ $laporanDetail['alamat_detail_tkp'] }}</textarea>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="basic-default-message">Kronologi Kasus yang terjadi</label>
                            <textarea id="basic-default-message" class="form-control">{{ $laporanDetail['kronologis_kasus'] }}</textarea>
                        </div>

                    </div>
                </div>
<div class="tab-pane fade {{ $tab === 'pelapor' ? 'show active' : '' }}" id="navs-pills-justified-pelapor" role="tabpanel">
                    <h3 class="card-header">Data Pelapor</h3>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ !empty($laporanDetail['Data']['User']['photo_profile']) ? $laporanDetail['Data']['User']['photo_profile'] : asset('asset-admin/assets/img/avatars/no_photo.png') }}"
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
                                            value="{{ $laporanDetail['User']['full_name'] }}"
                                            aria-label="{{ $laporanDetail['User']['full_name'] }}"
                                            aria-describedby="basic-icon-default-fullname2">
                                    </div>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Username</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $laporanDetail['User']['username'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">NIK</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName"
                                        value="{{ $laporanDetail['User']['nik'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="bx bx-envelope"></i>
                                        </span>
                                        <input type="text" id="basic-icon-default-email" class="form-control"
                                            value="{{ $laporanDetail['User']['email'] }}"
                                            aria-label="{{ $laporanDetail['User']['email'] }}"
                                            aria-describedby="basic-icon-default-email2">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="organization" class="form-label">Tempat, tanggal Lahir</label>
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ $laporanDetail['User']['tempat_lahir'] }}, {{ $laporanDetail['User']['tanggal_lahir'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Nomor Handphone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            value="{{ $laporanDetail['User']['phone_number'] }}">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control"
                                        value="{{ $laporanDetail['User']['jenis_kelamin'] }}" id="jenis_kelamin"
                                        name="jenis_kelamin">
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
<div class="tab-pane fade {{ $tab === 'pelaku' ? 'show active' : '' }}" id="navs-pills-justified-pelaku" role="tabpanel">
                @forelse ($laporanDetail['pelaku'] as $pelaku)
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $pelaku['dokumentasi_pelaku'] }}" alt="user-avatar" class="d-block rounded"
                                height="150" width="150">
                        </div>
                    </div>
                    <br>
                    <hr class="my-0">
                    <br>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="nama_pelaku" class="form-label">Nama Pelaku</label>
                                    <input type="text" class="form-control" id="nama_pelaku" name="nama_pelaku"
                                        value="{{ $pelaku['nama_pelaku'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nik_pelaku" class="form-label">NIK Pelaku</label>
                                    <input type="text" class="form-control" id="nik_pelaku" name="nik_pelaku"
                                        value="{{ $pelaku['nik_pelaku'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="jenis_kelamin_pelaku" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin_pelaku" name="jenis_kelamin_pelaku"
                                        value="{{ $pelaku['jenis_kelamin'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="agama_pelaku" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama_pelaku" name="agama_pelaku"
                                        value="{{ $pelaku['agama'] }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kebangsaan_pelaku" class="form-label">Kebangsaan</label>
                                    <input type="text" class="form-control" id="kebangsaan_pelaku" name="kebangsaan_pelaku"
                                        value="{{ $pelaku['kebangsaan'] }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="alamat_pelaku" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat_pelaku" name="alamat_pelaku">{{ $pelaku['alamat_pelaku'] }}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                @empty
                    <div class="container-xxl container-p-y d-flex justify-content-center align-items-center">
                        <div class="misc-wrapper">
                            <h2 class="mb-2 mx-2">Data Pelaku Belum Ditambahkan</h2>
                            <p class="mb-4 mx-2">Pelapor belum menambahkan data pelaku untuk kasus ini.</p>
                            <div class="mt-4">
                                <img src="{{ asset('asset-admin/assets/img/backgrounds/nodata.png') }}" alt="no-data"
                                    width="500" class="img-fluid">
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
