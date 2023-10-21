<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Contact;
use App\Models\Governorate;
use App\Models\Setting;
use Illuminate\Http\Request;

class MainController extends Controller
{
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

    public function storeContact(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails())
            return apiResponse(1,$validator->errors()->first(), $validator->errors());


        $request['email'] = auth()->user()->email;
        // $request->merge(['email' => auth()->user()->email]);
        // dd($request->all());

        $contact = Contact::create($request->all());
        return apiResponse(1, 'تمت الإضافه بنجاح', $contact);
    }
}
