<?php

namespace App\Http\Controllers;

use App\Traits\AjaxResponserTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, AjaxResponserTrait;

    /**
     * Mengembalikan konstanta yang terdefinisi dalam file config/constants.php
     *
     * @param string $source nama konstanta yang ingin diambil
     * @return array konstanta yang diambil
     */
    public function constants($source)
    {
        return config('constants.' . $source);
    }

    /**
     * Mengembalikan path URL dari stylesheet yang terdefinisi dalam konstanta.
     * Path URL stylesheet diambil dari file config/constants.php
     *
     * @param array $array nama konstanta yang ingin diambil
     * @return array path URL stylesheet yang diambil
     */
    public function styles(array $array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $result[] = asset($this->constants($value));
        }
        // dd($result);

        return $result;
    }

    /**
     * Mengembalikan path URL dari script yang terdefinisi dalam konstanta.
     * Path URL script diambil dari file config/constants.php
     *
     * @param array $array nama konstanta yang ingin diambil
     * @return array path URL script yang diambil
     */
    public function scripts(array $array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            $result[] = asset($this->constants($value));
        }

        return $result;
    }
}
