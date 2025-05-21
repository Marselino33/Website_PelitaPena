<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/event');
        if ($response->successful()) {
            $events = $response->json()['Data'];
        } else {
            $events = [];
        }
        return view('admin.pages.event.index', [
            'title' => 'Event DPMDPPA',
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.event.create', [
            'title' => 'Buat Event Baru',
        ]);
    }

    public function store(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);

        $validator = Validator::make($request->all(), [
            'nama_event' => 'required|string|max:255',
            'deskripsi_event' => 'required|string',
            'thumbnail_event' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            'tanggal_pelaksanaan' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('thumbnail_event');
        $thumbnailContent = file_get_contents($image);

        $data = [
            'nama_event' => $request->input('nama_event'),
            'deskripsi_event' => $request->input('deskripsi_event'),
            'tanggal_pelaksanaan' => $request->input('tanggal_pelaksanaan'),
        ];

        $response = Http::withHeaders($headers)
            ->attach('thumbnail_event', $thumbnailContent, $image->getClientOriginalName())
            ->post(env('API_URL') . 'api/admin/create-event', $data);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('event.index')->with('success', 'Event berhasil dibuat.');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal membuat event. Silakan coba lagi.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-event/' . $id);

        if ($response->successful()) {
            $eventDetail = $response->json()['Data'];
            return view('admin.pages.event.detail', [
                'title' => 'Detail Konten',
                'eventDetail' => $eventDetail,
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data konten. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-event/' . $id);

        if ($response->successful()) {
            $event = $response->json()['Data'];
            return view('admin.pages.event.update', [
                'title' => 'Edit Konten',
                'event' => $event,
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data konten. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_event' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required',
            'deskripsi_event' => 'required|string',
            'thumbnail_event' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:7000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $headers = ApiHelper::getAuthorizationHeader($request);
        $nama_event = $request->input('nama_event');
        $tanggal_pelaksanaan = \Carbon\Carbon::parse($request->input('tanggal_pelaksanaan'))->format('Y-m-d H:i:s');
        $deskripsi_event = $request->input('deskripsi_event');
        $thumbnail_event = $request->file('thumbnail_event');

        $response = Http::withHeaders($headers)
            ->asMultipart();

        $response->attach('nama_event', $nama_event);
        $response->attach('tanggal_pelaksanaan', $tanggal_pelaksanaan);
        $response->attach('deskripsi_event', $deskripsi_event);

        if ($thumbnail_event) {
            $response->attach('thumbnail_event', file_get_contents($thumbnail_event), $thumbnail_event->getClientOriginalName());
        }

        $response = $response->put(env('API_URL') . 'api/admin/edit-event/' . $id);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('event.index')->with('success', 'Event berhasil diperbarui');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->delete(env('API_URL') . "api/admin/delete-event/{$id}");

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('event.index');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back();
        }
    }
}
