<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('id', 'asc')->get(); // model pake di ujung nya
        $title = 'User';
        return view('admin.user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $title = 'Tambah User';
        return view('admin.user.create', compact('title', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        Alert::success('Berhasil!!', 'Data berhasil ditambah!');
        // Alert::success('Berhasil!!', 'Transaksi berhasil di buat');
        return redirect()->to('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = User::find($id);
        $title = 'Ubah User';
        return view('admin.user.edit', compact('edit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;
        if ($request->filled('password')) {
            $users->password = $request->password;
        }
        $users->save();

        Alert::success('Berhail!', 'Data berhasil di ubah!');
        return redirect()->to('user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();

        Alert::success('Berhasil', 'Data berhasil dihapus');
        return redirect()->to('user');
    }

    public function editRole($id)
    {
        $title = 'Tambah Role';
        $roles = Roles::get();
        $user = User::find($id);
        return view('admin.user.add_role', compact('roles', 'title', 'user'));
    }

    public function updateRoles(Request $request, $id)
    {
        $users = User::find($id);
        $users->roles()->sync($request->roles ?? []);
        Alert::success('Berhasil!', 'Data berhasil ditambahkan');
        return redirect()->to('user');
    }
}
