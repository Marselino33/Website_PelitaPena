<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TrackingLaporanController extends Controller
{


    public function store(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $validator = Validator::make($request->all(), [
            'no_registrasi' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'document' => 'required|file|mimes:jpeg,png,jpg|max:7000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $no_registrasi = $request->input('no_registrasi');
        $keterangan = $request->input('keterangan');
        $document = $request->file('document');

        $response = Http::withHeaders($headers)
            ->asMultipart()
            ->attach('document', file_get_contents($document), $document->getClientOriginalName())
            ->post(env('API_URL') . 'api/admin/create-tracking-laporan', [
                'no_registrasi' => $no_registrasi,
                'keterangan' => $keterangan,
            ]);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back();
        } else {
            Alert::success('Success', $response->json('message'));
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        // Ambil header autentikasi (misalnya token JWT dari helper)
        $headers = ApiHelper::getAuthorizationHeader($request);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_registrasi' => 'sometimes|string|max:255',
            'keterangan' => 'sometimes|string|max:255',
            'document' => 'sometimes|file|mimes:jpeg,png,jpg,pdf|max:7000', // Maksimum 7MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Data yang akan dikirim
        $data = [];
        if ($request->has('no_registrasi')) {
            $data['no_registrasi'] = $request->input('no_registrasi');
        }
        if ($request->has('keterangan')) {
            $data['keterangan'] = $request->input('keterangan');
        }

        // Siapkan request HTTP
        $http = Http::withHeaders($headers)->asMultipart();

        // Jika ada file document yang diunggah
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $http->attach(
                'document',
                file_get_contents($document),
                $document->getClientOriginalName()
            );
        }

        // Kirim request ke endpoint Go
        $response = $http->put(env('API_URL') . "api/admin/edit-tracking-laporan/{$id}", $data);

        // Tangani respons
        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back();
        } else {
            Alert::error('Error', $response->json('message') ?? 'Something went wrong');
            return redirect()->back();
        }
    }

    // Method untuk Delete Tracking Laporan
    public function destroy(Request $request, $id)
    {
        // Ambil header autentikasi
        $headers = ApiHelper::getAuthorizationHeader($request);

        // Kirim request DELETE ke endpoint Go
        $response = Http::withHeaders($headers)
            ->delete(env('API_URL') . "api/admin/delete-tracking-laporan/{$id}");

        // Tangani respons
        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back();
        } else {
            Alert::error('Error', $response->json('message') ?? 'Failed to delete tracking laporan');
            return redirect()->back();
        }
    }

}
