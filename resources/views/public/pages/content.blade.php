@extends('public.layouts.public_master')

@section('content')
    <!-- Page Header - Updated background color -->
    <div class="page-header" style="background-color: #ffffff; padding: 25px 0; margin-bottom: 20px;">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="section-tittle text-center">
                        <h2 style="color: #2d3e69; font-weight: 700; position: relative; display: inline-block; font-size: 26px; margin-bottom: 5px;">
                            Konten
                            <span style="position: absolute; bottom: -8px; left: 50%; transform: translateX(-50%); width: 60px; height: 3px; background-color: #7FBC8C; border-radius: 2px;"></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="blog_area" style="padding: 20px 0; background-color: #F5F7FA;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @forelse ($contents as $content)
                            <article class="blog_item" style="margin-bottom: 20px; border-radius: 10px; overflow: hidden; box-shadow: 0 3px 10px rgba(0,0,0,0.05); transition: all 0.3s ease;">
                                <div class="blog_item_img" style="position: relative; overflow: hidden;">
                                    <img class="card-img" src="{{ $content['image_content'] }}"
                                        alt="{{ $content['judul'] }}" style="height: 220px; object-fit: cover; transition: transform 0.5s ease;">
                                    <div class="category-badge" style="position: absolute; top: 15px; right: 15px; background-color: #7FBC8C; color: white; padding: 4px 12px; border-radius: 15px; font-size: 11px; font-weight: 600;">
                                        <i class="fa fa-tag" style="margin-right: 4px;"></i>{{ $content['violence_category']['category_name'] }}
                                    </div>
                                </div>

                                <div class="blog_details" style="padding: 18px; background-color: white;">
                                    <a href="{{ route('content.detail', ['id' => $content['id']]) }}"
                                        class="d-inline-block" style="text-decoration: none;">
                                        <h2 style="color: #2d3e69; font-size: 18px; font-weight: 600; margin-bottom: 10px; transition: color 0.3s ease;">{{ $content['judul'] }}</h2>
                                    </a>
                                    <p style="color: #666; margin-bottom: 15px; line-height: 1.5; font-size: 13px;">{{ Str::limit(strip_tags($content['isi_content']), 120, '...') }}</p>
                                    <div class="blog-info-wrapper" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 12px;">
                                        <ul class="blog-info-link" style="list-style: none; padding: 0; margin: 0; display: flex; gap: 15px;">
                                            <li style="color: #777; font-size: 12px;">
                                                <i class="fa fa-list-alt" style="color: #7FBC8C; margin-right: 4px;"></i> 
                                                {{ $content['violence_category']['category_name'] }}
                                            </li>
                                            <li style="color: #777; font-size: 12px;">
                                                <i class="fa fa-calendar" style="color: #7FBC8C; margin-right: 4px;"></i>
                                                {{ \Carbon\Carbon::parse($content['created_at'])->format('d M Y') }}
                                            </li>
                                        </ul>
                                        <a href="{{ route('content.detail', ['id' => $content['id']]) }}" class="read-more-btn" style="color: #7FBC8C; font-weight: 600; font-size: 12px; text-decoration: none; display: flex; align-items: center; transition: all 0.3s ease;">
                                            Baca Selengkapnya 
                                            <i class="fa fa-arrow-right" style="margin-left: 4px; transition: transform 0.3s ease;"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="empty-state" style="text-align: center; padding: 30px 20px; background-color: white; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
                                <i class="fa fa-file-text-o" style="font-size: 36px; color: #ccc; margin-bottom: 15px;"></i>
                                <p style="font-size: 15px; color: #666;">Belum ada konten tersedia saat ini. Silakan periksa kembali nanti.</p>
                            </div>
                        @endforelse

                        <nav class="blog-pagination justify-content-center d-flex" style="margin-top: 25px;">
                            {{ $contents->links() }}
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <!-- Search widget for sidebar -->
                        <aside class="single_sidebar_widget search_widget" style="background-color: white; padding: 15px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
                            <form action="{{ route('content.search') }}" method="GET">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keyword"
                                            placeholder='Cari dengan kata kunci' style="height: 40px; border-radius: 20px 0 0 20px; border: 1px solid #ddd; padding: 0 15px; font-size: 13px;">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit" style="background-color: #7FBC8C; color: white; border-radius: 0 20px 20px 0; height: 40px; width: 50px; border: none;">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </aside>
                        
                        <!-- Recent Posts Widget -->
                        <aside class="single_sidebar_widget popular_post_widget" style="background-color: white; padding: 18px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); margin-bottom: 20px;">
                            <h3 class="widget_title" style="color: #2d3e69; font-size: 16px; font-weight: 600; margin-bottom: 15px; position: relative; padding-bottom: 8px;">
                                <i class="fa fa-newspaper-o" style="margin-right: 6px; color: #7FBC8C;"></i>Konten Terbaru
                                <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background-color: #7FBC8C; border-radius: 1px;"></span>
                            </h3>
                            
                            @foreach ($recent_posts as $post)
                                <div class="media post_item" style="padding: 10px 0; border-bottom: 1px solid #eee; transition: all 0.3s ease;">
                                    <div style="width: 60px; height: 60px; border-radius: 6px; overflow: hidden; margin-right: 12px; flex-shrink: 0;">
                                        <img src="{{ $post['image_content'] }}" alt="post" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
                                    </div>
                                    <div class="media-body">
                                        <a href="{{ route('content.detail', ['id' => $post['id']]) }}" style="text-decoration: none;">
                                            <h3 style="font-size: 14px; line-height: 1.4; margin-bottom: 5px; color: #2d3e69; font-weight: 600; transition: color 0.3s ease;">{{ $post['judul'] }}</h3>
                                        </a>
                                        <p style="font-size: 12px; color: #777; margin: 0;">
                                            <i class="fa fa-clock-o" style="color: #7FBC8C; margin-right: 4px;"></i>
                                            {{ \Carbon\Carbon::parse($post['created_at'])->locale('id')->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                        
                        <!-- Newsletter Widget -->
                        <aside class="single_sidebar_widget newsletter_widget" style="background-color: white; padding: 18px; border-radius: 10px; text-align: center; box-shadow: 0 3px 10px rgba(0,0,0,0.05);">
                            <div style="width: 50px; height: 50px; background-color: #7FBC8C; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                                <i class="fa fa-envelope" style="font-size: 20px; color: white;"></i>
                            </div>
                            <h4 style="color: #2d3e69; font-size: 16px; font-weight: 600; margin-bottom: 10px;">Kirimkan saran anda</h4>
                            <p style="color: #666; margin-bottom: 15px; font-size: 13px;">Jika anda memiliki saran, kirimkan saran anda kepada kami</p>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Updated background color */
        body {
            background-color: #F5F7FA;
        }
        
        /* Hover effects */
        .blog_item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        
        .blog_item:hover .card-img {
            transform: scale(1.05);
        }
        
        .blog_details a:hover h2 {
            color: #7FBC8C;
        }
        
        .read-more-btn:hover {
            color: #2d3e69;
        }
        
        .read-more-btn:hover i {
            transform: translateX(3px);
        }
        
        .media.post_item:hover {
            background-color: rgba(127, 188, 140, 0.05);
        }
        
        .media.post_item:hover img {
            transform: scale(1.1);
        }
        
        .media.post_item:hover h3 {
            color: #7FBC8C;
        }
        
        .subscribe-btn:hover {
            background-color: #2d3e69;
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
        
        /* Add Font Awesome if not already included */
        @if (!isset($fontAwesomeIncluded))
            @push('styles')
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            @endpush
        @endif
    </style>
@endsection
