@extends('public.layouts.public_master')
@section('content')
    <div class="contact-area py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 style="font-family:poppins;font-size:35px" class="fw-bold mb-2">Kontak kami</h1>
                    <p class="text-muted mb-5">Kami Ada untuk Anda Kirimkan Pertanyaan atau saran Anda dan Tim Kami Akan Segera Menjawab.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="contact-form-card p-4 bg-white rounded shadow-sm">
                        <h3 class="mb-4 fw-bold">Kirim kami pesan</h3>
                        
                        <form class="form-contact" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="name" class="form-label d-block mb-2">Nama</label>
                                    <input type="text" class="form-control border" id="name" name="name" placeholder="Enter your name">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label d-block mb-2">Email</label>
                                    <input type="email" class="form-control border" id="email" name="email" placeholder="Enter your email">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label d-block mb-2">Subject</label>
                                <input type="text" class="form-control border" id="subject" name="subject" placeholder="bagaimana kami dapat membantu anda?">
                            </div>
                            
                            <div class="mb-4">
                                <label for="message" class="form-label d-block mb-2">Pesan</label>
                                <input type="text" style="height:200px" class="form-control border" id="subject" name="subject" placeholder="Tulis pesan anda di sini...">
                                <!-- <textarea style="height:50px" class="form-control border" id="message" name="message" rows="3" placeholder="Tulis pesan anada di sini..."></textarea> -->
                            </div>
                            
                            <button type="submit" style="background-color:#79B2E1" class="btn btn-primary w-100 rounded-pill">Kirim Email Sekarang →</button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="map-container mb-4 rounded overflow-hidden shadow-sm">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4905.267775428106!2d99.06063007934567!3d2.335780099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e0596302b7b71%3A0xdd3c80b4b307aa0f!2sDinas%20PMDPPA!5e1!3m2!1sid!2sid!4v1717293741155!5m2!1sid!2sid"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="contact-info-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-light-pink me-3">
                                        <img src="assets/img/logo/location.png" alt="Pelaporan Cepat"
                                        style="size: 50px">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                    </div>
                                    <h5 class="mb-0">Lokasi</h5>
                                </div>
                                <p class="mb-0 text-muted">Jl. Siliwangi No.1, Kec. Balige, Toba, Sumatera Utara 22312</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="contact-info-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-light-pink me-3">
                                        <i class="bi bi-envelope text-primary"></i>
                                        <img src="assets/img/logo/mail.png" alt="Pelaporan Cepat">
                                    </div>
                                    <h5 class="mb-0">Email kami</h5>
                                </div>
                                <p class="mb-0 text-muted">dpmdppa@tobakab.go.id</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="contact-info-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-light-pink me-3">
                                        <img src="assets/img/logo/phone-call.png" alt="Pelaporan Cepat">
                                        <i class="bi bi-telephone text-primary"></i>
                                    </div>
                                    <h5 class="mb-0">telepon kami</h5>
                                </div>
                                <p class="mb-0 text-muted">082276720003</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="contact-info-card p-4 bg-white rounded shadow-sm h-100">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-light-pink me-3">
                                        <img src="assets/img/logo/clock.png" alt="Pelaporan Cepat">
                                        <i class="bi bi-clock text-primary"></i>
                                    </div>
                                    <h5 class="mb-0">Jam Buka</h5>
                                </div>
                                <p class="mb-0 text-muted">Kami buka setiap hari 24 jam dari senin - minggu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }
    
    .contact-area {
        background-color: #f8f9fa;
        padding: 60px 0;
    }
    
    .map-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 ratio */
        height: 0;
        overflow: hidden;
        max-width: 100%;
        border-radius: 12px;
    }
    
    .map-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 0;
    }
    
    .contact-form-card, .contact-info-card {
        border-radius: 12px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .form-control {
        height: 50px;
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #e0e0e0;
    }
    
    .form-control::placeholder {
        color: #adb5bd;
    }
    
    textarea.form-control {
        height: auto;
        resize: none;
    }
    
    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .bg-light-pink {
        background-color: #ffebf0;
    }
    
    .btn-primary {
        background-color: #6c9aff;
        border-color: #6c9aff;
        transition: all 0.3s ease;
        height: 50px;
        font-weight: 500;
        border-radius: 25px;
    }
    
    .btn-primary:hover {
        background-color: #5a8eff;
        border-color: C;
    }
    
    h1 {
        font-size: 36px;
        font-weight: 700;
    }
    
    h3 {
        font-size: 24px;
        font-weight: 600;
    }
    
    h5 {
        font-size: 18px;
        font-weight: 600;
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-light-pink {
        background-color: #7FBC8C;
    }

    .icon-circle img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }
    
    /* Add Bootstrap Icons */
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css");
    /* Add Poppins font */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
</style>