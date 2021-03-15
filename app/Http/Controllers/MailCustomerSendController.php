<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailCustomerSend;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class MailCustomerSendController extends Controller
{

    function send(Request $request)
    {
     $this->validate($request, [
      'name'     =>  'required',
      'email'  =>  'required|email',
     ]);

        $data = array(
            'name'      =>  $request['name'],
            'email'     =>   $request['email'],
            'phone'     =>   $request['phone']
        );

     Mail::to('nguyendacnam.bds@gmail.com')->send(new SendMailable($data));
     return back()->with('success', 'Thanks for contacting us!');

    }
}
