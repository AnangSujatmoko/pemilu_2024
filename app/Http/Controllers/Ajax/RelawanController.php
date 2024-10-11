<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Relawan;
use Illuminate\Http\Request;
// use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RelawanRequest; // pastikan request class sesuai
use App\Models\Lingkungan;

class RelawanController extends Controller
{
    /**
     * Handle ajax request for get data relawan
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = new Relawan();
            $data = $model->orderBy('nama', 'asc');
            $dataTable = DataTables::of($data)->addIndexColumn()
                ->addColumn('nama', function ($data) {
                    return $data->nama;
                })
                ->addColumn('no_hp', function ($data) {
                    return $data->no_hp;
                })
                ->addColumn('kode_kel', function ($data) {
                    // return $data->kode_kel;
                    return $data->relawanWilayah->nama_kelurahan;
                })
                ->addColumn('kode_lingkungan', function ($data) {
                    // return $data->kode_lingkungan;
                    return $data->relawanLingkungan->uraian;
                })
                ->addColumn('rt', function ($data) {
                    return $data->rt;
                })
                ->addColumn('rw', function ($data) {
                    return $data->rw;
                })
                ->addColumn('action', function ($data) {
                    $isDisable = '';

                    $editBtn = "<button class='btn btn-sm btn-info edit' $isDisable data-single_source='{$data}'><i class='fas fa-pencil-alt'></i></button>";
                    $deleteBtn = "<button class='btn btn-sm btn-danger delete' $isDisable data-single_source='{$data}'><i class='fas fa-trash'></i></button>";

                    $actionBtn = $editBtn . $deleteBtn;
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value']) {
                        $search = $request->search['value'];
                        $query->where('nama', 'like', "%{$search}%")
                            ->orWhere('no_hp', 'like', "%{$search}%");
                    }
                })
                ->setRowId('id');

            return $dataTable->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RelawanRequest $request)
    {
        $data = new Relawan();
        $data_requests = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'kode_kel' => $request->kode_kel,
            'kode_lingkungan' => $request->kode_lingkungan,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ];
        $new_relawan = $data->create($data_requests);

        $response = (object)[
            "success" => true,
            "message" => "Data relawan berhasil ditambahkan",
            "data" => $data_requests,
        ];

        return $this->conditionalResponse($response);
    }

    public function update(RelawanRequest $request)
    {
        $data = Relawan::find($request->id);
        $data_requests = [
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'kode_kel' => $request->kode_kel,
            'kode_lingkungan' => $request->kode_lingkungan,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ];

        $data->update($data_requests);

        $response = (object)[
            "success" => true,
            "message" => "Data relawan berhasil diupdate",
            "data" => $data_requests,
        ];

        return $this->conditionalResponse($response);
    }

    public function destroy($id)
    {
        $data = Relawan::find($id);

        if ($data) {
            $data->delete();

            $response = (object)[
                "success" => true,
                "message" => "Data relawan berhasil dihapus",
            ];
        } else {
            $response = (object)[
                "success" => false,
                "message" => "Data relawan tidak ditemukan",
            ];
        }

        return response()->json($response);
    }

    public function getLingkunganByKel($kode_kel)
    {
        $data = new Lingkungan();
        if (isset($kode_kel)) {
            $data = $data->where('kode_kel', $kode_kel);
        }
        $data = $data->get();
        return response()->json($data);
    }
}
