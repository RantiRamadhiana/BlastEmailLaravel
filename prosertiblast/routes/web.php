<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\remindercontroller;
use App\Http\Controllers\UsersController;
use App\Imports\UsersImport;
use App\Imports\templateImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\pesertaproa;
use App\Models\Portal;
use App\Models\templatemsg;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('masterhome');
});

Route::get('/blast',function () {
    return view('homeproa');
});

Route::get('/reminder',function () {
	$pesertaproa = pesertaproa::select('kelaspelatihan')->groupBy('kelaspelatihan')->get();

	$query = DB::raw("idreminder,kelaspelatihan,subject,datetimeschedule,(CASE WHEN status='YES' THEN 'Finished' ELSE 'Scheduled' END) as status");
	$datareminder = Portal::select($query)->groupBy('idreminder','kelaspelatihan','subject','datetimeschedule','status')->orderBy('datetimeschedule', 'desc')->get();

	$emailreminder = Portal::where('kelaspelatihan',$datareminder->all());
	
    return view('reminder.reminder')->with('pesertaproa',$pesertaproa)
    							->with('datareminder',$datareminder)
    							->with('emailreminder',$emailreminder);
});

Route::get('/remindertemplate',function () {
	$templatepsan = templatemsg::select('tema')->groupBy('tema')->get();

	$query = DB::raw("idreminder,kelaspelatihan,subject,datetimeschedule,(CASE WHEN status='YES' THEN 'Finished' ELSE 'Scheduled' END) as status");

	$datareminder = Portal::select($query)->groupBy('idreminder','kelaspelatihan','subject','datetimeschedule','status')->orderBy('datetimeschedule', 'desc')->get();

	$emailreminder = Portal::where('kelaspelatihan',$datareminder->all());
	
    return view('reminder.remindertemplate')->with('templatepsan',$templatepsan)
    							->with('datareminder',$datareminder)
    							->with('emailreminder',$emailreminder);
});

Route::get("/emailblastquick",function(){
	$pesertaproa = pesertaproa::select('kelaspelatihan')->groupBy('kelaspelatihan')->get();
	$pesertaproaall = pesertaproa::all();
    return view('reminder.blastmail',['pesertaproa'=>$pesertaproa], ['pesertaproaall'=>$pesertaproaall]);
});

Route::get('/wareminder',function () {
	$pesertaproa = pesertaproa::select('kelaspelatihan')->groupBy('kelaspelatihan')->get();
    return view('WAreminder',['pesertaproa'=>$pesertaproa]);
});

Route::get('/peserta',function () {
	$pesertaproa = pesertaproa::select('*')->orderBy('kelaspelatihan', 'asc')->get();
    return view('peserta',['pesertaproa'=>$pesertaproa]);
});

Route::post('/peserta', function () {
    Excel::import(new UsersImport, request()->file('file'));
    return back();
});

Route::post('/templatevoucher', function(){
	Excel::import(new templateImport, request()->file('file'));
	return back();
});

Route::get('/templatevoucher', function () {
	$templatepsn = templatemsg::select('*')->orderBy('tema', 'asc')->get();
    return view('templatepesan',['voucher'=>$templatepsn]);
});

Route::get('/send-mail',function(){
	$details=[
		'title'=>'mail from pusbang proserti',
		'body' => 'this is for testing mail using smtp'
	];

	\Mail::to('1214056rr@gmail.com')->send(new \App\Mail\UserEmail($details));
	dd("Email is Sent");
});

Route::post('masterhome', array('as' => 'log_in', 'uses' => 'remindercontroller@login'));

Route::view("/login","homeproa");


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sendmail','App\Http\Controllers\remindercontroller@sendemail')->name('sendmail');

Route::post('/savetemplate','App\Http\Controllers\remindercontroller@savetemplate')->name('savetemplate');

Route::get('/deletepeserta/{idpeserta}','App\Http\Controllers\remindercontroller@deletepeserta')->name('deletepeserta');

Route::get('/download/{file}', 'App\Http\Controllers\remindercontroller@download');

Route::get('/deleteall','App\Http\Controllers\remindercontroller@deleteall')->name('deleteall');

Route::get('/deleteallreminder','App\Http\Controllers\remindercontroller@deleteallreminder')->name('deleteallreminder');

Route::get('/deleteallvoucher','App\Http\Controllers\remindercontroller@deleteallvoucher')->name('deleteallvoucher');

Route::get('/sendwa','App\Http\Controllers\waappcontroller@createnotif')->name('sendwa');

Route::get('/deletereminder/{idreminder}','App\Http\Controllers\remindercontroller@deletereminder')->name('deletereminder');

Route::post('/updatemail','App\Http\Controllers\remindercontroller@updatemail')->name('updatemail');

Route::get('/templatepesan',function () {
	$templatemsg = templatemsg::select('*')->orderBy('tema', 'asc')->get();
    return view('templatepesan',['templatemsg'=>$templatemsg]);


Route::get('/deletealltemplate','App\Http\Controllers\remindercontroller@deletealltemplate')->name('deletealltemplate');
});

Route::get('/deletetemplate/{idtemplate}','App\Http\Controllers\remindercontroller@deletetemplate')->name('deletetemplate');

Route::get('/deletevoucher/{idtemplate}','App\Http\Controllers\remindercontroller@deletevoucher')->name('deletevoucher');



