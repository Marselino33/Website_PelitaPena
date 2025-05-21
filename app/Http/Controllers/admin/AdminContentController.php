<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AdminContentController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
    
        $contents = Content::with('violence_category')
            ->where(function($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('isi_content', 'like', "%{$keyword}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->appends(['keyword' => $keyword]);
    
        $recent_posts = Content::orderBy('created_at', 'desc')
                               ->limit(5)
                               ->get();
    
        return view('public.content.index', compact('contents', 'recent_posts'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/contents');
        if ($response->successful()) {
            $contents = $response->json()['Data'];
        } else {
            $contents = [];
        }
        return view('admin.pages.content.index', [
            'title' => 'Content',
            'contents' => $contents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $headers = ApiHelper::getAuthorizationHeader(request());
        $responseCategories = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/violence-categories');

        $categoryViolences = [];
        if ($responseCategories->successful()) {
            $categoryViolences = $responseCategories->json()['Data'];
        }

        return view('admin.pages.content.create', [
            'title' => 'Buat Konten Baru',
            'category_violences' => $categoryViolences,
        ]);
    }

    public function store(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'image_content' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            'violence_category_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('image_content');
        $imageContent = file_get_contents($image);

        $data = [
            'judul' => $request->input('judul'),
            'isi_content' => $request->input('isi_content'),
            'violence_category_id' => $request->input('violence_category_id'),
        ];

        $response = Http::withHeaders($headers)
            ->attach('image_content', $imageContent, $image->getClientOriginalName())
            ->post(env('API_URL') . 'api/admin/create-content', $data);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('content.index')->with('success', 'Konten berhasil dibuat.');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal membuat konten. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-content/' . $id);

        if ($response->successful()) {
            $contentDetail = $response->json()['Data'];
            return view('admin.pages.content.detail', [
                'title' => 'Detail Konten',
                'contentDetail' => $contentDetail,
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
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-content/' . $id);

        if ($response->successful()) {
            $content = $response->json()['Data'];
            return view('admin.pages.content.update', [
                'title' => 'Edit Konten',
                'content' => $content,
            ]);
        } else {
            return redirect()->back()->with('error', 'Gagal mengambil data konten. Silakan coba lagi.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi_content' => 'required|string',
            'image_content' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:7000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $headers = ApiHelper::getAuthorizationHeader($request);
        $judul = $request->input('judul');
        $isi_content = $request->input('isi_content');
        $image_content = $request->file('image_content');

        $response = Http::withHeaders($headers)
            ->asMultipart();

        $response->attach('judul', $judul);
        $response->attach('isi_content', $isi_content);

        if ($image_content) {
            $response->attach('image_content', file_get_contents($image_content), $image_content->getClientOriginalName());
        }

        $response = $response->put(env('API_URL') . 'api/admin/edit-content/' . $id);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('content.index')->with('success', 'Konten berhasil diperbarui');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back()->with('error', 'Gagal memperbarui konten. Silakan coba lagi.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->delete(env('API_URL') . "api/admin/delete-content/{$id}");

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('content.index');
        } else {
            Alert::error('Error', $response->json('message'));
            return redirect()->back();
        }
    }
}
