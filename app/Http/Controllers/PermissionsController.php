<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Permissions;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PermissionUpdateRequest;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Permissions::query();
            return Datatables::eloquent($query)
                ->addColumn('action', function ($permission) {
                    return '<a href="' . route('permissions.edit', $permission->id) . '" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('permissions.list');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        Permissions::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permissions::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $request, string $id)
    {
        $permission = Permissions::findOrFail($id);
        $permission->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permissions::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully');
    }

}
