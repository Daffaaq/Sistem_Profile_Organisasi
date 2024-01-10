<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\category_article;
use App\Http\Requests\CategoryArticleRequest;

class CategoryArticleController extends Controller
{
    public function json(){
        $data = category_article::all();
         $index = 1;
        return DataTables::of($data)
        ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
           ->addColumn('action', function ($row) {
            $editUrl = url('/superadmin/categoryArticle/edit/' . $row->id);
            $deleteUrl = url('/superadmin/categoryArticle/destroy/' . $row->id);

            return '<a href="' . $editUrl . '">Edit</a> | <a href="#" class="delete-category" data-url="' . $deleteUrl . '">Delete</a>';
        })
            ->make(true);
    }
    public function index()
    {
        return view('superadmin.Category.Article.index');
    }

    public function create()
    {
        return view('superadmin.Category.Article.create');
    }

    public function store(CategoryArticleRequest $request)
    {
        category_article::create($request->all());
        return redirect('/superadmin/categoryArticle')
            ->with('success', 'Category Article created successfully.');
    }

    public function edit($id)
    {
        $categoryArticle = category_article::find($id);
        return view('superadmin.Category.Article.edit', compact('categoryArticle'));
    }

    public function update(CategoryArticleRequest $request, $id)
    {

        $categoryArticle = category_article::find($id);
        $categoryArticle->update($request->all());

        return redirect('/superadmin/categoryArticle')
            ->with('success', 'Category Article updated successfully.');
    }

    public function destroy($id)
    {
        category_article::destroy($id);
        session()->flash('success', 'Category Article deleted successfully.');
        return response()->json(['success' => 'Category Article deleted successfully.']);
    }
}
