<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NotificationController extends Controller
{
    public function index() 
    {
        //
    }

    public function count() 
    {
        //
    }

    public function registerToken(Request $request) // when the client sign in from a device: add the token of this device here...
    {
        $validator = validator($request->all(), [
            'token' => 'required', 
            'platform' => [
                'required', 
                'in:android,ios'
                // Rule::in(['android', 'ios'])
            ],
        ]);

        if($validator->fails()){
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        Token::where('token', $request->token)->delete();
            // To check if this device is linked previously with another client
            // each device has a uniqe token, whatever the number of clients has been registered on it...

        $token = $request->user()->tokens()->create($request->all());

        // another way to add the token...
        // $request->merge(['client_id' => $request->user()->id]);
        // $token = Token::create($request->all());

        return apiResponse(1, 'تمت الاضافه بنجاح', $token);
    }

    public function removeToken(Request $request) // when the client sign out from a device: remove the token from here...
    {
        $validator = validator($request->all(), [
            'token' => 'required',
        ]);

        if($validator->fails()){
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $token = Token::where('token', $request->token)->delete();
            // when the client sign out from a device, remove this device token
            // to make sure that if another client is signing in in the future we will link it's api_token with this device token

        if($token){
            return apiResponse(1, 'تم الحذف بنجاح');
        }
        return apiResponse(1, 'لا يوجد معرف بهذه القيمه');
            
    }

    public function notificationSettings(Request $request)
    {
        try {

            $validator = validator($request->all(), [
                'governorate_id' => 'array',
                'blood_type_id' => 'array',
            ]);

            if ($validator->fails()) {
                return apiResponse(0, $validator->errors()->first(), $validator->errors());
            }

            $client = $request->user();

            if ($request->has('governorate_id') || $request->has('blood_type_id')) {
                if ($request->has('governorate_id'))
                    $client->governorates()->sync($request->governorate_id);

                if ($request->has('blood_type_id'))
                    $client->bloodTypes()->sync($request->blood_type_id);

                return apiResponse(1, 'تم تعديل إعدادات الإشعارات بنجاح', [$client->governorates, $client->bloodTypes]);
            }

            return apiResponse(1, 'إعدادات إشعارات المستخدم', [$client->governorates, $client->bloodTypes]);

        } catch (\Throwable $th) {
            return apiResponse(0, 'حدث خطأ، برجاء المحاولة مرة أخرى', $th->getMessage());
        }
    }

}