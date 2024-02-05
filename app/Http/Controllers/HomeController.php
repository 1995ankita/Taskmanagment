<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Return an empty response for DataTables
            return response()->json([]);
        }

        return view('home.index');
    }
}
