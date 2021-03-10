<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailCustomerSend;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class MailCustomerSendController extends Controller
{
    public function send(Request $request)
    {
        MailCustomerSend::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone']
        ]);
        $data = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone']


        );

        Mail::to('nguyendacname.bds@gmail.com')->send(new SendMailable($data));
        return back()->with('success', 'Thanks for contacting us!');
    }
}
