<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\category_galery;
use App\Http\Requests\CategoryGaleryRequest;

class CategoryGaleryController extends Controller
{
    public function json(){
        $data = category_galery::all();
         $index = 1;
        return DataTables::of($data)
        ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
           ->addColumn('action', function ($row) {
            $editUrl = url('/superadmin/categoryGalery/edit/' . $row->id);
            $deleteUrl = url('/superadmin/categoryGalery/destroy/' . $row->id);

            return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-category" data-url="' . $deleteUrl . '">Delete</a>';
        })
            ->make(true);
    }
    public function index()
    {
        return view('superadmin.Category.Galery.index');
    }

    public function create()
    {
        return view('superadmin.Category.Galery.create');
    }

    public function store(CategoryGaleryRequest $request)
    {
        category_galery::create($request->all());
        return redirect('/superadmin/categoryGalery')
            ->with('success', 'Category Galeri created successfully.');
    }

    public function edit($id)
    {
        $categoryGaleri = category_galery::find($id);
        return view('superadmin.Category.Galery.edit', compact('categoryGaleri'));
    }

    public function update(CategoryGaleryRequest $request, $id)
    {

        $categoryArticle = category_galery::find($id);
        $categoryArticle->update($request->all());

        return redirect('/superadmin/categoryGalery')
            ->with('success', 'Category Galeri updated successfully.');
    }

    public function destroy($id)
    {
        category_galery::destroy($id);
        session()->flash('success', 'Category Galery deleted successfully.');
        return response()->json(['success' => 'Category Galeri deleted successfully.']);
    }
}
