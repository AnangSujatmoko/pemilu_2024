<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Relawan;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Enums\JenisKelaminEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SurveyController extends Controller
{
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = new Penduduk();

            // check if user login is Operator
            if (Auth::user()->roles[0]->name == 'Operator') {
                // get user kode_kec
                $userKodeKec = Auth::user()->operatorPivots->kode_kec;
                // filter penduduk by kode_kec
                $data = $data->where('kode_kec', $userKodeKec);
            }

            // Tambahkan filter berdasarkan relawan jika ada
            // if ($request->has('relawan_id') && !empty($request->relawan_id)) {
            //     $data = $data->where('rt', $request->relawan_id); // Sesuaikan dengan kolom yang sesuai
            // }

            // Tambahkan filter berdasarkan 'relawan_id' yang diterima dari request
            if ($request->has('relawan_id') && !empty($request->relawan_id)) {
                $relawan = Relawan::find($request->relawan_id);

                if ($relawan) {
                    $namaKelurahan = $relawan->relawanWilayah->nama_kelurahan ?? '';
                    $rt = $relawan->rt;
                    $rw = $relawan->rw;

                    // Filter berdasarkan nama_kelurahan, rt, dan rw dari relawanWilayah
                    $data = $data->whereHas('pendudukWilayah', function ($query) use ($namaKelurahan) {
                        $query->where('nama_kelurahan', 'like', "%{$namaKelurahan}%");
                    })->where('rt', $rt)->where('rw', $rw);
                }
            }

            // Urutkan berdasarkan id terlebih dahulu, kemudian nama
            $data = $data->orderBy('id', 'asc')->orderBy('nama', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->addColumn('nik', function ($data) {
                    return $data->nik;
                })
                ->addColumn('jenis_kelamin', function ($data) {
                    // Ubah dari angka ke label menggunakan enum
                    return JenisKelaminEnum::tryFrom($data->jenis_kelamin)?->label() ?? 'Tidak Diketahui';
                })
                ->addColumn('usia', function ($data) {
                    return $data->usia;
                })
                ->addColumn('alamat', function ($data) {
                    return $data->alamat;
                })
                ->addColumn('rt', function ($data) {
                    return $data->rt;
                })
                ->addColumn('rw', function ($data) {
                    return $data->rw;
                })
                ->addColumn('tps', function ($data) {
                    return $data->tps;
                })
                ->addColumn('kode_kec', function ($data) {
                    return $data->pendudukWilayah->nama_kecamatan;
                })
                ->addColumn('kode_kel', function ($data) {
                    return $data->pendudukWilayah->nama_kelurahan;
                })
                ->addColumn('id_paslon', function ($data) {
                    // dd($data->pendudukPaslon->uraian);
                    return $data->pendudukPaslon->uraian ?? '';
                })
                ->addColumn('id_domisili', function ($data) {
                    // dd($data->pendudukDomisili->uraian);
                    return $data->pendudukDomisili->uraian ?? '';
                })
                ->addColumn('keterangan', function ($data) {
                    return $data->keterangan;
                })
                ->addColumn('action', function ($data) {
                    // ========== Action ==========
                    $editBtn = "<button class='btn btn-sm btn-info edit' data-id='{$data->id}'><i class='fas fa-pencil-alt'></i></button>";
                    $deleteBtn = "<button class='btn btn-sm btn-danger delete' data-id='{$data->id}'><i class='fas fa-trash'></i></button>";
                    $actionBtn = $editBtn . ' ' . $deleteBtn;
                    return $actionBtn;
                })
                ->rawColumns(['action']) // Jangan lupa mendefinisikan rawColumns untuk action jika ingin menggunakannya
                // ->filter(function ($query) use ($request) {
                //     if ($request->has('search') && $request->search['value']) {
                //         $search = $request->search['value'];
                //         $query->where('nama', 'like', "%{$search}%")
                //             ->orWhere('nik', 'like', "%{$search}%");
                //     }
                // })
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value']) {
                        $search = $request->search['value'];
                        $query->where('nama', 'like', "%{$search}%")
                            ->orWhere('nik', 'like', "%{$search}%")
                            ->orWhere('alamat', 'like', "%{$search}%") // Menambahkan filter untuk alamat
                            ->orWhereHas('pendudukWilayah', function ($q) use ($search) {
                                $q->where('nama_kecamatan', 'like', "%{$search}%")
                                    ->orWhere('nama_kelurahan', 'like', "%{$search}%"); // Menambahkan filter untuk nama_kecamatan dan nama_kelurahan
                            })
                            ->orWhereHas('pendudukPaslon', function ($q) use ($search) {
                                $q->where('uraian', 'like', "%{$search}%"); // Menambahkan filter untuk id_paslon
                            })
                            ->orWhereHas('pendudukDomisili', function ($q) use ($search) {
                                $q->where('uraian', 'like', "%{$search}%"); // Menambahkan filter untuk id_domisili
                            });
                    }
                })
                ->make(true);
        }
    }
}

