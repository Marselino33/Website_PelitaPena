@extends('public.layouts.public_master')

@section('content')
<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(135deg,rgb(240, 246, 252) 0%,rgb(248, 231, 236) 100%); padding: 5px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
            <h1 class="mb-4" style="font-size: 3rem; color: #2d3e69; font-weight: bold; font-family: 'Poppins', sans-serif;">
   Hadapi Kekerasan dengan Pelita Pena
        </h1>

                <p class="mb-4" style="color: #666; font-size: 1.1rem;">
                Hadapi Kekerasan dengan Pelita Pena, Solusi Cerdas untuk Mengatasi Ancaman dan Menciptakan Keamanan Bersama.      
            </p>
                <div class="hero-buttons">
                    {{-- <button class="btn" style="background-color: #7FBC8C; color: white; padding: 8px 30px; border-radius: 5px; border: none; margin-right: 15px;">
                        Download
                    </button> --}}
<button id="scroll-to-features"
        style="background-color: #7FBC8C; color: white; padding: 8px 30px; border-radius: 5px; border: none; margin-right: 15px;">
  Lihat Selengkapnya
</button>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="assets/img/hero/app.png" alt="Pelita Pena Screenshot" class="img-fluid" style="max-width: 80%; margin-left: auto; display: block;">
            </div>
        </div>
    </div>
</section>

<!-- App Features Section -->
<section id="features" class="features-section" style="padding: 50px 0;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom Kiri (Teks & Fitur) -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <!-- Label kecil di atas -->
                <p style="color: #79B2E1; font-weight: 600; margin-bottom: 0;">
                    Pelita Pena
                </p>
                <!-- Judul besar -->
                <h2 style="color: #121127; font-weight: bold; margin: 10px 0 20px; font-size: 2rem;font-family: 'Poppins'">
                    Tentang Aplikasi Pelita Pena
                </h2>
                <!-- Deskripsi singkat -->
                <p style="color: #666; margin-bottom: 20px;">Pelita Pena adalah aplikasi yang memudahkan masyarakat melaporkan kekerasan terhadap anak dan perempuan secara cepat, aman, dan rahasia.
                    <br>
Selain pelaporan, aplikasi ini menyediakan informasi edukatif, layanan chat,pelacakan laporan, dan janji temu. Dengan tampilan yang sederhana, Pelita Pena hadir sebagai solusi praktis untuk menciptakan lingkungan yang lebih aman dan peduli.</p>
                <!-- Tombol Download -->
                <!-- <button class="btn"
                        >
                    Download
                </button> -->
                                        <button style="background-color: #7FBC8C; color: white; padding: 10px 30px; border: none; border-radius: 5px; margin-bottom: 30px;" type="button" data-toggle="modal" data-target="#downloadModal" class="header-btn">DOWNLOAD</button> 

                <!-- Dua fitur di bawah tombol -->
                <div class="row g-4">
                    <!-- Fitur 1 -->
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <!-- Ganti icon_telpon.png dengan ikon yang sesuai -->
                            <img src="assets/img/logo/icon_telpon.png" alt="Pelaporan Cepat"
                                 style="width: 30px; margin-right: 15px;height: 30px;">
                            <div>
                                <h5 style="color: #2d3e69; margin-bottom: 5px;font-weight:bold;font-size:20px">Pelaporan Melalui Panggilan</h5>
                                <p style="color: #666; margin-bottom: 0;">
                                Dengan Satu Klik, Dapatkan Dukungan yang Anda Butuhkan untuk Menangani Situasi Darurat.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Fitur 2 -->
                    <div class="col-sm-6">
                        <div class="d-flex">
                            <!-- Ganti icon_orang.png dengan ikon yang sesuai -->
                            <img src="assets/img/logo/icon_orang.png" alt="Konsultasi Langsung"
                                 style="width: 30px; margin-right: 15px;height: 30px;">
                            <div>
                                <h5 style="color: #2d3e69; margin-bottom: 5px;font-weight:bold;font-size:20px">Pelaporan Form dan Janji Temu</h5>
                                <p style="color: #666; margin-bottom: 0;">
                                Hubungkan Suara Anda dengan Tindakan, Melaporkan Masalah dan Menjadwalkan Pertemuan dengan kami
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan (Mockup Aplikasi) -->
            <div class="col-lg-6 text-center text-lg-end">
                <!-- Ganti img.png dengan mockup aplikasi Anda -->
                <img src="assets/img/hero/img.png" alt="App Screenshots" class="img-fluid" style="max-width: 100%;">
            </div>
        </div>
    </div>
</section>


<!-- Tutorial Section -->
<section class="tutorial-section" style="padding: 80px 0; background-color: #f8f9fa;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Kolom Kiri: Gambar / Mockup -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <!-- Gambar default (pertama kali muncul) -->
                <img id="tutorial-image"
                     src="assets/img/logo/tutor.png"
                     alt="Tutorial"
                     class="img-fluid"
                     style="max-width: 100%; display: block; margin: 0 auto;">
            </div>

            <!-- Kolom Kanan: Judul + Langkah-langkah -->
            <div class="col-lg-7">
                <h2 style="color: #2d3e69; font-weight: bold; font-size: 2rem; margin-bottom: 30px; font-family: 'Poppins'; max-width:500px;">
                    Tutorial Penggunaan Aplikasi Pelita Pena
                </h2>

                <!-- Daftar Langkah -->
                <div class="step-list">
                    <!-- STEP 1 -->
                    <div class="step-item d-flex align-items-start mb-4" 
                         data-image="assets/img/gallery/App1.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            1
                        </div>
                        <p style="margin: 0; color: #666;">
