<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category_article;
use Yajra\DataTables\DataTables;

class ArticleController extends Controller
{
    public function json()
    {
        // Retrieve data from the 'articles' table and include related information from 'category_articles' tables
        $data = Article::leftJoin('category_articles', 'articles.category_articles_id', '=', 'category_articles.id')
            ->select('articles.*', 'category_articles.name_category_article as category_name')
            ->get();

        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($Articles) {
                return $Articles->id;
            })
            ->addColumn('action', function ($Articles) {
                return '<button class="btn btn-primary view-article" data-id="' . $Articles->id . '">View</button>';
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
    public function create()
    {
        $categoryArticle = Category_article::all();
        return view('superadmin.Article.create', compact('categoryArticle'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required|string|max:255',
            'Descriptions' => 'required|string',
            'image_path_article' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000', // Aturan validasi untuk unggahan gambar
            'category_articles_id' => 'required|exists:category_articles,id',
        ]);

        // Menetapkan nilai default untuk created_date dan created_time
        $request->merge([
            'created_date' => now()->toDateString(),
            'created_time' => now()->toTimeString(),
        ]);

        // Mengunggah gambar dan mendapatkan path
        $imagePath = $request->file('image_path_article')->store('article_images', 'public');

        // Buat artikel baru dengan data yang diterima dan path gambar yang diunggah
        $article = new Article([
            'title' => $request->title,
            'Descriptions' => $request->Descriptions,
            'created_date' => $request->created_date,
            'created_time' => $request->created_time,
            'image_path_article' => $imagePath, // Path gambar yang diunggah
            'category_articles_id' => $request->category_articles_id,
        ]);
        $article->save();

        // Redirect ke halaman yang sesuai atau tampilkan pesan berhasil
        return redirect('/superadmin/Article')->with('success', 'Article created successfully');
    }
}
