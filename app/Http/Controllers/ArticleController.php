<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category_article;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function json()
    {
        // Retrieve data from the 'articles' table and include related information from 'category_articles' tables
        $data = Article::leftJoin('category_articles', 'articles.category_articles_id', '=', 'category_articles.id')
            ->select('articles.*', 'category_articles.name_category_article as category_name')
            ->get();
        $index = 1;
        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($Articles) {
                $editUrl = url('/superadmin/Article/edit/' . $Articles->id);
                $deleteUrl = url('/superadmin/Article/destroy/' . $Articles->id);
                return '<a href="' . $editUrl . '" class="btn btn-primary">Edit</a> ' .
                    '<a href="#" class="btn btn-danger delete-article" data-url="' . $deleteUrl . '">Delete</a>' .
                    '<button class="btn btn-primary view-article" data-id="' . $Articles->id . '">View</button>';

                // $editUrl = url('/superadmin/Articles/edit/' . $Articles->id);


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

        $userId = Auth::id();
        // Buat artikel baru dengan data yang diterima dan path gambar yang diunggah
        $article = new Article([
            'title' => $request->title,
            'Descriptions' => $request->Descriptions,
            'created_date' => $request->created_date,
            'created_time' => $request->created_time,
            'image_path_article' => $imagePath, // Path gambar yang diunggah
            'category_articles_id' => $request->category_articles_id,
            'user_id' => $userId,
        ]);
        $article->save();

        // Redirect ke halaman yang sesuai atau tampilkan pesan berhasil
        return redirect('/superadmin/Article')->with('success', 'Article created successfully');
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categoryArticle = Category_article::all(); // Ambil semua kategori artikel
        return view('superadmin.Article.edit', compact('categoryArticle', 'article'));
    }


    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required|string|max:255',
            'Descriptions' => 'required|string',
            'image_path_article' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // Opsional: Aturan validasi untuk unggahan gambar
            'category_articles_id' => 'required|exists:category_articles,id',
        ]);

        $userId = Auth::id();
        // Temukan artikel berdasarkan ID
        $article = Article::find($id);

        // Perbarui data artikel dengan data yang diterima dari request
        $article->title = $request->title;
        $article->Descriptions = $request->Descriptions;
        $article->category_articles_id = $request->category_articles_id;

        // Set nilai created_date dan created_time
        $article->created_date = $article->created_date ?? now()->toDateString(); // Jika nilai sebelumnya tidak ada, gunakan nilai saat ini
        $article->created_time = $article->created_time ?? now()->toTimeString(); // Jika nilai sebelumnya tidak ada, gunakan nilai saat ini

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image_path_article')) {
            // Validasi dan simpan gambar baru jika ada
            $request->validate([
                'image_path_article' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // Aturan validasi untuk unggahan gambar
            ]);

            // Hapus gambar lama jika ada
            Storage::disk('public')->delete($article->image_path_article);

            // Unggah gambar baru dan dapatkan pathnya
            $imagePath = $request->file('image_path_article')->store('article_images', 'public');
            $article->image_path_article = $imagePath;
        }
        $article->user_id = $userId;
        // Simpan perubahan ke dalam database
        $article->save();

        // Redirect ke halaman yang sesuai atau tampilkan pesan berhasil
        return redirect('/superadmin/Article')->with('success', 'Article updated successfully');
    }

    public function destroy($id)
    {
        // Temukan artikel berdasarkan ID
        $article = Article::find($id);

        // Hapus gambar terkait artikel jika ada
        Storage::disk('public')->delete($article->image_path_article);

        // Hapus artikel dari database
        $article->delete();
        session()->flash('success', 'Article deleted successfully.');
        // Redirect ke halaman yang sesuai atau tampilkan pesan berhasil
        return response()->json(['success' => 'Article deleted successfully.']);
    }
}
