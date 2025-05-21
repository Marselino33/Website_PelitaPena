@extends('public.layouts.public_master')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="background-color: #ffffff; padding: 25px 0; margin-bottom: 20px;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 style="color: #2d3e69; font-weight: 700; position: relative; display: inline-block; font-size: 26px; margin-bottom: 5px;">
                            Pelita Pena
                            <span style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background-color: #7FBC8C; border-radius: 2px;"></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content-detail-area" style="padding: 20px 0 40px; background-color: #F5F7FA;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    @if ($content)
                        <article class="content-detail" style="background-color: white; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 15px rgba(0,0,0,0.05);">
                            <!-- Featured Image -->
                            <div class="content-featured-img" style="position: relative;">
                                <img src="{{ $content['image_content'] }}" alt="{{ $content['judul'] }}" style="width: 100%; height: auto; max-height: 500px; object-fit: cover;">
                                
                                <!-- Category Badge -->
                                @if(isset($content['violence_category']))
                                <div class="category-badge" style="position: absolute; top: 20px; left: 20px; background-color: #7FBC8C; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                    <i class="fa fa-tag" style="margin-right: 5px;"></i>{{ $content['violence_category']['category_name'] }}
                                </div>
                                @endif
                            </div>
                            
                            <!-- Content Body -->
                            <div class="content-body" style="padding: 30px;">
                                <!-- Title -->
                                <h1 style="color: #2d3e69; font-size: 28px; font-weight: 700; margin-bottom: 15px; line-height: 1.3;">
                                    {{ $content['judul'] }}
                                </h1>
                                
                                <!-- Meta Info -->
                                <div class="content-meta" style="display: flex; align-items: center; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid #eee;">
                                    <div class="meta-date" style="display: flex; align-items: center; color: #777; font-size: 14px;">
                                        <i class="fa fa-calendar" style="color: #7FBC8C; margin-right: 6px;"></i>
                                        Diposting pada {{ \Carbon\Carbon::parse($content['created_at'])->format('d M Y') }}
                                    </div>
                                    
                                    <!-- Share Buttons -->
                                    <div class="share-buttons" style="margin-left: auto; display: flex; gap: 8px;">
                                        <a href="#" class="share-btn" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background-color: #f1f1f1; color: #555; transition: all 0.2s ease;">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#" class="share-btn" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background-color: #f1f1f1; color: #555; transition: all 0.2s ease;">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#" class="share-btn" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 50%; background-color: #f1f1f1; color: #555; transition: all 0.2s ease;">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="content-text" style="color: #444; font-size: 15px; line-height: 1.7; margin-bottom: 30px;">
                                    {!! $content['isi_content'] !!}
                                </div>
                                
                                <!-- Quote if available -->
                                @if (isset($content['quote']))
                                    <div class="quote-wrapper" style="background-color: #f8f9fa; border-left: 4px solid #7FBC8C; padding: 20px; margin: 30px 0; border-radius: 0 8px 8px 0;">
                                        <div class="quotes" style="font-style: italic; color: #555; font-size: 16px; line-height: 1.6; position: relative; padding-left: 25px;">
                                            <i class="fa fa-quote-left" style="position: absolute; left: 0; top: 0; color: #7FBC8C; font-size: 18px;"></i>
                                            {{ $content['quote'] }}
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Tags if available -->
                                @if(isset($content['tags']) && count($content['tags']) > 0)
                                <div class="content-tags" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                                    <span style="font-weight: 600; color: #555; margin-right: 10px;">Tags:</span>
                                    @foreach($content['tags'] as $tag)
                                        <a href="#" class="tag-link" style="display: inline-block; background-color: #f1f1f1; color: #555; font-size: 12px; padding: 4px 10px; border-radius: 15px; margin-right: 5px; margin-bottom: 5px; text-decoration: none; transition: all 0.2s ease;">
                                            {{ $tag }}
                                        </a>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            
                            <!-- Related Content -->
                            @if(isset($related_contents) && count($related_contents) > 0)
                            <div class="related-content" style="padding: 0 30px 30px;">
                                <h3 style="color: #2d3e69; font-size: 20px; font-weight: 600; margin-bottom: 20px; position: relative; padding-bottom: 10px;">
                                    Artikel Terkait
                                    <span style="position: absolute; bottom: 0; left: 0; width: 50px; height: 3px; background-color: #7FBC8C; border-radius: 1.5px;"></span>
                                </h3>
                                
                                <div class="row">
                                    @foreach($related_contents as $related)
                                    <div class="col-md-4 mb-4">
                                        <div class="related-item" style="background-color: #f8f9fa; border-radius: 8px; overflow: hidden; height: 100%; transition: all 0.3s ease;">
                                            <div class="related-img" style="height: 150px; overflow: hidden;">
                                                <img src="{{ $related['image_content'] }}" alt="{{ $related['judul'] }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                            </div>
                                            <div class="related-info" style="padding: 15px;">
                                                <h4 style="font-size: 15px; font-weight: 600; line-height: 1.4; margin-bottom: 8px;">
                                                    <a href="{{ route('content.detail', ['id' => $related['id']]) }}" style="color: #2d3e69; text-decoration: none; transition: color 0.2s ease;">
                                                        {{ $related['judul'] }}
                                                    </a>
                                                </h4>
                                                <span style="font-size: 12px; color: #777;">
                                                    <i class="fa fa-calendar" style="color: #7FBC8C; margin-right: 4px;"></i>
                                                    {{ \Carbon\Carbon::parse($related['created_at'])->format('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </article>
                    @else
                        <div class="empty-state" style="text-align: center; padding: 50px 20px; background-color: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
                            <i class="fa fa-file-text-o" style="font-size: 48px; color: #ccc; margin-bottom: 20px;"></i>
                            <h3 style="font-size: 20px; color: #2d3e69; margin-bottom: 10px;">Konten Tidak Tersedia</h3>
                            <p style="font-size: 15px; color: #666;">Belum ada konten yang di posting saat ini. Silakan periksa kembali nanti.</p>
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
        .content-text p {
            margin-bottom: 20px;
        }
        
        .content-text h2 {
            color: #2d3e69;
            font-size: 22px;
            font-weight: 600;
            margin: 30px 0 15px;
        }
        
        .content-text h3 {
            color: #2d3e69;
            font-size: 18px;
            font-weight: 600;
            margin: 25px 0 15px;
        }
        
        .content-text img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 20px 0;
        }
        
        .content-text ul, .content-text ol {
            margin-bottom: 20px;
            padding-left: 20px;
        }
        
        .content-text li {
            margin-bottom: 8px;
        }
        
        /* Hover effects */
        .share-btn:hover {
            background-color: #7FBC8C;
            color: white;
            transform: translateY(-3px);
        }
        
        .tag-link:hover {
            background-color: #7FBC8C;
            color: white;
            text-decoration: none;
        }
        
        .related-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .related-item:hover .related-img img {
            transform: scale(1.05);
        }
        
        .related-item:hover h4 a {
            color: #7FBC8C;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767px) {
            .content-body {
                padding: 20px;
            }
            
            .content-featured-img img {
                max-height: 300px;
            }
            
            h1 {
                font-size: 24px;
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
