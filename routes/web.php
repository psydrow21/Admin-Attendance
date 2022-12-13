<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ZKFetching;
use App\Http\Controllers\UserController;
use App\Mail\MailtrapExample;


use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Http\Middleware\CheckStatus;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Mail\Sample;
use Illuminate\Support\Facades\Mail;
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
//For After Login
Route::middleware('auth')->group(function(){

        Route::get('/main',[AdminController ::class, 'mainpage'])->name('main');
      
});
//Login Function
Route::controller(Login::class)->group(function () { 
    Route::get('/login', 'loginpage')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
    
    Route::get('/apicloud', [AdminController::class, 'apicloud'])->name('apicloud');
    
    Route::get('/attendancecontent' ,[AdminController::class , 'attendancecontent'])->name('attendancecontent');
    
    Route::get('/area' , [AdminController::class , 'area'])->name('area');
    });

//Option For Fetching Data    
Route::get('/sample', [AdminController::class, 'sample'])->name('sample');
Route::get('/f08', [ZKFetching::class, 'f08'])->name('f08');
Route::get('/main/list', [AdminController::class, 'getbiometrics'])->name('main.list');
Route::get('/addzk', [ZKFetching::class, 'fetchdata'])->name('addzk');
Route::get('/fetchspecific', [ZKFetching::class, 'fetchspecific'])->name('fetchspecific');
Route::get('/fetchattendancecount', [ZKFetching::class, 'fetchattendancecount'])->name('fetchattendancecount');
Route::get('/fetchdata', [ZKFetching::class, 'fetchdata'])->name('fetchdata');
Route::get('/cloud',[AdminController::class, 'cloud'])->name('cloud');

//own Filter
Route::get('/ownfilter', [ZkFetching::class, 'ownfilter'])->name('ownfilter');
//local Filter
Route::get('/attendancefilter', [ZKFetching::class, 'attendancefilter'])->name('attendancefilter');
//cloud Filter
Route::get('/cloudfilter', [ZKFetching::class, 'cloudfilter'])->name('cloudfilter');


// Option for Branches
Route::get('/teamdisplay', [AdminController::class , 'teamdisplay'])->name('teamdisplay');
Route::get('/branch', [AdminController::class, 'branch'])->name('branch');
Route::get('branchcode' , [AdminController::class , 'branchcode'])->name('branchcode');
Route::get('/companycontent', [AdminController::class , 'companylist'])->name('companycontent');
Route::get('/company', [AdminController::class, 'company'])->name('company');
Route::get('/district', [AdminController::class, 'district'])->name('district');
Route::get('/districtcontent', [AdminController::class, 'districtcontent'])->name('districtcontent');


// Option for Project Site Creation
Route::get('/oic', [AdminController::class, 'oic'])->name('oic');
Route::get('/pm', [AdminController::class, 'pm'])->name('pm');
Route::get('/teamcontent', [AdminController::class , 'teamcontent'])->name('teamcontent');
Route::get('/operationmanager', [AdminController::class , 'operationmanager'])->name('operationmanager');
Route::get('/projectmanager', [AdminController::class , 'projectmanager'])->name('projectmanager');
Route::get('/projectmanagercontent', [AdminController::class, 'projectmanagercontent'])->name('projectmanagercontent');
Route::get('/engineer', [AdminController::class , 'engineer'])->name('engineer');
Route::get('/projectengineercontent', [AdminController::class, 'projectengineercontent'])->name('projectengineercontent');
Route::get('/branchcontent', [AdminController::class, 'branchcontent'])->name('branchcontent');
Route::get('/branchdisplay', [AdminController::class, 'branchdisplay'])->name('branchdisplay');
Route::get('/areacontent', [AdminController::class, 'areacontent'])->name('areacontent');
Route::get('/areadisplay', [AdminController::class, 'areadisplay'])->name('areadisplay');


Route::get('/unregistered', [AdminController::class, 'unregistered'])->name('unregistered');

Route::get('/companycontents', [AdminController::class, 'companycontents'])->name('companycontents');
Route::get('/companydisplay', [AdminController::class, 'companydisplay'])->name('companydisplay');

Route::get('/userscount', [AdminController::class, 'userscount'])->name('userscount');
Route::get('/clouduserscount', [AdminController::class, 'clouduserscount'])->name('clouduserscount');
Route::post('/addnewemployeefunction' , [AdminController::class, 'addnewemployeefunction'])->name('addnewemployeefunction');

