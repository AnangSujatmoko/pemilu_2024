<?php

namespace App\Http\Controllers\Ajax;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Models\OperatorWilayah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Handle ajax request for get data user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        if ($request->ajax()) {
            $model = new User();
            $data = $model->orderBy('name', 'asc')->with('roles', 'operatorPivots');
            $dataTable = DataTables::of($data)->addIndexColumn()
                ->addColumn('nama', function ($data) {
                    return $data->name;
                })
                ->addColumn('username', function ($data) {
                    return $data->username;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('action', function ($data) {

                    $isDisable = '';

                    if (Auth::user()->id == $data->id) {
                        $isDisable = 'disabled';
                    }

                    // ========== Action ==========
                    $editBtn = "<button class='btn btn-sm btn-info edit' $isDisable data-single_source='{$data}'><i class='fas fa-pencil-alt'></i></button>";
                    $editPassword = "<button class='btn btn-sm btn-warning edit-password' $isDisable data-single_source='{$data}'><i class='fas fa-lock'></i></button>";
                    $deleteBtn = "<button class='btn btn-sm btn-danger delete' $isDisable data-single_source='{$data}'><i class='fas fa-trash'></i></button>";

                    $actionBtn = $editBtn . $editPassword . $deleteBtn;
                    // ========== End Action ==========
                    return $actionBtn;
                })
                ->rawColumns(['action'])
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
    public function store(UserRequest $request)
    {
        // dd($request);
        $data = new User();
        $data_requests = [
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $role = Role::find($request->role);

        $new_user = $data->create($data_requests);

        if ($new_user) {
            $new_user->assignRole([$role->id]);
        }

        // insert pivot operator wilayah
        $insertWilayah = OperatorWilayah::create(['id_user' => $new_user->id, 'kode_kec' => $request->wilayah]);
        // dd($insertWilayah);

        $response = (object)[
            "success" => true,
            "message" => "Data berhasil ditambahkan",
            "data" => $data_requests,
        ];

        return $this->conditionalResponse($response);
    }

    public function update(UserRequest $request)
    {
        // dd($request);
        $data = User::find($request->id);
        $data_requests = [
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $role = Role::find($request->role);

        $data->update($data_requests);

        // update role
        $data->syncRoles([]); // remove all roles
        $data->assignRole([$role->id]);

        // update pivot operator wilayah
        if (isset($data->operatorPivots)) {
            $updateWilayah = $data->operatorPivots()->update(['kode_kec' => $request->wilayah]);
        } else {
            $insertWilayah = OperatorWilayah::create(['id_user' => $data->id, 'kode_kec' => $request->wilayah]);
        }

        $response = (object)[
            "success" => true,
            "message" => "Data berhasil diupdate",
            "data" => $data_requests,
        ];

        return $this->conditionalResponse($response);
    }

    public function update_password(UpdateUserPasswordRequest $request)
    {
        $data = User::find($request->id);
        $data->update(['password' => Hash::make($request->password)]);
        $response = (object)[
            "success" => true,
            "message" => "Password user berhasil diupdate",
            "data" => null
        ];
        return $this->conditionalResponse($response);
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        $response = (object)[
            "success" => true,
            "message" => "Data user berhasil dihapus",
            "data" => null
        ];
        return $this->conditionalResponse($response);
    }
}
