<?php

namespace App\Http\Controllers\admin;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;    
use App\Models\Laporan;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;      // ← atau sesuai alias Anda

class AdminLaporanController extends Controller
{

    public function masuk(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');

        $laporans = [];

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['Data']) && is_array($data['Data'])) {
                $laporans = array_filter($data['Data'], function ($item) {
                    return isset($item['status']) && $item['status'] == 'Laporan masuk';
                });
            }
        }

        return view('admin.pages.laporan.baru_masuk.index', [
            'title' => 'Laporan Masyarakat Baru Masuk',
            'laporans' => $laporans,
        ]);
    }
    public function daftar(Request $request)
    {
        $headers  = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');
    
        $laporans = [];
    
        if ($response->successful()) {
            $data = $response->json('Data', []);
    
            if (is_array($data)) {
                // Ambil filter dari request
                $statusFilter = $request->input('status');
                $searchQuery  = strtolower($request->input('q'));
    
                $laporans = array_filter($data, function ($item) use ($statusFilter, $searchQuery) {
                    $matchStatus = !$statusFilter || (isset($item['status']) && $item['status'] === $statusFilter);
                    
                    $matchSearch = true;
                    if ($searchQuery) {
                        $fields = ['no_registrasi', 'nama', 'judul_laporan'];
                        $matchSearch = false;
                        foreach ($fields as $field) {
                            if (isset($item[$field]) && stripos($item[$field], $searchQuery) !== false) {
                                $matchSearch = true;
                                break;
                            }
                        }
                    }
    
                    return $matchStatus && $matchSearch;
                });
            }
        }
    
        return view('admin.pages.laporan.daftar.laporan_daftar', [
            'title'    => 'Daftar Semua Laporan',
            'laporans' => $laporans,
        ]);
    }
    

    public function masukDetail(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);
        if ($response->successful()) {
            $laporanDetail = $response->json()['Data'];
            return view('admin.pages.laporan.baru_masuk.detail_laporan', [
                'title' => 'Detail Laporan',
                'laporanDetail' => $laporanDetail,
            ]);
        }
        return redirect()->back()->with('error', 'Failed to fetch report detail');
    }


