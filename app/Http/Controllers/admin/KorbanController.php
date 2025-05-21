<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Korban;
use Illuminate\Support\Facades\Storage;

class KorbanController extends Controller
{
    /**
     * Store a newly created Korban in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_registrasi'          => 'required|string',
            'nik_korban'             => 'required|string',
            'nama'                   => 'required|string',
            'usia'                   => 'required|integer',
            'alamat_korban'          => 'required|string',
            'alamat_detail'          => 'nullable|string',
            'jenis_kelamin'          => 'required|string',
            'agama'                   => 'nullable|string',
            'no_telepon'             => 'nullable|string',
            'pendidikan'             => 'nullable|string',
            'pekerjaan'              => 'nullable|string',
            'status_perkawinan'      => 'nullable|string',
            'kebangsaan'             => 'nullable|string',
            'hubungan_dengan_korban' => 'nullable|string',
            'keterangan_lainnya'     => 'nullable|string',
            'dokumentasi_pelaku'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload gambar korban jika ada
        if ($request->hasFile('dokumentasi_pelaku')) {
            $file     = $request->file('dokumentasi_pelaku');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path     = $file->storeAs('public/korban', $filename);
            $validated['dokumentasi_pelaku'] = Storage::url($path);
        }

        Korban::create($validated);

        return redirect()->back()->with('success', 'Data korban berhasil disimpan.');
    }
}
