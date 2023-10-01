<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /*
    GET|HEAD        api/v1/contact .......................... contact.index › Api\ContactController@index
    POST            api/v1/contact .......................... contact.store › Api\ContactController@store
    GET|HEAD        api/v1/contact/{contact} ................ contact.show › Api\ContactController@show
    PUT|PATCH       api/v1/contact/{contact} ................ contact.update › Api\ContactController@update
    DELETE          api/v1/contact/{contact} ................ contact.destroy › Api\ContactController@destroy
     */

    public function index()
    {
        $contacts = Contact::all();
        return apiResponse(1, 'كل الرسائل التي قد وصلتك', $contacts);
    }

    public function show(string $id)
    {
        $contact = Contact::find($id);
        if($contact)
            return apiResponse(1, 'الرسالة الحالية', $contact);
        return apiResponse(0, 'لا توجد رسالة بهذا المعرف');
    }

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails())
            return apiResponse(1,$validator->errors()->first(), $validator->errors());

        $contact = Contact::create($request->all());
        return apiResponse(1, 'تمت الإضافه بنجاح', $contact);
    }

    public function update(Request $request, string $id)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($validator->fails())
            return apiResponse(1,$validator->errors()->first(), $validator->errors());

        $contact = Contact::find($id);
        $contact->update($request->all());
        return apiResponse(1, 'تم التعديل بنجاح', $contact);
    }

    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if($contact){
            $contact->delete();
            return apiResponse(1, 'the contact has been deleted succesfully');
        }
        return apiResponse(0, 'there is no contact with this id');
        
    }
}