Route::get('/adddata', [AdminController::class, 'adddata'])->name('adddata');
Route::post('/addnewdepartment', [AdminController::class, 'addnewdepartment'])->name('addnewdepartment');

Route::get('userscontent', [AdminController::class, 'userscontent'])->name('userscontent');
Route::get('usersdisplay', [AdminController::class, 'usersdisplay'])->name('usersdisplay');
Route::get('cloudusersdisplay', [AdminController::class, 'cloudusersdisplay'])->name('cloudusersdisplay');

Route::webhooks('https://www.acs.multi-linegroupofcompanies.com');
Route::get('/update-docs', [\App\Http\Controllers\GitHubWebhookController::class ,'handleDocsHook']);

//Option For Max Team ID
Route::get('/addmaxteamid' , [AdminController::class , 'addmaxteamid'])->name('addmaxteamid');
Route::get('/addmaxcompanyid', [AdminController::class, 'addmaxcompanyid'])->name('addmaxcompanyid');

Route::get('/companycount', [AdminController::class, 'companycount'])->name('companycount');

Route::get('/branchescount', [AdminController::class, 'branchescount'])->name('branchescount');
//For adding new employee function
Route::post('/addnewemployee', [AdminController::class , 'addnewemployee'])->name('addnewemployee');
Route::post('/addnewcompany', [AdminController::class , 'addnewcompanyfunction'])->name('addnewcompany');
//Option for the Login

//Fetch Local into cloud
Route::get('localcloud', [Zkfetching::class, 'localcloud'])->name('localcloud');

//Display table of fetchcloud
Route::get('fetchcloud', [ZkFetching::class, 'fetchcloud'])->name('fetchcloud');

//Display table of fetchlocal
Route::get('fetchlocal', [ZkFetching::class, 'fetchlocal'])->name('fetchlocal');

//Counting of Late and Early Out
Route::get('latecount', [ZkFetching::class, 'latecount'])->name('latecount');
Route::get('locallatecount', [ZkFetching::class, 'locallatecount'])->name('locallatecount');
Route::get('earlyoutcount', [ZkFetching::class, 'earlyoutcount'])->name('earlyoutcount');
Route::get('localearlyoutcount', [ZkFetching::class, 'localearlyoutcount'])->name('localearlyoutcount');

//Add department Max ID
Route::get('/addmaxdepartmentid', [AdminController::class, 'addmaxdepartmentid'])->name('addmaxdepartmentid');

//For Testing 
Route::get('/webhooktesting', [AdminController::class, 'webhooktesting'])->name('webhooktesting');
Route::webhooks('webhook-receiving-url');

Route::get('getuser', [ZkFetching::class, 'getuser'])->name('getuser');


Route::get('/departmentdisplay', [AdminController::class , 'departmentdisplay'])->name('departmentdisplay');
Route::get('/departmentcontent', [AdminController::class, 'departmentcontent'])->name('departmentcontent');

Route::get('/positions', [AdminController::class, 'positions'])->name('positions');
Route::get('/posdisplay', [AdminController::class, 'posdisplay'])->name('posdisplay');
Route::get('/positioncontent', [AdminCOntroller::class, 'positioncontent'])->name('positioncontent');

Route::post('/adddepartmentfunction', [AdminController::class, 'adddepartmentfunction'])->name('adddepartmentfunction');

Route::get('/addmaxpositionsid', [AdminController::class, 'addmaxpositionsid'])->name('addmaxpositionsid');
Route::post('/addpositionsfunction', [AdminController::class, 'addpositionsfunction'])->name('addpositionsfunction');


Route::get('/biolocdisplay', [AdminController::class, 'biolocdisplay'])->name('biolocdisplay');
Route::get('/biolocation', [AdminController::class, 'biolocation'])->name('biolocation');

Route::get('/biolocalldisplay', [AdminController::class, 'biolocalldisplay'])->name('biolocalldisplay');
Route::get('/biolocationall', [AdminController::class, 'biolocationall'])->name('biolocationall');

Route::get('/payrollformatdisplay', [AdminController::class, 'payrollformatdisplay'])->name('payrollformatdisplay');
Route::get('/payrollcontent', [AdminController::class, 'payrollcontent'])->name('payrollcontent');


