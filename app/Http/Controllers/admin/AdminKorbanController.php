<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKorbanController extends Controller
{
    public function store(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);

        $validator = Validator::make($request->all(), [
            'no_registrasi' => 'required|string|max:255',
            'nik_korban' => 'required|string|max:255',
            'nama_korban' => 'required|string|max:255',
            'usia_korban' => 'required|integer',
            'jenis_kelamin' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'kebangsaan' => 'required|string|max:255',
            'hubungan_dengan_pelaku' => 'required|string|max:255',
            'alamat_korban' => 'required|string|max:255',
            'alamat_detail' => 'nullable|string',
            'keterangan_lainnya' => 'nullable|string',
            'dokumentasi_korban' => 'required|image|mimes:jpeg,png,jpg,gif|max:7000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dokumentasi_korban = $request->file('dokumentasi_korban');

        $response = Http::withHeaders($headers)
            ->attach('dokumentasi_korban', file_get_contents($dokumentasi_korban), $dokumentasi_korban->getClientOriginalName())
            ->post(env('API_URL') . 'api/admin/create-korban-kekerasan', [
                'no_registrasi' => $request->input('no_registrasi'),
                'nik_korban' => $request->input('nik_korban'),
                'nama_korban' => $request->input('nama_korban'),
                'usia_korban' => $request->input('usia_korban'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'agama' => $request->input('agama'),
                'no_telepon' => $request->input('no_telepon'),
                'pendidikan' => $request->input('pendidikan'),
                'pekerjaan' => $request->input('pekerjaan'),
                'status_perkawinan' => $request->input('status_perkawinan'),
                'kebangsaan' => $request->input('kebangsaan'),
                'hubungan_dengan_pelaku' => $request->input('hubungan_dengan_pelaku'),
                'alamat_korban' => $request->input('alamat_korban'),
                'alamat_detail' => $request->input('alamat_detail'),
                'keterangan_lainnya' => $request->input('keterangan_lainnya'),
            ]);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back()->with('success', 'Data korban berhasil ditambahkan');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal menambahkan data korban. Silakan coba lagi.');
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
}
