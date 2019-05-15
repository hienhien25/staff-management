<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;
use App\Email;
use Auth;
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
        try {
            Mail::send('email',$data,function($msg) use ($data/*,$files*/){
            $msg->from('tienphamnb123@gmail.com','Pham Tien');
            $msg->to($data['fullname']);
            $msg->subject($data['title']);
            /*$msg->attach($files->getRealPath(), [
                'as' => $files->getClientOriginalName(), 
                'mime' => $files->getMimeType()
            ]);*/
            });
        } catch (Exception $e) {
            throw new Exception("System Error ", 1);
        }
    	$email= new Email();
        $email->fill($req->all());
        $email->user_id=Auth::user()->id;
        if(!$email->save())
        {
            throw new Exception("System Error ", 1);
        }
        //Session::flash('success','Email của bạn đã được gửi !');
        return redirect(route('admin.mailbox'));
    }
    public function getMailbox()
    {
        $email=Email::where('user_id',Auth::user()->id)->get();
        return view('layout.mailbox',compact('email'));
    }
}
