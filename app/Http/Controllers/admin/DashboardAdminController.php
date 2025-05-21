<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DashboardAdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $userData = $request->cookie('user_data');
        $headers = ApiHelper::getAuthorizationHeader($request);

        $eventsResponse = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/event');
        if ($eventsResponse->successful()) {
            $events = $eventsResponse->json()['Data'];
            $upcomingEvents = collect($events)->filter(function ($event) {
                $eventDate = Carbon::parse($event['tanggal_pelaksanaan']);
                return $eventDate->between(Carbon::now(), Carbon::now()->addDays(3));
            });
        } else {
            $upcomingEvents = collect([]);
        }
        $emergencyContactResponse = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/emergency-contact');
        if ($emergencyContactResponse->successful()) {
            $emergencyContact = $emergencyContactResponse->json()['data'];
        } else {
            $emergencyContact = null;
        }
        $laporansResponse = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');
        if ($laporansResponse->successful()) {
            $laporans = $laporansResponse->json()['Data'];
            $laporanMasuk = collect($laporans)->filter(function ($laporan) {
                return $laporan['status'] == 'Laporan masuk';
            });

            $laporanDilihat = collect($laporans)->filter(function ($laporan) {
                return $laporan['status'] == 'Dilihat';
            });

            $laporanDiproses = collect($laporans)->filter(function ($laporan) {
                return $laporan['status'] == 'Diproses';
            });
        } else {
            $laporanMasuk = collect([]);
            $laporanDilihat = collect([]);
            $laporanDiproses = collect([]);
        }

        Carbon::setLocale('id');
        return view('admin.pages.admin_dashboard', [
            'title' => 'Dashboard Admin',
            'user' => $userData,
            'events' => $upcomingEvents,
            'laporanMasuk' => $laporanMasuk,
            'laporanDilihat' => $laporanDilihat,
            'laporanDiproses' => $laporanDiproses,
            'emergencyContact' => $emergencyContact,
        ]);
    }
    public function showEmergencyContact($id)
    {
        // Set the authorization headers if needed
        $headers = [
            'Authorization' => 'Bearer ' . session('api_token'), // Adjust according to your auth mechanism
        ];

        // Make the GET request to the API
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/emergency-contact/' . $id);

        if ($response->successful()) {
            $emergencyContact = $response->json();

            return view('admin.emergency-contact-edit', compact('emergencyContact'));
        } else {
            Alert::error('Error', 'Gagal mengambil data kontak darurat.');
            return redirect()->back()->with('error', 'Gagal mengambil data kontak darurat.');
        }
    }

    public function updateContact(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $phone = $request->input('phone');

        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Http::withHeaders($headers)
            ->put(env('API_URL') . 'api/admin/emergency-contact-edit', [
                'phone' => $phone,
            ]);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->back();
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal memperbarui kontak darurat. Silakan coba lagi.');
        }
    }
}
