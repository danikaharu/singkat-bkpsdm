<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function select(Request $request)
    {
        $data = Employee::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);
        return response()->json($data);
    }
}