// Route::get('users/export/', [AdminController::class, 'export']);
Route::get('logs/export', [AdminController::class, 'export'])->name('exportlogs');

Route::get('/userssyncingfunction', [AdminController::class, 'userssyncingfunction'])->name('userssyncingfunction');
Route::get('/userscount', [AdminController::class, 'userscount'])->name('userscount');

Route::get('/payrollfilter', [AdminController::class, 'payrollfilter'])->name('payrollfilter');

Route::get('/piechart', [AdminController::class, 'piechart'])->name('piechart');

Route::get('/sample', [UserController::class, 'sample'])->name('sample');
Route::get('/users', 'UserController@index');  


Route::get('/ontimecount', [ZkFetching::class, 'ontimecount'])->name('ontimecount');

Route::get('/editcompanyfetch', [AdminController::class, 'editcompanyfetch'])->name('editcompanyfetch');

Route::get('/cloudtolocal', [ZkFetching::class, 'cloudtolocal'])->name('cloudtolocal');

Route::get('/send-mail2', function(){

    // $query = DB::table('users')->join('zkfetches', 'zkfetches.empid', 'users.empid')->orderBy('logs', 'DESC')->first();
//   dd($query);
   




    $mail_data1 = [
        'time_in'=> "",
        'status'=> "",
    ];

    $mail_data2 = [
        'time_out'=> "",
        'status'=> "",
    ];


    $datechecker = Carbon::today();
    $datechecker1 = date("Y-m-d",strtotime($datechecker));
    
    $query = DB::table('zkfetches')
                ->select('empid','logs', DB::raw("TIME_FORMAT(logs, '%H:%i:%s') as timelogs"))
                ->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)
                ->orderBy('logs', 'DESC')
                ->get();
                // ->unique('empid');
   

              
    $data = $query;
  
    $arr = array();

    if(count($data) > 0) {
        foreach($data as $key){

            $specificemail = DB::table('users')->where('empid', $key->empid)->first();
            
            array_push($arr, $specificemail);


       
           
            if($specificemail) {

                $timeinspan = date("H:i:s", strtotime('09:00:00'));
                $timeinspan2 = date("H:i:s", strtotime('13:00:00'));
                
                $timeinlast = date("H:i:s", strtotime($key->timelogs));

                //  if($timeinlast <= $timeinspan){
                    $lastinlogs = DB::table('zkfetches')
                    ->where('empid', $key->empid)
                    ->where('type', '0')
                    ->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)
                    ->where(DB::raw("(TIME_FORMAT(logs, '%H:%i:%s'))"), '<=' , $timeinspan)
                    // ->where(DB::raw("(TIME_FORMAT(logs, '%H:%i:%s'))"), '>=' , $timeinspan2)
                    ->orderBy('logs','DESC')
                    ->first();


                   
                  
                //  }
                //  else {
                //     $lastinlogs = '';
                //  }
                 
           
             
              
                 if($lastinlogs == NULL){
                    $lastinlogs = DB::table('zkfetches')
                    ->where('empid', $key->empid)
                    ->where('type', '0')
                    ->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)
                    // ->where(DB::raw("(TIME_FORMAT(logs, '%H:%i:%s'))"), '<=' , $timeinspan)
                    // ->where(DB::raw("(TIME_FORMAT(logs, '%H:%i:%s'))"), '>=' , $timeinspan2)
                    ->orderBy('logs','DESC')
                    ->first();
                 }
              
              
               
           
                // else {
                //     $lastinlogs->logs = '';
                // }
           
                // echo $timeinlast .'----- '. 
                // $timeinspan . '------ ' 
                //  $lastinlogs->logs .' ----------------------'
                // ;

                // echo $specificemail->email;
               


                
             
           

                $lastoutlogs = DB::table('zkfetches')
                ->where('empid', $key->empid)
                ->where('type', '1')
                ->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)
                ->orderBy('logs', 'DESC')->first();
            //     return$lastinlogs;
            //    echo $lastoutlogs;

       
            // TIME IN
            $text1 = 'No Logs';
            $state1 = '';
            $empid1 = '';
            $halfstate = '';
            
            
            // TIME OUT
            $text2 = 'No Logs';
            $state2 = '';
            $empid2 = '';


            
              
                if($lastinlogs){
                
                    $empid1 = $lastinlogs->empid;
                   //Time in Grace Period 

                 

                $checkin = date("H:i:s", strtotime('08:05:00'));
                //Considered as Late
                $checkinlate = date("H:i:s", strtotime('8:06'));


                //End of Late in TimeIn
                $checkinlateend = date("H:i:s", strtotime('11:59'));
                $checkin2nd = date("H:i:s", strtotime('12:00'));
                $checkin2ndend = date("H:i:s", strtotime('13:00'));

                $latestatus = date("H:i:s", strtotime($lastinlogs->logs));
                


                if($timeinspan >= $latestatus){
                    $text1 = $lastinlogs->logs;
                }else {
                    $text1 = $lastinlogs->logs;
                    $halfstate = 'Half Day';
                }

dd($lastinlogs);




                //Time check in 0:00 -> 8:05am
                if($latestatus <= $checkin){
                   
                }//Time check in Late 8:06am -> 11:59am
               else if ($latestatus >= $checkin && $latestatus <=$checkinlateend){
                $state1 = 'Late';
                }//Time check in 12pm -> 1pm
                else if($latestatus >= $checkin2nd && $latestatus <= $checkin2ndend){
                  
                }//Time check in 1pm onwards
                else if ($latestatus >= $checkin2ndend){
                $state1 = 'Late';               
                }else {
                    $state1 = '';
                }

                }


                

                if($lastoutlogs){
               
                    $empid2 = $lastoutlogs->empid;
                    // $lastoutlogs = NULL;
                //Checkout Time
                $checkin = date("H:i:s", strtotime('08:05:00'));
                $checkout = date("H:i:s", strtotime('12:00:00'));
                $checkoutend = date("H:i:s", strtotime('13:00:00'));
                $checkout2nd = date("H:i:s", strtotime('17:15:00'));
                $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
                
                $earlyoutstatus = date("H:i:s", strtotime($lastoutlogs->logs));
                if($earlyoutstatus <= $checkout && $earlyoutstatus >= $checkout2ndlimit && $earlyoutstatus >= $checkin){
                    $text2 = $lastoutlogs->logs;
                    $state2 = 'Early Out';
                } // 12 to 1 checkout  
                else if($earlyoutstatus >= $checkout && $earlyoutstatus <= $checkoutend){
                
                }  // 1 to 5 checkout
                else if ($earlyoutstatus >= $checkoutend && $earlyoutstatus <= $checkout2nd){
                  $text2 = $lastoutlogs->logs;
                  $state2 = 'Early Out';
                } // 5 onwards
                else if($earlyoutstatus >= $checkout2nd){
                    $text2 = $lastoutlogs->logs;
                } //Unavailable services
                else if ($earlyoutstatus <= $checkin){
                  
                }else {
                    $state2 = '';
                }

                }

                $mail_data1 = [
                    'empid' => $empid1,
                    'time_in'=> $text1,
                    'status'=> $state1,
                    'logstype'=> $halfstate,
                ];

                $mail_data2 = [
                    'empid' => $empid2,
                    'time_out'=> $text2,
                    'status'=> $state2,
                ];
                
        
               
               
                // Mail::to($specificemail->email)->send(new Sample($mail_data1,$mail_data2));
            }
  
         
         
        }
        dd($arr);
    }

