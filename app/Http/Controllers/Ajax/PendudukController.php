<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use App\Enums\JenisKelaminEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PendudukController extends Controller
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
                            });
                    }
                })
                ->make(true);
        }
    }
}

// class PendudukController extends Controller
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
//             // return $dataTable->toJson();
//         }
//     }
// }
