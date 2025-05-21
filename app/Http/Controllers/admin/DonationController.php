<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    // Tampilkan daftar donasi
    public function index()
    {
        $donations = Donation::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.donasi.index', [
            'donations' => $donations,
            'title' => 'Daftar Donasi'
        ]);
    }

    // Tampilkan form untuk membuat donasi baru
    public function create()
    {
        return view('admin.pages.donasi.create', [
            'title' => 'Tambah Donasi'
        ]);
    }

    // Simpan data donasi baru
    public function store(Request $request)
    {
        // Debug: Tampilkan semua input yang dikirim
        // dd($request->all());

        // Validasi input; title bersifat nullable
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'qr_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Ambil input title dan tetapkan default jika kosong
        $inputTitle = trim($request->input('title'));
        $title = ($inputTitle === '') ? 'Tanpa Judul' : $inputTitle;
        $description = $request->input('description');

        // Proses upload file QR Image
        if ($request->hasFile('qr_image')) {
            $path = $request->file('qr_image')->store('donations/qr_images', 'public');
        } else {
            $path = null;
        }

        // Pastikan kita mengirim array dengan field yang lengkap
        Donation::create([
            'title' => $title,
            'description' => $description,
            'qr_image' => $path,
        ]);

        return redirect()->route('admin.pages.donasi.index')->with('success', 'Donasi berhasil ditambahkan');
    }

    // Tampilkan detail donasi
    public function show($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.pages.donasi.show', [
            'donation' => $donation,
            'title' => 'Detail Donasi'
        ]);
    }

    // Tampilkan form untuk mengedit donasi
    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        return view('admin.pages.donasi.edit', [
            'donation' => $donation,
            'title' => 'Edit Donasi'
        ]);
    }

    // Perbarui data donasi
    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'qr_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $inputTitle = trim($request->input('title'));
        $title = ($inputTitle === '') ? 'Tanpa Judul' : $inputTitle;
        $description = $request->input('description');

        if ($request->hasFile('qr_image')) {
            if ($donation->qr_image && Storage::disk('public')->exists($donation->qr_image)) {
                Storage::disk('public')->delete($donation->qr_image);
            }
            $path = $request->file('qr_image')->store('donations/qr_images', 'public');
        } else {
            $path = $donation->qr_image;
        }

        $donation->update([
            'title' => $title,
            'description' => $description,
            'qr_image' => $path,
        ]);

        return redirect()->route('admin.pages.donasi.index')->with('success', 'Donasi berhasil diperbarui');
    }
    public function detail($id)
    {
        $donation = Donation::findOrFail($id);
        return view('public.pages.donasi_detail', [
            'donation' => $donation,
            'title' => $donation->title
        ]);
    }

    // Hapus data donasi
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        if ($donation->qr_image && Storage::disk('public')->exists($donation->qr_image)) {
            Storage::disk('public')->delete($donation->qr_image);
        }
        $donation->delete();
        return redirect()->route('admin.pages.donasi.index')->with('success', 'Donasi berhasil dihapus');
    }
}
