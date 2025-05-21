@extends('admin.layouts.admin_master')

@section('content')
<div class="card shadow-sm border-0 rounded-lg">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h3 class="mb-0 fw-bold">{{ $title }}</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle text-center">
                <thead class="bg-light">
                    <tr>
                        <th>Oleh</th>
                        <th>Jam Dimulai</th>
                        <th>Jam Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($janjitemusDisetujui as $janjitemu)
                        <tr>
                            <td>
                                <a href="{{ route('janji-temu.detail-disetujui', ['id' => $janjitemu['id']]) }}" 
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

    .text-decoration-none {
        color: #1a1a1a;
    }

    .text-decoration-none:hover {
        text-decoration: underline;
    }
</style>
@endpush