// $data[] = [
//     'empid' => "'".$query->empid."'",
//     'logs' => $query->logs
// ];
//     foreach($query as $key){
//     }
//     return $data;
   
    return 'A message has been sent to Mailtrap!';
});

Route::get('/send-mail', function () {
    Mail::to('newuser@example.com')->send(new MailtrapExample());
    return 'A message has been sent to Mailtrap!';});



// Route::get('/samples', function(){


//     $fetchdata = DB::Connection('mysql')
//     ->table('users')
//     ->get(); 

  
//  foreach ($fetchdata as $value){

//     $userchecking = DB::Connection('mysql2')
//     ->table('users')
//     ->where('empid' , $value->empid)
//     ->exists();


               
//     if(!$userchecking){
//             DB::Connection('mysql2')
//                 ->table('users')
//                 ->insert(['role' => $value->role, 
//                     'empid' => $value->empid, 
//                         'district_code' => $value->district_code,
//                             'area_code' => $value->area_code,
//                                 'branch_code' => $value->branch_code, 
//                                     'company_id' => $value->company_id, 
//                                         'user_code' => $value->user_code,
//                                             'name' => $value->name, 
//                                                 'email' => $value->email,
//                                                     'username' => $value->username,
//                                                         'password' => $value->password]);
//     }
//  } 


