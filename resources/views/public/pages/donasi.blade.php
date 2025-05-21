@extends('public.layouts.public_master')

@section('content')
    <!-- Hero Section -->
    <div class="hero-area relative h-[500px] bg-black text-white">
        <img src="{{ asset('assets/img/children.jpg') }}" 
             alt="Children smiling" 
             class="absolute inset-0 w-full h-full object-cover opacity-70" />

        <div class="container relative z-10 h-full flex items-center">
            <div class="max-w-lg px-4 py-16">
                <h1 class="text-5xl font-bold mb-4" style="font-family:poppins">
                    Semua Orang Berhak Bahagia
                </h1>
                <p class="text-lg mb-8 text-white">
                    Salurkan kepedulian Anda untuk membantu para korban kekerasan pada anak
                </p>
                <a href="#donate" 
                   class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-md transition">
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- QR Code and Info Sections -->
    <div class="py-12 bg-white">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                {{-- First QR Code (ID 1) --}}
                @php $donation1 = $donations->firstWhere('id', 1); @endphp
                @if($donation1)
                    <div class="bg-white p-8 rounded-lg shadow-md cursor-pointer hover:scale-105 transition-transform"
                         onclick="window.location='{{ route('donation.detail', $donation1->id) }}'">
                        <img src="{{ asset('storage/' . $donation1->qr_image) }}"
                             alt="QR Code {{ $donation1->title }}"
                             class="w-64 h-64 mx-auto rounded-lg border border-gray-200 shadow-sm" />
                        <h3 class="mt-4 text-xl font-semibold text-center">
                            {{ $donation1->title }}
                        </h3>
                        <p class="mt-2 text-gray-600 text-center">
                            {{ Str::limit($donation1->description, 100) }}
                        </p>
                    </div>
                @else
                    <p class="text-center w-full">Data donasi dengan ID 1 tidak ditemukan.</p>
                @endif

                {{-- Info for First QR --}}
                <div class="space-y-4">
                    <div>
                        <h2 class="text-3xl font-bold" style="font-family:poppins">
                            Setiap Bantuan itu Berarti
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Berikut ini tahapan donasi kepada para korban kekerasan
                        </p>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-pink-500" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 
                                             3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 
                                             2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1
                                             M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold">Scan Barcode</h3>
                                <p class="text-sm text-gray-500">Scan barcode untuk melakukan donasi</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-pink-500" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold">Masukkan Jumlah Donasi</h3>
                                <p class="text-sm text-gray-500">Masukkan nominal donasi yang ingin Anda berikan</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-pink-500" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor">
                                    <path stroke-linecap="round" 
                                          stroke-linejoin="round" 
                                          stroke-width="2" 
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold">Tekan Tombol Kirim</h3>
                                <p class="text-sm text-gray-500">Tekan tombol kirim untuk menyelesaikan proses donasi</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Blue Banner Section -->
    <div class="py-16 bg-blue-400 text-white text-center">
        <div class="container">
            <h2 class="text-5xl font-bold mb-4" style="font-family:poppins">
                Donasi Anda Sangat Membantu Kami
            </h2>
            <p class="max-w-3xl mx-auto mb-8">
                Donasi dari Anda sangat membantu kami mengatasi kekerasan pada anak dan perempuan.
            </p>
            <a href="#donate" 
               class="inline-block bg-white text-blue-500 font-bold py-3 px-6 rounded-md transition hover:bg-gray-100">
                Donasi Sekarang
            </a>
        </div>
    </div>

    <!-- Second QR Code Section (ID 2) -->
    <div class="py-12 bg-white">
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                {{-- Second QR Code (ID 2) --}}
                @php $donation2 = $donations->firstWhere('id', 2); @endphp
                @if($donation2)
                    <div class="bg-white p-8 rounded-lg shadow-md cursor-pointer hover:scale-105 transition-transform"
                         onclick="window.location='{{ route('donation.detail', $donation2->id) }}'">
                        <img src="{{ asset('storage/' . $donation2->qr_image) }}"
                             alt="QR Code {{ $donation2->title }}"
                             class="w-64 h-64 mx-auto rounded-lg border border-gray-200 shadow-sm" />
                        <h3 class="mt-4 text-xl font-semibold text-center">
                            {{ $donation2->title }}
                        </h3>
                        <p class="mt-2 text-gray-600 text-center">
                            {{ Str::limit($donation2->description, 100) }}
                        </p>
                    </div>
                @else
                    <p class="text-center w-full">Data donasi dengan ID 2 tidak ditemukan.</p>
                @endif

                {{-- Info for Second QR --}}
                <div class="space-y-4">
                    <div>
                        <h2 class="text-3xl font-bold" style="font-family:poppins">
                            Berikan Bantuan Anda pada Pengembang
                        </h2>
                        <p class="mt-2 text-gray-600">
                            Berikut ini tahapan donasi kepada para pengembang
                        </p>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-pink-500" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold">Scan Barcode</h3>
                                <p class="text-sm text-gray-500">Scan barcode untuk melakukan donasi</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-pink-500" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold">Masukkan Jumlah Donasi</h3>
                                <p class="text-sm text-gray-500">Masukkan nominal donasi yang ingin Anda berikan</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                     class="h-5 w-5 text-pink-500" 
                                     fill="none" 
                                     viewBox="0 0 24 24" 
                                     stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold">Tekan Tombol Kirim</h3>
                                <p class="text-sm text-gray-500">Tekan tombol kirim untuk menyelesaikan proses donasi</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
