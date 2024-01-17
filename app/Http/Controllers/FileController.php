<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\file;
use App\Models\Category_file;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function json()
    {
        $files = File::leftJoin('category_files', 'files.category_files_id', '=', 'category_files.id')
        ->select('files.*', 'category_files.name_category_files as category_name')
        ->get();

        return DataTables::of($files)
            ->addColumn('DT_RowIndex', function ($file) {
                return $file->id;
            })
            ->addColumn('action', function ($file) {
                // return '<a href="#" class="delete-category" data-url="'.route('your_delete_route', $file->id).'">Delete</a>';
                // Gantilah 'your_delete_route' dengan nama rute yang sesuai untuk menghapus file
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index(){
        $userRole = auth()->user()->role; // Mendapatkan peran pengguna
        $categories = Category_file::all();

         if ($categories->isEmpty()) {
            return redirect('/superadmin/categoryFile')->with('error', 'No category files available. Please add categories files first.');
        }

        if ($userRole == 'superadmin') {
            return view('superadmin.File.index');
        } elseif ($userRole == 'admin') {
            // Tambahkan logika atau tampilan yang sesuai untuk admin
            return view('admin.File.index');
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }

    public function create()
    {
        $categories = Category_file::all(); // Ambil semua kategori untuk formulir

        return view('Superadmin.File.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:10240', // Sesuaikan dengan jenis file yang diizinkan dan ukuran maksimumnya
            'category_files_id' => 'required|exists:category_files,id',
            // Sesuaikan aturan validasi lainnya sesuai kebutuhan Anda
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('private/files', $fileName, 'local');


            // Simpan informasi file ke dalam database
            $newFile = new File();
            $newFile->name = $request->input('name');
            $newFile->path = $filePath;
            $newFile->category_files_id = $request->input('category_files_id');
            $newFile->file_date_created = now()->toDateString();
            $newFile->file_time_created = now()->toTimeString();
            $newFile->save();

            return redirect('/superadmin/File')->with('success', 'File berhasil diunggah.');
        }

        return redirect('/superadmin/File/create')->with('failed', 'Gagal mengunggah file.');
    }

    public function serveFile($id)
    {
        $file = file::findOrFail($id);
        $path = Storage::disk('local')->path($file->path);

        if (Storage::disk('local')->exists($file->path)) {
            return response()->file($path);
        } else {
            abort(404, 'File not found');
        }
    }
}