// });

Route::get('/test-cloud', function() {
    echo 'Welcome to cloud';
})->name('test_cloud');


Route::get('/insert', function(Request $request){

    $fetchdata = DB::Connection('mysql')
    ->table('users')
    ->get(); 
    
    foreach($fetchdata as $data) {
        // $client = new \GuzzleHttp\Client();
        // $url = "https://www.acs.multi-linegroupofcompanies.com/public/userstocloud";
       
      
        // $request = $client->post($url,  $fetchdata);
        // $response = $request->send();
     
      
    }
    
    Http::get('http://127.0.0.1:8000/test-cloud');

    return;
});

Route::get('post', function(){
    // return 'test';
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', 'http://127.0.0.1:8000/api/store', [
        'form_params' => [
            'name' => 'krunal',
        ]
    ]);
    $response = $response->getBody()->getContents();
    echo '<pre>';
    print_r($response);
});

Route::get('/userscloudfunction',[AdminController::class, 'userscloudfunction'])->name('userscloudfunction');

Route::get('/userstocloud', function(){
 
    $fetchdata = DB::Connection('mysql')
    ->table('users')
    ->get(); 

//  foreach ($fetchdata as $value){
//     $userchecking = DB::Connection('mysql2')
//     ->table('users')
//     ->where('empid' , $value->empid)
//     ->exists();       
    // if(!$userchecking){
    //         DB::Connection('mysql2')
    //             ->table('users')
    //             ->insert(['bioloc_id' => $value->bioloc_id,
    //                 'role' => $value->role, 
    //                     'empid' => $value->empid, 
    //                         'district_code' => $value->district_code,
    //                             'area_code' => $value->area_code,
    //                                 'branch_code' => $value->branch_code, 
    //                                     'company_id' => $value->company_id, 
    //                                         'user_code' => $value->user_code,
    //                                             'name' => $value->name, 
    //                                                 'email' => $value->email,
    //                                                     'username' => $value->username,
    //                                                         'password' => $value->password]);
    //                                                         }
                                                 //}
    return response()->json($fetchdata, 200);
    
});


Route::get('/editcompanyfunction', [AdminController::class, 'editcompanyfunction'])->name('editcompanyfunction');


Route::get('/samplelogs', [AdminController::class, 'samplelogs'])->name('samplelogs');


Route::get('/biotocloud', function(){
    $biolocation = DB::table('tbl_bioloc_list')
                    ->get();
    return response()->json($biolocation, 200);
});

Route::get('/logstocloud', function(){
 
    $fetchdata = DB::Connection('mysql')
    ->table('zkfetches')
    ->get(); 

    return response()->json($fetchdata, 200);
    
});

Route::get('/samplecloud', [AdminController::class, 'samplecloud'])->name('samplecloud');


Route::get('/', function () {
    return view('login.login');
});


Route::get('/piechartwithtext', [AdminController::class, 'piechartwithtext'])->name('piechartwithtext');


Route::get('/qweqwe' , function (){


    $users = DB::table('zkfetches')
                ->select('logs')
                ->where('empid', 320)
                ->where(DB::raw('DATE_FORMAT(logs, "%Y-%m-%d")') ,'2022-11-03')
                ->where('type', 0)
                ->where(DB::raw('TIME_FORMAT(logs, "%h")') ,'<', '12')
                // ->whereIn('id', [3])
                ->orderBy('biometricsuid', 'DESC')
                ->first();

    

        return $users;

});

Route::get('/sync-bio-to-cloud', [AdminController::class, 'syncbio'])->name('syncbio');
Route::get('/profilecontent', [AdminController::class, 'profilecontent'])->name('profilecontent');

Route::get('/profiledisplay', [AdminController::class, 'profiledisplay'])->name('profiledisplay');


