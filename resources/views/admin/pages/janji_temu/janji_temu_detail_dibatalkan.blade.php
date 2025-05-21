@extends('admin.layouts.admin_master')

@section('content')
    <h1>Detail Janji Temu Dibatalkan</h1>
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Nama Masyarakat</strong>
                        </td>
                        <td>{{ $detailDibatalkan['user']['full_name'] }}</td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Photo Profil</strong>
                        </td>
                        <td>
                            <img src="{{ !empty($detailDibatalkan['user']['photo_profile']) ? $detailDibatalkan['user']['photo_profile'] : asset('asset-admin/assets/img/avatars/no_photo.png') }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                        </td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Nomor Telepon</strong>
                        </td>
                        <td>{{ $detailDibatalkan['user']['phone_number'] }}</td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Jam Dimulai</strong>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($detailDibatalkan['waktu_dimulai'])->format('d M Y, H:i') }}</td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Jam Selesai</strong>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($detailDibatalkan['waktu_selesai'])->format('d M Y, H:i') }}</td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Keperluan Konsultasi</strong>
                        </td>
                        <td>{{ $detailDibatalkan['keperluan_konsultasi'] }}</td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Status Request</strong>
                        </td>
                        <td>
                            <span class="badge bg-label-primary me-1">{{ $detailDibatalkan['status'] }}</span>
                        </td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Alasan Dibatalkan</strong>
                        </td>
                        <td>{{ $detailDibatalkan['alasan_dibatalkan'] }}</td>
                    </tr>
                </tbody>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>Dibatalkan Oleh</strong>
                        </td>
                        <td>{{ $detailDibatalkan['user']['full_name'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
