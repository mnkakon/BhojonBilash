<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Mail;

class ContactController extends Controller
{
    public function contact()
    {
    	 return view('contact.contact', []);
    }

    public function contactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'required'
        ]);

        if ($validator->fails())
        {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Mail::send('emails.contact', ['request' => $request], function ($m) use ($request) {
            $m->from($request->input('email'), $request->input('name'));
            $m->to(env('SITE_ADMIN_EMAIL'), env('SITE_ADMIN_NAME'));
            $m->subject('Contact From an user');
        });

	    
    	// return $request->all();



    	return redirect()->back()->with('success', 'We will contact with you shortly!');
    }
}
