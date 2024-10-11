<?php

namespace App\Http\Controllers\Pages;

use PDF;

use App\Models\Wilayah;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Enums\JenisKelaminEnum;
use App\Exports\PendudukExport;
use App\Imports\PendudukImport;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Blade;
use App\Helpers\DataTablesColumnsBuilder;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\StorePendudukRequest;
use App\Http\Requests\Admin\UpdatePendudukRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PendudukController extends Controller
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

        return view('app.penduduks.index', $data);
    }

    public function create()
    {
        $penduduk = new Penduduk();
        $roles = Role::all();
        $userRoles = [];
        $jenis_kelamin = JenisKelaminEnum::cases();
        $wilayah_kecamatan = Wilayah::select('kode_full_kec', 'nama_kecamatan')
            ->groupBy('kode_full_kec', 'nama_kecamatan')
            ->get();
        $wilayah_kelurahan = Wilayah::all();

        return view('app.penduduks.create', compact('penduduk', 'wilayah_kecamatan', 'wilayah_kelurahan', 'roles', 'userRoles', 'jenis_kelamin'));
    }

    public function store(Request $request)
    {
        // Definisikan aturan validasi
        $rules = [
            'nik' => 'required|numeric|digits:16|unique:penduduks,nik',
            'nama' => 'required|string|max:255',
            'usia' => 'required|numeric|min:0|max:150',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|numeric|min:1|max:999',
            'rw' => 'required|numeric|min:1|max:999',
            'tps' => 'required|string|max:10',
        ];

        // Buat instance Validator
        $validator = Validator::make($request->all(), $rules);

        // Cek apakah ada kesalahan validasi
        if ($validator->fails()) {
            // Redirect kembali dengan input dan pesan kesalahan
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Buat instance Penduduk dan simpan datanya
        $penduduk = new Penduduk();
        $penduduk->nik = $request['nik'];
        $penduduk->nama = $request['nama'];
        $penduduk->jenis_kelamin = $request['jenis_kelamin'];
        $penduduk->usia = $request['usia'];
        $penduduk->alamat = $request['alamat'];
        $penduduk->rt = $request['rt'];
        $penduduk->rw = $request['rw'];
        $penduduk->tps = $request['tps'];
        $penduduk->kode_kec = $request['kode_kec'];
        $penduduk->kode_kel = $request['kode_kel'];

        // Simpan data ke database
        $penduduk->save();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penduduks.index')->with('success', 'Data DPT berhasil disimpan.');
    }

    public function exportExcel(): BinaryFileResponse
    {
        // Mengembalikan respons dengan file Excel
        return Excel::download(new PendudukExport, 'dpt.xlsx');
    }

    public function importExcel(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new PendudukImport, $request->file('file'));

        return redirect()->route('penduduks.index')->with('success', 'Data DPT imported successfully!');
    }
}
