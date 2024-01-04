<?php

namespace App\Http\Controllers;
use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $categories = project::all();
        return view('project.list', compact('categories'));
    }
    public function create(){

        return view('project.create');
    }
    public function store(){

        //return view('category.create');
    }
}
