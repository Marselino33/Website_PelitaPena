<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


class AdminKategoryKekerasan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/violence-categories');
        if ($response->successful()) {
            $category_violences = $response->json()['Data'];
        } else {
            $category_violences = [];
        }
        return view('admin.pages.category_violence.index', [
            'title' => 'Category Violence',
            'category_violences' => $category_violences
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category_violence.create', [
            'title' => 'Create Category Violence'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $category_name = $request->input('category_name');
        $image = $request->file('image');
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $response = Http::withHeaders($headers)
            ->attach('image', file_get_contents($image), $image->getClientOriginalName())
            ->post(env('API_URL') . 'api/admin/create-violence-category', [
                'category_name' => $category_name,
            ]);
        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('category-violence.index')->with('success', 'Kategori kekerasan berhasil ditambahkan.');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal menambahkan kategori kekerasan. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::get(env('API_URL') . 'api/admin/violence-category' . $id);
        if ($response->successful()) {
            return response()->json($response->json()['Data']);
        } else {
            return response()->json(['error' => 'Failed to fetch category details.'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-violence-category/' . $id);

        if ($response->successful()) {
            $category_violence = $response->json()['Data'];
            return view('admin.pages.category_violence.update', [
                'title' => 'Edit Category Violence',
                'category_violence' => $category_violence,
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data kategori kekerasan. Silakan coba lagi.');
        }
    }



    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $category_name = $request->input('category_name');
        $image = $request->file('image');

        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Http::withHeaders($headers)
            ->asMultipart();
        $response->attach('category_name', $category_name);

        if ($image) {
            $response->attach('image', file_get_contents($image), $image->getClientOriginalName());
        }

        $response = $response->put(env('API_URL') . 'api/admin/edit-violence-category/' . $id);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('category-violence.index')->with('success', 'Kategori kekerasan berhasil diperbarui.');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal memperbarui kategori kekerasan. Silakan coba lagi.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->delete(env('API_URL') . "api/admin/delete-violence-category/{$id}");

        if ($response->successful() && $response->json('status') == 'success') {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('category-violence.index')->with('success', $response->json('message'));
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back();
        }
    }
}
