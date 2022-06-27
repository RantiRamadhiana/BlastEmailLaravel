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
use App\Models\templatemsg;
use App\Mail\UserEmail as MailPortal;
use App\Mail\UserMailtemplate as MailPortaltemplate;
use DB;
use Redirect;

class remindercontroller extends Controller
{
    public function sendemail(Request $request)
    {
        $msg = $request->all();
        $pesertaproa = pesertaproa::select('kelaspelatihan')->groupBy('kelaspelatihan')->get();
        $pesertaproaall = pesertaproa::all();

        if($request->action=='savereminderbtn'){
            $tandai = pesertaproa::select('email')->where('kelaspelatihan',$request->penerimapesan)->groupBy(['kelaspelatihan','email'])->get()->pluck('email');
            $bodyMail = $request->get('pesan');

            if($request->has('vouchercek')){
              $statvoucher='YES';
            }
            else{
              $statvoucher='NO';
            }

            foreach (collect($tandai)->chunk(3000) as $email) {
                $blog = Portal::create([
                   'subject'     => $request->subjek,
                   'datescheduling' => $request->dateschedule,
                   'timescheduling'   => $request->timeschedule,
                   'emailpeserta'   => $email,
                   'pesan'   => $bodyMail,
                   'kelaspelatihan'   => $request->penerimapesan,
                   'datetimeschedule' => date("Y-m-d H:i", strtotime(($request->dateschedule.' '.$request->timeschedule))),
                   'statusvoucher' => $statvoucher
                ]);
            }
            return \Redirect::back();
        }
        
        if($request->action=='sendbtn'){
            $tandai =pesertaproa::select('email')->where('kelaspelatihan', $request->penerimapesan)->groupBy(['kelaspelatihan','email'])->get()->pluck('email');
            $bodyMail = $request->get('pesan');
            $logerror = "";
            try{
                foreach ($tandai as $email) {
                  $namapeserta2 =pesertaproa::select('namapeserta')->where('email', $email)->limit(1)->get()->pluck('namapeserta');
       
                  $sbj = ($request->subjek).'-'.str_replace(array(']', '[', '"' ), '', $namapeserta2);

                  \Mail::to($email)->queue(new MailPortal($bodyMail,$sbj));
                }   
                $logerror = "No Errors, All Sent Successfully"; 
            }catch(\Exception $e){
                foreach ($tandai as $email) {
                  $logerror .= $email . " failed to send \n"; 
                }
                return view('logemail',['logerror'=>$logerror]);
            }
          return view('logemail',['logerror'=>$logerror]);
        }        
    }

    public function deletepeserta($idpeserta){
      DB::delete('delete from peserta where idpeserta = ?',[$idpeserta]);
      return \Redirect::back();
    }

    public function deleteall(){
      DB::delete('delete from peserta');
      return \Redirect::back();
    }

    public function download($file_name) {
      $file_path = public_path('../files/'.$file_name);
      return response()->download($file_path);
    }

    public function deleteallreminder(){
      DB::delete('delete from reminder');
      return \Redirect::back();
    }

    public function deleteallvoucher(){
      DB::delete('delete from kodevouchercdl2022');
      return \Redirect::back();
    }

    public function deletereminder($idreminder){
      DB::delete('delete from reminder where idreminder= ?',[$idreminder]);
      return \Redirect::back();
    }

    public function deletealltemplate(){
      DB::delete('delete from templatemail');
      return \Redirect::back();
    }

    public function deletetemplate($idtemplate){
      DB::delete('delete from templatemail where idtemplate = ?',[$idtemplate]);
      return \Redirect::back();
    }

    public function deletevoucher($idtemplate){
      DB::delete('delete from kodevouchercdl2022 where idtemplate= ?',[$idtemplate]);
      return \Redirect::back();
    }

    public function savetemplate(Request $request)
    {
      $msg = $request->all();     
      if($request->action=='savetemplatebtn'){
          $bodyMail = $request->get('pesan');
          $nametemplate = $request->get('subjek');

          $blog = templatemsg::create([
             'tema'     => $nametemplate.date('d').date('m').date('Y'),
             'voucher_code' => $bodyMail
          ]);           
          return \Redirect::back();
      }
    }
}
