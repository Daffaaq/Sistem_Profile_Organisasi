<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json()
    {
        $profiles = Profile::select(['id', 'name_profiles', 'address_profiles', 'phone_profiles', 'email_profiles', 'description_profiles', 'logo_profiles']);
        $index = 1;
        return DataTables::of($profiles)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($row) {
                $editUrl = url('/superadmin/Profile/edit/' . $row->id);
                $deleteUrl = url('/superadmin/Profile/destroy/' . $row->id);

                return '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit</a> | ' .
                    '<a href="#" class="delete-Profile btn btn-danger btn-sm" data-url="' . $deleteUrl . '">Delete</a> | ' .
                    '<a href="#" class="btn btn-primary btn-sm view-profiles" data-id="' . $row->id . '">View</a>';
            })
            ->toJson();
    }

    public function index()
    {
        $profileCount = Profile::count(); // Mendapatkan jumlah data profil

        // Jika jumlah data profil lebih dari 0, tombol "Tambah" tidak perlu dinonaktifkan
        $disableCreateButton = $profileCount > 0;

        // Tampilkan view dengan memberikan informasi apakah tombol "Tambah" harus dinonaktifkan
        return view('superadmin.Profiles.index', compact('disableCreateButton'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Profile::all();
        if ($profile->IsEmpty()) {
            return view('superadmin.Profiles.create');
        } else{
            return redirect('/superadmin/Profile')
            ->with('error', 'Maaf, Anda tidak dapat menambahkan profil perusahaan/organisasi saat ini karena hanya diperbolehkan 1
                data saja.');
        }
        
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
            'name_profiles' => 'required',
            'address_profiles' => 'required',
            'phone_profiles' => 'required',
            'email_profiles' => 'required|email',
            'logo_profiles' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000', // Validasi untuk gambar yang diperlukan
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan file gambar yang diunggah ke direktori yang ditentukan
        $logoPath = $request->file('logo_profiles')->store('logos', 'public');

        // Buat entri profil baru dengan path atau nama file logo
        Profile::create(array_merge($request->all(), ['logo_profiles' => $logoPath]));

        return redirect('/superadmin/Profile')->with('success', 'Profile created successfully.');
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
        $profile = Profile::findOrFail($id);
        return view('superadmin.Profiles.edit', compact('profile'));
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
            'name_profiles' => 'required',
            'address_profiles' => 'required',
            'phone_profiles' => 'required',
            'email_profiles' => 'required|email',
            'logo_profiles' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // Logo tidak wajib diubah setiap saat, jadi tidak perlu required
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $profile = Profile::findOrFail($id);

        // Jika ada file logo yang diunggah, simpan yang baru dan hapus yang lama
        if ($request->hasFile('logo_profiles')) {
            // Hapus file logo lama
            Storage::disk('public')->delete($profile->logo_profiles);

            // Simpan file gambar yang diunggah ke direktori yang ditentukan
            $logoPath = $request->file('logo_profiles')->store('logos', 'public');

            // Update path logo dengan yang baru
            $profile->update(array_merge($request->except('logo_profiles'), ['logo_profiles' => $logoPath]));
        } else {
            // Jika tidak ada file logo yang diunggah, hanya perbarui data tanpa mengubah logo
            $profile->update($request->except('logo_profiles'));
        }

        return redirect('/superadmin/Profile')->with('success', 'Profile updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        Storage::disk('public')->delete($profile->logo_profiles);
        $profile->delete();

        return response()->json(['success' => true, 'message' => 'Profile deleted successfully.']);
    }
}
