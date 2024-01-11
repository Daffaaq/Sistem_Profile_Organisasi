<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Category_file;
use App\Http\Requests\CategoryFileRequest;
use Illuminate\Support\Facades\Auth;

class CategoryFileController extends Controller
{
    protected function getRedirectUrlBasedOnRole($userRole)
    {
        switch ($userRole) {
            case 'superadmin':
                return '/superadmin/categoryFile';
            case 'admin':
                return '/admin/categoryFile';
            default:
                return null;
        }
    }

    protected function getViewBasedOnRole($viewName)
    {
        $userRole = auth()->user()->role;

        if ($userRole == 'superadmin' || $userRole == 'admin') {
            return view("$userRole.Category.File.$viewName");
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }
    public function json(){
        $data = Category_file::all();
         $index = 1;
        return DataTables::of($data)
        ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
           ->addColumn('action', function ($row) {
            $editUrl = url('/superadmin/categoryFile/edit/' . $row->id);
            $deleteUrl = url('/superadmin/categoryFile/destroy/' . $row->id);

            return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-category" data-url="' . $deleteUrl . '">Delete</a>';
        })
            ->make(true);
    }
    public function jsonAdmin(){
        $data = Category_file::all();
         $index = 1;
        return DataTables::of($data)
        ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
           ->addColumn('action', function ($row) {
            $editUrl = url('/admin/categoryFile/edit/' . $row->id);
            $deleteUrl = url('/admin/categoryFile/destroy/' . $row->id);

            return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-category" data-url="' . $deleteUrl . '">Delete</a>';
        })
            ->make(true);
    }
    public function index()
    {
        return $this->getViewBasedOnRole('index');
    }

    public function create()
    {
        return $this->getViewBasedOnRole('create');
    }

    public function store(CategoryFileRequest $request)
    {
        $categoryFile = Category_file::create($request->all());
        $redirectUrl = $this->getRedirectUrlBasedOnRole(auth()->user()->role);

        return $redirectUrl
            ? redirect($redirectUrl)->with('success', 'Category Aspiration created successfully.')
            : redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function edit($id)
    {
        $categoryFile = Category_file::find($id);
        if (!$categoryFile) {
            return redirect()->back()->with('error', 'Category File not found.');
        }
        $userRole = auth()->user()->role;
        if ($userRole == 'superadmin') {
            return view('superadmin.Category.File.edit', compact('categoryFile'));
        } elseif ($userRole == 'admin') {
             return view('admin.Category.File.edit', compact('categoryFile'));
        }
        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');

    }

    public function update(CategoryFileRequest $request, $id)
    {
        $categoryFile = Category_file::find($id);
        $categoryFile->update($request->all());

        $redirectUrl = $this->getRedirectUrlBasedOnRole(auth()->user()->role);

        return $redirectUrl
            ? redirect($redirectUrl)->with('success', 'Category Aspiration updated successfully.')
            : redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function destroy($id)
    {
        Category_file::destroy($id);
        session()->flash('success', 'Category Aspiration deleted successfully.');

        return response()->json(['success' => 'Category Aspiration deleted successfully.']);
    }
}
