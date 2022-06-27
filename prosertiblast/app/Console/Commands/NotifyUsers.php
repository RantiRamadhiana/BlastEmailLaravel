<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMailJob;
use Carbon\Carbon;
use App\Models\pesertaproa;
use App\Models\templatemsg;
use App\Models\Portal;
use App\Mail\UserMailtemplate as MailPortaltemplate;
use App\Mail\UserEmail as MailPortal;
use Illuminate\Support\Facades\Mail;


class NotifyUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //One hour is added to compensate for PHP being one hour faster 
        //$now = date("Y-m-d H:i", strtotime(Carbon::now()->addHour()));
        $now = date("Y-m-d H:i", strtotime(Carbon::now()));
        
        $msg = "NO";
        $msgyes = "YES";
        $messages = Portal::where('status','=',$msg)->get();

        if($messages !== null){
            //Get all messages that their dispatch date is due
            $messages->where('datetimeschedule','=', $now)->each(function($message) {
                if($message->status == "NO")
                {
                    $bodyMail =$message->pesan;
                    $email = json_decode($message->emailpeserta, true);
                    $vouc = $message->statusvoucher;

                    if($vouc=="YES"){
                        foreach ($email as $tandai) {
                            $templatee = templatemsg::select('email')->where('email','=',$tandai)->where('tema','=',$message->kelaspelatihan)->limit(1)->get()->pluck('email');

                            $g = str_replace(array(']', '[', '"' ), '',$templatee);
                           
                            
                            $namapeserta2=pesertaproa::select('namapeserta')->where('email', $tandai)->limit(1)->get()->pluck('namapeserta');
       
                            $sbj = ($message->subject).'-'.str_replace(array(']', '[', '"' ), '', $namapeserta2);

                            $vartmp =  templatemsg::select('voucher_code')->where('email', $tandai)->limit(1)->get()->pluck('voucher_code');
                            
                            $varvoucher= str_replace(array(']', '[', '"' ), '', $vartmp);

                            $vartmptema =  templatemsg::select('tema')->where('email',$tandai)->limit(1)->get()->pluck('tema');

                            $vartema = str_replace(array(']', '[', '"' ), '', $vartmptema);

                            $vartmpnama = templatemsg::select('nama')->where('email',$tandai)->limit(1)->get()->pluck('nama');

                            $varnama = str_replace(array(']','[','"'),'',$vartmpnama);          
                            
                            if(!empty($g)){
                                \Mail::to($g)->send(new MailPortaltemplate($bodyMail,$sbj,$varvoucher,$vartema,$varnama));
                            }              
                        }

                        if( count(\Mail::failures()) > 0 ) {
                           $errorlog = "There was one or more failures. They were: /r/n";

                            foreach(\Mail::failures() as $email_address) {
                               $errorlog .= " - $email_address /n/r";
                            }
                            $post2 = Portal::find($message->idreminder);
                            $post2->errorlog = $errorlog;
                            $post2->update();

                        } else {
                            $errorlog = "No errors, all sent successfully!";
                            $post2 = Portal::find($message->idreminder);
                            $post2->errorlog = $errorlog;
                            $post2->update();
                        } 

                    }
                    else{
                         /*dispatch(new SendMailJob(
                        $email, 
                        new UserEmail($bodyMail))
                        );*/
                        foreach ($email as $tandai) {
                            $namapeserta2=pesertaproa::select('namapeserta')->where('email', $tandai)->limit(1)->get()->pluck('namapeserta');
           
                            $sbj = ($message->subject).'-'.str_replace(array(']', '[', '"' ), '', $namapeserta2);

                            \Mail::to($tandai)->send(new MailPortal($bodyMail,$sbj));
                        }
                        if( count(\Mail::failures()) > 0 ) {
                            $errorlog = "There was one or more failures. They were: /r/n";

                           foreach(\Mail::failures() as $email_address) {
                               $errorlog .= " - $email_address /n/r";
                            }
                            $post2 = Portal::find($message->idreminder);
                            $post2->errorlog =$errorlog;
                            $post2->update();

                        } else {
                            $errorlog = "No errors, all sent successfully!";
                            $post2 = Portal::find($message->idreminder);
                            $post2->errorlog = $errorlog;
                            $post2->update();
                        } 
                    }
                             

                    //$message->status = 'YES';
                    //$message->save();   
                    $post = Portal::find($message->idreminder);
                    $post->status = "YES";
                    $post->lastsendtime = now();
                    $post->update();
                    info('sukses');
                }
            });
        }
    }
}
