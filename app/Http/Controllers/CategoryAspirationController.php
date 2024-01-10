<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\category_aspiration;
use App\Http\Requests\CategoryAspirationRequest;
use Illuminate\Support\Facades\Auth;

class CategoryAspirationController extends Controller
{
    protected function getRedirectUrlBasedOnRole($userRole)
    {
        switch ($userRole) {
            case 'superadmin':
                return '/superadmin/categoryAspiration';
            case 'admin':
                return '/admin/categoryAspiration';
            default:
                return null;
        }
    }

    protected function getViewBasedOnRole($viewName)
    {
        $userRole = auth()->user()->role;

        if ($userRole == 'superadmin' || $userRole == 'admin') {
            return view("$userRole.Category.Aspiration.$viewName");
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }
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
        return $this->getViewBasedOnRole('index');
    }

    public function create()
    {
        return $this->getViewBasedOnRole('create');
    }

    public function store(CategoryAspirationRequest $request)
    {
        $categoryAspiration = category_aspiration::create($request->all());
        $redirectUrl = $this->getRedirectUrlBasedOnRole(auth()->user()->role);

        return $redirectUrl
            ? redirect($redirectUrl)->with('success', 'Category Aspiration created successfully.')
            : redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function edit($id)
    {
        $categoryAspiration = category_aspiration::find($id);
        if (!$categoryAspiration) {
            return redirect()->back()->with('error', 'Category Aspiration not found.');
        }
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

        $redirectUrl = $this->getRedirectUrlBasedOnRole(auth()->user()->role);

        return $redirectUrl
            ? redirect($redirectUrl)->with('success', 'Category Aspiration updated successfully.')
            : redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function destroy($id)
    {
        category_aspiration::destroy($id);
        session()->flash('success', 'Category Aspiration deleted successfully.');

        return response()->json(['success' => 'Category Aspiration deleted successfully.']);
    }
}
