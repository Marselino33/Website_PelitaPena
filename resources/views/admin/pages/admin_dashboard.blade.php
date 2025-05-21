@extends('admin.layouts.admin_master')

@section('content')
    <!-- Welcome Banner -->
    <div class="welcome-banner mb-4">
        <div class="card">
            <div class="card-body p-0">
                <div class="d-flex align-items-stretch position-relative overflow-hidden">
                    <div class="welcome-content p-4">
                        <h2 class="welcome-title mb-2">Selamat Datang Admin DPMDPPA</h2>
                        <p class="welcome-message mb-3">
                            Jangan lupa selalu semangat 
                            <span class="highlight">100% tangani kekerasan</span> 
                            terhadap perempuan dan anak
                        </p>
                        <div class="d-flex mt-3">
                            <a href="{{ route('laporan.masuk') }}" class="btn btn-primary btn-action me-2">
                                <i class="bx bx-file me-1"></i> Lihat Laporan
                            </a>
                            <a href="{{ route('event.index') }}" class="btn btn-outline-primary btn-action">
                                <i class="bx bx-calendar-event me-1"></i> Kelola Event
                            </a>
                        </div>
                    </div>
                    <div class="welcome-image">
                        <img src="asset-admin/assets/img/illustrations/man-with-laptop-light.png" alt="Admin Dashboard">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Emergency Contact & Stats Row -->
    <div class="row mb-4">
        <!-- Emergency Contact Card -->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
            <div class="card emergency-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-wrapper me-3">
                                <div class="avatar-icon bg-danger">
                                    <i class="bx bx-phone-call"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="card-title mb-0">Kontak Darurat</h5>
                                <small class="text-muted">Nomor WhatsApp Darurat</small>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                            <i class="bx bx-edit me-1"></i> Edit
                        </button>
                    </div>
                    
                    <div class="emergency-number">
                        @if ($emergencyContact)
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $emergencyContact['Phone']) }}" 
                               class="d-flex align-items-center" target="_blank">
                                <i class="bx bxl-whatsapp fs-3 me-2"></i>
                                <span class="fs-4 fw-semibold">{{ $emergencyContact['Phone'] }}</span>
                            </a>
                        @else
                            <p class="text-muted">Belum Ada kontak darurat</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Summary Cards -->
        <div class="col-lg-8 col-md-6">
            <div class="row h-100">
                <!-- Incoming Reports -->
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-wrapper me-3">
                                    <div class="avatar-icon bg-primary">
                                        <i class="bx bx-envelope"></i>
                                    </div>
                                </div>
                                <h5 class="card-title mb-0">Laporan Masuk</h5>
                            </div>
                            <div class="stat-value">
                                <h2 class="mb-0">{{ $laporanMasuk->count() }}</h2>
                                <small class="text-muted">Laporan baru</small>
                            </div>
                            <a href="{{ route('laporan.masuk') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <!-- Viewed Reports -->
                <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-wrapper me-3">
                                    <div class="avatar-icon bg-info">
                                        <i class="bx bx-show"></i>
                                    </div>
                                </div>
                                <h5 class="card-title mb-0">Sudah Dilihat</h5>
                            </div>
                            <div class="stat-value">
                                <h2 class="mb-0">{{ $laporanDilihat->count() }}</h2>
                                <small class="text-muted">Laporan dilihat</small>
                            </div>
                            <a href="{{ route('laporan.dilihat') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                
                <!-- Processed Reports -->
                <div class="col-lg-4 col-md-12">
                    <div class="card stat-card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-wrapper me-3">
                                    <div class="avatar-icon bg-success">
                                        <i class="bx bx-loader-circle"></i>
                                    </div>
                                </div>
                                <h5 class="card-title mb-0">Diproses</h5>
                            </div>
                            <div class="stat-value">
                                <h2 class="mb-0">{{ $laporanDiproses->count() }}</h2>
                                <small class="text-muted">Laporan diproses</small>
                            </div>
                            <a href="{{ route('laporan.diproses') }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Events Section -->
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h4 class="mb-0">
                <i class="bx bx-calendar-event me-2"></i>
                Event yang akan datang
            </h4>
            <a href="{{ route('event.index') }}" class="btn btn-sm btn-primary">
                <i class="bx bx-plus me-1"></i> Kelola Event
            </a>
        </div>
        
        <div class="card-body">
            <div class="row">
                @forelse ($events as $event)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card event-card h-100">
                            <div class="event-image">
                                <img src="{{ $event['thumbnail_event'] }}" class="card-img-top" alt="{{ $event['nama_event'] }}">
                                <div class="event-date">
                                    <span class="day">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('d') }}</span>
                                    <span class="month">{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('M') }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $event['nama_event'] }}</h5>
                                
                                <div class="event-details mt-3">
                                    <div class="event-detail">
                                        <i class="bx bx-time-five"></i>
                                        <span>{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('H:i') }} WIB</span>
                                    </div>
                                    <div class="event-detail">
                                        <i class="bx bx-calendar"></i>
                                        <span>{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->format('d M Y') }}</span>
                                    </div>
                                    <div class="event-detail">
                                        <i class="bx bx-calendar-exclamation"></i>
                                        <span>{{ \Carbon\Carbon::parse($event['tanggal_pelaksanaan'])->diffForHumans() }}</span>
                                    </div>
                                </div>
                                
                                <a href="{{ route('event.show', $event['id']) }}" class="btn btn-outline-primary mt-3 w-100">
                                    <i class="bx bx-info-circle me-1"></i> Detail Event
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state text-center py-5">
                            <i class="bx bx-calendar-x empty-icon"></i>
                            <p>Tidak ada event yang akan datang dalam 3 hari ke depan.</p>
                            <a href="{{ route('event.create') }}" class="btn btn-primary mt-3">
                                <i class="bx bx-plus me-1"></i> Buat Event Baru
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Emergency Contact Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kontak Darurat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editContactForm" action="{{ route('contact.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor WhatsApp Darurat</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bxl-whatsapp"></i></span>
                                <input type="number" id="phone" name="phone" class="form-control"
                                    value="{{ $emergencyContact['Phone'] ?? '' }}" placeholder="Contoh: 08126346777">
                            </div>
                            <small class="text-muted">Masukkan nomor WhatsApp tanpa tanda + atau kode negara</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x me-1"></i> Batal
                        </button>
                        <button type="button" id="saveChangesBtn" class="btn btn-primary">
                            <i class="bx bx-check me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Base styles and variables */
    :root {
        --primary-color: #6c9aff;
        --primary-darker: #5a8eff;
        --primary-lighter: #e6eeff;
        --danger-color: #ff6b6b;
        --success-color: #56ca00;
        --info-color: #16b1ff;
        --warning-color: #ffb400;
        --card-border-radius: 0.75rem;
        --transition-speed: 0.3s;
    }

    /* Welcome Banner */
    .welcome-banner .card {
        border: none;
        border-radius: var(--card-border-radius);
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .welcome-content {
        flex: 1;
        padding: 2rem !important;
        z-index: 1;
    }

    .welcome-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--primary-darker);
        margin-bottom: 0.75rem;
    }

    .welcome-message {
        font-size: 1rem;
        color: #566a7f;
        max-width: 500px;
        line-height: 1.6;
    }

    .welcome-message .highlight {
        font-weight: 600;
        color: var(--primary-darker);
    }

    .welcome-image {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .welcome-image img {
        max-height: 180px;
        object-fit: contain;
    }

    .btn-action {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all var(--transition-speed) ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(108, 154, 255, 0.3);
    }

    /* Emergency Contact Card */
    .emergency-card {
        border: none;
        border-radius: var(--card-border-radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all var(--transition-speed) ease;
    }

    .emergency-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .avatar-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: white;
        font-size: 1.25rem;
    }

    .bg-danger {
        background-color: var(--danger-color) !important;
    }

    .emergency-number {
        margin-top: 1rem;
        padding: 1rem;
        background-color: #fff8f8;
        border-radius: 0.5rem;
        transition: all var(--transition-speed) ease;
    }

    .emergency-number:hover {
        background-color: #fff0f0;
    }

    .emergency-number a {
        color: var(--danger-color);
        text-decoration: none;
        font-weight: 500;
    }

    /* Stat Cards */
    .stat-card {
        border: none;
        border-radius: var(--card-border-radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all var(--transition-speed) ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .bg-primary {
        background-color: var(--primary-color) !important;
    }

    .bg-info {
        background-color: var(--info-color) !important;
    }

    .bg-success {
        background-color: var(--success-color) !important;
    }

    .stat-value {
        margin-top: 1rem;
    }

    .stat-value h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }

    /* Event Cards */
    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }

    .event-card {
        border: none;
        border-radius: var(--card-border-radius);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: all var(--transition-speed) ease;
        overflow: hidden;
    }

    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .event-image {
        position: relative;
        height: 160px;
        overflow: hidden;
    }

    .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-speed) ease;
    }

    .event-card:hover .event-image img {
        transform: scale(1.05);
    }

    .event-date {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 60px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .event-date .day {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1;
    }

    .event-date .month {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 500;
    }

    .event-details {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .event-detail {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #566a7f;
    }

    .event-detail i {
        color: var(--primary-color);
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    /* Empty State */
    .empty-state {
        padding: 2rem;
        text-align: center;
    }

    .empty-icon {
        font-size: 3rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: var(--card-border-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        padding: 1.25rem 1.5rem;
    }

    .input-group-text {
        background-color: var(--primary-lighter);
        color: var(--primary-color);
        border-color: #dee2e6;
    }

    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .welcome-image {
            display: none;
        }
        
        .welcome-content {
            padding: 1.5rem !important;
        }
        
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .stat-value h2 {
            font-size: 1.75rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let saveChangesBtn = document.getElementById('saveChangesBtn');
        let form = document.getElementById('editContactForm');

        saveChangesBtn.addEventListener('click', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Yakin ingin menyimpan perubahan?',
                text: "Pastikan kontak darurat yang diubah sudah benar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6c9aff',
                cancelButtonColor: '#ff6b6b',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Add hover effects for cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.05)';
            });
        });
    });
</script>
