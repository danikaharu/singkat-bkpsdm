<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user')->only('index', 'show');
        $this->middleware('permission:edit user')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $employees = Employee::with('unit');

            return datatables()->of($employees)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->nama ? $row->nama : '-';
                })
                ->addColumn('unit_name', function ($row) {
                    return $row->unit ? $row->unit->n_unor : '-';
                })
                ->addColumn('action', 'admin.employees.include.action')
                ->toJson();
        }

        return view('admin.employees.index');
    }

    public function show(Employee $employee)
    {
        $employee->load('unit:k_unor,n_unor');
        return view('admin.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $units = Unit::all();
        $employee->load('unit:id,n_unor');
        return view('admin.employees.edit', compact('units', 'employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        try {
            DB::beginTransaction();

            $attr = $request->validate([
                'unit_id' => 'exists:tunor,k_unor'
            ]);

            $unit = Unit::where('k_unor', $attr['unit_id'])->first();
            $user = User::where('username', $employee->nip_baru)->first();

            $employee->update([
                'k_dinas' => $unit->k_dinas,
                'k_unor' => $attr['unit_id']
            ]);

            if ($user) {
                $user->update([
                    'unit_id' => $attr['unit_id']
                ]);
            }

            DB::commit();
            return redirect()
                ->route('employees.index')
                ->with('success', __('Data berhasil diedit.'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('employees.index')
                ->with('success', __($th->getMessage()));
        }
    }

    public function select(Request $request)
    {
        $data = Employee::where('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);
        return response()->json($data);
    }
}
