<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\galery;
use App\Models\category_galery;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json()
    {
        // Retrieve data from the 'articles' table and include related information from 'category_articles' tables
        $data = Galery::leftJoin('category_galeries', 'galeries.category_galeries_id', '=', 'category_galeries.id')
            ->select('galeries.*', 'category_galeries.name_category_galerie as category_name')
            ->get();
        $index = 1;
        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($Galery) {
                $editUrl = url('/superadmin/Galery/edit/' . $Galery->id);
                $deleteUrl = url('/superadmin/Galery/destroy/' . $Galery->id);
                return '<a href="' . $editUrl . '" class="btn btn-primary">Edit</a> ' .
                    '<a href="#" class="btn btn-danger delete-galery" data-url="' . $deleteUrl . '">Delete</a>' .
                    '<button class="btn btn-primary view-galery" data-id="' . $Galery->id . '">View</button>';

                // $editUrl = url('/superadmin/Articles/edit/' . $Articles->id);


                // return '<a href="' . $editUrl . '" class="edit-file">Edit</a> | <a href="#" class="delete-file" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        $categoryGalery = category_galery::all();
        if ($categoryGalery->IsEmpty()) {
            return redirect('/superadmin/categoryGalery')
                ->with('error', 'No category Galery available. Please add categories Galery first.');
        }
        return view('superadmin.Galery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryGalery = category_galery::all();
        return view('superadmin.Galery.create', compact('categoryGalery'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_path_galeries' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',
            'category_galeries_id' => 'required|exists:category_galeries,id',
        ]);

        $request->merge([
            'created_date' => now()->toDateString(),
            'created_time' => now()->toTimeString(),
        ]);

        $imagePath = $request->file('image_path_galeries')->store('galeries_images', 'public');

        $Galery = new Galery([
            'title' => $request->title,
            'created_date' => $request->created_date,
            'created_time' => $request->created_time,
            'image_path_galeries' => $imagePath,
            'category_galeries_id' => $request->category_galeries_id,
        ]);
        $Galery->save();
        return redirect('superadmin/Galery')
            ->with('success', 'Galery created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $galery = Galery::find($id);
        $categoryGalery = category_galery::all();
        return view('superadmin.Galery.edit', compact('categoryGalery', 'galery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image_path_galeries' => 'image|mimes:jpeg,png,jpg,gif|max:100000',
            'category_galeries_id' => 'required|exists:category_galeries,id',
        ]);

        $galery = Galery::find($id);
        $galery->title = $request->title;
        $galery->category_galeries_id = $request->category_galeries_id;

        // Set nilai created_date dan created_time
        $galery->created_date = $galery->created_date ?? now()->toDateString(); // Jika nilai sebelumnya tidak ada, gunakan nilai saat ini
        $galery->created_time = $galery->created_time ?? now()->toTimeString(); // Jika nilai sebelumnya tidak ada, gunakan nilai saat ini

        // Periksa apakah ada file gambar yang diunggah
        if ($request->hasFile('image_path_galeries')) {
            // Validasi dan simpan gambar baru jika ada
            $request->validate([
                'image_path_galeries' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // Aturan validasi untuk unggahan gambar
            ]);

            // Hapus gambar lama jika ada
            Storage::disk('public')->delete($galery->image_path_galeries);

            // Unggah gambar baru dan dapatkan pathnya
            $imagePath = $request->file('image_path_galeries')->store('galeries_images', 'public');
            $galery->image_path_galeries = $imagePath;
        }

        $galery->save();

        return redirect('superadmin/Galery')
            ->with('success', 'Galery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Temukan Galery berdasarkan ID
            $galery = Galery::findOrFail($id);

            // Hapus gambar terkait Galery jika ada
            Storage::disk('public')->delete($galery->image_path_galeries);

            // Hapus Galery dari database
            $galery->delete();

            return response()->json(['success' => 'Galery deleted successfully.']);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani dan kirim respons error
            return redirect('superadmin/Galery')->with('error', 'Failed to delete Galery.');
        }
    }
}
