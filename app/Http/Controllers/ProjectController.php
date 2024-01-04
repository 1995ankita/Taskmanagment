<?php

namespace App\Http\Controllers;
use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = project::all();
        return view('project.list', compact('projects'));
    }
    public function create(){

        return view('project.create');
    }
    public function store(Request $request){


        project::create([

            'name' => $request->name,
        ]);

        session()->flash('success', 'project Created successfully.');
        return redirect()->route('project.index');
    }
}
