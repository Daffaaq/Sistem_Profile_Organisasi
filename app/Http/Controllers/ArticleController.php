<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category_article;
use Yajra\DataTables\DataTables;
use App\Models\Image;

class ArticleController extends Controller
{
    public function json()
    {
        $images = Image::leftJoin('articles', 'images.articles_id', '=', 'articles.id')
        ->leftJoin('category_articles', 'articles.category_articles_id', '=', 'category_articles.id')
        ->select('images.*', 'articles.title as article_title', 'category_articles.name_category_article')
        ->get();

        return DataTables::of($images)
            ->addColumn('DT_RowIndex', function ($Articles) {
                return $Articles->id;
            })
            ->addColumn('action', function ($Articles) {
                // $editUrl = url('/superadmin/Articles/edit/' . $Articles->id);
                // $deleteUrl = url('/superadmin/Articles/destroy/' . $Articles->id);

                // return '<a href="' . $editUrl . '" class="edit-file">Edit</a> | <a href="#" class="delete-file" data-url="' . $deleteUrl . '">Delete</a>';
            })
        ->rawColumns(['action'])
            ->toJson();
    }
    public function index()
    {
        $categoryArticle = Category_article::all();
        if ($categoryArticle->IsEmpty()) {
            return redirect('/superadmin/categoryArticle')
                ->with('error', 'No category Article available. Please add categories Article first.');
        }
        return view('superadmin.Article.index');
    }
}
