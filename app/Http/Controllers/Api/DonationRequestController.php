<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationRequest;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class DonationRequestController extends Controller
{
    public function index()
    {
        $donations = DonationRequest::all();
        dd($donations);
    }

    public function create(Request $request)
    {
        try{
            $validator = validator($request->all(), [
                'patient_name' => 'required',
                'patient_phone' => 'required',
                'patient_age' => 'required',
                'hospital_name' => 'required',
                'hospital_address' => 'required',
                'bags_num' => 'required',
                'details' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'blood_type_id' => 'required',
                'city_id' => 'required',
            ]);
    
            if($validator->fails()){
                return apiResponse(0, $validator->errors()->first(), $validator->errors());
            }
    
            $client_id = $request->user()->id;
    
            $request->merge(['client_id' => $client_id]);
    
            $donations_request = DonationRequest::create($request->all());
    
            return apiResponse(1, 'تم إضافة الطلب بنجاح', $donations_request);
        }
        catch(Throwable $th){
            return apiResponse(0, 'حدث خطأ، برجاء المحاولة مجددا', $th->getMessage());
        }
    }
}
