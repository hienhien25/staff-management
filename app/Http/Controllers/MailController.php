<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
class MailController extends Controller
{
    public function getSendMail()
    {
    	return view('layout.user.send_mail');
    }
    public function postSendMail(Request $req)
    {
    	$data=['fullname'=>$req->user_recive,'title'=>$req->title,'content'=>$req->content];
        //$files = $req->file('files');
    	Mail::send('email',$data,function($msg) use ($data/*,$files*/){
    		$msg->from('tienphamnb123@gmail.com','Pham Tien');
    		$msg->to($data['fullname']);
            $msg->subject($data['title']);
            /*$msg->attach($files->getRealPath(), [
                'as' => $files->getClientOriginalName(), 
                'mime' => $files->getMimeType()
            ]);*/
        });
        //Session::flash('success','Email của bạn đã được gửi !');
        return redirect(route('home'));
    }
}
