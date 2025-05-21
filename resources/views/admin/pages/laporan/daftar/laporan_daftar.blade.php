@extends('admin.layouts.admin_master')

@section('title', $title)

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
        <div class="card-header bg-gradient-primary text-white p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h4 font-weight-bold mb-0">Daftar Laporan</h1>
                <!-- Tombol filter dan export yang lebih menonjol -->
                <div class="d-flex">
                    <button type="button" id="filterButton" class="btn btn-warning btn-md rounded-pill mr-3 d-flex align-items-center font-weight-bold px-4 py-2 shadow">
                        <i class="fas fa-filter mr-2"></i> Filters
                    </button>
                    <form id="exportForm" method="GET" action="{{ route('admin.laporan.export_pdf') }}">
                        <button type="submit" id="exportButton" class="btn btn-success btn-md rounded-pill d-flex align-items-center font-weight-bold px-4 py-2 shadow">
                            <i class="fas fa-file-export mr-2"></i> Eksport
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            <!-- Search Bar tanpa kotak kecil di kiri -->
            <div class="search-container mb-4">
                <input
                    type="text"
                    id="searchInput"
                    class="form-control py-2 search-bar"
                    placeholder="Cari laporan berdasarkan nomor, nama, atau judul..."
                    value="{{ request('q') }}"
                >
            </div>

            <!-- Animated Filter Form -->
            <div id="filterForm" class="mb-4 filter-panel" style="display: none;">
                <form method="GET" action="{{ route('laporan.daftar') }}" class="bg-light p-4 rounded-lg shadow-sm">
                    <div class="row align-items-end">
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="small font-weight-bold text-uppercase mb-1">Status Laporan</label>
                            <select name="status" class="form-control custom-select">
                                <option value="">Semua Status</option>
                                @foreach(['Laporan masuk','Dilihat','Diproses','Selesai','Dibatalkan'] as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <label class="small font-weight-bold text-uppercase mb-1">Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                <i class="fas fa-filter mr-2"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Status Summary Cards - FIXED to use array_filter instead of Collection methods -->
            <div class="row mb-4">
                @php
                    // Count occurrences of each status using array functions
                    $countLaporanMasuk = count(array_filter($laporans, function($item) {
                        return $item['status'] === 'Laporan masuk';
                    }));
                    
                    $countDiproses = count(array_filter($laporans, function($item) {
                        return $item['status'] === 'Diproses';
                    }));
                    
                    $countSelesai = count(array_filter($laporans, function($item) {
                        return $item['status'] === 'Selesai';
                    }));
                    
                    $countDibatalkan = count(array_filter($laporans, function($item) {
                        return $item['status'] === 'Dibatalkan';
                    }));
                    
                    $statusCounts = [
                        ['status' => 'Baru', 'count' => $countLaporanMasuk, 'icon' => 'fa-inbox', 'color' => 'primary'],
                        ['status' => 'Diproses', 'count' => $countDiproses, 'icon' => 'fa-spinner', 'color' => 'warning'],
                        ['status' => 'Selesai', 'count' => $countSelesai, 'icon' => 'fa-check-circle', 'color' => 'success'],
                        ['status' => 'Dibatalkan', 'count' => $countDibatalkan, 'icon' => 'fa-times-circle', 'color' => 'danger']
                    ];
                @endphp
                
                @foreach($statusCounts as $item)
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card border-left-{{ $item['color'] }} shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-{{ $item['color'] }} text-uppercase mb-1">
                                        {{ $item['status'] }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $item['count'] }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas {{ $item['icon'] }} fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Enhanced Table with Hover Effects - Kolom Aksi dihapus -->
            <div class="table-responsive">
                <table class="table table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-light">
                            <th width="30">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="selectAll">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th class="font-weight-bold text-uppercase text-xs">Nomor Registrasi</th>
                            <th class="font-weight-bold text-uppercase text-xs">Tanggal</th>
                            <th class="font-weight-bold text-uppercase text-xs">Jam</th>
                            <th class="font-weight-bold text-uppercase text-xs">Status</th>
                            <!-- Kolom Aksi dihapus -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                            @php
                                $created = \Carbon\Carbon::parse($laporan['created_at']);
                                // mapping warna & teks badge
                                switch($laporan['status']) {
                                    case 'Laporan masuk':
                                        $bgColor = '#e6f0ff'; $textColor = '#0066ff'; $statusText = 'Baru'; 
                                        $statusIcon = 'fa-inbox'; break;
                                    case 'Dilihat':
                                        $bgColor = '#f0e6ff'; $textColor = '#6600cc'; $statusText = 'Dibaca'; 
                                        $statusIcon = 'fa-eye'; break;
                                    case 'Diproses':
                                        $bgColor = '#fff2e6'; $textColor = '#ff8c1a'; $statusText = 'Proses'; 
                                        $statusIcon = 'fa-spinner'; break;
                                    case 'Selesai':
                                        $bgColor = '#e6ffe6'; $textColor = '#00cc00'; $statusText = 'Selesai'; 
                                        $statusIcon = 'fa-check-circle'; break;
                                    case 'Dibatalkan':
                                        $bgColor = '#ffe6e6'; $textColor = '#ff3333'; $statusText = 'Dibatalkan'; 
                                        $statusIcon = 'fa-times-circle'; break;
                                    default:
                                        $bgColor = '#f2f2f2'; $textColor = '#666666'; $statusText = $laporan['status'];
                                        $statusIcon = 'fa-question-circle';
                                }
                            @endphp
                            <tr class="report-row">
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input
                                            type="checkbox"
                                            name="selected[]"
                                            value="{{ $laporan['no_registrasi'] }}"
                                            class="custom-control-input rowCheckbox"
                                            id="check-{{ $laporan['no_registrasi'] }}"
                                        >
                                        <label class="custom-control-label" for="check-{{ $laporan['no_registrasi'] }}"></label>
                                    </div>
                                </td>
                                <td class="font-weight-bold">
                                    @if($laporan['status'] === 'Laporan masuk')
                                        <form 
                                            action="{{ route('laporan.lihat', ['no_registrasi' => $laporan['no_registrasi']]) }}" 
                                            method="POST"
                                            class="d-inline"
                                        >
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-link text-primary p-0 m-0 align-baseline">
                                                {{ $laporan['no_registrasi'] }}
                                            </button>
                                        </form>
                                    @else
                                        @php
                                            $routeMap = [
                                                'Dilihat'    => 'laporan.detail-dilihat',
                                                'Diproses'   => 'laporan.detail-diproses',
                                                'Selesai'    => 'laporan.detail-selesai',
                                                'Dibatalkan' => 'laporan.detail-dibatalkan',
                                            ];
                                            $routeName = $routeMap[$laporan['status']] ?? null;
                                        @endphp

                                        @if ($routeName)
                                            <a href="{{ route($routeName, ['no_registrasi' => $laporan['no_registrasi']]) }}" class="text-primary">
                                                {{ $laporan['no_registrasi'] }}
                                            </a>
                                        @else
                                            <span class="text-muted">{{ $laporan['no_registrasi'] }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $created->format('d M Y') }}</td>
                                <td>{{ $created->format('H:i') }}</td>
                                <td>
                                    <span
                                        class="badge badge-pill px-3 py-2 d-flex align-items-center"
                                        style="background-color: {{ $bgColor }}; color: {{ $textColor }}; font-weight: 500; width: fit-content;"
                                    >
                                        <i class="fas {{ $statusIcon }} mr-1"></i> {{ $statusText }}
                                    </span>
                                </td>
                                <!-- Kolom Aksi dihapus -->
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-folder-open text-muted fa-4x mb-3"></i>
                                        <p class="text-muted h5 mb-0">Belum ada laporan yang ditemukan.</p>
                                        <p class="text-muted small">Coba ubah filter pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan {{ count($laporans) }} dari {{ count($laporans) }} laporan
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Modern Card Styling */
    .card {
        border-radius: 15px;
        box-shadow: 0 0.25rem 1.5rem rgba(58,59,69,0.15);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 2rem rgba(58,59,69,0.2);
    }
    
    /* Gradient Header */
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
    
    /* Table Styling */
    .table th {
        font-size: 0.75rem;
        letter-spacing: 1px;
        font-weight: 600;
        color: #555;
        border-top: none;
    }
    
    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
    }
    
    /* Row hover effect */
    .report-row {
        transition: all 0.2s;
    }
    
    .report-row:hover {
        background-color: rgba(78, 115, 223, 0.05);
        transform: scale(1.005);
    }
    
    /* Badge Styling */
    .badge {
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: all 0.2s;
    }
    
    .badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Form Controls */
    .form-control, .custom-select {
        border-radius: 30px;
        padding: 0.5rem 1.25rem;
        border: 1px solid #e3e6f0;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    
    .form-control:focus, .custom-select:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    
    /* Tombol Filter dan Export yang lebih menonjol */
    .btn-warning {
        background-color: #f6c23e;
        border-color: #f6c23e;
        color: #fff;
    }
    
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(246, 194, 62, 0.3);
    }
    
    .btn-success {
        background-color: #1cc88a;
        border-color: #1cc88a;
    }
    
    .btn-success:hover {
        background-color: #17a673;
        border-color: #169b6b;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(28, 200, 138, 0.3);
    }
    
    /* Search Bar Styling */
    .search-bar {
        transition: all 0.3s;
        border-radius: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding-left: 45px; /* Ruang untuk ikon */
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%234e73df" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg>');
        background-repeat: no-repeat;
        background-position: 15px center;
    }
    
    .search-bar:focus {
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.1);
        transform: translateY(-2px);
    }
    
    /* Filter Panel Animation */
    .filter-panel {
        transition: all 0.3s ease-out;
        transform-origin: top;
        opacity: 0;
        transform: scaleY(0);
    }
    
    .filter-panel.show {
        opacity: 1;
        transform: scaleY(1);
    }
    
    /* Status Cards */
    .border-left-primary {
        border-left: 4px solid #4e73df;
    }
    
    .border-left-success {
        border-left: 4px solid #1cc88a;
    }
    
    .border-left-warning {
        border-left: 4px solid #f6c23e;
    }
    
    .border-left-danger {
        border-left: 4px solid #e74a3b;
    }
    
    /* Empty State */
    .empty-state {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.5s ease-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Custom Checkbox */
    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #4e73df;
        border-color: #4e73df;
    }
