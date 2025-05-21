@extends('admin.layouts.admin_master')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Daftar Category Kekerasan</h4>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
            <a href="{{ route('category-violence.create') }}" class="btn btn-primary">Buat Kategori</a>
        </div>
    </div>

    <div class="row">
        @forelse ($category_violences as $category_violence)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="rounded-3 text-center mb-3 pt-4">
                            <img class="img-fluid w-60" src="{{ $category_violence['image'] }}" alt="Gambar Kategori" />
                        </div>
                        <h4 class="mb-2 pb-1">{{ $category_violence['category_name'] }}</h4>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-primary btn-detail" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter" data-category-id="{{ $category_violence['id'] }}"
                                    data-category-image="{{ $category_violence['image'] }}"
                                    data-category-name="{{ $category_violence['category_name'] }}">
                                    <span class="tf-icons bx bx-show"></span>&nbsp;Detail
                                </button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('category-violence.edit', $category_violence['id']) }}"
                                    class="btn btn-sm btn-warning">
                                    <span class="tf-icons bx bx-pencil"></span>&nbsp;Edit
                                </a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('category-violence.destroy', $category_violence['id']) }}"
                                      method="POST" class="delete-category-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger btn-delete-category">
                                        <span class="tf-icons bx bx-trash"></span>&nbsp;Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="container-xxl container-p-y d-flex justify-content-center align-items-center">
                <div class="misc-wrapper">
                    <h2 class="mb-2 mx-2">Belum ada Kategori Kekerasan</h2>
                    <p class="mb-4 mx-2">Maaf, belum ada data kategori yang tersedia saat ini.</p>
                    <a href="{{ route('category-violence.create') }}" class="btn btn-primary">Buat Kategori</a>
                    <div class="mt-4">
                        <img src="asset-admin/assets/img/illustrations/girl-doing-yoga-light.png"
                             alt="Ilustrasi" width="500" class="img-fluid"
                             data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
                             data-app-light-img="illustrations/girl-doing-yoga-light.png" />
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form>
                    <div class="card-body text-center">
                        <img src="" id="categoryImage" height="300" width="300"
                             class="d-block rounded img-fluid mb-3" alt="Category Image">
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nama Kategori</label>
                            <input type="text" id="categoryName" class="form-control" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Detail Modal
            document.querySelectorAll('.btn-detail').forEach(button => {
                button.addEventListener('click', function () {
                    const image = button.getAttribute('data-category-image');
                    const name = button.getAttribute('data-category-name');
                    document.getElementById('categoryImage').src = image;
                    document.getElementById('categoryName').value = name;
                });
            });

            // Hapus Kategori dengan Konfirmasi SweetAlert
            document.querySelectorAll('.btn-delete-category').forEach(button => {
                button.addEventListener('click', function () {
                    const form = button.closest('form');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
