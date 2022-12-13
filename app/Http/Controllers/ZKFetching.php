<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Rats\Zkteco\Lib\ZKTeco;
use App\Models\zkfetch;
use Illuminate\Http\Request;
use Auth;
use DB;

use DataTables;
use Response;
use Carbon\Carbon;
// use JsonResponse;

use Spatie\WebhookServer\WebhookServerServiceProvider;
class ZKFetching extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function ontimecount(){
        // $dt = Carbon::today()->addDays(-15);
        $dt = Carbon::now('m');
    
        $users = DB::Connection('mysql')
        ->table('zkfetches')
        ->join('users', 'users.empid' , 'zkfetches.empid')
        ->where('zkfetches.empid', Auth::user()->empid)
        ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m")'), '>=' ,$dt->format("Y-m"))
        ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                    'zkfetches.serial_no as serial_no')
        ->get();

      

      
      

     
        //Time in Grace Period 
        $checkin = date("H:i:s", strtotime('08:05:00'));
        //Considered as Late
        $checkinlate = date("H:i:s", strtotime('8:06'));
        //End of Late in TimeIn
        $checkinlateend = date("H:i:s", strtotime('11:59'));
        $checkin2nd = date("H:i:s", strtotime('12:00'));
        $checkin2ndend = date("H:i:s", strtotime('13:00'));

        //Checkout Time
        $checkout = date("H:i:s", strtotime('12:00:00'));
        $checkoutend = date("H:i:s", strtotime('13:00:00'));
        $checkout2nd = date("H:i:s", strtotime('17:15:00'));
        $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));

        // $time = $state . $checkin;
        // return $time;

      

        // return $time;
        $ontimecount = 0;
       
        foreach($users as $value){
            $state = date("H:i:s", strtotime($value->logs));
            if($value->type == '0'){
                //Time check in 0:00 -> 8:05am
                if($state <= $checkin){
                    $ontimecount++;   
                }//Time check in Late 8:06am -> 11:59am
               else if ($state >= $checkin && $state <=$checkinlateend){
                }//Time check in 12pm -> 1pm
                else if($state >= $checkin2nd && $state <= $checkin2ndend){
                    $ontimecount++;
                }//Time check in 1pm onwards
                else if ($state >= $checkin2ndend){
            }

        } if($value->type == '1'){
            if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
             
           } // 12 to 1 checkout  
           else if($state >= $checkout && $state <= $checkoutend){
                $ontimecount++;
           }  // 1 to 5 checkout
           else if ($state >= $checkoutend && $state <= $checkout2nd){
             
           } // 5 onwards
           else if($state >= $checkout2nd){
            $ontimecount++;
           } //Unavailable services
           else if ($state <= $checkin){
           }
       }  
    }
    return $ontimecount;
}
// local late count
public function locallatecount(){
        
    // $dt = Carbon::today()->addDays(-15);
    $dt = Carbon::now('m');

    $users = DB::table('zkfetches')
    ->join('users', 'users.empid' , 'zkfetches.empid')
    ->where('zkfetches.empid', Auth::user()->empid)
    ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m")'), '>=' ,$dt->format("Y-m"))
    ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                'zkfetches.serial_no as serial_no')
    ->get();

  
 

    //Time in Grace Period 
    $checkin = date("H:i:s", strtotime('08:05:00'));
    //Considered as Late
    $checkinlate = date("H:i:s", strtotime('8:06'));
    //End of Late in TimeIn
    $checkinlateend = date("H:i:s", strtotime('11:59'));
    $checkin2nd = date("H:i:s", strtotime('12:00'));
    $checkin2ndend = date("H:i:s", strtotime('13:00'));

  

    // return $time;
    $latecount = 0;
    foreach($users as $value){
        $state = date("H:i:s", strtotime($value->logs));
        if($value->type == '0'){
            //Time check in 0:00 -> 8:05am
            if($state <= $checkin){
           
            }//Time check in Late 8:06am -> 11:59am
           else if ($state >= $checkin && $state <=$checkinlateend){
            $latecount++;
            }//Time check in 12pm -> 1pm
            else if($state >= $checkin2nd && $state <= $checkin2ndend){
              
            }//Time check in 1pm onwards
            else if ($state >= $checkin2ndend){
              $latecount++;                }
        }

    }

    return $latecount;
  

 }

     public function latecount(){
        
        // $dt = Carbon::today()->addDays(-15);
        $dt = Carbon::now('m');
    
        $users = DB::Connection('mysql')
        ->table('zkfetches')
        ->join('users', 'users.empid' , 'zkfetches.empid')
        ->where('zkfetches.empid', Auth::user()->empid)
        ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m")'), '>=' ,$dt->format("Y-m"))
        ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                    'zkfetches.serial_no as serial_no')
        ->get();

      
   

        //Time in Grace Period 
        $checkin = date("H:i:s", strtotime('08:05:00'));
        //Considered as Late
        $checkinlate = date("H:i:s", strtotime('8:06'));
        //End of Late in TimeIn
        $checkinlateend = date("H:i:s", strtotime('11:59'));
        $checkin2nd = date("H:i:s", strtotime('12:00'));
        $checkin2ndend = date("H:i:s", strtotime('13:00'));

      

        // return $time;
        $latecount = 0;
        foreach($users as $value){
            $state = date("H:i:s", strtotime($value->logs));
            if($value->type == '0'){
                //Time check in 0:00 -> 8:05am
                if($state <= $checkin){
               
                }//Time check in Late 8:06am -> 11:59am
               else if ($state >= $checkin && $state <=$checkinlateend){
                $latecount++;
                }//Time check in 12pm -> 1pm
                else if($state >= $checkin2nd && $state <= $checkin2ndend){
                  
                }//Time check in 1pm onwards
                else if ($state >= $checkin2ndend){
                  $latecount++;                }
            }

        }

        return $latecount;
      

     }

     public function localearlyoutcount(){

        $dt = Carbon::now('m');

        $users = DB::table('zkfetches')
        ->join('users', 'users.empid' , 'zkfetches.empid')
        ->where('zkfetches.empid', Auth::user()->empid)
        ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->format("Y-m"))
        ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                    'zkfetches.serial_no as serial_no')
        ->get();

        //Time in Grace Period 
        $checkin = date("H:i:s", strtotime('08:05:00'));
        //Considered as Late
        $checkinlate = date("H:i:s", strtotime('8:06'));
        //End of Late in TimeIn
        $checkinlateend = date("H:i:s", strtotime('11:59'));
        $checkin2nd = date("H:i:s", strtotime('12:00'));
        $checkin2ndend = date("H:i:s", strtotime('13:00'));

        //Checkout Time
        $checkout = date("H:i:s", strtotime('12:00:00'));
        $checkoutend = date("H:i:s", strtotime('13:00:00'));
        $checkout2nd = date("H:i:s", strtotime('17:15:00'));
        $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
        // $time = $state . $checkin;
        // return $time;
        $earlyoutcount = 0;
        foreach($users as $value){
            $state = date("H:i:s", strtotime($value->logs));
            if($value->type == '1'){
                if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                   $earlyoutcount++;
               } // 12 to 1 checkout  
               else if($state >= $checkout && $state <= $checkoutend){
               }  // 1 to 5 checkout
               else if ($state >= $checkoutend && $state <= $checkout2nd){
                  $earlyoutcount++;
               } // 5 onwards
               else if($state >= $checkout2nd){
               } //Unavailable services
               else if ($state <= $checkin){
               }
           }  
        }
        return $earlyoutcount;
     }

     // Cloud early out count
     public function earlyoutcount(){

        $dt = Carbon::now('m');

        $users = DB::Connection('mysql')
        ->table('zkfetches')
        ->join('users', 'users.empid' , 'zkfetches.empid')
        ->where('zkfetches.empid', Auth::user()->empid)
        ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->format("Y-m"))
        ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                    'zkfetches.serial_no as serial_no')
        ->get();

            
       

   
        

        //Time in Grace Period 
        $checkin = date("H:i:s", strtotime('08:05:00'));
        //Considered as Late
        $checkinlate = date("H:i:s", strtotime('8:06'));
        //End of Late in TimeIn
        $checkinlateend = date("H:i:s", strtotime('11:59'));
        $checkin2nd = date("H:i:s", strtotime('12:00'));
        $checkin2ndend = date("H:i:s", strtotime('13:00'));

        //Checkout Time
        $checkout = date("H:i:s", strtotime('12:00:00'));
        $checkoutend = date("H:i:s", strtotime('13:00:00'));
        $checkout2nd = date("H:i:s", strtotime('17:15:00'));
        $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
        // $time = $state . $checkin;
        // return $time;
        $earlyoutcount = 0;
        foreach($users as $value){
            $state = date("H:i:s", strtotime($value->logs));
            if($value->type == '1'){
                if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                   $earlyoutcount++;
               } // 12 to 1 checkout  
               else if($state >= $checkout && $state <= $checkoutend){
               
               }  // 1 to 5 checkout
               else if ($state >= $checkoutend && $state <= $checkout2nd){
                  $earlyoutcount++;
               } // 5 onwards
               else if($state >= $checkout2nd){
              
               } //Unavailable services
               else if ($state <= $checkin){
                 
               }
           }  

        }

        return $earlyoutcount;
      
     }

     public function cloudtolocal(){
       
        $fetchdata = DB::Connection('mysql')
        ->table('users')
        ->get(); 

      
     foreach ($fetchdata as $value){

        if (Auth::user()->bioloc_id == $value->bioloc_id){
            $userchecking = DB::Connection('mysql')
            ->table('users')
            ->where('empid' , $value->empid)
          
            ->exists();
    
    
                       
            if(!$userchecking){
                    DB::Connection('mysql')
                        ->table('users')
                        ->insert(['bioloc_id' => $value->bioloc_id,
                                        'role' => $value->role, 
                                            'empid' => $value->empid, 
                                                'district_code' => $value->district_code,
                                                    'area_code' => $value->area_code,
                                                        'branch_code' => $value->branch_code, 
                                                            'company_id' => $value->company_id, 
                                                                'user_code' => $value->user_code,
                                                                    'name' => $value->name, 
                                                                        'email' => $value->email,
                                                                            'username' => $value->username,
                                                                                'password' => $value->password]);
                            }
        }
   
     } 
     }


    //Local database filtering
    public function attendancefilter(Request $request)
    {
        $fromDate = $request->from;
        $toDate =  $request->to;
        $lastfilter = $request->filter;
        if($fromDate != "" && $toDate != ""){
            $query = DB::table('zkfetches')
            //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
              ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$fromDate)
              ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '<=' ,$toDate)
              ->get();
        }else if($lastfilter != ""){
                if($lastfilter == "Today"){
                    $dt = Carbon::today();
                    $query = DB::table('zkfetches')
                    //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
                      ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                      ->get();
                }else if($lastfilter == "Yesterday") {
                    $dt = Carbon::today()->addDays(-1);
                    $query = DB::table('zkfetches')
                     ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                      ->get();
                }else if($lastfilter == "Last15"){
                    $dt = Carbon::today()->addDays(-15);
                    $query = DB::table('zkfetches')
                     ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                      ->get();
                }else if ($lastfilter == "LastMonth"){
                    $dt = Carbon::today()->subMonth();

                    $query = DB::table('zkfetches')
                     ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                     
                      ->get();
                }
        }

 

              
      
