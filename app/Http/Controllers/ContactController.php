<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //goto contactus view
    public function contact()
    {
        return view('admin.contact-us');
    }

    //send Mail
    public function sendEmail(Request $request){
        $details=[
            'name'=>$request->name,
            'email'=>$request->email,
            'msg'=>$request->msg
        ];

        Mail::to('tupkms2022@gmail.com')->send(new ContactMail($details));
        session()->flash('message-sent', 'Your message has been sent succesfully');
        return back();
    }
}
