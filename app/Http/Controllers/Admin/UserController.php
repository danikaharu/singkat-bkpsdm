<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Alert;

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
            $users = User::with('roles:id,name');

            return Datatables::of($users)
                ->addIndexColumn()
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
        return view('admin.users.create', compact('roles', 'employees'));
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
        $user->load('roles:id,name');

        return view('admin.users.edit', compact('user', 'roles', 'employees'));
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
        $attr = $request->validated();
        $employee = Employee::where('nip_baru', $attr['username'])->first();

        $attr['name'] = $employee->nama;

        if (is_null($attr['password'])) {
            unset($attr['password']);
        } else {
            $attr['password'] = bcrypt($attr['password']);
        }

        $user->update($attr);

        $user->syncRoles($request->role);

        return redirect()
            ->route('users.index')
            ->with('success', __('Data berhasil diedit.'));
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
