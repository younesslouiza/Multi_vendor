<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbordController extends Controller
{
    //Actions
    public function index(){

        //$user = Auth::user();
        //dd($user);

        //return view json redirect file 
        return view('dashboard.index');
    }
}