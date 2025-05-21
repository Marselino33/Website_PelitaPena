<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="asset-admin/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <base href="/public">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="asset-admin/assets/img/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="asset-admin/assets/css/select2/select2.min.css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="asset-admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="asset-admin/assets/css/demo.css">
    <script src="asset-admin/assets/vendor/js/helpers.js"></script>
    <script src="asset-admin/assets/js/config.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom CSS for SweetAlert z-index -->
    <style>
        .swal2-container {
            z-index: 2000 !important;
            /* Adjust this value if necessary */
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.layouts.sidebar')
            <div class="layout-page">
                @include('admin.layouts.header')
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    @include('admin.layouts.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Tambah Data Korban Modal -->
    <div class="modal fade" id="tambahKorban" tabindex="-1" aria-labelledby="tambahKorbanLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahKorbanLabel">Tambah Data Korban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('korban.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Form fields go here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="asset-admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="asset-admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="asset-admin/assets/vendor/js/bootstrap.js"></script>
    <script src="asset-admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="asset-admin/assets/vendor/js/menu.js"></script>
    <script src="asset-admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="asset-admin/assets/js/main.js"></script>
    <script src="asset-admin/assets/vendor/libs/dropzone/dropzone.js"></script>
    <script src="asset-admin/assets/js/forms-file-upload.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="asset-admin/assets/js/pages-account-settings-account.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
<script src="{{ asset('js/laporan-export.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
    @stack('scripts')
</body>

</html>
