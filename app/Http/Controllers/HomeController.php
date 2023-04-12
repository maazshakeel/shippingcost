<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Courier;
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
        $courier = $this->getCourier();
        return view('home', compact('province', 'courier'));

    }

    public function store(Request $request){
        dd($request->all());
    }

    public function getCourier(){
        return Courier::all();
    }

    public function getProvince(){
        return Province::pluck('title','code');
    }

    public function getCities($id){
        return City::where('province_code', $id)->pluck('title', 'code');
    }

    public function searchCities(Request $request){
        $search = $request->search;

        if (empty($search)) {
            $cities = City::orderBy('title', 'asc')
            ->select('id', 'title')->limit(5)->get();
        } else {
            $cities = City::orderBy('title', 'asc')
            ->where('title', 'like', '%'.$search.'%')
            ->select('id', 'title')->limit(5)->get();
        }

        $response = [];

        foreach ($cities as $city) {
            $response[] = [
                'id' => $city->id,
                'text' => $city->title
            ];
        }

       return json_encode($response); 

    }

}