Lakukan pelaporan melalui fitur panggilan yang tersedia di aplikasi.
                        </p>
                    </div>

                    <!-- STEP 2 -->
                    <div class="step-item d-flex align-items-start mb-4" 
                         data-image="assets/img/gallery/App2.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            2
                        </div>
                        <p style="margin: 0; color: #666;">
                            Login atau daftarkan akun Anda untuk mengakses layanan aplikasi.
                        </p>
                    </div>

                    <!-- STEP 3 -->
                    <div class="step-item d-flex align-items-start mb-4" 
                         data-image="assets/img/gallery/App3.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            3
                        </div>
                        <p style="margin: 0; color: #666;">
                            Silakan gunakan fitur-fitur yang telah disediakan sesuai kebutuhan Anda.
                        </p>
                    </div>

                    <!-- STEP 4 -->
                    <div class="step-item d-flex align-items-start mb-4" 
                         data-image="assets/img/gallery/App4.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            4
                        </div>
                        <p style="margin: 0; color: #666;">
                            Laporkan kasus kekerasan yang Anda alami atau saksikan dengan aman.
                        </p>
                    </div>

                    <!-- STEP 5 -->
                    <div class="step-item d-flex align-items-start"
                         data-image="assets/img/gallery/App5.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            5
                        </div>
                        <p style="margin: 0; color: #666;">
                            Unggah atau kirim bukti pendukung untuk memperkuat laporan Anda
                        </p>
                    </div>

                                        <!-- STEP 6-->
                    <div class="step-item d-flex align-items-start"
                         data-image="assets/img/gallery/App6.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            6
                        </div>
                        <p style="margin: 0; color: #666;">
Ajukan janji temu dengan petugas.
                        </p>
                    </div>
                                        <!-- STEP 5 -->
                    {{-- <div class="step-item d-flex align-items-start"
                         data-image="assets/img/gallery/App7.png"
                         style="padding: 15px 20px; border-radius: 8px; transition: background-color 0.3s ease; cursor: pointer;">
                        <div class="step-number"
                             style="background-color: #7FBC8C; color: #fff; padding: 8px 12px; border-radius: 8px; font-weight: bold; margin-right: 15px;">
                            7
                        </div>
                        <p style="margin: 0; color: #666;">
Gunakan fitur chat untuk berkonsultasi langsung dengan petugas.
                        </p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Style tambahan untuk efek hover -->
<style>
    /* Efek hover: ubah background menjadi #79B2E1, teks menjadi putih */
    .step-item:hover {
        background-color: #79B2E1;
    }
    .step-item:hover p {
        color: #ffffff !important;
    }
    .step-item:hover .step-number {
        background-color: #7FBC8C;
        color: #ffffff;
    }
</style>

<!-- JavaScript untuk mengubah gambar saat step diklik -->
<script>
    // Seleksi semua elemen dengan class .step-item
    const stepItems = document.querySelectorAll('.step-item');

    // Setiap step-item, tambahkan event listener "click"
    stepItems.forEach(item => {
        item.addEventListener('click', () => {
            // Ambil nilai data-image dari step-item
            const newImage = item.getAttribute('data-image');
            // Ganti src gambar di #tutorial-image dengan data-image
            document.getElementById('tutorial-image').src = newImage;
        });
    });
</script>


<!-- Contact Section -->
<section class="contact-section" style="padding: 80px 0; background-color: #79B2E1;">
    <div class="container text-center">
        <h2 class="mb-4" style="color:rgb(255, 255, 255); font-weight: bold;font-family: 'Poppins';font-size:40px">Punya Saran?</h2>
        <h3 class="mb-4" style="color:rgb(255, 255, 255);font-family: 'Poppins'">Berikan saran anda kepada kami</h3>
        <center>
        <p class="mb-5" style="color: #ffffff;width: 650px;font-family: 'Poppins';font-weight: regular">
        Jadilah bagian dari perubahan! Kirimkan saran Anda untuk membantu kami memahami bagaimana kami dapat lebih baik dalam melayani kebutuhan Anda. Kami menghargai setiap pendapat yang Anda sampaikan.
        </p>
        </center>
<a href="{{ route('contact') }}">
    <button class="btn" style="background-color:rgb(255, 255, 255); color: #121127; padding: 10px 30px; border-radius: 5px; border: none;">
        Kontak kami
    </button>
</a>
    </div>
</section>

<style>
    html {
  scroll-behavior: smooth;
}
    .hero-section {
        overflow: hidden;
    }
    
    .feature-item {
        transition: all 0.3s ease;
    }
    
    .feature-item:hover {
        transform: translateY(-5px);
    }
    
    .tutorial-steps .step {
        transition: all 0.3s ease;
    }
    
    .tutorial-steps .step:hover {
        transform: translateX(10px);
    }
    
    @media (max-width: 768px) {
        .hero-section {
            text-align: center;
            padding: 40px 0;
        }
        
        .hero-buttons {
            justify-content: center;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .features-section,
        .tutorial-section,
        .contact-section {
            padding: 40px 0;
        }
    }
</style>
<script>
  document.getElementById('scroll-to-features').addEventListener('click', function() {
    document.getElementById('features').scrollIntoView({ behavior: 'smooth' });
  });
</script>
@endsection
