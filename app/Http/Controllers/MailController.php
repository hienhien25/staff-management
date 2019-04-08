<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function getsendmail()
    {
    	return view('layout.user.sendmail');
    }
    public function postsendmail(Request $req)
    {
    	$data=['fullname'=>$req->user_recive,'title'=>$req->title,'content'=>$req->content];
    	Mail::send('email',$data,function($msg){
    		$msg->from('tienphamnb123@gmail.com','Pham Tien');
    		$msg->to('hienhien2511997@gmail.com','Hien Pham')->subject('Chạy thử email');
    	});
    	return redirect(route('home'));
    }
}
