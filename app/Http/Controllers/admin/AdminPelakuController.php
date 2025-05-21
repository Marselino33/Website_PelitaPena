<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPelakuController extends Controller
{
    public function store(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $no_registrasi = $request->input('no_registrasi');
        $nik_pelaku = $request->input('nik_pelaku');
        $nama_pelaku = $request->input('nama_pelaku');
        $usia_pelaku = $request->input('usia_pelaku');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $agama = $request->input('agama');
        $no_telepon = $request->input('no_telepon');
        $pendidikan = $request->input('pendidikan');
        $pekerjaan = $request->input('pekerjaan');
        $status_perkawinan = $request->input('status_perkawinan');
        $kebangsaan = $request->input('kebangsaan');
        $hubungan_dengan_korban = $request->input('hubungan_dengan_korban');
        $alamat_pelaku = $request->input('alamat_pelaku');
        $alamat_detail = $request->input('alamat_detail');
        $keterangan_lainnya = $request->input('keterangan_lainnya');
        $dokumentasi_pelaku = $request->file('dokumentasi_pelaku');

        $validator = Validator::make($request->all(), [
            'no_registrasi' => 'required|string|max:255',
            'nik_pelaku' => 'required|string|max:255',
            'nama_pelaku' => 'required|string|max:255',
            'usia_pelaku' => 'required|integer',
            'jenis_kelamin' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'kebangsaan' => 'required|string|max:255',
            'hubungan_dengan_korban' => 'required|string|max:255',
            'alamat_pelaku' => 'required|string|max:255',
            'alamat_detail' => 'nullable|string',
            'keterangan_lainnya' => 'nullable|string',
            'dokumentasi_pelaku' => 'required|image|mimes:jpeg,png,jpg,gif|max:7000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Http::withHeaders($headers)
            ->attach('dokumentasi_pelaku', file_get_contents($dokumentasi_pelaku), $dokumentasi_pelaku->getClientOriginalName())
            ->post(env('API_URL') . 'api/admin/create-pelaku-kekerasan', [
                'no_registrasi' => $no_registrasi,
                'nik_pelaku' => $nik_pelaku,
                'nama_pelaku' => $nama_pelaku,
                'usia_pelaku' => $usia_pelaku,
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => $agama,
                'no_telepon' => $no_telepon,
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'status_perkawinan' => $status_perkawinan,
                'kebangsaan' => $kebangsaan,
                'hubungan_dengan_korban' => $hubungan_dengan_korban,
                'alamat_pelaku' => $alamat_pelaku,
                'alamat_detail' => $alamat_detail,
                'keterangan_lainnya' => $keterangan_lainnya,
            ]);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back()->with('success', 'Data pelaku berhasil ditambahkan');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal menambahkan data pelaku. Silakan coba lagi.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->delete(env('API_URL') . "api/admin/delete-pelaku-kekerasan/{$id}");

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back();
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back();
        }
    }
public function update(Request $request, $id)
{
    $headers = ApiHelper::getAuthorizationHeader($request);

    // validation
    $validator = Validator::make($request->all(), [
        'nik_pelaku'             => 'required|string|max:255',
        'nama_pelaku'            => 'required|string|max:255',
        'usia_pelaku'            => 'required|integer',
        'jenis_kelamin'          => 'required|string|max:255',
        'agama'                  => 'required|string|max:255',
        'no_telepon'             => 'required|string|max:255',
        'pendidikan'             => 'required|string|max:255',
        'pekerjaan'              => 'required|string|max:255',
        'status_perkawinan'      => 'required|string|max:255',
        'kebangsaan'             => 'required|string|max:255',
        'hubungan_dengan_korban' => 'required|string|max:255',
        'alamat_pelaku'          => 'required|string|max:255',
        'alamat_detail'          => 'nullable|string',
        'keterangan_lainnya'     => 'nullable|string',
        'dokumentasi_pelaku'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:7000',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // prepare the HTTP client, with or without a file
    $http = Http::withHeaders($headers);

    if ($request->hasFile('dokumentasi_pelaku')) {
        $file = $request->file('dokumentasi_pelaku');
        $http = $http->attach(
            'dokumentasi_pelaku',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        );
    }

    // call your Go backend’s edit-pelaku-kekerasan route
    $response = $http->put(
        env('API_URL') . "api/admin/edit-pelaku-kekerasan/{$id}",
        [
            'nik_pelaku'             => $request->input('nik_pelaku'),
            'nama_pelaku'            => $request->input('nama_pelaku'),
            'usia_pelaku'            => $request->input('usia_pelaku'),
            'jenis_kelamin'          => $request->input('jenis_kelamin'),
            'agama'                  => $request->input('agama'),
            'no_telepon'             => $request->input('no_telepon'),
            'pendidikan'             => $request->input('pendidikan'),
            'pekerjaan'              => $request->input('pekerjaan'),
            'status_perkawinan'      => $request->input('status_perkawinan'),
            'kebangsaan'             => $request->input('kebangsaan'),
            'hubungan_dengan_korban' => $request->input('hubungan_dengan_korban'),
            'alamat_pelaku'          => $request->input('alamat_pelaku'),
            'alamat_detail'          => $request->input('alamat_detail'),
            'keterangan_lainnya'     => $request->input('keterangan_lainnya'),
        ]
    );

    if ($response->successful()) {
        Alert::success('Success', $response->json('message'));
        return redirect()->back()->with('success', 'Data pelaku berhasil diperbarui');
    } else {
        Alert::error('Error', $response->json('message') ?? 'Gagal memperbarui data pelaku');
        return redirect()->back()->withInput();
    }
}
}
