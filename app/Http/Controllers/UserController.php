<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json()
    {
        $users = User::select(['id', 'name', 'email', 'role']);
        $index = 1;
        return DataTables::of($users)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($row) {
                $editUrl = url('/superadmin/Users/edit/' . $row->id);
                $deleteUrl = url('/superadmin/Users/destroy/' . $row->id);

                return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-users" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->toJson();
    }
    public function index()
    {
        $users = User::all();
        return view('superadmin.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        // Enkripsi password
        $encryptedPassword = bcrypt($request->password);

        // Buat user dengan password yang dienkripsi
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $encryptedPassword,
            'role' => $request->role,
        ]);

        return redirect('/superadmin/Users')
            ->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('superadmin.Users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Ambil data user berdasarkan ID
        $user = User::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'role' => 'required',
        ]);

        // Jika pengguna yang sedang login sedang mengedit data mereka sendiri,
        // peran akan tetap sama seperti sebelumnya
        if ($user->id === Auth::id()) {
            // Periksa apakah pengguna mengubah email atau password
            $changedEmail = $request->email !== $user->email;
            $changedPassword = $request->filled('password');

            // Update data user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
                'role' => 'superadmin',
            ]);

            // Jika pengguna mengubah email atau password, logout setelah 5 detik
            if ($changedEmail || $changedPassword) {
                return redirect('/superadmin/Users')
                ->with('info', 'User updated successfully. Logging out in 5 seconds...');
            }
        } else {
            // Update data user
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
                'role' => $request->role,
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect('/superadmin/Users')->with('success', 'User updated successfully');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return response()->json([
                'warning' => 'You cannot delete your own account because you are currently logged in as ' . Auth::user()->name . '.'
            ]);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