Route::get('/sampleabsent', function(){
   
    $datechecker = Carbon::today();
    $datechecker1 = date("Y-m-d",strtotime($datechecker));
  
        
    $query2 = DB::table('users')
    ->get();


    $querycount = DB::table('tbl_bioloc_list')
                    ->max('id');

    
    $querychecking = DB::table('tbl_bioloc_list')
    ->where('id', $querycount)
    ->first();

   
   
 
                foreach($query2 as $item){
                    $query = DB::table('zkfetches')      
                    // 
                    ->where('empid' , $item->empid) 
                    ->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)
                      ->orderBy('logs', 'DESC')
                      ->exists();
                    
                    // return $query2;
                    // $query3 = DB::table('users')
                    // ->where('empid', $item->empid)
                    // ->exists();
                    if(!$query){



                        $absentchecker = DB::table('zkabsents')
                        ->where('empid', $item->empid)
                        ->where('absent_date', $datechecker1)
                        ->exists();

                       
                        if(!$absentchecker){
                            $query4 = DB::table('zkabsents')
                            ->insert([
                            'serialnumber' => $querychecking->serialno, 
                            'empid' => $item->empid , 
                            'absents' => 'Absent', 
                            'absent_date' => now()->format('Y-m-d')]);
                        }

                    }

                  
                    // if(count($query) < 0){
                    //     // if(!$query3){
                    //         $query4 = DB::table('zkabsents')
                    //                 ->insert(['serialnumber' => "Insert", 'empid' => $item->empid , 'absents' => 'Absent']);
                                    
                    //     // }
                    // }
              

                   
                     
                }
                return ;
              

});

Route::get('/fetchabsentcount', [AdminController::class, 'absentscount'])->name('fetchabsentcount');

Route::get('/editbiolocfunction', [AdminController::class, 'editbiolocfunction'])->name('editbiolocfunction');

Route::get('/editdepartmentfunction', [AdminController::class, 'editdepartmentfunction'])->name('editdepartmentfunction');

Route::get('/sample-insert', function(){
    $absent = DB::table('zkabsents')->get();
    foreach($absent as $item){
        $client = new GuzzleHttp\Client();
        $res = $client->request('POST', 'https://www.acs.multi-linegroupofcompanies.com/api/cloudabsent', [
            'form_params' => [
                'serialnumber' => $item->serialnumber,
                'empid' => $item->empid,
                'absents' => $item->absents,
                'absent_date' => $item->absent_date
            ]]);
    }
    return response()->json(["message" => "Success"],200);
})->name('sample.insert');

Route::get('/insert-api', function(){
          //Get the logs
   $mydate = DB::Connection('mysql')
   ->table('zkfetches')
   ->select(DB::raw("DISTINCT DATE_FORMAT(logs, '%Y-%m-%d') as date"), 'empid', 'serial_no')
   ->get();
   //Get the users
    $users = DB::Connection('mysql')
    ->table('users')
    ->get();
    //Get the users data
    foreach($users as $key){
   
            //Get the data logs
            foreach($mydate as $datekey){
                //Check if the date is existing
                $mydatelogs = DB::Connection('mysql')
                ->table('zkfetches')
                ->where(DB::raw("DATE_FORMAT(logs , '%Y-%m-%d')"), $datekey->date)
                ->where('empid', $key->empid)
                ->exists();

                //If date is not exisitng
                if(!$mydatelogs){
                    // echo "<br>";
                    // echo "Absent ".$key->empid . " ---- ".$datekey->date;

                    //Get the absent logs if existing
                 $myabsentlogs = DB::Connection('mysql')
                                ->table('zkabsents')
                                ->where('empid',$key->empid)
                                ->where('absent_date',$datekey->date)
                                ->exists();
                 
                    if(!$myabsentlogs){
                        $client = new GuzzleHttp\Client();
                        $res = $client->request('POST', 'https://www.acs.multi-linegroupofcompanies.com/api/sample-api', [
                            'form_params' => [
                                'serialnumber' => trim($datekey->serial_no),
                                'empid' => $key->empid,
                                'absents' => "Absent",
                                'absent_date' => $datekey->date
                            ]]);
                    }
                }
                   
            
        }
       
    }
    return response()->json(['message' => 'Success'],200);
});


