<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric|digits:11',
            'email' => 'required|unique:clients',
            'password' => 'required|confirmed',
            'd_o_b' => 'required|date',
            'last_donation_date' => 'required|date',
            'city_id' => 'required',
            'blood_type_id' => 'required',
        ]);

        if($validator->fails())
        {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }


        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());

        // $inputs = $request->all();
        // $inputs['password'] = Hash::make($request->password);
        // $client = Client::create($inputs);
        
        $client->api_token = Str::random(60);
        $client->save();
        
        return apiResponse(1, 'تم الإضافة بنجاح', [
            'api_token' => $client->api_token, 
            'client' => $client
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator($request->all(), [
            'phone' => 'required|numeric|digits:11',
            'password' => 'required',
        ]);

        if($validator->fails())
        {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }


        // DO IT MANUALLY
        // $client = Client::where('phone', $request->phone)->get();
        $client = Client::where('phone', $request->phone)->first();
        // dd($client);
        if($client && Hash::check($request->password, $client->password))
        {
            return apiResponse(1, 'Correct Credintials', [
                'api_token' => $client->api_token, 
                'client' => $client
            ]);

        }
        return apiResponse(0, 'Incorrent Credintials');
        
        // DO IT WITH LARAVEL'S METHODS
        // $auth =  auth()->guard('api')->validate($request->all());
        // return apiResponse(1, '', $auth);
    
    }

    public function changePassword(Request $request)
    {
        $validator = validator($request->all(), [
            'password' => 'required', 
            'new_password' => 'required|confirmed|different:password', 
        ]);

        if($validator->fails())
        {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Auth::guard('api')->user();
        $client_api_token = $client->api_token;


        if(Hash::check($request->password, $client->password))
        {
            $client = Client::where('api_token', $client_api_token)->first();
            // dd($client);
            $client->password = bcrypt($request->new_password);
            // dd($client);
            $client->save();

            // $client['password'] = bcrypt($request->password);
            // $client = Client::create($client);

            return apiResponse(1, 'password has been changed succesfully');

        }
        return apiResponse(0, 'password is not correct');

        
    }

    public function resetPassword(Request $request)
    {
        $validator = validator($request->all(), [
            'phone' => 'required|numeric|digits:11',
        ]);

        if($validator->fails()){
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();
        
        if($client)
        {
            $code = rand(1111, 9999);
            $client->pin_code = $code;
            $client->save();
            // $client->update(['pin_code'=> $code]);
            
            if($client)
            {
                // Send SMS

                // Send Email
                // Mail::to($client->email)
                Mail::to($client->email)->send(new ResetPassword($client));

                return apiResponse(1, 'تم إرسال كود التحقق، برجاء فحص البريد الإلكتروني', [
                    'pin_code' => $code, 
                    // 'mail_fails' => Mail::failures(), 
                    'emali' => $client->email
                ]);
            }
            else{
                return apiResponse(0, 'حدث خطأ حاول مرة أخرى');
            }
        }
        return apiResponse(0, 'لا يوجد حساب بهذا الرقم');
    }

    public function newPassword(Request $request)
    {
        $validator = validator($request->all(), [
            'phone' => 'required|numeric|digits:11',
            'pin_code' => 'required|', 
            'password' => 'required|confirmed', 
        ]);

        if($validator->fails())
        {
            return apiResponse(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();
        
        if($client)
        {
            if($client->pin_code && $client->pin_code == $request->pin_code)
            {
                $password = bcrypt($request->password);
                $client->password = $password;
                $client->pin_code = null;
                
                if($client->save())
                {
                    return apiResponse(1, 'your password has been changed succesfully');
                }
                return apiResponse(0, 'there is an error, please try again');
                
            }
            return apiResponse(0, 'pin code is not correct');
        }

        return apiResponse(0, 'invalid data');
    }

}
