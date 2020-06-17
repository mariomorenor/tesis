<?php

namespace App\Http\Controllers;

use App\Lote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password],false) ) {
            return response('logueado',200);
        }else{
            return response()->json(['errors'=>['login'=>'Los datos ingresados no existen o son incorrectos']],422);
        }
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getUser(Request $request)
    {
        return User::where('username','like',$request->username)->first();
    }

    public function check()
    {
        return Auth::check();
    }

    public function checkControlLote(Request $request)
    {
     
        if ($request->ajax()) {
           
            $lote = Lote::where('state','A')->get();
           
            return count($lote) > 0 ? response()->json($lote,200) : response()->json(['error'=>['message'=>'Lote not found']],404);
        }
    }

    
}
