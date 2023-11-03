<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;



class MailController extends Controller
{
    public function index(){
        $mailData = [
            "title" => "Mail from BLITZ ELECTRIC",
            "body" => "This is for testing email using smtp"
        ];
        Mail::to("septa.git@gmail.com")->send(new MailNotify($mailData));
        dd("Email send successfully.");
    }
}
