<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Domisili;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class DomisiliController extends Controller
{
    public function data(Request $request)
    {
        if ($request->ajax()) {

            // Urutkan berdasarkan id terlebih dahulu, kemudian uraian
            $data = Domisili::query()->orderBy('id', 'asc')->orderBy('uraian', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('uraian', function ($data) {
                    return $data->uraian;
                })

                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $request->search['value']) {
                        $search = $request->search['value'];
                        $query->where('id', 'like', "%{$search}%")
                            ->orWhere('uraian', 'like', "%{$search}%");
                    }
                })
                ->make(true);
        }
    }
}