</style>
@endpush

@push('scripts')
<script>
    $(function() {
        // Toggle filter form with animation
        $('#filterButton').click(function() {
            $('#filterForm').toggleClass('show');
            if ($('#filterForm').hasClass('show')) {
                $('#filterForm').slideDown(300);
            } else {
                $('#filterForm').slideUp(300);
            }
        });

        // Enhanced search with debounce
        let searchTimer;
        $('#searchInput').on('keyup', function(e) {
            clearTimeout(searchTimer);
            
            if (e.key === 'Enter') {
                window.location.href = "{{ route('laporan.daftar') }}?q=" + $(this).val();
                return;
            }
            
            searchTimer = setTimeout(() => {
                if ($(this).val().length >= 3) {
                    window.location.href = "{{ route('laporan.daftar') }}?q=" + $(this).val();
                }
            }, 500);
        });

        // Select / Deselect all rows with animation
        $('#selectAll').change(function() {
            const isChecked = $(this).prop('checked');
            
            $('.rowCheckbox').each(function(index) {
                const $this = $(this);
                setTimeout(() => {
                    $this.prop('checked', isChecked);
                    $this.closest('tr').toggleClass('bg-light', isChecked);
                }, index * 50); // Staggered animation
            });
        });
        
        // Individual row selection
        $('.rowCheckbox').change(function() {
            $(this).closest('tr').toggleClass('bg-light', $(this).prop('checked'));
            
            // Update selectAll checkbox
            const totalRows = $('.rowCheckbox').length;
            const selectedRows = $('.rowCheckbox:checked').length;
            $('#selectAll').prop('checked', totalRows === selectedRows);
        });

        // Export form validation with enhanced UX - DIPERBAIKI AGAR SESUAI DENGAN KODE ASLI
        $('#exportForm').on('submit', function(e) {
            var $checked = $('.rowCheckbox:checked');
            if (!$checked.length) {
                e.preventDefault();
                
                // Show animated notification instead of alert
                const notification = $('<div class="alert alert-warning alert-dismissible fade show" role="alert">' +
                    '<strong><i class="fas fa-exclamation-triangle mr-2"></i> Perhatian!</strong> Silakan pilih minimal satu laporan untuk di-export.' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>' +
                    '</div>');
                
                notification.css({
                    'position': 'fixed',
                    'top': '20px',
                    'right': '20px',
                    'z-index': '9999',
                    'max-width': '300px',
                    'box-shadow': '0 0.5rem 1rem rgba(0,0,0,0.15)',
                    'border-radius': '10px',
                    'opacity': '0',
                    'transform': 'translateY(-20px)'
                });
                
                $('body').append(notification);
                
                // Animate in
                notification.animate({
                    opacity: 1,
                    transform: 'translateY(0)'
                }, 300);
                
                // Auto dismiss after 5 seconds
                setTimeout(() => {
                    notification.alert('close');
                }, 5000);
                
                return;
            }
            
            // Hapus input selected[] lama
            $(this).find('input[name="selected[]"]').remove();
            
            // Tambahkan field selected[] untuk setiap yang dicentang - PERBAIKAN DISINI
            $checked.each(function() {
                $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'selected[]')
                    .val($(this).val())
                    .appendTo('#exportForm');
            });

            // Sertakan param filter/search saat ini - PERBAIKAN DISINI
            var params = new URLSearchParams(window.location.search);
            params.forEach(function(v, k) {
                if (k !== 'selected') {
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', k + '[]') // Menambahkan [] seperti di kode asli
                        .val(v)
                        .appendTo('#exportForm');
                }
            });
            
            // Show loading spinner on button
            $('#exportButton').html('<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...');
        });
        
        // Row hover effect for better UX
        $('.report-row').hover(
            function() {
                $(this).find('.badge').addClass('shadow-sm');
            },
            function() {
                $(this).find('.badge').removeClass('shadow-sm');
            }
        );
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush