<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103

class UserController extends Controller
{
    public function __construct() {
<<<<<<< HEAD
        $this->middleware('role');
=======
        // $this->middleware('role');
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        return $request;
=======
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required|confirmed',
            'role'=>'required'
        ]);
            $validatedData['password'] = Hash::make($request->password);
        $user = User::create($validatedData);
        $user->assignRole($validatedData['role']);
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit')->with(['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
<<<<<<< HEAD
        //
=======
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:3',
            'password' => 'required|confirmed',
            'role'=>'required'
        ]);
    
        $user->removeRole($user->Roles_u[0]->name);
        $user->update([
            'name'=>$validatedData['name'],
            'username'=>$validatedData['username'],
            'password'=>Hash::make($validatedData['password']),
        ]);
        $user->assignRole($validatedData['role']);
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    public function getUsers(Request $request)
    {
<<<<<<< HEAD
        if ($request->ajax()) {
            
            $users = User::all()->except([Auth::id()]);
           
=======
    //   return User::all();
        if ($request->ajax()) {
            
            $users = User::all()->except([Auth::id()]);
            
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
            return response()->json([
                'rows'=> $users
            ]);
        }
    }
<<<<<<< HEAD
=======

    public function roles(Request $request)
    {
        
        if ($request->ajax()) {
            $roles = Role::orderBy('name','desc')->get();
            return response()->json($roles);
        }
    }
>>>>>>> ab9cc6bd0a625ad6f648e297d41c497e9b1ec103
}
