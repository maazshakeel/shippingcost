<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $province = $this->getProvince();
        return view('home', compact('province'));

    }

    public function getProvince(){
        return Province::pluck('title','code');
    }

    public function getCities($id){
        return City::where('province_code', $id)->pluck('title', 'code');
    }

}
