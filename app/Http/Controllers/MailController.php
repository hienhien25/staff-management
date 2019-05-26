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
        $files = $req->file('document');
        try {
            Mail::send('email', $data, function ($msg) use ($data,$files) {
                $msg->from('tienphamnb123@gmail.com', 'Pham Tien');
                $msg->to($data['fullname']);
                $msg->subject($data['title']);
                $msg->attach($files->getRealPath(), [
                    'as' => $files->getClientOriginalName(),
                    'mime' => $files->getClientMimeType()
                ]);
            });
        } catch (Exception $e) {
            throw new Exception("System Error ", 1);
        }
        $email= new Email();
        $email->fill($req->all());
        $email->user_id=Auth::user()->id;
        if (!$email->save()) {
            throw new Exception("System Error ", 1);
        }
        //Session::flash('success','Email của bạn đã được gửi !');
        return redirect(route('admin.mailbox'));
    }
    public function getMailbox()
    {
        $email=Email::where('user_id', Auth::user()->id)->paginate(12);
        return view('layout.sent-mail', compact('email'));
    }
    public function getSearchMail(Request $req)
    {
        $search=Email::where('title','like','%'.$req->keyword.'%')->paginate(12);
        $count=count($search);
        return view('layout.search_mail',compact('search','count'));
    }
    public function getMailReceived()
    {
        $mail_received=Email::where('user_recive',Auth::user()->email)->paginate(12);
        //dd($mail_received);
        return view('layout.mail-received',compact('mail_received'));
    }
}
