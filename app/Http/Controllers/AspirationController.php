<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\aspiration;
use App\Models\category_aspiration;
use App\Models\Profile;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class AspirationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json()
    {
        $aspirations = Aspiration::leftJoin('category_aspirations', 'aspirations.category_aspirations_id', '=', 'category_aspirations.id')
            ->select('aspirations.*', 'category_aspirations.name_category_aspirations as category_name')
            ->get();

        $index = 1;
        return DataTables::of($aspirations)
            ->addColumn('DT_RowIndex', function ($aspirations) use (&$index) {
                return $index++;
            })
            ->addColumn('update_status', function ($aspirations) {
                $updateStatusUrl = url('/superadmin/Aspiration/updateStatus/' . $aspirations->id);
                $updateStatusButton = '<a href="#" class="btn btn-info update-status" data-id="' . $aspirations->id . '">Update Status</a>';
                return $updateStatusButton;
            })
            ->addColumn('edit_delete', function ($aspirations) {
                $editUrl = url('/superadmin/Aspiration/edit/' . $aspirations->id);
                $deleteUrl = url('/superadmin/Aspiration/destroy/' . $aspirations->id);
                $editButton = '<a href="' . $editUrl . '" class="btn btn-primary edit-file">Edit</a>';
                $deleteButton = '<a href="#" class="btn btn-danger delete-file" data-url="' . $deleteUrl . '">Delete</a>';
                return $editButton . ' | ' . $deleteButton;
            })
            ->rawColumns(['update_status', 'edit_delete'])
            ->toJson();
    }
    public function jsonAdmin()
    {
        $aspirations = Aspiration::leftJoin('category_aspirations', 'aspirations.category_aspirations_id', '=', 'category_aspirations.id')
            ->select('aspirations.*', 'category_aspirations.name_category_aspirations as category_name')
            ->get();

        $index = 1;
        return DataTables::of($aspirations)
            ->addColumn('DT_RowIndex', function ($aspirations) use (&$index) {
                return $index++;
            })
            ->addColumn('update_status', function ($aspirations) {
                $updateStatusUrl = url('/admin/Aspiration/updateStatus/' . $aspirations->id);
                $updateStatusButton = '<a href="#" class="btn btn-info update-status" data-id="' . $aspirations->id . '">Update Status</a>';
                return $updateStatusButton;
            })
            ->addColumn('edit_delete', function ($aspirations) {
                $editUrl = url('/admin/Aspiration/edit/' . $aspirations->id);
                $deleteUrl = url('/admin/Aspiration/destroy/' . $aspirations->id);
                $editButton = '<a href="' . $editUrl . '" class="btn btn-primary edit-file">Edit</a>';
                $deleteButton = '<a href="#" class="btn btn-danger delete-file" data-url="' . $deleteUrl . '">Delete</a>';
                return $editButton . ' | ' . $deleteButton;
            })
            ->rawColumns(['update_status', 'edit_delete'])
            ->toJson();
    }



    public function index(Request $request)
    {
        $userRole = auth()->user()->role; // Mendapatkan peran pengguna
        $categories = category_aspiration::all();

        // Menambahkan filter status aspirasi
        $selectedStatus = $request->input('status', 'all'); // Mendapatkan nilai status yang dipilih dari request

        if ($categories->isEmpty()) {
            if ($userRole == 'superadmin') {
                return redirect('/superadmin/categoryAspiration')->with('error', 'No category Aspiration available. Please add categories Aspiration first.');
            } elseif ($userRole == 'admin') {
                return redirect('/admin/categoryAspiration')->with('error', 'No category Aspiration available. Please add categories Aspiration first.');
            }
        }

        if ($userRole == 'superadmin') {
            return view('superadmin.Aspiration.index', compact('selectedStatus')); // Mengirimkan variabel $selectedStatus ke view
        } elseif ($userRole == 'admin') {
            // Tambahkan logika atau tampilan yang sesuai untuk admin
            return view('admin.Aspiration.index', compact('selectedStatus')); // Mengirimkan variabel $selectedStatus ke view
        }

        return redirect('/login')->with('error', 'Unauthorized access. Please log in with the correct account.');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRole = auth()->user()->role;
        $categories = category_aspiration::all(); // Ambil semua kategori untuk formulir
        if ($userRole == 'superadmin') {
            return view('Superadmin.Aspiration.create', compact('categories'));
        } elseif ($userRole == 'admin') {
            return view('admin.Aspiration.create', compact('categories'));
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
        $userRole = auth()->user()->role;
        $request->validate([
            'tittle_aspirations' => 'required',
            'description_aspirations' => 'required',
            'category_aspirations_id' => 'required|exists:category_aspirations,id',
        ]);

        try {
            $requestData = $request->all();
            $requestData['created_date'] = now()->toDateString();
            $requestData['created_time'] = now()->toTimeString();

            if ($userRole == 'superadmin') {
                Aspiration::create($requestData);
                return redirect('/superadmin/Aspiration')->with('success', 'Aspiration created successfully.');
            } elseif ($userRole == 'admin') {
                Aspiration::create($requestData);
                return redirect('/admin/Aspiration')->with('success', 'Aspiration created successfully.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('error', 'Failed to create aspiration. Please try again.');
        }
    }
    public function storeLandingPage(Request $request)
    {
        $request->validate([
            'tittle_aspirations' => 'required',
            'description_aspirations' => 'required',
            'category_aspirations_id' => 'required|exists:category_aspirations,id',
        ]);

        $requestData = $request->all();
        $requestData['created_date'] = now()->toDateString();
        $requestData['created_time'] = now()->toTimeString();

        $aspiration = Aspiration::create($requestData);

        if ($aspiration) {
            return response()->json(['success' => 'Aspiration created successfully.']);
        } else {
            return response()->json(['error' => 'Failed to create aspiration. Please try again.'], 500);
        }
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
        $userRole = auth()->user()->role;
        $aspiration = Aspiration::findOrFail($id);
        $categories = category_aspiration::all(); // Ambil semua kategori untuk formulir
        if ($userRole == 'superadmin') {
            return view('Superadmin.Aspiration.edit', compact('categories', 'aspiration'));
        } elseif ($userRole == 'admin') {
            return view('admin.Aspiration.edit', compact('categories', 'aspiration'));
        }
        return view('aspirations.edit', compact('aspiration'));
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
        $userRole = auth()->user()->role;
        $request->validate([
            'tittle_aspirations' => 'required',
            'description_aspirations' => 'required',
            'category_aspirations_id' => 'required|exists:category_aspirations,id',
        ]);

        try {
            $requestData = $request->all();
            $requestData['created_date'] = now()->toDateString();
            $requestData['created_time'] = now()->toTimeString();

            $aspiration = Aspiration::findOrFail($id);

            if ($userRole == 'superadmin') {
                $aspiration->update($requestData);
                return redirect('/superadmin/Aspiration')->with('success', 'Aspiration updated successfully.');
            } elseif ($userRole == 'admin') {
                $aspiration->update($requestData);
                return redirect('/admin/Aspiration')->with('success', 'Aspiration updated successfully.');
            }
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('error', 'Failed to update aspiration. Please try again.');
        }
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
            $aspiration = Aspiration::findOrFail($id);
            $aspiration->delete();

            return response()->json(['message' => 'Aspiration deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete aspiration'], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $aspiration = Aspiration::find($id);

        if (!$aspiration) {
            return response()->json(['error' => 'Aspiration not found'], 404);
        }

        $status = $request->input('status');
        if (!in_array($status, ['Todo', 'In progress', 'Done'])) {
            return response()->json(['error' => 'Invalid status'], 422);
        }

        try {
            $aspiration->status = $status;
            $aspiration->save();

            return response()->json(['success' => 'Aspiration status updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update aspiration status'], 500);
        }
    }

    public function pdfPrint($status)
    {
        $aspirations = Aspiration::query();

        // Filter data berdasarkan status yang dipilih
        if ($status !== 'all') {
            $aspirations->where('status', $status);
        }

        $aspirations = $aspirations->get();
        $categories = category_aspiration::all();
        $profile = Profile::first();

        // Check if profile data is empty
        if (!$profile) {
            return redirect('/superadmin/Profile')->with('error', 'Profile data is empty. Please fill in the profile details first.');
        }

        $pdf = Pdf::loadView('superadmin.Aspiration.printPDF', [
            'aspirations' => $aspirations,
            'categories' => $categories,
            'profile' => $profile
        ]);

        return $pdf->stream();
    }
}
