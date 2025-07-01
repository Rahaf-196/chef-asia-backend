<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class ContactController extends Controller
{
    use ApiResponseTrait;

    // عرض جميع الرسائل
    public function index()
    {
        $contacts = Contact::all();
        return $this->success('تم عرض الرسائل بنجاح', $contacts);
    }

    // تخزين رسالة جديدة
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create($data);
        return $this->success('تم إرسال الرسالة بنجاح', $contact, 201);
    }

    // عرض رسالة واحدة
    public function show(Contact $contact)
    {
        return $this->success('تم عرض الرسالة بنجاح', $contact);
    }

    // تعديل رسالة
    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name'    => 'sometimes|required|string|max:255',
            'email'   => 'sometimes|required|email|max:255',
            'message' => 'sometimes|required|string',
        ]);

        $contact->update($data);
        return $this->success('تم تعديل الرسالة بنجاح', $contact);
    }

    // حذف الرسالة
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->success('تم حذف الرسالة بنجاح');
    }
}