Route::get('/getuniquedate', function(){
    //Get the logs
   $mydate = DB::Connection('mysql')
   ->table('zkfetches')
   ->select(DB::raw("DISTINCT DATE_FORMAT(logs, '%Y-%m-%d') as date"), 'empid', 'serial_no')
   ->get();
   //Get the users
    $users = DB::Connection('mysql')
    ->table('users')
    ->get();

    //Get the users data
    foreach($users as $key){
   
            //Get the data logs
            foreach($mydate as $datekey){
                //Check if the date is existing
                $mydatelogs = DB::Connection('mysql')
                ->table('zkfetches')
                ->where(DB::raw("DATE_FORMAT(logs , '%Y-%m-%d')"), $datekey->date)
                ->where('empid', $key->empid)
                ->exists();

                //If date is not exisitng
                if(!$mydatelogs){
                    // echo "<br>";
                    // echo "Absent ".$key->empid . " ---- ".$datekey->date;

                    //Get the absent logs if existing
                 $myabsentlogs = DB::Connection('mysql')
                                ->table('zkabsents')
                                ->where('empid',$key->empid)
                                ->where('absent_date',$datekey->date)
                                ->exists();
                 
                    if(!$myabsentlogs){
                        $data = DB::Connection('mysql')
                        ->table('zkabsents')
                        ->insert(['serialnumber' => trim($datekey->serial_no), 'empid' => $key->empid, 'absents' => "Absent", 'absent_date' => $datekey->date]);
                    }
                }
                   
            
        }
       
    }
    return ;

    // foreach($mylogs as $key){

      
    //         foreach($mydate as $keydate){
    //             if($key->date == $keydate->date){
    //                 echo "Absent ". $key->empid;
    //             }
    //         }
         
       
      
    //      }



    return ;
 
});

Route::get('/getcloudlocation', function(){
    
    $localres = DB::table('tbl_bioloc_list')->get();
    
    foreach($localres as $item){
        $res = Http::post('https://www.acs.multi-linegroupofcompanies.com/api/cloudlocationfunction', 
        [
            'serialno' => $item->serialno,
                'location' => 'Multi-Multi'
        ]);
    }
  

});

Route::get('/api-logs', function(){
    $logs = DB::table('zkfetches')
    ->get();

    $users = DB::table('users')
    ->get();

    $location = DB::table('tbl_bioloc_list')
    ->get();

    foreach($logs as $item){
        $res = Http::post('https://www.acs.multi-linegroupofcompanies.com/api/cloudlogs', 
        [
            'biometricsuid' => $item->biometricsuid,
                'empid' => $item->empid,
                    'logs' => $item->logs,
                        'status' => $item->status,
                            'type' => $item->type,
                                'serial_no' => trim($item->serial_no)
        ]);
    }
});


Route::get('/getabsentlogs' , function(){
    $mydate = DB::Connection('mysql')
    ->table('zkfetches')
    ->select(DB::raw("DISTINCT DATE_FORMAT(logs, '%Y-%m-%d') as date"), 'empid', 'serial_no')
    ->get();
    //Get the users
     $users = DB::Connection('mysql')
     ->table('users')
     ->get();



     //Get the users data
     foreach($users as $key){
             //Get the data logs
             foreach($mydate as $datekey){
                 //Check if the date is existing
                 $mydatelogs = DB::Connection('mysql')
                 ->table('zkfetches')
                 ->where(DB::raw("DATE_FORMAT(logs , '%Y-%m-%d')"), $datekey->date)
                 ->where('empid', $key->empid)
                 ->exists();
                 //If date is not exisitng
                 if(!$mydatelogs){
                     // echo "<br>";
                     // echo "Absent ".$key->empid . " ---- ".$datekey->date;
                     //Get the absent logs if existing
                  $myabsentlogs = DB::Connection('mysql')
                                 ->table('zkabsents')
                                 ->where('empid',$key->empid)
                                 ->where('absent_date',$datekey->date)
                                 ->exists();
                     if(!$myabsentlogs){
                         $data = DB::Connection('mysql')
                         ->table('zkabsents')
                         ->insert(['serialnumber' => trim($datekey->serial_no), 'empid' => $key->empid, 'absents' => "Absent", 'absent_date' => $datekey->date]);
                     }
                 }  
         }
     }

     $absent = DB::table('zkabsents')
        ->get();

        dd($absent);
        foreach($absent as $item){
                $response = Http::post('https://www.acs.multi-linegroupofcompanies.com/api/cloudabsent', 
                [
                        'serialnumber' => $item->serialnumber,
                        'empid' => $item->empid,
                        'absents' => $item->absents,
                        'absent_date' => $item->absent_date
                ]);
        }
});