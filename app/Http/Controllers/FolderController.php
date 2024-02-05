<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Permissions;
use App\Models\UserFolders;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\FolderRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\FolderUpdateRequest;



class FolderController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if the request is an AJAX request and if the user is authenticated
        if ($request->ajax() && Auth::check()) {
            $user = Auth::user();

            // Fetch folders associated with the authenticated user
            $folders = Folder::leftJoin('user_folders', 'folders.id', '=', 'user_folders.folder_id')
                ->where('user_folders.created_by', $user->id) // Filter folders by the authenticated user's ID
                ->select('folders.id', 'folders.name')
                ->distinct() // Ensure only distinct folders are fetched
                ->get();

            // Format the folders data for Datatables
            $formattedFolders = $folders->map(function ($folder) {
                $permissions = Permissions::whereIn('id', function ($query) use ($folder) {
                    $query->select('permission_id')
                        ->from('user_folders')
                        ->where('folder_id', $folder->id);
                })->pluck('name')->implode(', ');

                return [
                    'id' => $folder->id,
                    'name' => $folder->name,
                    'permissions' => $permissions,
                ];
            });

            return Datatables::of($formattedFolders)->make(true);
        }

        // If not an AJAX request or user is not authenticated, return the view with DataTables script
        return view('folders.list');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all permissions from the database
        $permissions = Permissions::all();
        return view('folders.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FolderRequest $request)
    {
        // Validate the request data if necessary

        // Create a new folder instance
        $folder = Folder::create([
            'name' => $request->name,
            'created_by' => auth()->id(), // Assuming the current authenticated user creates the folder
            // Add other fields as needed
        ]);

        // Store the relationship between the user and folder for each selected permission
        foreach ($request->permissions as $permissionId) {
            UserFolders::create([
                'created_by' => auth()->id(), // Assuming the current authenticated user
                'folder_id' => $folder->id,
                'permission_id' => $permissionId,
            ]);
        }

        return redirect()->route('folders.index')
            ->with('success', 'Folder created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $folder = Folder::find((int)$id); // Cast $id to integer
        return view('folders.edit', compact('folder'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(FolderUpdateRequest $request, $id)
    {
        $folder = Folder::findOrFail($id);

        $folder->update([
            'name' => $request->name,
            // 'created_by' => $request->created_by, // Assuming 'created_by' is in the request
            // Add other fields as needed
        ]);

        return redirect()->route('folders.index')
            ->with('success', 'Folder updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folder = Folder::findOrFail($id);
        $folder->delete();

        return redirect()->route('folders.index')
            ->with('success', 'Folder deleted successfully');
    }
}