public function lihat(Request $request)
{
    $no_registrasi = $request->route('no_registrasi');
    $headers = ApiHelper::getAuthorizationHeader($request);
    $response = Http::withHeaders($headers)->put(env('API_URL') . 'api/admin/lihat-laporan/' . $no_registrasi);

    if ($response->successful()) {
        // arahkan ke halaman detail Dilihat
        return redirect()
            ->route('laporan.detail-dilihat', ['no_registrasi' => $no_registrasi])
            ->with('success', 'Laporan berhasil ditandai sebagai Dilihat.');
    }

    return redirect()->back()->with('error', 'Gagal menandai laporan. Silakan coba lagi.');
}





    public function dilihat(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');

        $laporanDilihat = [];

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['Data']) && is_array($data['Data'])) {
                $laporanDilihat = array_filter($data['Data'], function ($item) {
                    return isset($item['status']) && $item['status'] == 'Dilihat';
                });
            }
        }

        return view('admin.pages.laporan.dilihat.laporan_dilihat', [
            'title' => 'Laporan Masyarakat Sudah Dilihat',
            'laporanDilihat' => $laporanDilihat,
        ]);
    }

    public function detailDilihat(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);
        if ($response->successful()) {
            $laporanDetailDilihat = $response->json()['Data'];
            return view('admin.pages.laporan.dilihat.detail_laporan_dilihat', [
                'title' => 'Detail Laporan Diproses' . $no_registrasi,
                'laporanDetailDilihat' => $laporanDetailDilihat,
            ]);
        }
        return redirect()->back()->with('error', 'Failed to fetch report detail');
    }

    public function proses(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->put(env('API_URL') . 'api/admin/proses-laporan/' . $no_registrasi);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('laporan.detail-diproses', ['no_registrasi' => $no_registrasi])->with('success', 'Sekarang Laporan telah diproses.');
        }

        return redirect()->back()->with('error', 'Gagal menyetujui janji temu. Silakan coba lagi.');
    }

    public function diproses(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');
        $laporanDiproses = [];
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['Data']) && is_array($data['Data'])) {
                $laporanDiproses = array_filter($data['Data'], function ($item) {
                    return isset($item['status']) && $item['status'] == 'Diproses';
                });
            }
        }
        return view('admin.pages.laporan.diproses.laporan_diproses', [
            'title' => 'Laporan Masyarakat Diproses',
            'laporanDiproses' => $laporanDiproses,
        ]);
    }

    // public function detailDiProses(Request $request, string $no_registrasi)
    // {
    //     $headers = ApiHelper::getAuthorizationHeader($request);
    //     $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);
    //     if ($response->successful()) {
    //         $laporanDetailDiproses = $response->json()['Data'];
    //         return view('admin.pages.laporan.diproses.detail_laporan_diproses', [
    //             'title' => 'Detail Laporan Diproses',
    //             'laporanDetailDiproses' => $laporanDetailDiproses,
    //         ]);
    //     }
    //     return redirect()->back()->with('error', 'Failed to fetch report detail');
    // }
    public function detailDiProses(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);

        if ($response->successful()) {
            $laporanDetailDiproses = $response->json()['Data'];

            // Sort tracking_laporan by created_at in descending order
            usort($laporanDetailDiproses['tracking_laporan'], function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return view('admin.pages.laporan.diproses.detail_laporan_diproses', [
                'title' => 'Detail Laporan Diproses',
                'laporanDetailDiproses' => $laporanDetailDiproses,
            ]);
        }

        return redirect()->back()->with('error', 'Failed to fetch report detail');
    }





    public function dibatalkan(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');
        $laporanDibatalkan = [];
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['Data']) && is_array($data['Data'])) {
                $laporanDibatalkan = array_filter($data['Data'], function ($item) {
                    return isset($item['status']) && $item['status'] == 'Dibatalkan';
                });
            }
        }

        return view('admin.pages.laporan.dibatalkan.laporan_dibatalkan', [
            'title' => 'Laporan Masyarakat Yang Dibatalkan',
            'laporanDibatalkan' => $laporanDibatalkan,
        ]);
    }

    public function detailDibatalkan(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);
        if ($response->successful()) {
            $laporanDetailDibatalkan = $response->json()['Data'];
            return view('admin.pages.laporan.dibatalkan.detail_laporan_dibatalkan', [
                'title' => 'Detail Laporan',
                'laporanDetailDibatalkan' => $laporanDetailDibatalkan,
            ]);
        }
        return redirect()->back()->with('error', 'Failed to fetch report detail');
    }

    public function selesaikanLaporan(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->put(env('API_URL') . 'api/admin/laporan-selesai/' . $no_registrasi);

        if ($response->successful()) {
            Alert::success('Success', $response->json('message'));
            return redirect()->route('laporan.detail-selesai', ['no_registrasi' => $no_registrasi]);
        }
        Alert::error('Error', $response->json('message'));
        return redirect()->back()->with('error', 'Gagal menyetujui janji temu. Silakan coba lagi.');
    }

    public function selesai(Request $request)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/laporans');
        $laporanSelesai = [];
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['Data']) && is_array($data['Data'])) {
                $laporanSelesai = array_filter($data['Data'], function ($item) {
                    return isset($item['status']) && $item['status'] == 'Selesai';
                });
            }
        }

        return view('admin.pages.laporan.selesai.laporan_selesai', [
            'title' => 'Laporan Masyarakat Sudah Selesai',
            'laporanSelesai' => $laporanSelesai,
        ]);
    }

    //     public function detailSelesai(Request $request, string $no_registrasi)
    //     {
    //         $headers = ApiHelper::getAuthorizationHeader($request);
    //         $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);
    //         if ($response->successful()) {
    //             $laporanDetailSelesai = $response->json()['Data'];
    //             return view('admin.pages.laporan.selesai.detail_laporan_selesai', [
    //                 'title' => 'Detail Laporan Yang sudah Selesai',
    //                 'laporanDetailSelesai' => $laporanDetailSelesai,
    //             ]);
    //         }
    //         return redirect()->back()->with('error', 'Failed to fetch report detail');
    //     }
    // }

    public function detailSelesai(Request $request, string $no_registrasi)
    {
        $headers = ApiHelper::getAuthorizationHeader($request);
        $response = Http::withHeaders($headers)->get(env('API_URL') . 'api/admin/detail-laporan/' . $no_registrasi);

        if ($response->successful()) {
            $laporanDetailSelesai = $response->json()['Data'];

            // Sort tracking_laporan by created_at in descending order
            usort($laporanDetailSelesai['tracking_laporan'], function ($a, $b) {
                return strtotime($b['created_at']) - strtotime($a['created_at']);
            });

            return view('admin.pages.laporan.selesai.detail_laporan_selesai', [
                'title' => 'Detail Laporan Diproses',
                'laporanDetailSelesai' => $laporanDetailSelesai,
            ]);
        }

        return redirect()->back()->with('error', 'Failed to fetch report detail');
    }
    
    /**
     * Export daftar laporan ke Excel.
     */

