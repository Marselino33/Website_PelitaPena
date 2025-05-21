@extends('admin.layouts.admin_master')

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h3 class="mb-0 fw-bold">{{ $title }}</h3>
    </div>

    <div class="card-body">
        {{-- Search and Filter --}}
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
                        <th>No Registrasi</th>
                        <th>Tanggal Laporan</th>
                        <th>Jam Pelaporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($laporanDiproses as $laporan)
                        <tr>
                            <td>
                                <a href="{{ route('laporan.detail-diproses', ['no_registrasi' => $laporan['no_registrasi']]) }}"
                                   class="text-decoration-none fw-semibold text-primary">
                                    {{ $laporan['no_registrasi'] }}
                                </a>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('d M Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('H:i') }}
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bx bx-folder-open fs-1 text-muted"></i>
                                <h5 class="mt-2">Belum ada Laporan yang diproses</h5>
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

    .table th {
        font-weight: 600;
        color: #555;
        background-color: #f8f9fa;
    }

    .table td {
        padding: 12px 0;
        vertical-align: middle;
    }

    .badge {
        font-weight: 500;
        font-size: 0.875rem;
    }

    a.text-primary {
        color: #5a8eff !important;
    }

    a.text-primary:hover {
        text-decoration: underline;
    }

    .form-control,
    .input-group-text {
        border-color: #e0e0e0;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #5a8eff;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const tableBody = document.getElementById('tableBody');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = this.value.toLowerCase();
            const rows = tableBody.getElementsByTagName('tr');

            Array.from(rows).forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
    });
</script>
@endpush
