<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Files;
use App\Models\Folder;
use App\Models\UserFiles;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\FilesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\FilesUpdateRequest;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Fetch folders created by the authenticated user
            $folders = Folder::where('created_by', $user->id)->pluck('name', 'id');

            // Check if the request is an AJAX request
            if ($request->ajax()) {
                $foldersIds = $folders->keys()->toArray(); // Get folder IDs associated with the authenticated user

                // Fetch files associated with the folders created by the authenticated user
                $filesQuery = Files::with(['folder'])
                    ->whereIn('folder_id', $foldersIds);

                return Datatables::eloquent($filesQuery)
                    ->addColumn('folder_name', function ($file) {
                        return optional($file->folder)->name;
                    })
                    ->addColumn('permissions', function ($file) {
                        // Fetch and format permissions for the file
                        $permissions = UserFiles::where('file_id', $file->id)
                            ->join('permissions', 'user_files.permission_id', '=', 'permissions.id')
                            ->pluck('name')
                            ->implode(', ');
                        return $permissions;
                    })
                    // Exclude 'path' and 'extension' from the DataTable
                    ->editColumn('path', function ($file) {
                        return ''; // You can customize this as needed
                    })
                    ->editColumn('extension', function ($file) {
                        return ''; // You can customize this as needed
                    })
                    ->make(true);
            }

            // Pass the $folders variable to the view for the dropdown
            return view('files.list', compact('folders'));
        }

        // If the user is not authenticated, return the view with DataTables script
        return view('files.list');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        if (!$user) {
            // Handle the case where no user is authenticated
            // For example, redirect back or show an error message
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Fetch folders created by the authenticated user
        $folders = $user->folders;
        $permissions = Permissions::all();

        return view('files.create', compact('folders', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilesRequest $request)
    {
        // Validate the request here if needed

        // Process file upload
        $file = $request->file('file');
        $uuid = \Illuminate\Support\Str::uuid();
        $filename = $file->getClientOriginalName(); // Get the original filename without UUID prefix
        $extension = $file->getClientOriginalExtension();
        $filenameWithExtension = $filename . '.' . $extension;

        // Move the file to the public storage directory with UUID prefix
        $file->move(public_path('storage/' . $uuid), $filenameWithExtension);


        // Create the file record
        $fileRecord = Files::create([
            'uuid' => $uuid,
            'folder_id' => $request->folder_id,
            'path' => 'storage/' . $uuid, // Store the path without the filename
            'name' => $request->name, // Store only the filename without the extension and UUID
            'display_name' => $request->display_name,
            'extension' => $extension,
            'created_by' => auth()->id(),
        ]);


        // Store the relationship between the user, file, and each selected permission
        foreach ($request->permissions as $permissionId) {
            UserFiles::create([
                'created_by' => auth()->id(),
                'file_id' => $fileRecord->id,
                'permission_id' => $permissionId,
            ]);
        }

        return redirect()->route('files.index')
            ->with('success', 'File created successfully');
    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $file = Files::findOrFail($id);
        $originalFileName = pathinfo($file->name, PATHINFO_FILENAME); // Extract only the filename without the extension
        $folders = Folder::all();

        return view('files.edit', compact('file', 'folders', 'originalFileName'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(FilesUpdateRequest $request, $id)
    {
        // print($request);
        $file = Files::findOrFail($id);

        // Validate the request here if needed

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            // A new file is uploaded, handle file update
            $newFile = $request->file('file');
            $uuid = $file->uuid;

            // Generate a unique filename with extension
            $filename = $uuid . '_' . $newFile->getClientOriginalName();
            $extension = $newFile->getClientOriginalExtension();
            $filenameWithExtension = $filename . '.' . $extension;

            // Move the file to the public storage directory
            $newFile->move(public_path('storage/' . $uuid), $filenameWithExtension);

            // Remove the old file
            Storage::delete($file->path . '/' . $file->name);

            // Update necessary information in the database
            $file->update([
                'folder_id' => $request->folder_id,
                'path' => 'storage/' . $uuid,
                'name' => $request->name, // Store only the filename without the extension
                'display_name' => $request->display_name,
                'extension' => $extension,
                'created_by' => auth()->id(), // Assuming the current authenticated user updates the file
                // Add other fields as needed
            ]);

            return redirect()->route('files.index')
                ->with('success', 'File updated successfully');
        }

        // If no new file is uploaded, update other information without changing the file
        $file->update([
            'folder_id' => $request->folder_id,
            'display_name' => $request->display_name,
            // Add other fields as needed
        ]);

        return redirect()->route('files.index')
            ->with('success', 'File information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $file = Files::findOrFail($id);
        $file->delete();

        return redirect()->route('files.index')
            ->with('success', 'File deleted successfully');
    }
}
