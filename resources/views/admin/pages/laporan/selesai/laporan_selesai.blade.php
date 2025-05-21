@extends('admin.layouts.admin_master')

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white py-3">
        <h3 class="mb-0 fw-bold" style="text-align: left;">{{ $title }}</h3>
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
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>No Registrasi</th>
                        <th>Tanggal Laporan</th>
                        <th>Jam Pelaporan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($laporanSelesai as $laporan)
                        <tr>
                            <td>
                                <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>
                                    <a href="{{ route('laporan.detail-selesai', ['no_registrasi' => $laporan['no_registrasi']]) }}" 
                                       class="text-decoration-none fw-semibold text-primary">
                                        {{ $laporan['no_registrasi'] }}
                                    </a>
                                </strong>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('d M Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($laporan['tanggal_pelaporan'])->format('H:i') }}
                            </td>
                            <td>
                                <span class="badge rounded-pill bg-success text-white px-3 py-2">
                                    {{ $laporan['status'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bx bx-folder-open fs-1 text-muted"></i>
                                <h5 class="mt-2">Belum ada Laporan yang selesai</h5>
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
    }

    .table td {
        padding: 12px 0;
        vertical-align: middle;
    }

    .badge {
        font-weight: 500;
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .input-group-text {
        background-color: #fff;
        border-color: #e0e0e0;
    }

    .form-control:focus {
        border-color: #5a8eff;
        box-shadow: none;
    }

    .text-primary {
        color: #5a8eff !important;
    }

    .text-primary:hover {
        text-decoration: underline;
    }

    h3 {
        text-align: left;
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
