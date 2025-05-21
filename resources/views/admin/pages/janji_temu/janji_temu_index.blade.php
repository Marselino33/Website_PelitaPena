{{-- resources/views/admin/pages/janjitemu.blade.php --}}
@extends('admin.layouts.admin_master')

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h3 class="mb-0 fw-bold">{{ $title }}</h3>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12">
                <div class="input-group w-100"> 
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bx bx-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Cari Laporan" id="searchInput">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Oleh</th>
                        <th>Jam Dimulai</th>
                        <th>Jam Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($janjitemus as $janjitemu)
                        <tr>
                            <td>
                                <a href="{{ route('janji-temu.detail', ['id' => $janjitemu['id']]) }}" 
                                   class="text-decoration-none fw-semibold">
                                    {{ $janjitemu['user']['full_name'] }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($janjitemu['waktu_dimulai'])->format('d M Y, H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($janjitemu['waktu_selesai'])->format('d M Y, H:i') }}</td>
                            <td>
                                @php
                                    $statusBg = '';
                                    $statusText = '';
                                    
                                    switch (strtolower($janjitemu['status'])) {
                                        case 'menunggu':
                                            $statusBg = '#e6f0ff';
                                            $statusText = '#5a8eff';
                                            break;
                                        case 'disetujui':
                                        case 'selesai':
                                            $statusBg = '#e6ffe6';
                                            $statusText = '#33cc33';
                                            break;
                                        case 'ditolak':
                                            $statusBg = '#ffe6e6';
                                            $statusText = '#ff3333';
                                            break;
                                        default:
                                            $statusBg = '#f3e6ff';
                                            $statusText = '#9966ff';
                                    }
                                @endphp
                                <span class="badge rounded-pill px-3 py-2" 
                                      style="background-color: {{ $statusBg }}; color: {{ $statusText }};">
                                    {{ $janjitemu['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bx bx-calendar-x fs-1 text-muted"></i>
                                <h5 class="mt-2">Tidak Ada Request {{ $title }}</h5>
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
        // Fitur pencarian
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush
