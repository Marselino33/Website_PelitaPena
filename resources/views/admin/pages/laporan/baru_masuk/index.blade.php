{{-- resources/views/admin/pages/laporan/baru_masuk/index.blade.php --}}
@extends('admin.layouts.admin_master')
@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h3 class="mb-0 fw-bold">{{ $title }}</h3>
        {{-- <button class="btn btn-primary px-4" style="background-color: #6c9aff; border-color: #5a8eff;">
            <i class="bx bx-plus me-1"></i> Tambah Laporan
        </button> --}}
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Pencaharian" id="searchInput">
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end gap-2">
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-filter me-1"></i> Filters
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                        <li><a class="dropdown-item" href="#" data-filter="all">Semua</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="baru">Baru</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="dibaca">Dibaca</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="proses">Proses</a></li>
                        <li><a class="dropdown-item" href="#" data-filter="selesai">Selesai</a></li>
                    </ul>
                </div>
                <button class="btn btn-outline-secondary" id="exportBtn">
                    <i class="bx bx-export me-1"></i> Eksport
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="bg-light">
                    <tr>
                        <th width="40">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th>No Registrasi</th>
                        <th>Tanggal Laporan</th>
                        <th>Jam Pelaporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporans as $laporan)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $laporan['no_registrasi'] }}">
                                </div>
                            </td>
                            <td>
                                <form
                                    action="{{ route('laporan.lihat', ['no_registrasi' => $laporan['no_registrasi']]) }}"
                                    method="POST" id="lihat-laporan-{{ $laporan['no_registrasi'] }}">
                                    @csrf
                                    @method('PUT')
                                    <a href="#" class="text-decoration-none fw-semibold"
                                        onclick="event.preventDefault(); document.getElementById('lihat-laporan-{{ $laporan['no_registrasi'] }}').submit();">
                                        {{ $laporan['no_registrasi'] }}
                                    </a>
                                </form>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('d M Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('H:i') }}
                            </td>
                            <td>
                                @php
                                    $statusClass = 'bg-primary';
                                    $statusBg = '';
                                    $statusText = '';
                                    
                                    if (strtolower($laporan['status']) == 'baru') {
                                        $statusBg = '#e6f0ff';
                                        $statusText = '#5a8eff';
                                    } elseif (strtolower($laporan['status']) == 'dibaca') {
                                        $statusBg = '#f3e6ff';
                                        $statusText = '#9966ff';
                                    } elseif (strtolower($laporan['status']) == 'proses') {
                                        $statusBg = '#fff8e6';
                                        $statusText = '#ffcc33';
                                    } elseif (strtolower($laporan['status']) == 'selesai') {
                                        $statusBg = '#e6ffe6';
                                        $statusText = '#33cc33';
                                    }
                                @endphp
                                <span class="badge rounded-pill px-3 py-2" 
                                      style="background-color: {{ $statusBg }}; color: {{ $statusText }};">
                                    {{ $laporan['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bx bx-folder-open fs-1 text-muted"></i>
                                <h5 class="mt-2">Belum Ada Laporan yang baru masuk</h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .btn-primary {
        border-radius: 8px;
    }
    
    .form-control, .input-group-text {
        border-color: #e0e0e0;
    }
    
    .form-control:focus {
        box-shadow: none;
        border-color: #5a8eff;
    }
    
    .table th {
        font-weight: 600;
        color: #555;
    }
    
    .table td {
        padding-top: 12px;
        padding-bottom: 12px;
    }
    
    .badge {
        font-weight: 500;
    }
    
    .btn-outline-secondary {
        border-color: #e0e0e0;
        color: #444;
    }
    
    .btn-outline-secondary:hover {
        background-color: #f8f9fa;
        color: #333;
        border-color: #d0d0d0;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Existing functionality
        document.querySelectorAll('form[id^="lihat-laporan-"]').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const noRegistrasi = this.id.split('-')[2];
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this)
                }).then(response => {
                    if (response.ok) {
                        window.location.href = "{{ route('laporan.masuk-detail', '') }}/" + noRegistrasi;
                    } else {
                        response.json().then(data => {
                            alert(data.message);
                        });
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });
            });
        });

        // New functionality
        // Select all checkbox
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('tbody .form-check-input');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }

        // Search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Filter functionality
        const filterLinks = document.querySelectorAll('[data-filter]');
        filterLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');
                const tableRows = document.querySelectorAll('tbody tr');
                
                tableRows.forEach(row => {
                    if (filter === 'all') {
                        row.style.display = '';
                    } else {
                        const statusCell = row.querySelector('td:nth-child(5)');
                        if (statusCell) {
                            const statusText = statusCell.textContent.trim().toLowerCase();
                            if (statusText === filter) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    }
                });
                
                document.getElementById('filterDropdown').textContent = 'Filter: ' + 
                    filter.charAt(0).toUpperCase() + filter.slice(1);
            });
        });

        // Export functionality
        const exportBtn = document.getElementById('exportBtn');
        if (exportBtn) {
            exportBtn.addEventListener('click', function() {
                // Get visible rows
                const visibleRows = Array.from(document.querySelectorAll('tbody tr'))
                    .filter(row => row.style.display !== 'none');
                
                if (visibleRows.length === 0) {
                    alert('Tidak ada data untuk diekspor');
                    return;
                }
                
                // Create CSV content
                let csvContent = 'No Registrasi,Tanggal Laporan,Jam Pelaporan,Status\n';
                
                visibleRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const noRegistrasi = cells[1].textContent.trim();
                    const tanggalLaporan = cells[2].textContent.trim();
                    const jamPelaporan = cells[3].textContent.trim();
                    const status = cells[4].textContent.trim();
                    
                    csvContent += `${noRegistrasi},${tanggalLaporan},${jamPelaporan},${status}\n`;
                });
                
                // Create download link
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.setAttribute('href', url);
                link.setAttribute('download', 'laporan_' + new Date().toISOString().slice(0,10) + '.csv');
                link.style.visibility = 'hidden';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }
    });
</script>
@endpush