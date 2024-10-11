<?php

namespace App\Http\Controllers\Pages;

use App\Models\Wilayah;
use App\Models\Lingkungan;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;


class RelawanController extends Controller
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

        // $role = Role::all();
        $wilayah_kelurahan = Wilayah::all();
        $relawan_lingkungan = Lingkungan::all();
        $data = [
            "HeadSource" => $this->styles($hs),
            "JsSource" => $this->scripts($js),
            // "role" => $role,
            "wilayah_kelurahan" => $wilayah_kelurahan,
            "relawan_lingkungan" => $relawan_lingkungan
        ];

        return view('app.relawans.index', $data);
    }
}