public function exportPdf(Request $request)
{
    // Ambil selected dari query string
    $selected = $request->input('selected');

    if (!$selected) {
        return redirect()->back()->with('error', 'Tidak ada data yang dipilih.');
    }

    // Pecah string menjadi array
    $selectedIds = explode(',', $selected);

    // Ambil laporan sesuai yang dipilih
    $laporans = Laporan::with(['korban', 'pelaku'])->whereIn('no_registrasi', $selectedIds)->get();

    $pdf = Pdf::loadView('admin.laporan.export_pdf', compact('laporans'))->setPaper('A4', 'portrait');
    return $pdf->download('laporan-masyarakat.pdf');
}
/**
 * Update data korban.
 */
public function updateKorban(Request $request, $id)
{
    $validated = $request->validate([
        'no_registrasi'            => 'required|string',
        'nik_korban'               => 'required|numeric',
        'nama_korban'              => 'required|string',
        'usia_korban'              => 'required|integer',
        'jenis_kelamin'            => 'required|string',
        'agama'                    => 'required|string',
        'no_telepon'               => 'required|string',
        'pendidikan'               => 'required|string',
        'status_perkawinan'        => 'required|string',
        'kebangsaan'               => 'required|string',
        'hubungan_dengan_pelaku'   => 'required|string',
        'alamat_korban'            => 'required|string',
        'alamat_detail'            => 'nullable|string',
        'keterangan_lainnya'       => 'nullable|string',
        'dokumentasi_korban'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $headers = ApiHelper::getAuthorizationHeader($request);
    $data = $validated;

    $data['_method'] = 'PUT'; // 👈 INI KUNCI UTAMA

    $multipart = [];
    foreach ($data as $key => $val) {
        if ($key === 'dokumentasi_korban' && $request->hasFile('dokumentasi_korban')) {
            $multipart[] = [
                'name'     => $key,
                'contents' => fopen($request->file('dokumentasi_korban')->getRealPath(), 'r'),
                'filename' => $request->file('dokumentasi_korban')->getClientOriginalName(),
            ];
        } else {
            $multipart[] = ['name' => $key, 'contents' => $val];
        }
    }

    // Gunakan POST tapi override jadi PUT
    $response = Http::withHeaders($headers)
        ->asMultipart()
        ->put(env('API_URL') . "api/admin/edit-korban-kekerasan/{$id}", $multipart);

    if ($response->successful()) {
        Alert::success('Sukses', 'Data korban berhasil diubah.');
    } else {
        Alert::error('Gagal', 'Gagal mengubah data korban: ' . $response->body());
    }

    return redirect()->route('laporan.detail-diproses', [
        'no_registrasi' => $validated['no_registrasi']
    ]);
}

    /**
     * Hapus data korban.
     */
    public function destroyKorban(Request $request, $id)
    {
        $no      = $request->input('no_registrasi');
        $headers = ApiHelper::getAuthorizationHeader($request);

        $response = Http::withHeaders($headers)
                        ->delete(env('API_URL') . "api/admin/korban/{$id}");

        if ($response->successful()) {
            Alert::success('Sukses', 'Data korban berhasil dihapus.');
        } else {
            Alert::error('Gagal', 'Gagal menghapus data korban.');
        }

        return redirect()->route('laporan.detail-diproses', ['no_registrasi' => $no]);
    }
public function create(Request $request)
{
    $headers   = ApiHelper::getAuthorizationHeader($request);
    $usersResp = Http::withHeaders($headers)->get(env('API_URL').'api/admin/users');
    $catsResp  = Http::withHeaders($headers)->get(env('API_URL').'api/admin/violence-categories');

    $usersRaw      = $usersResp->successful() ? $usersResp->json('Data', []) : [];
    $categoriesRaw = $catsResp->successful() ? $catsResp->json('Data', []) : [];

    // normalisasi users (untuk berjaga jika key beda)
    $users = array_map(function($u){
        return [
            'id'    => $u['id'] ?? $u['UserID'] ?? null,
            'name'  => $u['nama'] ?? $u['name'] ?? ($u['Nama'] ?? '—'),
            'email' => $u['email'] ?? ($u['Email'] ?? '-'),
        ];
    }, $usersRaw);

    // normalisasi categories supaya selalu ada ['id','name']
    $categories = array_map(function($c){
        return [
            'id'   => $c['id'] ?? $c['KategoriKekerasanID'] ?? $c['kategori_kekerasan_id'] ?? null,
            'name' => $c['name'] ?? $c['nama'] ?? ($c['Nama'] ?? '—'),
        ];
    }, $categoriesRaw);

    return view('admin.pages.laporan.create', compact('users', 'categories'))
           ->with('title', 'Tambah Laporan');
}


    /**
     * Simpan laporan baru ke API dan database.
     */
public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'kategori_kekerasan_id' => 'required',
        'tanggal_kejadian'      => 'required|date',
        'kategori_lokasi_kasus' => 'required|string|max:255',
        'alamat_tkp'            => 'required|string|max:255',
        'alamat_detail_tkp'     => 'nullable|string|max:500',
        'kronologis_kasus'      => 'required|string',
        'dokumentasi.*'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Generate no_registrasi
    $month    = Carbon::now()->month;
    $year     = Carbon::now()->year;
    $romanMap = [1=>'I',2=>'II',3=>'III',4=>'IV',5=>'V',6=>'VI',7=>'VII',8=>'VIII',9=>'IX',10=>'X',11=>'XI',12=>'XII'];
    $roman    = $romanMap[$month];
    $baseNo   = "001-DPMDPPA-{$roman}-{$year}";

    // Ambil semua existing untuk cek unik
    $headers = ApiHelper::getAuthorizationHeader($request);
    $list    = Http::withHeaders($headers)
                   ->get(env('API_URL').'api/admin/laporans')
                   ->json('Data', []);
    $exists  = array_column($list, 'no_registrasi');

    if (in_array($baseNo, $exists)) {
        for ($i=2; $i<1000; $i++) {
            $pad = str_pad($i,3,'0',STR_PAD_LEFT);
            $cand = "{$pad}-DPMDPPA-{$roman}-{$year}";
            if (! in_array($cand, $exists)) {
                $baseNo = $cand;
                break;
            }
        }
    }

    // Siapkan multipart tanpa _method
    $multipart = [
        ['name'=>'no_registrasi',        'contents'=>$baseNo],
        ['name'=>'user_id',              'contents'=>auth()->id()],
        ['name'=>'kategori_kekerasan_id','contents'=>$validated['kategori_kekerasan_id']],
        ['name'=>'tanggal_kejadian',     'contents'=>$validated['tanggal_kejadian']],
        ['name'=>'kategori_lokasi_kasus','contents'=>$validated['kategori_lokasi_kasus']],
        ['name'=>'alamat_tkp',           'contents'=>$validated['alamat_tkp']],
        ['name'=>'alamat_detail_tkp',    'contents'=>$validated['alamat_detail_tkp'] ?? ''],
        ['name'=>'kronologis_kasus',     'contents'=>$validated['kronologis_kasus']],
    ];

    if ($request->hasFile('dokumentasi')) {
        foreach ($request->file('dokumentasi') as $file) {
            $multipart[] = [
                'name'     => 'dokumentasi[]',
                'contents' => fopen($file->getRealPath(), 'r'),
                'filename' => $file->getClientOriginalName(),
            ];
        }
    }

    // Kirim POST multipart
    $response = Http::withHeaders(ApiHelper::getAuthorizationHeader($request))
                    ->asMultipart()
                    ->post(
                        rtrim(env('API_URL'), '/')
                        .'/api/admin/create-laporan',
                        $multipart
                    );

    if ($response->successful()) {
        Alert::success('Sukses', 'Laporan berhasil ditambahkan.');
        return redirect()->route('admin.laporan.daftar');
    }

    Alert::error('Gagal', 'Tidak dapat menyimpan laporan: '.$response->body());
    return back()->withInput();
}

}
