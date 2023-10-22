<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notificationSettings(Request $request)
    {
        $validator = validator($request->all(), [
            'governorate_id' => 'array',
            'blood_type_id' => 'array',
        ]);

        $client = $request->user();

        if($request->has('governorate_id') || $request->has('blood_type_id')){
            if($request->has('governorate_id'))
                $client->governorates()->sync($request->governorate_id);

            if($request->has('blood_type_id'))
                $client->bloodTypes()->sync($request->blood_type_id);
            
            return apiResponse(1, 'تم تعديل إعدادات الإشعارات بنجاح', [$client->governorates, $client->bloodTypes]);
        }

        return apiResponse(1, 'إعدادات إشعارات المستخدم', [$client->governorates, $client->bloodTypes]);
    }
}
