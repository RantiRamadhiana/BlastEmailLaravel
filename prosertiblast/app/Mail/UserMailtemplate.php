<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMailtemplate extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $subject;
    public $varmsg;
    public $vartema;
    public $namapeserta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$subject,$varmsg,$vartema,$namapeserta)
    {
        $this->details = $details;
        $this->subject = $subject;
        $this->varmsg = $varmsg;
        $this->vartema = $vartema;
        $this->namapeserta =  $namapeserta;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $voucheroa = $this->varmsg;
        $vartema = $this->vartema;
        $namapeserta = $this->namapeserta;
        return $this->subject($this->subject)
        ->view('UserEmailtemplate')->with(['voucher'=>$voucheroa])->with(['tema'=>$vartema])->with(['namapeserta'=>$namapeserta]);
    }
}
