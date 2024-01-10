<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\category_aspiration;
use App\Http\Requests\CategoryAspirationRequest;

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
    public function index()
    {
        return view('superadmin.Category.Aspiration.index');
    }

    public function create()
    {
        return view('superadmin.Category.Aspiration.create');
    }

    public function store(CategoryAspirationRequest $request)
    {
        category_aspiration::create($request->all());
        return redirect('/superadmin/categoryAspiration')
            ->with('success', 'Category Aspirasi created successfully.');
    }

    public function edit($id)
    {
        $categoryAspiration = category_aspiration::find($id);
        return view('superadmin.Category.Aspiration.edit', compact('categoryAspiration'));
    }

    public function update(CategoryAspirationRequest $request, $id)
    {

        $categoryAspiration = category_aspiration::find($id);
        $categoryAspiration->update($request->all());

        return redirect('/superadmin/categoryAspiration')
            ->with('success', 'Category Aspirasi updated successfully.');
    }

    public function destroy($id)
    {
        category_aspiration::destroy($id);
        session()->flash('success', 'Category Aspirasi deleted successfully.');
        return response()->json(['success' => 'Category Aspirasi deleted successfully.']);
    }
}
