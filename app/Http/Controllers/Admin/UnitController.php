<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Unit;

class UnitController extends Controller
{
    public function select()
    {
        $data = Unit::where('n_unor', 'LIKE', '%' . request('q') . '%')->paginate(10);
        return response()->json($data);
    }
}
