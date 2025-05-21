@extends('public.layouts.public_master')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="background-color: #ffffff; padding: 25px 0; margin-bottom: 20px;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 style="color: #2d3e69; font-weight: 700; position: relative; display: inline-block; font-size: 26px; margin-bottom: 5px;">
                            Event DPMDPPA
                            <span style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background-color: #7FBC8C; border-radius: 2px;"></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="event-area" style="padding: 20px 0; background-color: #F5F7FA;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="event-grid">
                        <div class="row">
                            @forelse ($events as $event)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="event-card" style="background-color: white; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 10px rgba(0,0,0,0.05); height: 100%; transition: all 0.3s ease;">
                                        <div class="event-img" style="position: relative; height: 200px; overflow: hidden;">
                                            <img src="{{ $event['thumbnail_event'] }}" alt="{{ $event['nama_event'] }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                            <div class="event-date" style="position: absolute; top: 15px; left: 15px; background-color: #7FBC8C; color: white; border-radius: 8px; padding: 8px 12px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,0.1);">
                                                <div style="font-size: 18px; font-weight: 700; line-height: 1;">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('d') }}</div>
                                                <div style="font-size: 12px; text-transform: uppercase;">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('M') }}</div>
                                            </div>
                                        </div>
                                        <div class="event-content" style="padding: 20px;">
                                            <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; line-height: 1.4; color: #2d3e69;">
                                                <a href="{{ route('event.detail', ['id' => $event['id']]) }}" style="color: inherit; text-decoration: none; transition: color 0.3s ease;">
                                                    {{ $event['nama_event'] }}
                                                </a>
                                            </h3>
                                            <p style="color: #666; font-size: 13px; line-height: 1.5; margin-bottom: 15px;">{!! Str::limit(strip_tags($event['deskripsi_event']), 100, '...') !!}</p>
                                            <div class="event-meta" style="display: flex; justify-content: space-between; border-top: 1px solid #eee; padding-top: 15px;">
                                                <div class="event-info" style="display: flex; flex-direction: column; gap: 8px;">
                                                    <div style="display: flex; align-items: center; color: #777; font-size: 12px;">
                                                        <i class="fa fa-calendar" style="color: #7FBC8C; margin-right: 6px; width: 14px;"></i>
                                                        {{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->locale('id')->isoFormat('LL') }}
                                                    </div>
                                                    <div style="display: flex; align-items: center; color: #777; font-size: 12px;">
                                                        <i class="fa fa-clock-o" style="color: #7FBC8C; margin-right: 6px; width: 14px;"></i>
                                                        {{ \Carbon\Carbon::parse($event['created_at'])->locale('id')->diffForHumans() }}
                                                    </div>
                                                </div>
                                                <a href="{{ route('event.detail', ['id' => $event['id']]) }}" class="event-btn" style="align-self: flex-end; color: #7FBC8C; font-weight: 600; font-size: 12px; text-decoration: none; display: flex; align-items: center; transition: all 0.3s ease;">
                                                    Detail <i class="fa fa-arrow-right" style="margin-left: 4px; transition: transform 0.3s ease;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="empty-state" style="text-align: center; padding: 50px 20px; background-color: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); margin-bottom: 30px;">
                                        <i class="fa fa-calendar-times-o" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                                        <h3 style="font-size: 20px; color: #2d3e69; margin-bottom: 10px;">Belum Ada Kegiatan</h3>
                                        <p style="font-size: 15px; color: #666;">Belum ada kegiatan atau event dari DPMDPPA saat ini. Silakan periksa kembali nanti.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Pagination -->
                        <div class="row">
                            <div class="col-12">
                                <nav class="event-pagination justify-content-center d-flex" style="margin-top: 20px;">
                                    {{ $events->links() }}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Base styles */
        body {
            background-color: #F5F7FA;
        }
        
        /* Event card hover effects */
        .event-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .event-card:hover .event-img img {
            transform: scale(1.05);
        }
        
        .event-card:hover h3 a {
            color: #7FBC8C !important;
        }
        
        .event-btn:hover {
            color: #2d3e69;
        }
        
        .event-btn:hover i {
            transform: translateX(3px);
        }
        
        /* Pagination styling */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 3px;
        }
        
        .pagination .page-item .page-link {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #666;
            border: 1px solid #eee;
            background-color: white;
            transition: all 0.3s ease;
            font-size: 13px;
        }
        
        .pagination .page-item.active .page-link,
        .pagination .page-item .page-link:hover {
            background-color: #7FBC8C;
            color: white;
            border-color: #7FBC8C;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .event-img {
                height: 180px !important;
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
