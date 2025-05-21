<footer style="background-color: #fff; padding: 40px 0;">
    <div class="container">
        <div class="row">
            <!-- Kolom Kiri: Logo & Tombol Download -->
            <div class="col-md-2 text-center text-md-start mb-4 mb-md-0">
                <!-- Logo -->
                <img src="assets/img/logo/new_logo2.png" alt="Pelita Pena" width="120" />
                <span style="margin-left:-3px; font-size: 22px; font-weight: bold; color: #2d3e69;">Pelita Pena</span>
                
                <!-- Tombol Download (di bawah logo) -->
                <div>
                </div>
            </div>

            <!-- Kolom Tengah: Navigasi Cepat, Ikon Sosial, & Copyright -->
            <div class="col-md-8 text-center">
                <!-- Judul Navigasi Cepat -->
                <h4 style="font-family: 'Poppins', sans-serif; color: #2d3e69; font-weight: bold; margin-bottom: 20px;font-size:30px">
                    Navigasi Cepat
                </h4>
                
                <!-- Menu Navigasi -->
                <ul id="navigation-footer">
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
                
                <!-- Ikon Sosial Media -->
                <div class="mb-4">
                    <!-- Pastikan Anda sudah memuat library ikon (mis. Font Awesome) -->
                    <a href="#" style="margin: 0 10px; color: #000;">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="margin: 0 10px; color: #000;">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="margin: 0 10px; color: #000;">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
                
                <!-- Copyright -->
                <p style="color: #666; margin: 0;">
                    &copy; <script>document.write(new Date().getFullYear());</script> DPMDPP | Dinas Pemberdayaan
                    Masyarakat Desa, Perempuan dan Anak
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Styling Navigasi */
    #navigation-footer {
        display: flex;
        justify-content: center;
        padding: 0;
    }
    
    #navigation-footer li {
        list-style: none;
        position: relative;
    }
    
    #navigation-footer li a {
        display: block;
        padding: 8px 10px;
        text-decoration: none;
        color: #2d3e69;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease;
        margin:8px;
        border-radius: 10px;
    }
    


</style>
