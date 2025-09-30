<?php

namespace App\Http\Controllers;

use App\Formss;
use Illuminate\Http\Request;

class ContestFormController extends Controller
{
    // تخزين بيانات الفورم
    public function store(Request $request, $id)
    {
        $contestId = $id;
        $formData = $request->except(['_token', 'contest_id']);

        Formss::updateOrCreate(
            ['contest_id' => $contestId],
            ['form_data' => json_encode($formData)]
        );

        return response()->json(['message' => 'تم حفظ الفورم بنجاح!']);
    }

    //storeUser
    public function storeUser(Request $request, $id)
    {
        
        
        $validated = $request->validate([
        'name'         => ['required', 'string', 'max:255'],
        'employeeId'   => ['required', 'digits_between:1,10'],
        'jobTitle'     => ['required', 'string', 'max:255'],
        'email'        => ['required', 'email', 'max:255'],
        'phone'        => ['required', 'regex:/^05[0245689][0-9]{7}$/'],
    ], [
        'name.required'        => 'يرجى إدخال الاسم.',
        'employeeId.required'  => 'يرجى إدخال الرقم الوظيفي.',
        'employeeId.digits_between' => 'الرقم الوظيفي يجب أن يحتوي على أرقام فقط.',
        'jobTitle.required'    => 'يرجى إدخال المسمى الوظيفي.',
        'email.required'       => 'يرجى إدخال البريد الإلكتروني.',
        'email.email'          => 'صيغة البريد الإلكتروني غير صحيحة.',
        'phone.required'       => 'يرجى إدخال رقم الهاتف.',
        'phone.regex'          => 'يرجى إدخال رقم إماراتي صالح يبدأ بـ 05.',
    ]);

        

        $Contestsuser = new \App\Contestsuser();
        $Contestsuser->contest_id = $id;
        $Contestsuser->name = $request->input('name');
        $Contestsuser->employeeId = $request->input('employeeId');
        $Contestsuser->jobTitle = $request->input('jobTitle');
        $Contestsuser->email = $request->input('email');
        $Contestsuser->phone = $request->input('phone');
        $Contestsuser->save();

        $formData = $request->except(['_token', 'contest_id', 'name', 'employeeId', 'jobTitle', 'email', 'phone']);
        $Contestsuser->form_data = json_encode($formData);
        $Contestsuser->save();



        return response()->json(['message' => 'تم إرسال الفورم بنجاح!']);
    }

    //users
    public function users($id)
    {
        $Contestsuser = \App\Contestsuser::where('contest_id', $id)->get();
        return view('contests.users', compact('Contestsuser', 'id'));
    }
}
