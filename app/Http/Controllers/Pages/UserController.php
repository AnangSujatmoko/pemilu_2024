<?php

namespace App\Http\Controllers\Pages;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
        $wilayahKecamatan = Wilayah::select('nama_kecamatan', 'kode_full_kec')
            ->groupBy('nama_kecamatan', 'kode_full_kec')
            ->get();
        // dd($wilayah);
        $data = [
            "HeadSource" => $this->styles($hs),
            "JsSource" => $this->scripts($js),
            "role" => $role,
            "wilayahKecamatan" => $wilayahKecamatan,
        ];

        return view('app.user.index', $data);
    }
}
