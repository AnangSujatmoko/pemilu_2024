<?php

namespace App\Http\Controllers\Pages;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;


class DomisiliController extends Controller
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

        return view('app.domisilis.index', $data);
    }
}
