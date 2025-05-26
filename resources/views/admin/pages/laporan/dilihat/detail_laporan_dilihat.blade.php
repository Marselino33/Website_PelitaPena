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
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-pelaku" aria-controls="navs-pills-justified-profile"
                        aria-selected="false">
                        <i class="tf-icons bx bx-user"></i>
                        Pelaku
                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">
                            {{ count($laporanDetailDilihat['pelaku'] ?? []) }}
                        </span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-laporan" role="tabpanel">
                    <h3 class="card-header">Isi Laporan {{ $laporanDetailDilihat['no_registrasi'] }}</h3>
                    <h3>
                        Laporan dilihat pada
                        {{ \Carbon\Carbon::parse($laporanDetailDilihat['waktu_dilihat'])->format('d M Y, H:i') }}
                        dilihat oleh {{ $laporanDetailDilihat['user_melihat']['full_name'] }}
                    </h3>
                    <div class="card-body d-flex justify-content-start">
                        <form action="{{ route('laporan.proses', ['no_registrasi' => $laporanDetailDilihat['no_registrasi']]) }}"
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
                            @foreach ($laporanDetailDilihat['dokumentasi']['urls'] ?? [] as $url)
                                @php
                                    $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION) ?? '');
                                @endphp
                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif']))
                                    <img src="{{ $url }}" alt="dokumentasi" class="d-block rounded document-img"
                                         height="100" width="100" data-bs-toggle="modal"
                                         data-bs-target="#modalCenter" data-type="image"
                                         data-image-url="{{ $url }}">
                                @elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mkv', 'webm']))
                                    <video controls class="d-block rounded document-video" height="100" width="100"
                                           data-bs-toggle="modal" data-bs-target="#modalCenter" data-type="video"
                                           data-video-url="{{ $url }}">
                                        <source src="{{ $url }}" type="video/{{ $extension }}">
                                        Browser Anda tidak mendukung tag video
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
                                <div class="modal-body text-center" id="modalContent"></div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Field-field laporan... (tidak berubah) -->
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nomor Registrasi</label>
                            <input class="form-control" type="text" id="firstName" name="firstName"
                                   value="{{ $laporanDetailDilihat['no_registrasi'] }}">
                        </div>
                        <!-- ... dan seterusnya -->
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-pelapor" role="tabpanel">
                    <!-- Data Pelapor (tidak berubah) -->
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-korban" role="tabpanel">
                    @forelse ($laporanDetailDilihat['korban'] ?? [] as $korban)
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ $korban['dokumentasi_korban'] }}" alt="user-avatar"
                                     class="d-block rounded" height="150" width="150">
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">
                            <!-- Form data korban (tidak berubah) -->
                        </div>
                    @empty
                        <div class="container-xxl container-p-y d-flex justify-content-center align-items-center">
                            <div class="misc-wrapper">
                                <h2 class="mb-2 mx-2">Data Korban Belum Ditambahkan</h2>
                                <p class="mb-4 mx-2">Pelapor Belum menambahkan data korban pada kasus ini</p>
                                <img src="asset-admin/assets/img/backgrounds/nodata.png" alt="no data" width="500"
                                     class="img-fluid" />
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="tab-pane fade" id="navs-pills-justified-pelaku" role="tabpanel">
                    <div class="accordion mt-3" id="accordionExample">
                        @forelse ($laporanDetailDilihat['pelaku'] ?? [] as $index => $pelaku)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#accordion{{ $index }}"
                                            aria-expanded="false"
                                            aria-controls="accordion{{ $index }}">
                                        Data Pelaku {{ $index + 1 }}
                                    </button>
                                </h2>
                                <div id="accordion{{ $index }}" class="accordion-collapse collapse"
                                     aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <!-- Data Pelaku (tidak berubah, hanya guard null) -->
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="container-xxl container-p-y d-flex justify-content-center align-items-center">
                                <div class="misc-wrapper">
                                    <h2 class="mb-2 mx-2">Data Pelaku Belum Ditambahkan</h2>
                                    <img src="asset-admin/assets/img/backgrounds/nodata.png" alt="no data" width="500"
                                         class="img-fluid" />
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const documentImgs = document.querySelectorAll(".document-img");
        const documentVideos = document.querySelectorAll(".document-video");
        const modalContent = document.getElementById("modalContent");

        documentImgs.forEach(img => {
            img.addEventListener("click", function() {
                const imageUrl = this.dataset.imageUrl;
                modalContent.innerHTML = `<img src="${imageUrl}" alt="dokumentasi" class="img-fluid">`;
            });
        });

        documentVideos.forEach(video => {
            video.addEventListener("click", function() {
                const videoUrl = this.dataset.videoUrl;
                modalContent.innerHTML = `
                    <video controls class="img-fluid">
                        <source src="${videoUrl}" type="video/${videoUrl.split('.').pop()}">
                        Browser Anda tidak mendukung tag video
                    </video>`;
            });
        });
    });
</script>
@endpush
