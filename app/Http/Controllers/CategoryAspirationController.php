<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\category_aspiration;
use App\Http\Requests\CategoryAspirationRequest;
use Illuminate\Support\Facades\Auth;

class CategoryAspirationController extends Controller
{
    public function json(){
        $data = category_aspiration::all();
         $index = 1;
        return DataTables::of($data)
        ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
           ->addColumn('action', function ($row) {
            $editUrl = url('/superadmin/categoryAspiration/edit/' . $row->id);
            $deleteUrl = url('/superadmin/categoryAspiration/destroy/' . $row->id);

            return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-category" data-url="' . $deleteUrl . '">Delete</a>';
        })
            ->make(true);
    }
    public function jsonAdmin(){
        $data = category_aspiration::all();
         $index = 1;
        return DataTables::of($data)
        ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
           ->addColumn('action', function ($row) {
            $editUrl = url('/admin/categoryAspiration/edit/' . $row->id);
            $deleteUrl = url('/admin/categoryAspiration/destroy/' . $row->id);

            return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-category" data-url="' . $deleteUrl . '">Delete</a>';
        })
            ->make(true);
    }
    public function index()
    {
        $userRole = auth()->user()->role; // Mendapatkan peran pengguna

        if ($userRole == 'superadmin') {
            return view('superadmin.Category.Aspiration.index');
        } elseif ($userRole == 'admin') {
            // Tambahkan logika atau tampilan yang sesuai untuk admin
            return view('admin.Category.Aspiration.index');
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function create()
    {
        $userRole = auth()->user()->role;
        if ($userRole == 'superadmin') {
            return view('superadmin.Category.Aspiration.create');
        } elseif ($userRole == 'admin') {
            return view('admin.Category.Aspiration.create');
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function store(CategoryAspirationRequest $request)
    {
        category_aspiration::create($request->all());
        $userRole = auth()->user()->role;
        if ($userRole == 'superadmin') {
            return redirect('/superadmin/categoryAspiration')
            ->with('success', 'Category Aspirasi created successfully.');
        } elseif ($userRole == 'admin') {
            return redirect('/admin/categoryAspiration')->with('success', 'Category Aspirasi created successfully.');
        }
        // Jika peran tidak sesuai, arahkan kembali ke halaman login
    return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function edit($id)
    {
        $categoryAspiration = category_aspiration::find($id);
        $userRole = auth()->user()->role;
        if ($userRole == 'superadmin') {
            return view('superadmin.Category.Aspiration.edit', compact('categoryAspiration'));
        } elseif ($userRole == 'admin') {
             return view('admin.Category.Aspiration.edit', compact('categoryAspiration'));
        }
        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function update(CategoryAspirationRequest $request, $id)
    {

        $categoryAspiration = category_aspiration::find($id);
        $categoryAspiration->update($request->all());
        $userRole = auth()->user()->role;
        if ($userRole == 'superadmin') {
            return redirect('/superadmin/categoryAspiration')
            ->with('success', 'Category Aspirasi updated successfully.');
        } elseif ($userRole == 'admin') {
            return redirect('/admin/categoryAspiration')
            ->with('success', 'Category Aspirasi created successfully.');
        }
        // Jika peran tidak sesuai, arahkan kembali ke halaman login
    return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function destroy($id)
    {
        category_aspiration::destroy($id);
        session()->flash('success', 'Category Aspirasi deleted successfully.');
        return response()->json(['success' => 'Category Aspirasi deleted successfully.']);
    }
}