// return $query;
                    return DataTables::of($query)
                    ->addColumn('type', function($row){
                        $actionBtn = '';
                        if($row->type=='0'){$actionBtn = 'IN'; }else if($row->type=='1'){$actionBtn = 'OUT'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
                        return $actionBtn;
                    })
                    
                    ->addColumn('status', function($row){
                        $actionBtn = '';
                        if($row->status=='1'){$actionBtn = 'Biometrics';}else {$actionBtn = 'HashCard';}
                        return $actionBtn;
                    })
            
                    ->addColumn('date', function($row){
                        $actionBtn = '';
                        $actionBtn = date("Y-m-d", strtotime($row->logs));
                        return $actionBtn;
                    })
                    ->addColumn('time', function($row){
                        $actionBtn = '';
                        $actionBtn = date("h:i:s a", strtotime($row->logs));
                        return $actionBtn;
                    })
                    ->addColumn('serial_no', function($row){
                        $actionBtn = '';
            
                $serialchecking = DB::Connection('mysql')
                                ->table('tbl_bioloc_list')
                                ->where('serialno', trim($row->serial_no))
                                ->exists();

                if($serialchecking){
                    $serialdisplay = DB::Connection('mysql')
                                    ->table('tbl_bioloc_list')
                                    ->where('serialno', trim($row->serial_no))
                                    ->first();

                    $actionBtn = $serialdisplay->location;
     
                }
               else {
                    $actionBtn = 'Unknown';
                }
                return $actionBtn;
                    })
                    ->addColumn('state', function($row){
                        $state = date("H:i:s", strtotime($row->logs));
                        //Time in Grace Period 
                        $checkin = date("H:i:s", strtotime('08:05:00'));
                        //Considered as Late
                        $checkinlate = date("H:i:s", strtotime('8:06'));
                        //End of Late in TimeIn
                        $checkinlateend = date("H:i:s", strtotime('11:59'));
                        $checkin2nd = date("H:i:s", strtotime('12:00'));
                        $checkin2ndend = date("H:i:s", strtotime('13:00'));
            
                        //Checkout Time
                        $checkout = date("H:i:s", strtotime('12:00:00'));
                        $checkoutend = date("H:i:s", strtotime('13:00:00'));
                        $checkout2nd = date("H:i:s", strtotime('17:15:00'));
                        $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
            
                        // $time = $state . $checkin;
                        // return $time;
                        $actionBtn = '';
                 
                        // Checking if type is Time in,Time Out, Overtime in , Overtime out
                        // Time in = 0, Time out = 1, Overtime in = 4, Overtime out = 5
                        //Time in
                        if($row->type == '0'){
                            //Time check in 0:00 -> 8:05am
                            if($state <= $checkin){
                                $actionBtn = '<span style="color:green">On Time</span>';
                           }//Time check in Late 8:06am -> 11:59am
                           else if ($state >= $checkin && $state <=$checkinlateend){
                                $actionBtn = '<span style="color:red;">Late<span>';
                            }//Time check in 12pm -> 1pm
                            else if($state >= $checkin2nd && $state <= $checkin2ndend){
                                $actionBtn = '<span style="color:green">On Time</span>';
                            }//Time check in 1pm onwards
                            else if ($state >= $checkin2ndend){
                                $actionBtn = '<span style="color:red;">Late<span>';
                            }
                        }
                    
                    //time out
                        else if($row->type == '1'){
                             if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                                $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                            } // 12 to 1 checkout  
                            else if($state >= $checkout && $state <= $checkoutend){
                                $actionBtn = '<span style="color:green">On Time</span>';
                            }  // 1 to 5 checkout
                            else if ($state >= $checkoutend && $state <= $checkout2nd){
                                $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                            } // 5 onwards
                            else if($state >= $checkout2nd){
                                $actionBtn = '<span style="color:green">On Time</span>';
                            } //Unavailable services
                            else if ($state <= $checkin){
                                $actionBtn = '<span style="color:red">Unavailable</span>';
                            }
                        }   
                         else if($row->type == '4'){
            
                         }
            
                        // if ($state <= $checkin && $row->type == '0'){
                        //     $actionBtn = "On Time";
                        // }
                        
                        // elseif ($state >= $checkin && $state <= $checkinlateend && $row->type == '0'){
                        //     $actionBtn = "Late";
                        // }
                        return $actionBtn;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['state'])
                    ->make(true);
    }
     
      //Cloud database filtering
      public function cloudfilter(Request $request)
      {
          $fromDate = $request->from;
          $toDate =  $request->to;
          $lastfilter = $request->filter;
          $locationfilter = $request->location;
          
          
          //If location and last filter is not null
        if($locationfilter != "" && $lastfilter != "" && $fromDate == "" && $toDate == ""){
            $query = DB::Connection('mysql')->table('zkfetches')
            //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
              ->where('serial_no', $locationfilter)
              ->get();

              if($lastfilter == "Today"){
                $dt = Carbon::today();
                $query = DB::Connection('mysql')->table('zkfetches')
                //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
                  ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                  ->where('serial_no', $locationfilter)
                  ->get();
            }else if($lastfilter == "Yesterday") {
                $dt = Carbon::today()->addDays(-1);
                $query = DB::Connection('mysql')->table('zkfetches')
                 ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                 ->where('serial_no', $locationfilter)
                  ->get();
            }else if($lastfilter == "Last15"){
                $dt = Carbon::today()->addDays(-15);
                $query = DB::Connection('mysql')->table('zkfetches')
                 ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                 ->where('serial_no', $locationfilter)
                  ->get();
            }else if ($lastfilter == "LastMonth"){
                $dt = Carbon::today()->subMonth();

                $query = DB::Connection('mysql')->table('zkfetches')
                 ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                 ->where('serial_no', $locationfilter)
                  ->get();
            }

        }else if ($locationfilter != "" && $lastfilter == "" && $fromDate != "" && $toDate != ""){
            $query = DB::Connection('mysql')->table('zkfetches')
              ->where('serial_no', $locationfilter)
              ->get();

              if($fromDate != "" && $toDate != "" && $locationfilter != ""){
                $query = DB::Connection('mysql')
                ->table('zkfetches')
                ->where('serial_no', $locationfilter)
                ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$fromDate)
                ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '<=' ,$toDate)
                ->get();

        }
    }
        // 
        else {    
            if($locationfilter != ""){
            $query = DB::Connection('mysql')->table('zkfetches')
            //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
              ->where('serial_no', $locationfilter)
              ->get();
        }

        if($fromDate != "" && $toDate != ""){
            $query = DB::Connection('mysql')->table('zkfetches')
            //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
              ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$fromDate)
              ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '<=' ,$toDate)
              ->get();
        }else if($lastfilter != ""){
                if($lastfilter == "Today"){
                    $dt = Carbon::today();
                    $query = DB::Connection('mysql')->table('zkfetches')
                    //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
                      ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                      ->get();
                }else if($lastfilter == "Yesterday") {
                    $dt = Carbon::today()->addDays(-1);
                    $query = DB::Connection('mysql')->table('zkfetches')
                     ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                      ->get();
                }else if($lastfilter == "Last15"){
                    $dt = Carbon::today()->addDays(-15);
                    $query = DB::Connection('mysql')->table('zkfetches')
                     ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                      ->get();
                }else if ($lastfilter == "LastMonth"){
                    $dt = Carbon::today()->subMonth();

                    $query = DB::Connection('mysql')->table('zkfetches')
                     ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                      ->get();
                }
        }  }
  
   
  
                
        
  // return $query;
                      return DataTables::of($query)
                      ->addColumn('type', function($row){
                          $actionBtn = '';
                          if($row->type=='0'){$actionBtn = 'IN'; }else if($row->type=='1'){$actionBtn = 'OUT'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
                          return $actionBtn;
                      })
                      
                      ->addColumn('status', function($row){
                          $actionBtn = '';
                          if($row->status=='1'){$actionBtn = 'Biometrics';}else {$actionBtn = 'HashCard';}
                          return $actionBtn;
                      })
              
                
                      
                      ->addColumn('date', function($row){
                          $actionBtn = '';
                          $actionBtn = date("Y-m-d", strtotime($row->logs));
                          return $actionBtn;
                      })
                      ->addColumn('time', function($row){
                          $actionBtn = '';
                          $actionBtn = date("h:i:s a", strtotime($row->logs));
                          return $actionBtn;
                      })
                      ->addColumn('serial_no', function($row){
                        $actionBtn = '';
            
                        $serialchecking = DB::Connection('mysql')
                                        ->table('tbl_bioloc_list')
                                        ->where('serialno', $row->serial_no)
                                        ->exists();
        
                        if($serialchecking){
                            $serialdisplay = DB::Connection('mysql')
                                            ->table('tbl_bioloc_list')
                                            ->where('serialno', $row->serial_no)
                                            ->first();
        
                            $actionBtn = $serialdisplay->location;
             
                        }
                       else {
                            $actionBtn = 'Unknown';
                        }
                        return $actionBtn;
                      })
                      ->addColumn('state', function($row){
                          $state = date("H:i:s", strtotime($row->logs));
                          //Time in Grace Period 
                          $checkin = date("H:i:s", strtotime('08:05:00'));
                          //Considered as Late
                          $checkinlate = date("H:i:s", strtotime('8:06'));
                          //End of Late in TimeIn
                          $checkinlateend = date("H:i:s", strtotime('11:59'));
                          $checkin2nd = date("H:i:s", strtotime('12:00'));
                          $checkin2ndend = date("H:i:s", strtotime('13:00'));
              
                          //Checkout Time
                          $checkout = date("H:i:s", strtotime('12:00:00'));
                          $checkoutend = date("H:i:s", strtotime('13:00:00'));
                          $checkout2nd = date("H:i:s", strtotime('17:15:00'));
                          $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
              
                          // $time = $state . $checkin;
                          // return $time;
                          $actionBtn = '';
                   
                          // Checking if type is Time in,Time Out, Overtime in , Overtime out
                          // Time in = 0, Time out = 1, Overtime in = 4, Overtime out = 5
                          //Time in
                          if($row->type == '0'){
                              //Time check in 0:00 -> 8:05am
                              if($state <= $checkin){
                                  $actionBtn = '<span style="color:green">On Time</span>';
                             }//Time check in Late 8:06am -> 11:59am
                             else if ($state >= $checkin && $state <=$checkinlateend){
                                  $actionBtn = '<span style="color:red;">Late<span>';
                              }//Time check in 12pm -> 1pm
                              else if($state >= $checkin2nd && $state <= $checkin2ndend){
                                  $actionBtn = '<span style="color:green">On Time</span>';
                              }//Time check in 1pm onwards
                              else if ($state >= $checkin2ndend){
                                  $actionBtn = '<span style="color:red;">Late<span>';
                              }
                          }
                      
                      //time out
                          else if($row->type == '1'){
                               if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                                  $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                              } // 12 to 1 checkout  
                              else if($state >= $checkout && $state <= $checkoutend){
                                  $actionBtn = '<span style="color:green">On Time</span>';
                              }  // 1 to 5 checkout
                              else if ($state >= $checkoutend && $state <= $checkout2nd){
                                  $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                              } // 5 onwards
                              else if($state >= $checkout2nd){
                                  $actionBtn = '<span style="color:green">On Time</span>';
                              } //Unavailable services
                              else if ($state <= $checkin){
                                  $actionBtn = '<span style="color:red">Unavailable</span>';
                              }
                          }   
                           else if($row->type == '4'){
              
                           }
              
                          // if ($state <= $checkin && $row->type == '0'){
                          //     $actionBtn = "On Time";
                          // }
                          
                          // elseif ($state >= $checkin && $state <= $checkinlateend && $row->type == '0'){
                          //     $actionBtn = "Late";
                          // }
                          return $actionBtn;
                      })
                      ->addIndexColumn()
                      ->rawColumns(['state'])
                      ->make(true);
      }
       
 //Own database filtering
 public function ownfilter(Request $request)
 {
     $fromDate = $request->from;
     $toDate =  $request->to;
     $lastfilter = $request->filter;
     if($fromDate != "" && $toDate != ""){

        $query = DB::Connection('mysql')
                ->table('zkfetches')
                ->join('users', 'users.empid' , 'zkfetches.empid')
                ->where('zkfetches.empid', Auth::user()->empid)
                ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$fromDate)
                ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '<=' ,$toDate)
                ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                            'zkfetches.serial_no as serial_no')
                ->orderBy('logs', 'desc')
                ->get();

        //  $query = DB::Connection('mysql2')
        //    ->table('zkfetches')
        //  //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
        //    ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$fromDate)
        //    ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '<=' ,$toDate)
        //    ->get();

     }else if($lastfilter != ""){
             if($lastfilter == "Today"){
                 $dt = Carbon::today();
                 $query = DB::Connection('mysql')
                 ->table('zkfetches')
                 ->join('users', 'users.empid' , 'zkfetches.empid')
                 ->where('zkfetches.empid', Auth::user()->empid)
                 //  ->select(DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogs'), DB::raw('DATE_FORMAT(zkfetches.logs, "%d-%m-%Y") as datelogsTo'))
                ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                ->get();
             }else if($lastfilter == "Yesterday") {
                 $dt = Carbon::today()->addDays(-1);
                 $query = DB::Connection('mysql')
                 ->table('zkfetches')
                 ->join('users', 'users.empid' , 'zkfetches.empid')
                 ->where('zkfetches.empid', Auth::user()->empid)
                  ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")') ,$dt->toDateString())
                   ->get();
             }else if($lastfilter == "Last15"){
                 $dt = Carbon::today()->addDays(-15);
                 $query = DB::Connection('mysql')
                 ->table('zkfetches')
                 ->join('users', 'users.empid' , 'zkfetches.empid')
                 ->where('zkfetches.empid', Auth::user()->empid)
                  ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                   ->get();
             }else if ($lastfilter == "LastMonth"){
                 $dt = Carbon::today()->subMonth();

                 $query = DB::Connection('mysql')
                 ->table('zkfetches')
                 ->join('users', 'users.empid' , 'zkfetches.empid')
                 ->where('zkfetches.empid', Auth::user()->empid)
                  ->where(DB::raw('DATE_FORMAT(zkfetches.logs, "%Y-%m-%d")'), '>=' ,$dt->toDateString())
                   ->get();
             }
     }



           
   