// class SurveyController extends Controller
// {
//     public function data(Request $request)
//     {
//         if ($request->ajax()) {
//             $model = new Penduduk();
//             $data = $model->orderBy('nama', 'asc');
//             $dataTable = DataTables::of($data)->addIndexColumn()
//                 ->addColumn('nama', function ($data) {
//                     return $data->nama;
//                 })
//                 ->addColumn('nik', function ($data) {
//                     return $data->nik;
//                 })
//                 // ->addColumn('jenis_kelamin', function ($data) {
//                 //     return $data->jenis_kelamin;
//                 // })
//                 ->addColumn('jenis_kelamin', function ($data) {
//                     // Ubah dari angka ke label menggunakan enum
//                     return JenisKelaminEnum::tryFrom($data->jenis_kelamin)?->label() ?? 'Tidak Diketahui';
//                 })
//                 ->addColumn('usia', function ($data) {
//                     return $data->usia;
//                 })
//                 ->addColumn('alamat', function ($data) {
//                     return $data->alamat;
//                 })
//                 ->addColumn('rt', function ($data) {
//                     return $data->rt;
//                 })
//                 ->addColumn('rw', function ($data) {
//                     return $data->rw;
//                 })
//                 ->addColumn('tps', function ($data) {
//                     return $data->tps;
//                 })
//                 // ->addColumn('kode_kec', function ($data) {
//                 //     return $data->kode_kec;
//                 // })
//                 // ->addColumn('kode_kel', function ($data) {
//                 //     return $data->kode_kel;
//                 // })
//                 ->addColumn('kode_kec', function ($data) {
//                     return $data->pendudukWilayah->nama_kecamatan;
//                 })
//                 ->addColumn('kode_kel', function ($data) {
//                     return $data->pendudukWilayah->nama_kelurahan;
//                 })
//                 // ->addColumn('id_paslon', function ($data) {
//                 //     return $data->id_paslon;
//                 // })
//                 // ->addColumn('id_domisili', function ($data) {
//                 //     return $data->id_domisili;
//                 // })
//                 ->addColumn('id_paslon', function ($data) {
//                     // dd($data->pendudukPaslon->uraian);
//                     return $data->pendudukPaslon->uraian ?? '';
//                 })
//                 ->addColumn('id_domisili', function ($data) {
//                     // dd($data->pendudukDomisili->uraian);
//                     return $data->pendudukDomisili->uraian ?? '';
//                 })
//                 ->addColumn('keterangan', function ($data) {
//                     return $data->keterangan;
//                 })
//                 // ->addColumn('action', function ($data) {

//                 //     // ========== Action ==========
//                 //     $editBtn = "<button class='btn btn-sm btn-info edit' data-single_source='{$data}'><i class='fas fa-pencil-alt'></i></button>";
//                 //     $deleteBtn = "<button class='btn btn-sm btn-danger delete' data-single_source='{$data}'><i class='fas fa-trash'></i></button>";

//                 //     $actionBtn = $editBtn . $deleteBtn;
//                 //     // ========== End Action ==========
//                 //     return $actionBtn;
//                 // })
//                 ->rawColumns(['action'])
//                 ->setRowId('id');

//             return $dataTable->make(true);
//         }
//     }
// }
