<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Log;
use App\Models\Donation;

class DashboardPublicController extends Controller
{
    public function welcome()
    {

        return view('public.pages.welcome', [
            'title' => 'Selamat Datang di Apliaksi Pelita Pena'
        ]);
    }

    public function donasi()
    {
        // Mengambil donasi berdasarkan created_at (donasi terbaru)
        $donations = Donation::orderBy('created_at', 'desc')->paginate(10);
        $recent_donations = Donation::orderBy('created_at', 'desc')->limit(5)->get();
    
        return view('public.pages.donasi', [
            'title'             => 'Donasi',
            'donations'         => $donations,
            'recent_donations'  => $recent_donations,
        ]);
    }
    public function detail($id)
{
    $donation = Donation::findOrFail($id);
    return view('public.pages.donasi_detail', [
        'donation' => $donation,
        'title'    => $donation->title
    ]);
}

public function index()
{
    $donations = Donation::orderBy('donation_date', 'desc')->paginate(10);
    return view('admin.pages.donasi.index', [
        'donations' => $donations,
        'title' => 'Daftar Donasi'
    ]);
}
    
    

    public function feature()
    {
        return view('public.pages.feature', [
            'title' => 'Fitur Aplikasi Pelita Pena'
        ]);
    }

    public function content()
    {
        try {
            $response = Http::get(env('API_URL') . 'api/publik-content');
            if ($response->successful()) {
                $contents = collect($response->json()['Data']);
            } else {
                $contents = collect([]);
            }

            // Fetch violence categories
            $responseCategories = Http::get(env('API_URL') . 'api/publik/kategori-kekerasan');
            if ($responseCategories->successful()) {
                $violenceCategories = collect($responseCategories->json()['Data']);
            } else {
                $violenceCategories = collect([]);
            }
        } catch (\Exception $e) {
            $contents = collect([]);
            $violenceCategories = collect([]);
        }

        // Manual Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = $contents->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedContents = new LengthAwarePaginator($currentPageItems, $contents->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        // Get recent posts (example, you may need to fetch from API)
        $recentPosts = $contents->sortByDesc('created_at')->take(5);

        return view('public.pages.content', [
            'title' => 'Blog Pelita Pena',
            'contents' => $paginatedContents,
            'recent_posts' => $recentPosts,
            'violence_categories' => $violenceCategories
        ]);
    }
    

    public function searchByCategory($categoryId)
    {
        try {
            // Fetch contents by category
            $responseContents = Http::get(env('API_URL') . 'api/publik-content?category_id=' . $categoryId);
            if ($responseContents->successful()) {
                $contents = collect($responseContents->json()['Data']);
            } else {
                $contents = collect([]);
            }
        } catch (\Exception $e) {
            $contents = collect([]);
        }

        // Manual Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = $contents->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedContents = new LengthAwarePaginator($currentPageItems, $contents->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        // Get recent posts (example, you may need to fetch from API)
        $recentPosts = $contents->sortByDesc('created_at')->take(5);

        return view('public.pages.content', [
            'title' => 'Blog Pelita Pena',
            'contents' => $paginatedContents,
            'recent_posts' => $recentPosts,
            'noResults' => $contents->isEmpty() // Add a flag for no results
        ]);
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        try {
            // Fetch violence categories
            $responseCategories = Http::get(env('API_URL') . 'api/publik/kategori-kekerasan');
            if ($responseCategories->successful()) {
                $violenceCategories = collect($responseCategories->json()['Data']);
            } else {
                $violenceCategories = collect([]);
            }

            // Fetch contents by keyword
            $responseContents = Http::get(env('API_URL') . 'api/publik-content?keyword=' . urlencode($keyword));
            if ($responseContents->successful()) {
                $contents = collect($responseContents->json()['Data']);
            } else {
                $contents = collect([]);
            }
        } catch (\Exception $e) {
            $contents = collect([]);
            $violenceCategories = collect([]);
        }

        // Manual Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = $contents->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedContents = new LengthAwarePaginator($currentPageItems, $contents->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        // Get recent posts (example, you may need to fetch from API)
        $recentPosts = $contents->sortByDesc('created_at')->take(5);

        return view('public.pages.content', [
            'title' => 'Blog Pelita Pena',
            'contents' => $paginatedContents,
            'recent_posts' => $recentPosts,
            'violence_categories' => $violenceCategories,
            'keyword' => $keyword,
            'noResults' => $contents->isEmpty() // Add a flag for no results
        ]);
    }

    public function detailContent($id)
    {
        try {
            $response = Http::get(env('API_URL') . 'api/detail-content/' . $id);
            if ($response->successful()) {
                $data = $response->json();
                $contentDetail = $data['Data'] ?? null;
            } else {
                $contentDetail = null;
            }
        } catch (\Exception $e) {
            $contentDetail = null;
        }

        return view('public.pages.content_detail', [
            'title' => $contentDetail && array_key_exists('judul', $contentDetail) ? $contentDetail['judul'] : 'Blog Detail',
            'content' => $contentDetail
        ]);
    }


    public function event()
    {
        try {
            // Fetch events
            $response = Http::get(env('API_URL') . 'api/publik-event');
            if ($response->successful()) {
                $events = collect($response->json()['Data']);
            } else {
                $events = collect([]);
            }
        } catch (\Exception $e) {
            $events = collect([]);
        }

        // Manual Pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5;
        $currentPageItems = $events->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginatedEvents = new LengthAwarePaginator($currentPageItems, $events->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath()
        ]);

        return view('public.pages.event', [
            'title' => 'Event DPMDPPA',
            'events' => $paginatedEvents
        ]);
    }


    public function eventDetail($id)
    {
        try {
            // Fetch event details
            $response = Http::get(env('API_URL') . 'api/detail-event/' . $id);
            if ($response->successful()) {
                $event = $response->json()['Data'];
            } else {
                $event = null;
            }
        } catch (\Exception $e) {
            Log::error("Failed to fetch event details: " . $e->getMessage());
            $event = null;
        }

        return view('public.pages.event_detail', [
            'title' => 'Event Detail',
            'event' => $event
        ]);
    }






    public function contact()
    {
        return view('public.pages.contact', [
            'title' => 'Contact Kami'
        ]);
    }
}
