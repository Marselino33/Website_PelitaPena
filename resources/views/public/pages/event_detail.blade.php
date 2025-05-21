@extends('public.layouts.public_master')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="background-color: #ffffff; padding: 25px 0; margin-bottom: 20px;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 style="color: #2d3e69; font-weight: 700; position: relative; display: inline-block; font-size: 26px; margin-bottom: 5px;">
                            Event Details
                            <span style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background-color: #7FBC8C; border-radius: 2px;"></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="event-detail-area" style="padding: 20px 0 40px; background-color: #F5F7FA;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if ($event)
                        <article class="event-detail" style="background-color: white; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 15px rgba(0,0,0,0.05);">
                            <div class="row no-gutters">
                                <!-- Event Image - More proportional size -->
                                <div class="col-md-5">
                                    <div class="event-image" style="height: 100%; position: relative;">
                                        <img src="{{ $event['thumbnail_event'] }}" alt="{{ $event['nama_event'] }}" 
                                            style="width: 100%; height: 100%; object-fit: cover; max-height: 400px;">
                                        
                                        <!-- Event Date Badge -->
                                        <div class="event-date" style="position: absolute; top: 20px; left: 20px; background-color: #7FBC8C; color: white; border-radius: 8px; padding: 8px 12px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,0.1);">
                                            <div style="font-size: 18px; font-weight: 700; line-height: 1;">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('d') }}</div>
                                            <div style="font-size: 12px; text-transform: uppercase;">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('M Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Event Content -->
                                <div class="col-md-7">
                                    <div class="event-content" style="padding: 30px;">
                                        <!-- Title -->
                                        <h1 style="color: #2d3e69; font-size: 24px; font-weight: 700; margin-bottom: 15px; line-height: 1.3;">
                                            {{ $event['nama_event'] }}
                                        </h1>
                                        
                                        <!-- Meta Info -->
                                        <div class="event-meta" style="display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                                            <div class="meta-item" style="display: flex; align-items: center; color: #777; font-size: 14px;">
                                                <i class="fa fa-calendar" style="color: #7FBC8C; margin-right: 8px; width: 16px;"></i>
                                                {{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->locale('id')->isoFormat('LL') }}
                                            </div>
                                            <div class="meta-item" style="display: flex; align-items: center; color: #777; font-size: 14px;">
                                                <i class="fa fa-clock-o" style="color: #7FBC8C; margin-right: 8px; width: 16px;"></i>
                                                {{ \Carbon\Carbon::parse($event['created_at'])->locale('id')->diffForHumans() }}
                                            </div>
                                        </div>
                                        
                                        <!-- Description Preview -->
                                        <div class="event-description-preview" style="color: #444; font-size: 15px; line-height: 1.7; margin-bottom: 20px; max-height: 300px; overflow-y: auto;">
                                            <p>{!! Str::limit(strip_tags($event['deskripsi_event']), 300, '...') !!}</p>
                                        </div>
                                        
                                        <!-- Share Buttons -->
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Full Description -->
                            <div class="full-description" style="padding: 0 30px 30px;">
                                <h3 style="color: #2d3e69; font-size: 18px; font-weight: 600; margin: 20px 0; position: relative; padding-bottom: 10px;">
                                    Deskripsi Lengkap
                                    <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background-color: #7FBC8C; border-radius: 1px;"></span>
                                </h3>
                                
                                <div class="event-description" style="color: #444; font-size: 15px; line-height: 1.7;">
                                    {!! $event['deskripsi_event'] !!}
                                </div>
                            </div>
                            
                            <!-- Location Map (if coordinates available) -->
                            @if(isset($event['lokasi_lat']) && isset($event['lokasi_long']))
                            <div class="event-location" style="padding: 0 30px 30px;">
                                <h3 style="color: #2d3e69; font-size: 18px; font-weight: 600; margin: 20px 0; position: relative; padding-bottom: 10px;">
                                    Lokasi Event
                                    <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background-color: #7FBC8C; border-radius: 1px;"></span>
                                </h3>
                                
                                <div class="map-container" style="height: 300px; border-radius: 10px; overflow: hidden;">
                                    <iframe 
                                        width="100%" 
                                        height="100%" 
                                        frameborder="0" 
                                        scrolling="no" 
                                        marginheight="0" 
                                        marginwidth="0" 
                                        src="https://maps.google.com/maps?q={{ $event['lokasi_lat'] }},{{ $event['lokasi_long'] }}&hl=id&z=14&output=embed">
                                    </iframe>
                                </div>
                            </div>
                            @endif
                        </article>
                    @else
                        <div class="empty-state" style="text-align: center; padding: 50px 20px; background-color: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
                            <i class="fa fa-calendar-times-o" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                            <h3 style="font-size: 20px; color: #2d3e69; margin-bottom: 10px;">Event Tidak Ditemukan</h3>
                            <p style="font-size: 15px; color: #666;">Event yang Anda cari tidak tersedia atau telah dihapus.</p>
                            <a href="{{ route('event') }}" class="back-btn" style="display: inline-block; margin-top: 15px; background-color: #7FBC8C; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-weight: 500; transition: all 0.3s ease;">
                                <i class="fa fa-arrow-left" style="margin-right: 5px;"></i> Kembali ke Daftar Event
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Base styles */
        body {
            background-color: #F5F7FA;
        }
        
        /* Content styling */
        .event-description p, .event-description-preview p {
            margin-bottom: 15px;
        }
        
        .event-description h2, .event-description-preview h2 {
            color: #2d3e69;
            font-size: 20px;
            font-weight: 600;
            margin: 25px 0 15px;
        }
        
        .event-description h3, .event-description-preview h3 {
            color: #2d3e69;
            font-size: 18px;
            font-weight: 600;
            margin: 20px 0 15px;
        }
        
        .event-description img, .event-description-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 15px 0;
        }
        
        .event-description ul, .event-description ol,
        .event-description-preview ul, .event-description-preview ol {
            margin-bottom: 15px;
            padding-left: 20px;
        }
        
        .event-description li, .event-description-preview li {
            margin-bottom: 8px;
        }
        
        /* Hover effects */
        .share-btn:hover {
            background-color: #7FBC8C;
            color: white;
            transform: translateY(-3px);
        }
        
        .back-btn:hover {
            background-color: #2d3e69;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .event-content {
                padding: 20px;
            }
            
            .event-image img {
                max-height: 250px;
            }
            
            h1 {
                font-size: 22px;
            }
            
            .full-description, .event-location {
                padding: 0 20px 20px;
            }
        }
        
        /* Add Font Awesome if not already included */
        @if (!isset($fontAwesomeIncluded))
            @push('styles')
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            @endpush
        @endif
    </style>
@endsection
