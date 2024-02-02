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
        $index = 1;
        return DataTables::of($files)
            ->addColumn('DT_RowIndex', function ($file) use (&$index) {
                return $index++;
            })
            ->addColumn('action', function ($file) {
                $editUrl = url('/superadmin/File/edit/' . $file->id);
                $deleteUrl = url('/superadmin/File/destroy/' . $file->id);

                return '<a href="' . $editUrl . '" class="edit-file">Edit</a> | <a href="#" class="delete-file" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
    public function jsonAdmin()
    {
        $files = File::leftJoin('category_files', 'files.category_files_id', '=', 'category_files.id')
            ->select('files.*', 'category_files.name_category_files as category_name')
            ->get();
        $index = 1;
        return DataTables::of($files)
            ->addColumn('DT_RowIndex', function ($file) use (&$index) {
                return $index++;
            })
            ->addColumn('action', function ($file) {
                $editUrl = url('/admin/File/edit/' . $file->id);
                $deleteUrl = url('/admin/File/destroy/' . $file->id);

                return '<a href="' . $editUrl . '" class="edit-file">Edit</a> | <a href="#" class="delete-file" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        $userRole = auth()->user()->role; // Mendapatkan peran pengguna
        $categories = Category_file::all();

        if ($categories->isEmpty()) {
            if ($userRole == 'superadmin') {
                return redirect('/superadmin/categoryFile')->with('error', 'No category files available. Please add categories files first.');
            } elseif ($userRole == 'admin') {
                return redirect('/admin/categoryFile')->with('error', 'No category files available. Please add categories files first.');
            }
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
        $userRole = auth()->user()->role;
        $categories = Category_file::all(); // Ambil semua kategori untuk formulir
        if ($userRole == 'superadmin') {
            return view('Superadmin.File.create', compact('categories'));
        } elseif ($userRole == 'admin') {
            return view('admin.File.create', compact('categories'));
        }
    }

    public function store(Request $request)
    {
        $userRole = auth()->user()->role;
        $request->validate([
            'name' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:10240', // Sesuaikan dengan jenis file yang diizinkan dan ukuran maksimumnya
            'category_files_id' => 'required|exists:category_files,id',
            // Sesuaikan aturan validasi lainnya sesuai kebutuhan Anda
        ]);
        if ($userRole == 'superadmin') {
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
        } elseif ($userRole == 'admin') {
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

                return redirect('/admin/File')->with('success', 'File berhasil diunggah.');
            }
            return redirect('/admin/File/create')->with('failed', 'Gagal mengunggah file.');
        }
    }

    public function edit($id)
    {
        $userRole = auth()->user()->role;
        $file = File::find($id);
        $categories = Category_file::all();

        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }
        if ($userRole == 'superadmin') {
            return view('Superadmin.File.edit', compact('file', 'categories'));
        } elseif ($userRole == 'admin') {
            return view('admin.File.edit', compact('file', 'categories'));
        }
    }


    public function update(Request $request, $id)
    {
        $userRole = auth()->user()->role;
        $file = File::find($id);

        if (!$file) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $request->validate([
            'name' => 'required',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'category_files_id' => 'required|exists:category_files,id',
        ]);
        if ($userRole == 'superadmin') {
            // Update other fields
            $file->name = $request->input('name');
            $file->category_files_id = $request->input('category_files_id');
            $file->file_date_created = now()->toDateString();
            $file->file_time_created = now()->toTimeString();

            // Check if a new file is provided
            if ($request->hasFile('new_file')) {
                // Log the old file path before deleting
                \Log::info('Old File Path: ' . $file->path);

                // Delete the old file
                Storage::disk('local')->delete($file->path);

                // Upload the new file
                $newFile = $request->file('new_file');
                $fileName = time() . '_' . $newFile->getClientOriginalName();
                $filePath = $newFile->storeAs('private/files', $fileName, 'local');
                $file->path = $filePath;

                // Log the new file path after updating
                \Log::info('New File Path: ' . $file->path);
            }

            $file->save();

            return redirect('/superadmin/File')->with('success', 'File successfully updated.');
        } elseif ($userRole == 'admin') {
            // Update other fields
            $file->name = $request->input('name');
            $file->category_files_id = $request->input('category_files_id');
            $file->file_date_created = now()->toDateString();
            $file->file_time_created = now()->toTimeString();

            // Check if a new file is provided
            if ($request->hasFile('new_file')) {
                // Log the old file path before deleting
                \Log::info('Old File Path: ' . $file->path);

                // Delete the old file
                Storage::disk('local')->delete($file->path);

                // Upload the new file
                $newFile = $request->file('new_file');
                $fileName = time() . '_' . $newFile->getClientOriginalName();
                $filePath = $newFile->storeAs('private/files', $fileName, 'local');
                $file->path = $filePath;

                // Log the new file path after updating
                \Log::info('New File Path: ' . $file->path);
            }

            $file->save();

            return redirect('/admin/File')->with('success', 'File successfully updated.');
        }
    }


    public function destroy($id)
    {
        $file = File::find($id);

        if (!$file) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Delete the file from storage
        Storage::disk('local')->delete($file->path);

        // Delete the file record from the database
        $file->delete();

        return response()->json(['message' => 'File successfully deleted.']);
    }

    public function serveFile($id)
    {
        $file = File::findOrFail($id);

        // Use the updated file path
        $path = Storage::disk('local')->path($file->path);

        if (Storage::disk('local')->exists($file->path)) {
            return response()->file($path);
        } else {
            abort(404, 'File not found');
        }
    }
}
