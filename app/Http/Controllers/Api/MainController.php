<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function posts()
    {
        $posts = Post::with('category')->get();
        return apiResponse(200, 'succes', $posts);
    }

    public function governrates()
    {
        $governorates = Governorate::select(['id', 'name'])->with('cities')->get();
        return apiResponse(200, 'succes', $governorates);
    }

    // There are 2 functions(with 2 routes)
    // public function cities()
    // {
    //     $cities = City::select(['id', 'name'])->with('governorate')->get();
    //     return apiResponse(200, 'succes', $cities);
    // }
    // public function city(Request $request)
    // {
    //     $cities = City::select(['id', 'name'])
    //                     ->with('governorate')
    //                     ->where('id', $request->city_id)
    //                     ->get();
    //     return apiResponse(200, 'succes', $cities);
    // }

    
    // we can compine them in one function, with one route: 
    public function cities(Request $request)
    {
        $cities = City::where(function($query) use ($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id', $request->governorate_id);
            }
        })
        ->with('governorate')->get();
        return apiResponse(200, 'succes', $cities);
    }

    public function bloodTypes()
    {
        $blood_types = BloodType::all();
        return apiResponse(1, 'كل فصائل الدم المتاحه حتى الآن', $blood_types);
    }

    public function settings()
    {
        $settings = Setting::all();
        return apiResponse(1, 'كل البيانات الخاصه بالموقع', $settings);
    }
}
