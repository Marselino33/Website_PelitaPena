<header style="position: fixed; top: 0; left: 0; right: 0; z-index: 1000;">
    <div class="header-area" style="background-color: rgb(207, 229, 248); padding: 10px 0; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo dan Teks -->
                <div class="col-xl-2 col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ route('welcome') }}">
                            <div style="display: flex; align-items: center;">
                                <img src="assets/img/logo/new_logo2.png" alt="Pelita Pena" width="60">
                                <span class="logo-text">Pelita Pena</span>
                            </div>
                        </a>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <div class="col-xl-7 col-lg-7 col-md-7">
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li class="{{ \Route::is('welcome') ? 'active' : '' }}">
                                    <a href="{{ route('welcome') }}">Beranda</a>
                                </li>
                                <li class="{{ \Route::is('content') || \Route::is('content.detail') ? 'active' : '' }}">
                                    <a href="{{ route('content') }}">Konten</a>
                                </li>
                                <li class="{{ \Route::is('event') || \Route::is('event.detail') ? 'active' : '' }}">
                                    <a href="{{ route('event') }}">Event</a>
                                </li>
                                <li class="{{ \Route::is('contact') ? 'active' : '' }}">
                                    <a href="{{ route('contact') }}">Kontak</a>
                                </li>
                                <li class="{{ \Route::is('donasi') ? 'active' : '' }}">
                                    <a href="{{ route('donasi') }}">Donasi</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Buttons -->
                @php
                    use Illuminate\Support\Facades\Cookie;

                    $hasToken = Cookie::has('user_token');
                    $userData = $hasToken
                        ? json_decode(Cookie::get('user_data'), true)
                        : null;
                @endphp

                <div class="col-xl-3 col-lg-3 col-md-3 d-none d-lg-flex justify-content-start" style="margin-left: -120px;">
                    @if (! $hasToken)
                        {{-- Belum login --}}
                        <a href="{{ route('user.login') }}" style="margin-right: 10px;">
                            <button type="button" class="header-btn">LOGIN</button>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#downloadModal" class="header-btn">DOWNLOAD</button> 
                    @else
                        {{-- Sudah login --}}
                        @if ($userData['role'] === 'admin')
                            <a href="{{ route('admin.dashboard') }}">
                                <button type="button" class="header-btn">BERANDA ADMIN</button>
                            </a>
                        @else
                            <a href="{{ route('user.profile') }}">
                                <button type="button" class="header-btn">AKUN SAYA</button>
                            </a>
                        @endif
                    @endif
                </div>

                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Pelita Pena</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="download-container">
                    <div class="download-text">
                        <h1>Pindai kode QR dan dapatkan aplikasinya sekarang!</h1>
                    </div>
                    <div class="download-qr-code">
                        <img src="assets/img/logo/qr.png" alt="QR Code">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Navigasi */
    #navigation {
        display: flex;
        justify-content: center;
        padding: 0;
    }

    #navigation li {
        list-style: none;
        position: relative;
    }

    #navigation li a {
        display: block;
        padding: 8px 10px;
        text-decoration: none;
        color: #2d3e69;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin:8px;
        border-radius: 10px;
    }

    /* Hover Effect: Background dan Warna Teks - Changed to green */
    #navigation li a:hover {
        background-color: #7FBC8C;
        color: white;
    }

    /* Active menu item - Changed to green */
    #navigation li.active a {
        background-color: #7FBC8C;
        color: white;
        font-weight: bold;
    }

    /* Hover Effect untuk Tombol Header - Changed to green */
    .header-btn {
        background-color: #7FBC8C;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 20px;
        font-weight: 500;
        font-size: 15px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-right: 10px;
    }

    .header-btn:hover {
        background-color: rgba(127, 188, 140, 0.55);
        transform: scale(1.05);
    }

    /* Hover Effect untuk Logo */
    .logo-text {
        margin-left: 10px;
        font-size: 22px;
        font-weight: bold;
        color: #2d3e69;
        transition: color 0.3s ease;
    }

    .logo a:hover .logo-text {
        color: #7FBC8C;
    }

    /* Download modal styles */
    .download-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        max-width: 600px;
        margin: auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .download-text {
        flex: 1;
        margin-right: 20px;
    }
    .download-text h1 {
        font-size: 1.5em;
        margin-bottom: 10px;
    }
    .download-qr-code {
        flex: none;
    }
    .download-qr-code img {
        height: 200px;
        width: 200px;
    }

    /* Responsive adjustments for modal */
    @media (max-width: 768px) {
        .download-container {
            flex-direction: column;
        }
        .download-text {
            margin-right: 0;
            margin-bottom: 20px;
            text-align: center;
        }
    }

    /* Agar konten utama tidak tertutup oleh header fixed */
    body {
        padding-top: 80px; /* Sesuaikan dengan tinggi header */
    }
</style>
