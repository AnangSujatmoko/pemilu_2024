<?php

namespace App\Http\Controllers\Pages;

use PDF;

use App\Models\Paslon;
use App\Models\Relawan;
use App\Models\Wilayah;
use App\Models\Domisili;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Imports\SurveyImport;
use App\Enums\JenisKelaminEnum;
use App\Exports\PendudukExport;
use App\Imports\PendudukImport;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SurveyPendudukExport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Blade;
use App\Helpers\DataTablesColumnsBuilder;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StorePendudukRequest;
use App\Http\Requests\Admin\UpdatePendudukRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SurveyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $hs = [
            'HeadSource.FONTAWESOME',
            'HeadSource.STYLE',
            'HeadSource.DATATABLESBOOTSTRAP',
            'HeadSource.RESPONSIVEBOOTSTRAP',
            'HeadSource.BUTTONSBOOTSTRAP',
            'HeadSource.IONICONS',
            'HeadSource.IZITOASTER',
            'HeadSource.SELECT2',
            'HeadSource.SELECT2BOOTSTRAP',
        ];

        $js = [
            'JsSource.BOOTSTRAP',
            'JsSource.GOOGLECHARTS',
            'JsSource.DATATABLES',
            'JsSource.DATATABLESBOOTSTRAP',
            'JsSource.DATATABLESRESPONSIVE',
            'JsSource.RESPONSIVEBOOTSTRAP',
            'JsSource.DATATABLESBUTTONS',
            'JsSource.BUTTONSBOOTSTRAP',
            'JsSource.BLOCKUI',
            'JsSource.IZITOASTER',
            'JsSource.SELECT2',
        ];

        $role = Role::all();
        $data = [
            "HeadSource" => $this->styles($hs),
            "JsSource" => $this->scripts($js),
            "role" => $role,
        ];

        return view('app.surveys.index', $data);
    }

    public function create()
    {
        $hs = [
            'HeadSource.FONTAWESOME',
            'HeadSource.STYLE',
            'HeadSource.DATATABLESBOOTSTRAP',
            'HeadSource.RESPONSIVEBOOTSTRAP',
            'HeadSource.BUTTONSBOOTSTRAP',
            'HeadSource.IONICONS',
            'HeadSource.IZITOASTER',
            'HeadSource.SELECT2',
            'HeadSource.SELECT2BOOTSTRAP',
        ];

        $js = [
            'JsSource.BOOTSTRAP',
            'JsSource.GOOGLECHARTS',
            'JsSource.DATATABLES',
            'JsSource.DATATABLESBOOTSTRAP',
            'JsSource.DATATABLESRESPONSIVE',
            'JsSource.RESPONSIVEBOOTSTRAP',
            'JsSource.DATATABLESBUTTONS',
            'JsSource.BUTTONSBOOTSTRAP',
            'JsSource.BLOCKUI',
            'JsSource.IZITOASTER',
            'JsSource.SELECT2',
        ];

        $HeadSource = $this->styles($hs);
        $JsSource = $this->scripts($js);

        $penduduk = new Penduduk();
        $roles = Role::all();
        $userRoles = [];
        $jenis_kelamin = JenisKelaminEnum::cases();
        $wilayah_kecamatan = Wilayah::select('kode_full_kec', 'nama_kecamatan')
            ->groupBy('kode_full_kec', 'nama_kecamatan')
            ->get();
        $wilayah_kelurahan = Wilayah::all();
        $paslon = Paslon::all();
        $domisili = Domisili::all();

        return view('app.surveys.create', compact('HeadSource', 'JsSource', 'paslon', 'domisili', 'penduduk', 'wilayah_kecamatan', 'wilayah_kelurahan', 'roles', 'userRoles', 'jenis_kelamin'));
    }

    // public function search(Request $request)
    // {
    //     // Ambil input pencarian dari request
    //     $search = $request->get('penduduk');

    //     // Jika pencarian tidak diisi, kembalikan array kosong
    //     if (!$search) {
    //         return response()->json([]);
    //     }

    //     $data = new Penduduk();

    //     // Cari penduduk berdasarkan NIK atau nama jika pencarian diisi
    //     $data = $data->where('nik', 'LIKE', "%{$search}%")
    //         ->orWhere('nama', 'LIKE', "%{$search}%");

    //     // check if user login is Operator
    //     if (Auth::user()->roles[0]->name == 'Operator') {
    //         // get user kode_kec
    //         $userKodeKec = Auth::user()->operatorPivots->kode_kec;
    //         // filter penduduk by kode_kec
    //         $data = $data->where('kode_kec', $userKodeKec);
    //     }

    //     $penduduk = $data->limit(10)->get();

    //     // Return response dalam format JSON
    //     return response()->json($penduduk);
    // }

    public function search(Request $request)
    {
        // Ambil input pencarian dari request
        $search = $request->get('penduduk');

        // Jika pencarian tidak diisi, kembalikan array kosong
        if (!$search) {
            return response()->json([]);
        }

        // Membuat instance baru dari Penduduk
        $data = Penduduk::query();

        // Memeriksa apakah pengguna yang login adalah Operator
        if (Auth::user()->roles[0]->name == 'Operator') {
            // Dapatkan kode_kec pengguna
            $userKodeKec = Auth::user()->operatorPivots->kode_kec;
            // Filter penduduk berdasarkan kode_kec
            $data->where('kode_kec', $userKodeKec);
        }

        // Jika pencarian diisi, cari penduduk berdasarkan NIK atau nama
        $data->where('nik', 'LIKE', "%{$search}%")
            ->orWhere('nama', 'LIKE', "%{$search}%");

        // Ambil data penduduk dengan limit 10
        $penduduk = $data->limit(10)->get();

        // Kembalikan response dalam format JSON
        return response()->json($penduduk);
    }

    public function getbynik(Request $request)
    {
        // Ambil input pencarian dari request
        $search = $request->get('nik');

        // Jika pencarian tidak diisi, kembalikan array kosong
        if (!$search) {
            return response()->json([]);
        }

        // Cari penduduk berdasarkan NIK atau nama jika pencarian diisi
        $penduduk = Penduduk::where('nik', $search)
            ->limit(10)  // Batasi hasil pencarian untuk performa yang lebih baik
            ->get();

        // Return response dalam format JSON
        return response()->json($penduduk);
    }

    public function update(Request $request)
    {
        $penduduk = Penduduk::where('nik', $request->nik)->first();
        // dd($request);
        // Buat array data untuk diupdate
        $penduduk_requests = [
            // 'nik' => $request->nik,
            // 'name' => $request->name,
            // 'jenis_kelamin' => $request->jenis_kelamin, // Pastikan ini ada di request
            // 'usia' => $request->usia,
            // 'alamat' => $request->alamat,
            // 'rt' => $request->rt,
            // 'rw' => $request->rw,
            // 'tps' => $request->tps,
            // 'kode_kec' => $request->kode_kec, // Pastikan ini ada di request
            // 'kode_kel' => $request->kode_kel, // Pastikan ini ada di request
            'id_paslon' => $request->id_paslon,
            'id_domisili' => $request->id_domisili,
            'keterangan' => $request->keterangan,
        ];

        // Update data penduduk
        $penduduk->update($penduduk_requests);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('surveys.index')->with('success', 'Data Survey berhasil disimpan.');
    }

    // public function searchRelawan(Request $request)
    // {
    //     $search = $request->search;

    //     // $query = Relawan::query();

    //     // Memuat relasi relawanWilayah
    //     $query = Relawan::with('relawanWilayah'); // Pastikan relasi sudah didefinisikan di model


    //     if (!empty($search)) {
    //         $query->where('nama', 'like', '%' . $search . '%')
    //             ->orWhere('kode_kel', 'like', '%' . $search . '%')
    //             ->orWhere('rt', 'like', '%' . $search . '%')
    //             ->orWhere('rw', 'like', '%' . $search . '%');
    //     }

    //     $relawan = $query->limit(10)->get();

    //     return response()->json($relawan);
    // }

    public function searchRelawan(Request $request)
    {
        $search = $request->search;

        // Query dasar dengan relasi
        $query = Relawan::with('relawanWilayah'); // Memastikan relasi ter-load

        // if (!empty($search)) {
        //     // Pencarian di kolom-kolom yang relevan
        //     $query->where(function ($q) use ($search) {
        //         $q->where('nama', 'like', '%' . $search . '%')
        //             ->orWhere('kode_kel', 'like', '%' . $search . '%')
        //             ->orWhere('rt', 'like', '%' . $search . '%')
        //             ->orWhere('rw', 'like', '%' . $search . '%');
        //     });
        // }

        if (!empty($search)) {
            // Pencarian di kolom-kolom yang relevan, termasuk relasi
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('rt', 'like', '%' . $search . '%')
                    ->orWhere('rw', 'like', '%' . $search . '%')
                    ->orWhereHas('relawanWilayah', function ($q) use ($search) {
                        $q->where('nama_kelurahan', 'like', '%' . $search . '%');
                    });
            });
        }

        // Ambil maksimum 10 hasil untuk keperluan AJAX select2
        $relawan = $query->limit(10)->get();

        // Pastikan data relawanWilayah ter-load
        return response()->json($relawan->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'relawan_wilayah' => [
                    'nama_kelurahan' => $item->relawanWilayah->nama_kelurahan ?? '',
                ],
                'rt' => $item->rt,
                'rw' => $item->rw,
            ];
        }));
    }

    // public function getSurveyData(Request $request)
    // {
    //     $query = Penduduk::query();

    //     // Filter berdasarkan kode_kel, rt, rw dari request
    //     if (!empty($request->kode_kel)) {
    //         $query->where('kode_kel', $request->kode_kel);
    //     }
    //     if (!empty($request->rt)) {
    //         $query->where('rt', $request->rt);
    //     }
    //     if (!empty($request->rw)) {
    //         $query->where('rw', $request->rw);
    //     }

    //     // Lanjutkan dengan pengolahan DataTables
    //     return datatables()->of($query)
    //         ->addIndexColumn()
    //         ->make(true);
    // }

    public function exportExcel(): BinaryFileResponse
    {
        // Mengembalikan respons dengan file Excel
        return Excel::download(new SurveyPendudukExport, 'survey.xlsx');
    }

    public function importExcel(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SurveyImport, $request->file('file'));

        return redirect()->route('surveys.index')->with('success', 'Data Survey berhasil diimport!');
    }
}
