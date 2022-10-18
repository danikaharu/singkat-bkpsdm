<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleAndPermissionRequest;
use App\Http\Requests\UpdateRoleAndPermissionRequest;
use Carbon\Carbon;
use Spatie\Permission\Models\{Role, Permission};
use Yajra\DataTables\Facades\DataTables;

class RoleAndPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view role & permission')->only('index', 'show');
        $this->middleware('permission:create role & permission')->only('create', 'store');
        $this->middleware('permission:edit role & permission')->only('edit', 'update');
        $this->middleware('permission:delete role & permission')->only('delete');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $roles = Role::query();

            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y H:i');
                })
                ->addColumn('action', 'admin.roles.include.action')
                ->toJson();
        }


        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleAndPermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleAndPermissionRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        $role->givePermissionTo($request->permissions);

        return redirect()
            ->route('roles.index')
            ->with('success', __('Data berhasil ditambah.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRoleAndPermissionRequest  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleAndPermissionRequest $request, Role $role)
    {
        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions);

        return redirect()
            ->route('roles.index')
            ->with('success', __('Data berhasil diedit.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::withCount('users')->findOrFail($id);

        // if any user where role.id = $id
        if ($role->users_count < 1) {
            $role->delete();

            return redirect()
                ->route('roles.index')
                ->with('success', __('Data berhasil dihapus.'));
        } else {
            return redirect()
                ->route('roles.index')
                ->with('error', __('Tidak bisa hapus role.'));
        }

        return redirect()->route('role.index');
    }
}
