{{-- resources/views/admin/pages/laporan/dilihat/index.blade.php --}}
@extends('admin.layouts.admin_master')

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h3 class="mb-0 fw-bold">{{ $title }}</h3>
    </div>

    <div class="card-body">
        {{-- Search and Export --}}
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


        {{-- Table --}}
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
                        <th>Waktu Pelaporan</th>
                        <th>Status</th>
                        <th>Waktu Dilihat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanDilihat as $laporan)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $laporan['no_registrasi'] }}">
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('laporan.detail-dilihat', ['no_registrasi' => $laporan['no_registrasi']]) }}"
                                   class="text-decoration-none fw-semibold">
                                    {{ $laporan['no_registrasi'] }}
                                </a>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('d M Y \j\a\m H:i') }}
                            </td>
                            <td>
                                @php
                                    $status = strtolower($laporan['status']);
                                    $statusBgMap = [
                                        'baru' => ['#e6f0ff', '#5a8eff'],
                                        'dibaca' => ['#f3e6ff', '#9966ff'],
                                        'proses' => ['#fff8e6', '#ffcc33'],
                                        'selesai' => ['#e6ffe6', '#33cc33'],
                                    ];
                                    [$bgColor, $textColor] = $statusBgMap[$status] ?? ['#e0e0e0', '#000'];
                                @endphp
                                <span class="badge rounded-pill px-3 py-2"
                                      style="background-color: {{ $bgColor }}; color: {{ $textColor }};">
                                    {{ ucfirst($laporan['status']) }}
                                </span>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['waktu_dilihat'])->format('d M Y \j\a\m H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bx bx-folder-open fs-1 text-muted"></i>
                                <h5 class="mt-2">Belum ada laporan yang sudah dilihat</h5>
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

    .form-control,
    .input-group-text {
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
        padding: 12px 0;
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
    document.addEventListener('DOMContentLoaded', function () {
        // Checkbox Select All
        const selectAllCheckbox = document.getElementById('selectAll');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                const checkboxes = document.querySelectorAll('tbody .form-check-input');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }

        // Pencarian baris
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchTerm) ? '' : 'none';
                });
            });
        }
    });
</script>
@endpush
