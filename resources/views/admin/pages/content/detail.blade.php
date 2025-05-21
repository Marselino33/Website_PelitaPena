@extends('admin.layouts.admin_master')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Content Details</h4>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Image Column -->
                            <div class="col-md-5 mb-4 mb-md-0">
                                <div class="image-container border rounded overflow-hidden">
                                    <img 
                                        src="{{ $contentDetail['image_content'] }}" 
                                        alt="{{ $contentDetail['judul'] }}" 
                                        class="img-fluid w-100"
                                        style="max-height: 400px; object-fit: cover;"
                                    >
                                </div>
                                <div class="mt-3 text-muted text-center">
                                    <small>Last updated: {{ \Carbon\Carbon::parse($contentDetail['updated_at'])->format('d M Y, H:i') }}</small>
                                </div>
                            </div>
                            
                            <!-- Content Column -->
                            <div class="col-md-7">
                                <h2 class="mb-3">{{ $contentDetail['judul'] }}</h2>
                                <div class="content-body bg-light p-3 rounded">
                                    {!! $contentDetail['isi_content'] !!}
                                </div>
                                
                                <!-- Additional Metadata -->
                                <div class="mt-4 pt-3 border-top">
                                    <div class="row">
                                        <div class="col-6">
                                            <h6 class="text-sm text-muted">Created At</h6>
                                            <p class="text-sm">{{ \Carbon\Carbon::parse($contentDetail['created_at'])->format('d M Y') }}</p>
                                        </div>
                                        <div class="col-6">
                                            <h6 class="text-sm text-muted">Last Updated</h6>
                                            <p class="text-sm">{{ \Carbon\Carbon::parse($contentDetail['updated_at'])->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .image-container {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .image-container:hover {
        transform: translateY(-5px);
    }
    
    .content-body {
        line-height: 1.8;
    }
    
    .content-body img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 4px;
    }
    
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
    }
    
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
    }
</style>
@endsection