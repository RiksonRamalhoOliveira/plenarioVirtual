<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        
        return view('admin.dashboard');

    }

}
