<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\DonationRequest;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class DonationRequestController extends Controller
{
    public function index()
    {
        $donations = DonationRequest::all();
        return apiResponse(1, 'كل التبرعات', $donations);
    }

    public function show($id)
    {
        $donation = DonationRequest::find($id);
        if($donation)
            return apiResponse(1, 'الطلب المطلوب', $donation);
        return apiResponse(1, 'لا يوجد طلب، البيانات خاطئه');
        
    }
    public function create(Request $request)
    {
        // dd($request->all());
        try{
            $validator = validator($request->all(), [
                'patient_name' => 'required',
                'patient_phone' => 'required|digits:11',
                'patient_age' => 'required|gte:1|lte:100',
                'hospital_name' => 'required',
                'hospital_address' => 'required',
                'bags_num' => 'required|gte:1|lte:50',
                'details' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',
                'blood_type_id' => 'required|exists:blood_types,id',
                'city_id' => 'required|exists:cities,id',
            ]);
    
            if($validator->fails()){
                return apiResponse(0, $validator->errors()->first(), $validator->errors());
            }
    
            $client_id = $request->user()->id;
            $request->merge(['client_id' => $client_id]);
    
            $donations_request = DonationRequest::create($request->all());

            // Find the clients who is suitable for this donation request:
            $clientIds = $donations_request->city
                    ->governorate
                    ->clients()->whereHas('bloodTypes', function ($query) use($request) {
                                    $query->where('blood_type_id', $request->blood_type_id);
                                })->pluck('clients.id')->toArray();
    
            if(count($clientIds)){
                
                // Create the notification in the DB: 
                $notification = $donations_request->notifications()->create([
                    'title' => 'يوجد حالة تبرع قريبه منك', 
                    'content' => 'محتاج متبرع لفصيلة'. BloodType::where('id', $donations_request->blood_type_id)->first(), 
                ]);

                // Attach clients to this notification: 
                $notification->clients()->attach($clientIds);

                // Get Tokens for FCM (Pushing Notifications using FCM): 
                


            }

            return apiResponse(1, 'تم إضافة الطلب بنجاح', $donations_request);
        }
        catch(Throwable $th){
            return apiResponse(0, 'حدث خطأ، برجاء المحاولة مجددا', $th->getMessage());
        }
    }
}
