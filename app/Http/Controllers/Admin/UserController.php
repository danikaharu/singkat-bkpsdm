<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreUserRequest, UpdateUserRequest};
use App\Models\{Employee, User, Unit};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view user')->only('index', 'show');
        $this->middleware('permission:create user')->only('create', 'store');
        $this->middleware('permission:edit user')->only('edit', 'update');
        $this->middleware('permission:delete user')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles', 'unit');

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('nama_unor', function ($row) {
                    return $row->unit ? $row->unit->n_unor : '-';
                })
                ->addColumn('action', 'admin.users.include.action')
                ->addColumn('role', function ($row) {
                    return $row->getRoleNames()->toArray() !== [] ? $row->getRoleNames()[0] : '-';
                })
                ->toJson();
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $employees = Employee::get();
        $units = Unit::get();
        return view('admin.users.create', compact('roles', 'employees', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $attr = $request->validated();
        $employee = Employee::where('nip_baru', $attr['username'])->first();

        $attr['unit_id'] = $employee->k_unor;
        $attr['name'] = $employee->nama;
        $attr['password'] = Hash::make($request->password);

        $user = User::create($attr);

        $user->assignRole($request->role);

        return redirect()
            ->route('users.index')
            ->with('success', __('Data berhasil ditambah.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles:id,name');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $employees = Employee::get();
        $units = Unit::get();
        $user->load('roles:id,name');

        return view('admin.users.edit', compact('user', 'roles', 'employees', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            $attr = $request->validated();

            $employee = Employee::where('nip_baru', $attr['username'])->first();
            $agency = Unit::where('k_unor', $attr['unit_id'])->first();

            if ($employee) {
                $employee->k_dinas = $agency->k_dinas;
                $employee->k_unor = $agency->k_unor;
                $employee->save();
            }

            $attr['name'] = $employee->nama;

            if (is_null($attr['password'])) {
                unset($attr['password']);
            } else {
                $attr['password'] = bcrypt($attr['password']);
            }

            $user->update($attr);

            $user->syncRoles($request->role);

            DB::commit();
            return redirect()
                ->route('users.index')
                ->with('success', __('Data berhasil diedit.'));
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()
                ->route('users.index')
                ->with('success', __($th->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', __('Data berhasil dihapus.'));
    }
}