// return $query;
                 return DataTables::of($query)
                 ->addColumn('type', function($row){
                     $actionBtn = '';
                     if($row->type=='0'){$actionBtn = 'IN'; }else if($row->type=='1'){$actionBtn = 'OUT'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
                     return $actionBtn;
                 })
                 
                 ->addColumn('status', function($row){
                     $actionBtn = '';
                     if($row->status=='1'){$actionBtn = 'Biometrics';}else {$actionBtn = 'HashCard';}
                     return $actionBtn;
                 })
         
                 ->addColumn('date', function($row){
                     $actionBtn = '';
                     $actionBtn = date("Y-m-d", strtotime($row->logs));
                     return $actionBtn;
                 })
                 ->addColumn('time', function($row){
                     $actionBtn = '';
                     $actionBtn = date("h:i:s a", strtotime($row->logs));
                     return $actionBtn;
                 })
                 ->addColumn('serial_no', function($row){
                    $actionBtn = '';
            
                    $serialchecking = DB::Connection('mysql')
                                    ->table('tbl_bioloc_list')
                                    ->where('serialno', trim($row->serial_no))
                                    ->exists();
    
                    if($serialchecking){
                        $serialdisplay = DB::Connection('mysql')
                                        ->table('tbl_bioloc_list')
                                        ->where('serialno', trim($row->serial_no))
                                        ->first();
    
                        $actionBtn = $serialdisplay->location;
         
                    }
                   else {
                        $actionBtn = 'Unknown';
                    }
                    return $actionBtn;
                 })
                 ->addColumn('state', function($row){
                     $state = date("H:i:s", strtotime($row->logs));
                     //Time in Grace Period 
                     $checkin = date("H:i:s", strtotime('08:05:00'));
                     //Considered as Late
                     $checkinlate = date("H:i:s", strtotime('8:06'));
                     //End of Late in TimeIn
                     $checkinlateend = date("H:i:s", strtotime('11:59'));
                     $checkin2nd = date("H:i:s", strtotime('12:00'));
                     $checkin2ndend = date("H:i:s", strtotime('13:00'));
         
                     //Checkout Time
                     $checkout = date("H:i:s", strtotime('12:00:00'));
                     $checkoutend = date("H:i:s", strtotime('13:00:00'));
                     $checkout2nd = date("H:i:s", strtotime('17:15:00'));
                     $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
         
                     // $time = $state . $checkin;
                     // return $time;
                     $actionBtn = '';
              
                     // Checking if type is Time in,Time Out, Overtime in , Overtime out
                     // Time in = 0, Time out = 1, Overtime in = 4, Overtime out = 5
                     //Time in
                     if($row->type == '0'){
                         //Time check in 0:00 -> 8:05am
                         if($state <= $checkin){
                             $actionBtn = '<span style="color:green">On Time</span>';
                        }//Time check in Late 8:06am -> 11:59am
                        else if ($state >= $checkin && $state <=$checkinlateend){
                             $actionBtn = '<span style="color:red;">Late<span>';
                         }//Time check in 12pm -> 1pm
                         else if($state >= $checkin2nd && $state <= $checkin2ndend){
                             $actionBtn = '<span style="color:green">On Time</span>';
                         }//Time check in 1pm onwards
                         else if ($state >= $checkin2ndend){
                             $actionBtn = '<span style="color:red;">Late<span>';
                         }
                     }
                 
                 //time out
                     else if($row->type == '1'){
                          if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                             $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                         } // 12 to 1 checkout  
                         else if($state >= $checkout && $state <= $checkoutend){
                             $actionBtn = '<span style="color:green">On Time</span>';
                         }  // 1 to 5 checkout
                         else if ($state >= $checkoutend && $state <= $checkout2nd){
                             $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                         } // 5 onwards
                         else if($state >= $checkout2nd){
                             $actionBtn = '<span style="color:green">On Time</span>';
                         } //Unavailable services
                         else if ($state <= $checkin){
                             $actionBtn = '<span style="color:red">Unavailable</span>';
                         }
                     }   
                      else if($row->type == '4'){
         
                      }
         
                     // if ($state <= $checkin && $row->type == '0'){
                     //     $actionBtn = "On Time";
                     // }
                     
                     // elseif ($state >= $checkin && $state <= $checkinlateend && $row->type == '0'){
                     //     $actionBtn = "Late";
                     // }
                     return $actionBtn;
                 })
                 ->addIndexColumn()
                 ->rawColumns(['state'])
                 ->make(true);
 }

    public static function f08(){
        header("Content-Type: text/html; charset=ISO-8859-1");
        echo '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">';

        ini_set('max_execution_time', 180); //3 minutes
        
         $zk = new ZKTeco('192.168.0.163');

      $zk->connect();
        $zk->getAttendance();

        
        // $zk->getModel();

        // $array = $zk->getAttendance();
     
        
        $json_data = json_encode($array);

      return           $zk->platform();   ;

        // function decrypt($ivHashCiphertext, $password) {
        //     $method = "AES-256-CBC";
        //     $iv = substr($ivHashCiphertext, 0, 16);
        //     $hash = substr($ivHashCiphertext, 16, 32);
        //     $ciphertext = substr($ivHashCiphertext, 48);
        //     $key = hash('sha256', $password, true);
        
        //     if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
        
        //     return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
        // }

        // $json_data as $key
        // foreach($array as $key){
        //     echo $key;
        // }

            // foreach($array as $key){
            //     $key.['uid']; break;

            // }
            $array = $zk->getAttendance();
        $cnt = count($array)-1;
        for($i=0;$i <= 10; $i++){
           
            $_emp_id = $array[$i]['id'];
            $source =  $array[$i]['timestamp'];
           
            $emp_id = $_emp_id;
            
           
            $timestamp=date('Y-m-d h:i A',strtotime($source));

            echo $emp_id . " &nbsp&nbsp&nbsp ==========  &nbsp&nbsp&nbsp" .$timestamp;
            echo '<br>';
        
           


            // echo $array[$i]['timestamp']; break;

        }
      
        return ;
        
        // foreach($json_data as $key){
        //     echo $key;

        // }

   
        // echo json_encode($array);

        //  $newString = mb_convert_encoding($array, "UTF-8", "auto");
        // // return response()->json($newString);
        // // return \Response::json($array);
        // //    $data = json_decode($array,true);
        // return  json_decode($newString);
        // \DB::connection('mysql')->getPDO();
        // echo \DB::connection('mysql')->getDatabaseName();
        // $users = DB::Connection('mysql2')->table('zkfetches')->select('id', 'biometricsuid')->get();
     
      
       
    //    return $users;

  
 }

 public function getuser(){
    $zk = new ZkTeco('192.168.0.163');
    $zk->connect();
    return     $zk->setUser(); ;
//   return     $zk->testVoice();;
    //SetUser - User Credentials
    //Parameter 1 - Userid of biometrics                                                *Required
    //Parameter 2 - Employeeid/id of biometrics                                         *Required
    //Parameter 3 - Name in the biometrics                                              *Not required
    //Parameter 4 - Password in the biometrics                                          *Not required
    //Parameter 5 - User Role there are two type of role 0 for User and 14 for Admin    *Required
//     $userid = 2;
//     $role = 14;
//    return $zk->setUser($userid,$userid,'Mark Jerome','',$role); ;
// return $zk->setUser('2','2','2','2');
 }

 public function localcloud(){
  
    //fetch the local data
    $fetchlocal = DB::table('zkfetches')
                ->get();
   
            
    foreach($fetchlocal as $item) { 
        $checking = DB::Connection('mysql')
                    ->table('zkfetches')
                    ->where('biometricsuid', $item->biometricsuid)
                    ->where('serial_no', $item->serial_no)
                    ->exists();
        
        if(!$checking){
            $users = DB::Connection('mysql')
                    ->table('zkfetches')
                    ->insert(['biometricsuid' => $item->biometricsuid, 'logs' => $item->logs, 'empid' => $item->empid,
                            'type' => $item->type, 'status' => $item->status,
                            'serial_no' => trim($item->serial_no)]);
        }



    }
    return response()->json(['message' => 'Success'], 200);
 }



     public function fetchdata(){
        $zk = new ZKTeco('192.168.0.163');
        $zk->connect();  
       
        
       $serialnumber = $zk->serialNumber();
 
   
       $array = $zk->getAttendance();
        foreach($array as $item) { 
            $checking = zkfetch::where('biometricsuid', $item['uid'])->exists();
            if(!$checking){
             
                $users = zkfetch::create(['biometricsuid' => $item["uid"], 'logs' => $item["timestamp"], 'empid' => $item["id"],
                 'type' => $item["type"], 'status' => $item["state"],
                 'serial_no' => $serialnumber]);
            }
        }
        return response()->json(['message' => 'Success'], 200);
     }
  

     
     //fetch cloud database
     public function fetchcloud(){

        // $users = DB::table('zkfetches')
        //             ->join('users', 'users.empid' , 'zkfetches.empid')
        //             ->where('zkfetches.empid', Auth::user()->empid)
        //             ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type')
        //             ->get();
        $users = DB::Connection('mysql')
                    ->table('zkfetches')
                    ->orderBy('logs', 'desc')
                    ->get();
    
            return DataTables::of($users)
            ->addColumn('empId', function($row){ 
                return '<td>'.$row->empid.'</td>';
            })
            ->addColumn('type', function($row){
                $actionBtn = '';
                if($row->type=='0'){$actionBtn = 'Time In'; }else if($row->type=='1'){$actionBtn = 'Time Out'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
                return $actionBtn;
            })
            
            ->addColumn('status', function($row){
                $actionBtn = '';
                if($row->status=='1'){$actionBtn = 'Biometrics';}else {$actionBtn = 'HashCard';}
                return $actionBtn;
            })
    
            ->addColumn('date', function($row){
                $actionBtn = '';
                $actionBtn = date("Y-m-d", strtotime($row->logs));
                return $actionBtn;
            })
            ->addColumn('time', function($row){
                $actionBtn = '';
                $actionBtn = date("h:i:s a", strtotime($row->logs));
                return $actionBtn;
            })
            ->addColumn('serial_no', function($row){
                $actionBtn = '';
            
                $serialchecking = DB::Connection('mysql')
                                ->table('tbl_bioloc_list')
                                ->where('serialno', $row->serial_no)
                                ->exists();

                if($serialchecking){
                    $serialdisplay = DB::Connection('mysql')
                                    ->table('tbl_bioloc_list')
                                    ->where('serialno', $row->serial_no)
                                    ->first();

                    $actionBtn = $serialdisplay->location;
     
                }
               else {
                    $actionBtn = 'Unknown';
                }
                return $actionBtn;
            })
    
            
            ->addColumn('state', function($row){
                $state = date("H:i:s", strtotime($row->logs));
                //Time in Grace Period 
                $checkin = date("H:i:s", strtotime('08:05:00'));
                //Considered as Late
                $checkinlate = date("H:i:s", strtotime('8:06'));
                //End of Late in TimeIn
                $checkinlateend = date("H:i:s", strtotime('11:59'));
                $checkin2nd = date("H:i:s", strtotime('12:00'));
                $checkin2ndend = date("H:i:s", strtotime('13:00'));
    
                //Checkout Time
                $checkout = date("H:i:s", strtotime('12:00:00'));
                $checkoutend = date("H:i:s", strtotime('13:00:00'));
                $checkout2nd = date("H:i:s", strtotime('17:15:00'));
                $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
    
                // $time = $state . $checkin;
                // return $time;
                $actionBtn = '';
         
                // Checking if type is Time in,Time Out, Overtime in , Overtime out
                // Time in = 0, Time out = 1, Overtime in = 4, Overtime out = 5
                //Time in
                if($row->type == '0'){
                    //Time check in 0:00 -> 8:05am
                    if($state <= $checkin){
                        $actionBtn = '<span style="color:green">On Time</span>';
                   }//Time check in Late 8:06am -> 11:59am
                   else if ($state >= $checkin && $state <=$checkinlateend){
                        $actionBtn = '<span style="color:red;">Late<span>';
                    }//Time check in 12pm -> 1pm
                    else if($state >= $checkin2nd && $state <= $checkin2ndend){
                        $actionBtn = '<span style="color:green">On Time</span>';
                    }//Time check in 1pm onwards
                    else if ($state >= $checkin2ndend){
                        $actionBtn = '<span style="color:red;">Late<span>';
                    }
                }
            
            //time out
                else if($row->type == '1'){
                     if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                        $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                    } // 12 to 1 checkout  
                    else if($state >= $checkout && $state <= $checkoutend){
                        $actionBtn = '<span style="color:green">On Time</span>';
                    }  // 1 to 5 checkout
                    else if ($state >= $checkoutend && $state <= $checkout2nd){
                        $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                    } // 5 onwards
                    else if($state >= $checkout2nd){
                        $actionBtn = '<span style="color:green">On Time</span>';
                    } //Unavailable services
                    else if ($state <= $checkin){
                        $actionBtn = '<span style="color:red">Unavailable</span>';
                    }
                }   
                 else if($row->type == '4'){
    
                 }
    
                // if ($state <= $checkin && $row->type == '0'){
                //     $actionBtn = "On Time";
                // }
                
                // elseif ($state >= $checkin && $state <= $checkinlateend && $row->type == '0'){
                //     $actionBtn = "Late";
                // }
                return $actionBtn;
    
         
            })
    
    
           
            ->addIndexColumn()
            ->rawColumns(['state', 'empId'])
            ->make(true);
         }

         //Fetch per local database
         public function fetchlocal(){
            $users = DB::table('zkfetches')
            ->orderBy('logs', 'desc')
            ->get();
        
                return DataTables::of($users)
                ->addColumn('empId', function($row){ 
                    return '<td>'.$row->empid.'</td>';
                })
                ->addColumn('type', function($row){
                    $actionBtn = '';
                    if($row->type=='0'){$actionBtn = 'Time In'; }else if($row->type=='1'){$actionBtn = 'Time Out'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
                    return $actionBtn;
                })
                
                ->addColumn('status', function($row){
                    $actionBtn = '';
                    if($row->status=='1'){$actionBtn = 'Biometrics';}else {$actionBtn = 'HashCard';}
                    return $actionBtn;
                })
        
                ->addColumn('date', function($row){
                    $actionBtn = '';
                    $actionBtn = date("Y-m-d", strtotime($row->logs));
                    return $actionBtn;
                })
                ->addColumn('time', function($row){
                    $actionBtn = '';
                    $actionBtn = date("h:i:s a", strtotime($row->logs));
                    return $actionBtn;
                })
                ->addColumn('serial_no', function($row){
                    $actionBtn = '';
                     
                $serialchecking = DB::table('tbl_bioloc_list')
                ->where('serialno', $row->serial_no)
                ->exists();

                   
                if($serialchecking){
                    $serialdisplay = DB::table('tbl_bioloc_list')
                                    ->where('serialno', $row->serial_no)
                                    ->first();

                    $actionBtn = $serialdisplay->location;

                }
                else {
                    $actionBtn = 'Unknown';
                }
                    return $actionBtn;
                })
        
                
                ->addColumn('state', function($row){
                    $state = date("H:i:s", strtotime($row->logs));
                    //Time in Grace Period 
                    $checkin = date("H:i:s", strtotime('08:05:00'));
                    //Considered as Late
                    $checkinlate = date("H:i:s", strtotime('8:06'));
                    //End of Late in TimeIn
                    $checkinlateend = date("H:i:s", strtotime('11:59'));
                    $checkin2nd = date("H:i:s", strtotime('12:00'));
                    $checkin2ndend = date("H:i:s", strtotime('13:00'));
        
                    //Checkout Time
                    $checkout = date("H:i:s", strtotime('12:00:00'));
                    $checkoutend = date("H:i:s", strtotime('13:00:00'));
                    $checkout2nd = date("H:i:s", strtotime('17:15:00'));
                    $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));
        
                    // $time = $state . $checkin;
                    // return $time;
                    $actionBtn = '';
             
                    // Checking if type is Time in,Time Out, Overtime in , Overtime out
                    // Time in = 0, Time out = 1, Overtime in = 4, Overtime out = 5
                    //Time in
                    if($row->type == '0'){
                        //Time check in 0:00 -> 8:05am
                        if($state <= $checkin){
                            $actionBtn = '<span style="color:green">On Time</span>';
                       }//Time check in Late 8:06am -> 11:59am
                       else if ($state >= $checkin && $state <=$checkinlateend){
                            $actionBtn = '<span style="color:red;">Late<span>';
                        }//Time check in 12pm -> 1pm
                        else if($state >= $checkin2nd && $state <= $checkin2ndend){
                            $actionBtn = '<span style="color:green">On Time</span>';
                        }//Time check in 1pm onwards
                        else if ($state >= $checkin2ndend){
                            $actionBtn = '<span style="color:red;">Late<span>';
                        }
                    }
                
                //time out
                    else if($row->type == '1'){
                         if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                            $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                        } // 12 to 1 checkout  
                        else if($state >= $checkout && $state <= $checkoutend){
                            $actionBtn = '<span style="color:green">On Time</span>';
                        }  // 1 to 5 checkout
                        else if ($state >= $checkoutend && $state <= $checkout2nd){
                            $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                        } // 5 onwards
                        else if($state >= $checkout2nd){
                            $actionBtn = '<span style="color:green">On Time</span>';
                        } //Unavailable services
                        else if ($state <= $checkin){
                            $actionBtn = '<span style="color:red">Unavailable</span>';
                        }
                    }   
                     else if($row->type == '4'){
        
                     }
        
                    // if ($state <= $checkin && $row->type == '0'){
                    //     $actionBtn = "On Time";
                    // }
                    
                    // elseif ($state >= $checkin && $state <= $checkinlateend && $row->type == '0'){
                    //     $actionBtn = "Late";
                    // }
                    return $actionBtn;
        
             
                })
        
        
               
                ->addIndexColumn()
                ->rawColumns(['state', 'empId'])
                ->make(true);
         } 


     //fetch per location
     public function fetchspecific(){

    $users = DB::Connection('mysql')
                ->table('zkfetches')
                ->join('users', 'users.empid' , 'zkfetches.empid')
                ->where('zkfetches.empid', Auth::user()->empid)
                ->select('zkfetches.empid as empid', 'users.name as name', 'zkfetches.logs as logs', 'zkfetches.status as status', 'zkfetches.type as type', 
                            'zkfetches.serial_no as serial_no')
                ->orderBy('logs', 'desc')
                ->get();
 

        return DataTables::of($users)
        ->addColumn('empId', function($row){ 
            return '<td>'.$row->empid.'</td>';
        })
        ->addColumn('type', function($row){
            $actionBtn = '';
            if($row->type=='0'){$actionBtn = 'Time In'; }else if($row->type=='1'){$actionBtn = 'Time Out'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
            return $actionBtn;
        })
        
        ->addColumn('status', function($row){
            $actionBtn = '';
            if($row->status=='1'){$actionBtn = 'Biometrics';}else {$actionBtn = 'HashCard';}
            return $actionBtn;
        })

        ->addColumn('date', function($row){
            $actionBtn = '';
            $actionBtn = date("Y-m-d", strtotime($row->logs));
            return $actionBtn;
        })
        ->addColumn('time', function($row){
            $actionBtn = '';
            $actionBtn = date("h:i:s a", strtotime($row->logs));
            return $actionBtn;
        })
   
        ->addColumn('serial_no', function($row){
            $actionBtn = '';

            $serialchecking = DB::Connection('mysql')
            ->table('tbl_bioloc_list')
            ->where('serialno',trim($row->serial_no))
            ->exists();

            if($serialchecking){
            $serialdisplay = DB::Connection('mysql')
                            ->table('tbl_bioloc_list')
                            ->where('serialno', trim($row->serial_no))
                            ->first();

            $actionBtn = $serialdisplay->location;

            }
            else {
            $actionBtn = 'Unknown';
            }
            return $actionBtn;
        })

        
        ->addColumn('state', function($row){
            $state = date("H:i:s", strtotime($row->logs));
            //Time in Grace Period 
            $checkin = date("H:i:s", strtotime('08:05:00'));
            //Considered as Late
            $checkinlate = date("H:i:s", strtotime('8:06'));
            //End of Late in TimeIn
            $checkinlateend = date("H:i:s", strtotime('11:59'));
            $checkin2nd = date("H:i:s", strtotime('12:00'));
            $checkin2ndend = date("H:i:s", strtotime('13:00'));

            //Checkout Time
            $checkout = date("H:i:s", strtotime('12:00:00'));
            $checkoutend = date("H:i:s", strtotime('13:00:00'));
            $checkout2nd = date("H:i:s", strtotime('17:15:00'));
            $checkout2ndlimit = date("H:i:s", strtotime('00:00:00'));

            // $time = $state . $checkin;
            // return $time;
            $actionBtn = '';
     
            // Checking if type is Time in,Time Out, Overtime in , Overtime out
            // Time in = 0, Time out = 1, Overtime in = 4, Overtime out = 5
            //Time in
            if($row->type == '0'){
                //Time check in 0:00 -> 8:05am
                if($state <= $checkin){
                    $actionBtn = '<span style="color:green">On Time</span>';
               }//Time check in Late 8:06am -> 11:59am
               else if ($state >= $checkin && $state <=$checkinlateend){
                    $actionBtn = '<span style="color:red;">Late<span>';
                }//Time check in 12pm -> 1pm
                else if($state >= $checkin2nd && $state <= $checkin2ndend){
                    $actionBtn = '<span style="color:green">On Time</span>';
                }//Time check in 1pm onwards
                else if ($state >= $checkin2ndend){
                    $actionBtn = '<span style="color:red;">Late<span>';
                }
            }
        
        //time out
            else if($row->type == '1'){
                 if($state <= $checkout && $state >= $checkout2ndlimit && $state >= $checkin){
                    $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                } // 12 to 1 checkout  
                else if($state >= $checkout && $state <= $checkoutend){
                    $actionBtn = '<span style="color:green">On Time</span>';
                }  // 1 to 5 checkout
                else if ($state >= $checkoutend && $state <= $checkout2nd){
                    $actionBtn = '<span style="color:#fc960f">Early Out</span>';
                } // 5 onwards
                else if($state >= $checkout2nd){
                    $actionBtn = '<span style="color:green">On Time</span>';
                } //Unavailable services
                else if ($state <= $checkin){
                    $actionBtn = '<span style="color:red">Unavailable</span>';
                }
            }   
             else if($row->type == '4'){

             }

            // if ($state <= $checkin && $row->type == '0'){
            //     $actionBtn = "On Time";
            // }
            
            // elseif ($state >= $checkin && $state <= $checkinlateend && $row->type == '0'){
            //     $actionBtn = "Late";
            // }
            return $actionBtn;

     
        })


       
        ->addIndexColumn()
        ->rawColumns(['state', 'empId'])
        ->make(true);
     }


     
     public function fetchattendancecount(){
        $users = zkfetch::where('empid', Auth::user()->empid)
                        ->get()
                        ->count();
            return $users;
     }
     
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c)
    {
        //
    }
}
