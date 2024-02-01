<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jabatan_so;
use App\Models\value_so;
use Yajra\DataTables\DataTables;

class SOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function json()
    {
        // Retrieve data from the 'value_sos' table and include related information from 'jabatan_sos' table
        $data = value_so::with('jabatanSo')->get();
        $index = 1;

        return DataTables::of($data)
            ->addColumn('DT_RowIndex', function ($data) use (&$index) {
                return $index++; // Menambahkan nomor urutan baris
            })
            ->addColumn('action', function ($valueSo) {
                $editUrl = url('/superadmin/SO/edit/' . $valueSo->id);
                $deleteUrl = url('/superadmin/SO/destroy/' . $valueSo->id);
                return '<a href="' . $editUrl . '" class="btn btn-primary">Edit</a> ' .
                    '<a href="#" class="btn btn-danger delete-value-so" data-url="' . $deleteUrl . '">Delete</a>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function index()
    {
        return view('superadmin.SO.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.SO.create');
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
            'name_jabatan' => 'required',
            'name_value_so' => 'required',
        ]);

        // Create jabatan_so
        $jabatan = jabatan_so::create([
            'name_jabatan' => $request->input('name_jabatan')
        ]);

        // Create value_so and associate it with the newly created jabatan_so
        $valueSo = value_so::create([
            'name_value_so' => $request->input('name_value_so'),
            'jabatan_so_id' => $jabatan->id // Using the id of the newly created jabatan_so
        ]);

        return redirect('/superadmin/SO')->with('success', 'organizational structure created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jabatanSo = jabatan_so::find($id);
        $valueSo = value_so::where('jabatan_so_id', $id)->first();

        if ($jabatanSo && $valueSo) {
            $jabatanSos = jabatan_so::all();
            return view('superadmin.SO.edit', compact('jabatanSo', 'valueSo', 'jabatanSos'));
        } else {
            return redirect()->back()->with('error', 'Data not found.');
        }
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
            'name_jabatan' => 'required',
            'name_value_so' => 'required',
        ]);

        // Update jabatan_so
        $jabatanSo = jabatan_so::find($id);
        if ($jabatanSo) {
            $jabatanSo->update([
                'name_jabatan' => $request->input('name_jabatan')
            ]);
        }

        // Update value_so
        $valueSo = value_so::where('jabatan_so_id', $id)->first();
        if ($valueSo) {
            $valueSo->update([
                'name_value_so' => $request->input('name_value_so')
            ]);
        }

        return redirect('/superadmin/SO')->with('success', 'Organizational structure updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete jabatan_so
        $deletedJabatan = jabatan_so::destroy($id);

        // Delete value_so associated with the deleted jabatan_so
        $deletedValue = value_so::where('jabatan_so_id', $id)->delete();

        if ($deletedJabatan || $deletedValue) {
            return response()->json(['message' => 'Organizational structure deleted successfully.']);
        } else {
            return response()->json(['error' => 'Failed to delete organizational structure.']);
        }
    }
}
