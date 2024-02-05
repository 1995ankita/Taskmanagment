<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserCreatedMail;
use App\Http\Requests\UserRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UserUpdateRequest;
use Yajra\DataTables\Facades\Datatables;

use App\Http\Requests\UserActivateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('auth'); // Requires authentication for all methods
        // $this->middleware('role:user|admin')->only(['index']); // Only users with role 'user' or 'admin' can access index method
        // $this->middleware('role:admin')->except(['index']); // Only users with role 'admin' can access methods other than index
    }
    /**
     * Display a listing of the resource.
     */

    // public function index(Request $request)
    // {
    //     // Get the authenticated user
    //     $authenticatedUser = Auth::user();

    //     // Check if the authenticated user's name matches the condition
    //     if ($authenticatedUser->name === 'desired_name') {
    //         if ($request->ajax()) {
    //             $query = User::with('creator');
    //             return Datatables::eloquent($query)->make(true);
    //         }
    //         return view('users.list');
    //     } else {
    //         // Redirect or abort the request for unauthorized users
    //         return redirect()->route('login')->with('error', 'You are not authorized to access this resource.');
    //     }
    // }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('creator');
            return Datatables::eloquent($query)->make(true);
        }
        return view('users.list');
    }




    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = User::with('creator');
    //         return Datatables::eloquent($query)->make(true);
    //     }
    //     return view('users.list');
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(UserRequest $request): RedirectResponse
    {
        $token = Str::random(100);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_by' =>  Auth::user()->id,
            'remember_token' => $token
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        // $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('danger', 'User deleted successfully');
    }


    public function activateaccount($remember_token)
    {
        $user = User::where('remember_token', $remember_token)->first();

        if ($user) {
            return view('users.activateaccount')->with('user', $user)->with('token', $remember_token);
        }
    }

    public function postactivate(UserActivateRequest $request, $token)
    {
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            $user = User::where('remember_token', $token)->where('email', $request['email'])->firstOrFail();
            $user->password = bcrypt($request['password']);
            $user->remember_token = Str::random(100);
            $user->is_active = 1;
            $user->save();
            Auth::loginUsingId($user->id);
            return redirect("dashboard")->withSuccess('Signed in successfully after resetting password');
        } else {
            return redirect()->route('activateaccount', $token)
                ->with('error', 'Email is not valid');
        }
    }
}
