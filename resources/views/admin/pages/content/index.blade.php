@extends('admin.layouts.admin_master')
@section('content')
    <div class="container-fluid p-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Daftar Konten</h2>
            <a href="{{ route('content.create') }}" class="btn btn-primary rounded-pill d-flex align-items-center">
                <i class="bx bx-plus me-2"></i>
                Tambahkan Konten
            </a>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="input-group w-100"> 
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Pencaharian" id="searchContent">
                </div>
            </div>
        </div>

        <!-- Content Cards -->
        <div class="content-list">
            @forelse ($contents as $content)
                <div class="card mb-4 border-0 rounded-4 shadow-sm content-item overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <!-- Content Image (Left Side) -->
                            <div class="col-md-4 col-lg-3">
                                <div class="h-100" style="background-image: url('{{ $content['image_content'] }}'); background-size: cover; background-position: center; min-height: 200px;"></div>
                            </div>
                            
                            <!-- Content Details (Right Side) -->
                            <div class="col-md-8 col-lg-9">
                                <div class="p-4">
                                    <!-- Title -->
                                    <h4 class="mb-2">{{ $content['judul'] }}</h4>
                                    
                                    <!-- Description -->
                                    <p class="text-muted mb-4">
                                        {{ $content['deskripsi'] ?? 'Diajun mengajak seluruh warga untuk bersama-sama peduli serta menyatakan hentikan kekerasan terhadap anak dan perempuan...' }}
                                    </p>
                                    
                                    <!-- Date and Action Buttons -->
                                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                                        <!-- Date -->
                                        <div class="d-flex align-items-center mb-3 mb-md-0">
                                            <div class="bg-light rounded-3 p-2 me-2">
                                                <i class="bx bx-calendar text-primary"></i>
                                            </div>
                                            <span class="fw-medium">{{ \Carbon\Carbon::parse($content['updated_at'])->format('d M Y') }}</span>
                                        </div>
                                        
                                        <!-- Action Buttons - Exactly matching the image -->
                                        <div class="">
                                            <a href="{{ route('content.show', ['content' => $content['id']]) }}" 
                                               class="action-btn detail-btn">
                                                <i class="bx bx-show me-2"></i>Detail
                                            </a>
                                            <a href="{{ route('content.edit', ['content' => $content['id']]) }}" 
                                               class="action-btn edit-btn">
                                                <i class="bx bx-edit me-2"></i>Edit
                                            </a>
                                            <form id="delete-form-{{ $content['id'] }}"
                                                action="{{ route('content.destroy', ['content' => $content['id']]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="action-btn delete-btn" data-id="{{ $content['id'] }}">
                                                    <i class="bx bx-trash me-2"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                    <div class="py-5">
                        <h2 class="mb-2">Belum ada Content</h2>
                        <p class="text-muted mb-4">Sorry for the inconvenience but we're performing some maintenance at the moment</p>
                        <a href="{{ route('content.create') }}" class="btn btn-primary">Buat Content</a>
                        <div class="mt-4">
                            <img src="asset-admin/assets/img/illustrations/girl-doing-yoga-light.png"
                                alt="girl-doing-yoga-light" width="400" class="img-fluid"
                                data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
                                data-app-light-img="illustrations/girl-doing-yoga-light.png" />
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button click event
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var contentId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus konten ini?',
                    text: "Jika anda menghapus maka data tidak akan bisa kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + contentId).submit();
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchContent');
        const contentItems = document.querySelectorAll('.content-item');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            contentItems.forEach(function(item) {
                const title = item.querySelector('h4').textContent.toLowerCase();
                const description = item.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || description.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>

<style>
    /* Modern styling */
    body {
        background-color: #f8f9fa;
    }
    
    .btn-primary {
        background-color: #5b9bd5;
        border-color: #5b9bd5;
    }
    
    .btn-primary:hover {
        background-color: #4a8bc2;
        border-color: #4a8bc2;
    }
    
    .card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
    
    .rounded-4 {
        border-radius: 1rem !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .text-primary {
        color: #5b9bd5 !important;
    }
    
    /* Action buttons styling - Exactly matching the image */
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    
    .action-btn {
        color: white;
        font-weight: 500;
        padding: 8px 20px;
        border: none;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 110px;
        text-decoration: none;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    
    .detail-btn {
        background-color: #6366f1; /* Purple color as shown in the image */
    }
    
    .edit-btn {
        background-color: #ffa000; /* Orange color as shown in the image */
    }
    
    .delete-btn {
        background-color: #f44336; /* Red color as shown in the image */
    }
    
    .action-btn:hover {
        opacity: 0.9;
        color: white;
        text-decoration: none;
    }
    
    /* Search bar styling */
    #searchContent::placeholder {
        color: #adb5bd;
    }
    
    .content-list {
        max-width: 1200px;
        margin: 0 auto;
    }
</style>