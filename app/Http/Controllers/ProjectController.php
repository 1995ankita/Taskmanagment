<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = project::all();
        return view('project.list', compact('projects'));
    }
    public function create()
    {

        return view('project.create');
    }
    public function store(Request $request)
    {


        project::create([

            'name' => $request->name,
        ]);

        session()->flash('success', 'project Created successfully.');
        return redirect()->route('project.index');
    }
    public function edit(project $project)
    {
        // echo"fdgg";
        $project = project::find($project->id);

        return view('project.edit', compact('project'));
    }
    public function update(Request $request, project $project)
    {
        $project->update([
            'name' => $request->name,
            // Add any other fields you need to update
        ]);

        session()->flash('success', 'project updated successfully.');
        return redirect()->route('project.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(project $project)
    {
        $project->delete();
        return redirect()->route('project.index')->with('success', 'project deleted successfully.');
    }
}
