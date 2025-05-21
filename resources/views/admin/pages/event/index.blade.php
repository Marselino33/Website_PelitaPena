@extends('admin.layouts.admin_master')
@section('content')
    <div class="container-fluid p-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Daftar Event</h2>
            <a href="{{ route('event.create') }}" class="btn btn-primary rounded-pill d-flex align-items-center">
                <i class="bx bx-plus me-2"></i>
                Buat Event
            </a>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="input-group w-100"> 
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari Event" id="searchEvent">
                </div>
            </div>
        </div>

        <!-- Event Cards -->
        <div class="row g-4 event-list">
            @forelse ($events as $event)
                <div class="col-md-6 col-lg-4 event-item">
                    <div class="card border-0 h-100 shadow-sm rounded-4 overflow-hidden">
                        <!-- Event Image -->
                        <div class="image-container" style="background-image: url('{{ $event['thumbnail_event'] }}');"></div>
                        
                        <div class="card-body p-4">
                            <!-- Event Title -->
                            <h4 class="card-title fw-semibold mb-3 text-truncate">{{ $event['nama_event'] }}</h4>
                            
                            <!-- Event Date and Time -->
                            <div class="row mb-4 g-3">
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-light p-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bx bx-calendar text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-medium">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('d M Y') }}</h6>
                                            <small class="text-muted">Tanggal</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-light p-2 me-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bx bx-time-five text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-medium">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->diffForHumans() }}</h6>
                                            <small class="text-muted">Waktu</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                             <center>
                            <div class=" justify-content-center gap-2">
                                <a href="{{ route('event.show', ['event' => $event['id']]) }}" 
                                   class="action-btn detail-btn">
                                    <i class="bx bx-show mb-10 "></i>Detail
                                </a>
                                <a href="{{ route('event.edit', ['event' => $event['id']]) }}" 
                                   class="action-btn edit-btn">
                                    <i class="bx bx-edit mb-10"></i>Edit
                                </a>
                                <form id="delete-form-{{ $event['id'] }}"
                                    action="{{ route('event.destroy', ['event' => $event['id']]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="action-btn delete-btn" data-id="{{ $event['id'] }}">
                                        <i class="bx bx-trash me-3 mb-10"></i>Hapus
                                    </button>
                                </form>
                            </div>
                            </center>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <div class="py-5">
                            <h2 class="mb-2 fw-bold">Belum ada Event</h2>
                            <p class="text-muted mb-4">Belum ada event yang dijadwalkan saat ini. Buat event baru untuk memulai.</p>
                            <a href="{{ route('event.create') }}" class="btn btn-primary rounded-pill px-4 py-2">Buat Event</a>
                            <div class="mt-4">
                                <img src="asset-admin/assets/img/illustrations/girl-doing-yoga-light.png"
                                    alt="girl-doing-yoga-light" width="400" class="img-fluid"
                                    data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
                                    data-app-light-img="illustrations/girl-doing-yoga-light.png" />
                            </div>
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
                var eventId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin ingin menghapus Event ini?',
                    text: "Jika anda menghapus maka data tidak akan bisa kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + eventId).submit();
                    }
                });
            });
        });

        // Search functionality
        const searchInput = document.getElementById('searchEvent');
        const eventItems = document.querySelectorAll('.event-item');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            eventItems.forEach(function(item) {
                const title = item.querySelector('.card-title').textContent.toLowerCase();
                
                if (title.includes(searchTerm)) {
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
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
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
    
    /* Image container styling */
    .image-container {
        background-size: cover;
        background-position: center;
        height: 200px;
        width: 100%;
        transition: transform 0.3s;
    }
    
    .card:hover .image-container {
        transform: scale(1.03);
    }
    
    /* Action buttons styling - UPDATED */
    .action-btn {
        color: white;
        font-weight: 500;
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 90px;
        text-decoration: none;
        cursor: pointer;
        transition: opacity 0.2s;
        font-size: 0.875rem;
    }
    
    .action-btn i {
        font-size: 0.875rem;
        margin-right: 4px;
    }
    
    .detail-btn {
        background-color: #6366f1;
    }
    
    .edit-btn {
        background-color: #ffa000;
    }
    
    .delete-btn {
        background-color: #f44336;
    }
    
    .action-btn:hover {
        opacity: 0.9;
        color: white;
        text-decoration: none;
    }
    
    /* Search bar styling */
    #searchEvent::placeholder {
        color: #adb5bd;
    }
    
    .event-list {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Improved typography */
    h2 {
        color: #333;
    }
    
    h4 {
        color: #444;
    }
    
    h6 {
        color: #555;
    }
    
    .text-muted {
        color: #888 !important;
    }
</style>