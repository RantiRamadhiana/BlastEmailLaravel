<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Imports\pesertaimport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\pesertaproa;
use App\Models\Portal;
use App\Mail\UserEmail as MailPortal;
use DB;
use Redirect;

class waappcontroller extends Controller
{
    //whatsapp notification
    private function whatsappnotification(string $recipient){
        $sid = getenv("TWILIO_AUTH_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $wa_from= getenv("TWILIO_WHATSAPP_FROM");
        $twilio = new Client ($sid, $token);
        $body = "Reminder live session pelatihan professional academy";

         return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);

    }

    protected function createnotif(){
        $this->whatsappnotification('083194310369');
        return \Redirect::back();
    }
}
