<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Rats\Zkteco\Lib\ZKTeco;
use App\Models\zkfetch;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

use App\Mail\Sample;
use Illuminate\Support\Facades\Mail;
use DB;
class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
       //Local Insertion and Local to Cloud location
        $schedule->call(function(){
            //Biometrics into local Location
            //If biometrics is connected uncomment and set the ip address and lcoation
            // $zk = new ZKTeco('192.168.0.68');
            // $zk->connect();  
            $location = '4th Floor Multiline Head Office';
            // $serialnumber = $zk->serialNumber();
            
            //Delete or Comment this line if biometrics is connected
             $serialnumber = '~SerialNumber=LSR201361907';
             $checking = DB::table('tbl_bioloc_list')
                            ->where('serialno' , $serialnumber)
                            ->first();
            if(!$checking){
                   DB::table('tbl_bioloc_list')
                   ->insert(['serialno' => trim($serialnumber), 'location' => $location]);
            }
            $checking = DB::table('tbl_bioloc_list')
                        ->where('serialno' , $serialnumber)
                        ->get();
               foreach($checking as $value){
                if($serialnumber != $value->serialno){          
                    DB::table('tbl_bioloc_list')
                    ->insert(['serialno' => $serialnumber, 'location' => $location]);
                }
               }

            //Local to Cloud using API
            $localres = DB::table('tbl_bioloc_list')->get();
            foreach($localres as $item){
                $res = Http::post('https://www.acs.multi-linegroupofcompanies.com/api/cloudlocationfunction', 
                [
                    'serialno' => $item->serialno,
                        'location' => $item->location
                ]);
            }
        })->name('location')->everyFiveMinute();
        // Biometrics to local system
        $schedule->call(function (){
            //Setup of biometrics 
            //     $zk = new ZKTeco('192.168.0.163');
            //     $zk->connect();  
            //    $serialnumber = $zk->serialNumber();
            //    $array = $zk->getAttendance();

            //     foreach($array as $item) { 
            //         $checking = zkfetch::where('biometricsuid', $item['uid'])->exists();
            //         if(!$checking){
            //             //Insert of biometrics into local
            //             $users = zkfetch::create(['biometricsuid' => $item["uid"], 'logs' => $item["timestamp"], 'empid' => $item["id"],
            //              'type' => $item["type"], 'status' => $item["state"],
            //              'serial_no' => $serialnumber]);
            //         }
            //     }

            $logs = DB::table('zkfetches')
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


        })->name('biolocalcloudlogs')->everyFiveMinute();

        //Email of Todays Logs
        $schedule->call(function(){
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
                        ->select('empid','logs')
                        ->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)
                        ->orderBy('logs', 'DESC')
                        ->get()
                        ->unique('empid');
            $data = $query;
            if(count($data) > 0) {
                foreach($data as $key){
                    $specificemail = DB::table('users')->where('empid', $key->empid)->first();
                    if($specificemail) {
                        // echo $specificemail->email;
                        $lastinlogs = DB::table('zkfetches')->where('empid', $key->empid)->where('type', '0')->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)->orderBy('logs','DESC')->first();
                        $lastoutlogs = DB::table('zkfetches')->where('empid', $key->empid)->where('type', '1')->where(DB::raw("(DATE_FORMAT(logs, '%Y-%m-%d'))"), $datechecker1)->orderBy('logs', 'DESC')->first();
                    //     return$lastinlogs;
                    //    echo $lastoutlogs;
                    // TIME IN
                    $text1 = 'No Logs';
                    $state1 = '';
                    $empid1 = '';
                    // TIME OUT
                    $text2 = 'No Logs';
                    $state2 = '';
                    $empid2 = '';
                        if($lastinlogs){
                            $text1 = $lastinlogs->logs;
                            $empid1 = $lastinlogs->empid;
                           //Time in Grace Period 
                        $checkin = date("H:i:s", strtotime('08:05:00'));
                        //Considered as Late
                        $checkinlate = date("H:i:s", strtotime('8:06'));
                        //End of Late in TimeIn
                        $checkinlateend = date("H:i:s", strtotime('11:59'));
                        $checkin2nd = date("H:i:s", strtotime('12:00'));
                        $checkin2ndend = date("H:i:s", strtotime('13:00'));
        
                        $latestatus = date("H:i:s", strtotime($text1));
                         //Time check in 0:00 -> 8:05am
                        if($latestatus <= $checkin){
                        }//Time check in Late 8:06am -> 11:59am
                       else if ($latestatus >= $checkin && $latestatus <=$checkinlateend){
                        $state1 = 'Late';
                        }//Time check in 12pm -> 1pm
                        else if($latestatus >= $checkin2nd && $latestatus <= $checkin2ndend){
                          
                        }//Time check in 1pm onwards
                        else if ($latestatus >= $checkin2ndend){
                        $state1 = 'Late';                }else {
                            $state1 = '';
                        }
                        }
                        if($lastoutlogs){
                            $text2 = $lastoutlogs->logs ;
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
                            $state2 = 'Early Out';
                        } // 12 to 1 checkout  
                        else if($earlyoutstatus >= $checkout && $earlyoutstatus <= $checkoutend){
                        }  // 1 to 5 checkout
                        else if ($earlyoutstatus >= $checkoutend && $earlyoutstatus <= $checkout2nd){
                          $state2 = 'Early Out';
                        } // 5 onwards
                        else if($earlyoutstatus >= $checkout2nd){
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
                        ];
                        $mail_data2 = [
                            'empid' => $empid2,
                            'time_out'=> $text2,
                            'status'=> $state2,
                        ];
                        Mail::to($specificemail->email)->send(new Sample($mail_data1,$mail_data2));
                    }
          
                }
            }
        })->name('email')->everyFiveMinutes();
        //Local Absent and Cloud absent
        $schedule->call(function(){

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
                foreach($absent as $item){
                        $response = Http::post('https://www.acs.multi-linegroupofcompanies.com/api/cloudabsent', 
                        [
                                'serialnumber' => $item->serialnumber,
                                'empid' => $item->empid,
                                'absents' => $item->absents,
                                'absent_date' => $item->absent_date
                        ]);
                }

        })->name('absents')->dailyAt('09:00');
  
 


        //Change the ip address and location per branch
        // $schedule->call(function (){
        //     // $zk = new ZKTeco('192.168.0.68');
        //     // $zk->connect();  
        //     $location = '4th Floor Multiline Head Office';
        //     // $serialnumber = $zk->serialNumber();
        //     // $serialnumber = '~SerialNumber=LSR201361906';
        //     $serialnumber = '~SerialNumber=0263142300007';
        //     $checking = DB::table('tbl_bioloc_list')
        //                     ->where('serialno' , $serialnumber)
        //                     ->first();
        //     if(!$checking){
        //            DB::table('tbl_bioloc_list')
        //            ->insert(['serialno' => trim($serialnumber), 'location' => $location]);
        //     }
        //     $checking = DB::table('tbl_bioloc_list')
        //                 ->where('serialno' , $serialnumber)
        //                 ->get();
        //        foreach($checking as $value){
        //         if($serialnumber != $value->serialno){          
        //             DB::table('tbl_bioloc_list')
        //             ->insert(['serialno' => $serialnumber, 'location' => $location]);
        //         }
        //        }
        // })->name('locallocation')->everyMinute();

        //Change the ip address and location per branch
        // $schedule->call(function (){
        //     //If the biometrics is connected you must change the ip address and uncomment this function and delete the serialnumber string
        //     // $zk = new ZKTeco('192.168.0.163');
        //     // $zk->connect();  
        //     // $serialnumber = trim($zk->serialNumber());

        //     $location = 'Multiline Head Office';
        //     $serialnumber = '~SerialNumber=0263142300007';
           
        //     $cloudchecking = DB::Connection('mysql2')
        //     ->table('tbl_bioloc_list')
        //     ->where('serialno', $serialnumber)
        //     ->exists();  

        //     if(!$cloudchecking){
        //         DB::Connection('mysql2')
        //         ->table('tbl_bioloc_list')
        //         ->insert(['serialno' => $serialnumber, 'location' => $location]);
        //     }     
        // })->name('cloudlocation')->everyMinute();

        // $schedule->call(function(){

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
        //                 ->insert(['bioloc_id' => $value->bioloc_id,
        //                     'role' => $value->role, 
        //                         'empid' => $value->empid, 
        //                             'district_code' => $value->district_code,
        //                                 'area_code' => $value->area_code,
        //                                     'branch_code' => $value->branch_code, 
        //                                         'company_id' => $value->company_id, 
        //                                             'user_code' => $value->user_code,
        //                                                 'name' => $value->name, 
        //                                                     'email' => $value->email,
        //                                                         'username' => $value->username,
        //                                                             'password' => $value->password]);
        //     }
        //  } 
          
          
          
       
        // })->name('userslocaltocloud');
       
    
        // $schedule->call(function () {
        //  $fetchlocal = DB::table('zkfetches')->get();
        //      foreach($fetchlocal as $item) { 
        //         $checking = DB::Connection('mysql2')
        //                     ->table('zkfetches')
        //                     ->where('biometricsuid', $item->biometricsuid)
        //                     ->where('serial_no', $item->serial_no)
        //                     ->exists();
        //         if(!$checking){
        //             $users = DB::Connection('mysql2')
        //                     ->table('zkfetches')
        //                     ->insert(['biometricsuid' => $item->biometricsuid, 'logs' => $item->logs, 'empid' => $item->empid,
        //                             'type' => $item->type, 'status' => $item->status,
        //                             'serial_no' => trim($item->serial_no)]);
        //         }
        //  }})->name('biolocaltocloud')->everyMinute();
            
     
    
    }

    
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
