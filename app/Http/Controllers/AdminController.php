<?php

namespace App\Http\Controllers;
use App\Models\zkfetch;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\projectmanager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Exports\UsersExport;
use App\Exports\InvoicesExport;
use App\Exports\Logs;
use Illuminate\Support\Facades\Http;

use App\Events\ReloadEvent;

use Yajra\DataTables\ExportServiceProvider;

use App\Exports\zkfetches;
use Maatwebsite\Excel\Facades\Excel;
use Rats\Zkteco\Lib\ZKTeco;
use Carbon\Carbon;

use DataTables;

use Spatie\WebhookClient\Models\WebhookCall;
use DB;

class AdminController extends Controller
{
    //
    public static function attendancecontent(){
        return view('section.attendancecontent');

    }

    public function piechart(){
        return view('login.piechart');
    }

    public function cloudsamples(){
        $users = DB::Connection('mysql')->table('users')->get();

        return $users;

    }

    public function profilecontent(){

        $companyread = DB::table('tbl_company_name')
        ->get();

        $department = DB::table('tbl_department_list')
        ->get();

        $departmentposition = DB::table('tbl_position_list')
        ->get();
        
        return view('section.profile', compact('companyread', 'department', 'departmentposition'));
    }
    
    public function profiledisplay(){
        $user = DB::table('users')->where('empid', Auth::user()->empid)->first();

        return $user;
    }

    // public function trigger(){
    //     $trigger = Http::get('http://127.0.0.1:8000/api/store');
    //     return $trigger;
    // }

    public function samplecloud(){
        return view('login.sample');
    }

    public function samplelogs(){
        return view('login.logs');
    }

    public function biolocation(){
        $ip = '192.168.0.163';

        $pingresult = shell_exec("start /b ping $ip -n 1");
           
        $dead = "Request timed out.";
        $deadoralive = strpos($dead, $pingresult);
    
        if ($deadoralive == false){
            // echo "The IP address, $ip, is dead";
            $bioserial = "0";
        } else {
            // echo "The IP address, $ip, is alive";
            $zk = new ZKTeco('192.168.0.163');
            $zk->connect();
            $bioserial = $zk->serialNumber();
        }
   
       

        return view('section.biolocation' , compact('bioserial'));
    }
    public function biolocationall(){
        return view('section.biolocationall');
    }
    public function positioncontent(){
        return view('section.positioncontent');
    }
    
    public static function projectmanagercontent(){
        return view('section.projectmanagercontent');
    }

    public static function companylist(){
        return view('section.companycontents');
    }

    public static function districtcontent(){
        return view('section.districtcontent');
    }

    public static function branchcontent(){
        return view('section.branchcontent');
    }

    public static function areacontent(){
        return view('section.areacontent');
    }

    public static function userscontent(){

      $locationdisplay = DB::table('tbl_bioloc_list')
                        ->first();


        return view('section.userscontent', compact('locationdisplay'));
    }

    public function payrollcontent(){
        $locationfilter = DB::Connection('mysql')
                        ->table('tbl_bioloc_list')
                        ->select('serialno','location')
                        ->get();
        return view('section.payrollcontent', compact('locationfilter'));
    }
    
    public static function addemployeefunction(Request $request){
       
        if($request->addprojectline == "ProjectSite"){

            return "HEllo";
        }else if($request->addprojectline == "HeadOffice"){
            return "Hi";
        }else if($request->addprojectline == "Everfirst"){
            return "kol";
        }
       

     

    }
       //Testing exporting
       public function export(Request $request) 
       {
        return $request->all();
        // if($request == ""){
            // return Excel::download(new zkfetches, 'logs.xlsx');

            // return (new zkfetches)->dateto($request->dateto)->datefrom()->download('logs.xlsx');
        // }elseif($request ){
            return (new Logs('320'))->download('invoices.xlsx');
        // }
        // return Excel::download(new InvoicesExport, 'invoices.xlsx');
       }

    


    public static function company(){
        $company = DB::table('tbl_company_name')
                    ->get();

                    return DataTables::of($company)
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->addIndexColumn()
                    ->make(true);


    }

    public function payrollfilter(Request $request)
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
     


        return DataTables::of($query)
        ->addColumn('type', function($row){
            $actionBtn = '';
            if($row->type=='0'){$actionBtn = 'IN'; }else if($row->type=='1'){$actionBtn = 'OUT'; }elseif($row->type=='4'){$actionBtn = 'Overtime In';}elseif($row->type=='5'){$actionBtn = 'Overtime Out';}
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
        ->addIndexColumn()
        ->make(true);
    }

    public  function payrollformatdisplay(){
        $payroll = DB::Connection('mysql')
                    ->table('zkfetches')
                    ->get();

                    return DataTables::of($payroll)
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
                    ->addIndexColumn()
                    ->make(true);
    }
    public static function district(){
        $district = DB::Connection('mysql3')
                    ->table('tbl_district_list')
                    ->get();

                    return DataTables::of($district)
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->addColumn('company_id', function($row){
                        $companycheck = DB::Connection('mysql3')
                                    ->table('tbl_company_name')
                                    ->select('company_id', 'company_name')
                                    ->where('company_id', $row->company_id)
                                    ->first();
                        $actionBtn = $companycheck->company_name;
                        return $actionBtn;
                    })
                    ->addIndexColumn()
                    ->make(true);
    }

    public function posdisplay(){
        $position = DB::table('tbl_position_list')
                    ->get();

        return DataTables::of($position)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('department_id', function($row){
            $department = DB::table('tbl_department_list')
                    ->where('id', $row->department_id)
                    ->first();
            
            $actionBtn = $department->department_name;
            return $actionBtn;
        })
        ->addIndexColumn()
        ->make(true);
    }   

    public static function branchdisplay(){
        $branch = DB::Connection('mysql3')->table('tbl_branch_list')
        ->get();

        return DataTables::of($branch)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('district_code', function($row){
        $districtcheck = DB::Connection('mysql3')->table('tbl_district_list')
        ->select('district_code', 'district_number')
        ->where('district_code', $row->district_code )
        ->first();
        
        if($districtcheck) {
            $actionBtn = $districtcheck->district_number;
            return $actionBtn;
        }else {
            return '';
        }
        })
        ->addColumn('company_id', function($row){
        $companycheck = DB::table('tbl_company_name')
        ->select('company_id', 'company_name')
        ->where('company_id', $row->company_id)
        ->first();
        
        if($companycheck)
        {$actionBtn = $companycheck->company_name;

            return $actionBtn;
    }else {
        return '';
    }
        

        })
        ->addColumn('area_code', function($row){
        $areacheck = DB::table('tbl_area')
        ->select('area_code', 'area_no')
        ->where('area_code' , $row->area_code)
        ->first();
        
        if($areacheck){
            $actionBtn = $areacheck->area_no;
            return $actionBtn;
        }else {
            return '';
        }


        })
        ->addIndexColumn()
        ->make(true);
    }

    public function usersdisplay(){


        if(Auth::user()->role == 1){
            $user = DB::Connection('mysql')->table('users')
            ->get();
        }elseif(Auth::user()->role == 2){
            $user = DB::table('users')
            ->where('bioloc_id', Auth::user()->bioloc_id)
            ->get();
        }
  

        return DataTables::of($user)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('role', function($row){
            if($row->role == 1){
            $actionBtn = 'Super Admin';
            }elseif($row->role == 2){
            $actionBtn = 'Admin';
            }elseif($row->role == 3){
            $actionBtn = 'User';
            }else {
            $actionBtn = 'Unknown Role';
            }
            return $actionBtn;

        })
        ->addColumn('company_id', function($row){
            $companyname = DB::table('tbl_company_name')
                                ->where('company_id' , $row->company_id)
                                ->first();
            $actionBtn = $companyname->company_name;
            return $actionBtn;
        })
        ->addIndexColumn()
        ->make(true);
    }

    public function cloudusersdisplay(){
            $user = DB::Connection('mysql')->table('users')
            ->get();
        
        return DataTables::of($user)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('bioloc_id', function($row){
            $locations = DB::Connection('mysql')
                        ->table('tbl_bioloc_list')
                        ->where('id', $row->bioloc_id)
                        ->first();

            $actionBtn = '';

            if($locations) {
                $actionBtn = $locations->location;
            }
            

            return $actionBtn;
        })
        ->addColumn('role', function($row){
            if($row->role == 1){
            $actionBtn = 'Super Admin';
            }elseif($row->role == 2){
            $actionBtn = 'Admin';
            }elseif($row->role == 3){
            $actionBtn = 'User';
            }else {
            $actionBtn = 'Unknown Role';
            }
            return $actionBtn;

        })
        ->addColumn('company_id', function($row){
            $companyname = DB::table('tbl_company_name')
                                ->where('company_id' , $row->company_id)
                                ->first();
            $actionBtn = $companyname->company_name;
            return $actionBtn;
        })
        ->addIndexColumn()
        ->make(true);
    }

    public function departmentdisplay(){
        $department = DB::table('tbl_department_list')
                ->get();

        return DataTables::of($department)
        ->addColumn('action', function($row){
            $actionBtn = '<button type="button" onclick="editdepartmentmodals(`'.$row->id.'`,`'.$row->department_name.'`)" class="edit btn btn-success btn-sm">Edit</button>';
            return $actionBtn;
        })
       
        ->addIndexColumn()
        ->make(true);
    }

    public function editdepartmentfunction(Request $request){
        $departmentexists = DB::table('tbl_department_list')
                            ->where('department_name', $request->editdepartmentname)
                            ->exists();

            if(!$departmentexists){
                DB::table('tbl_department_list')
                ->where('id', $request->editdepartment_iddisplay)
                ->update(['department_name' => $request->editdepartmentname]);

                return response()->json(["message" => "Success"], 200);
            }else {
                return response()->json(["message" => "Failed"], 404);
            }
    }

    public static function companycount(){
        $companycount = DB::table('tbl_company_name')->count();
        return $companycount;
    }

    
    public static function clouduserscount(){
        $userscount = DB::Connection('mysql')->table('users')->count();
        return $userscount;
    }


    public static function userscount(){
        $userscount = DB::table('users')->where('bioloc_id', Auth::user()->bioloc_id)->count();
        return $userscount;
    }
    public static function branchescount(){
        $branchescount = DB::table('tbl_branch_list')->get()->count();
        return $branchescount;
    }
    public static function areadisplay(){
        $area = DB::Connection('mysql3')
                ->table('tbl_area')
                ->get();

                return DataTables::of($area)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('district_code', function($row){
                    $districtcheck = DB::Connection('mysql3')
                    ->table('tbl_district_list')
                    ->select('district_code', 'district_number')
                    ->where('district_code', $row->district_code)
                    ->first();

                    $actionBtn = $districtcheck->district_number;
                    return $actionBtn;
                })
                ->addColumn('company_id', function($row){
                    $companycheck = DB::table('tbl_company_name')
                    ->select('company_id', 'company_name')
                    ->where('company_id', $row->company_id)
                    ->first();


                    $actionBtn = $companycheck->company_name;
                    return $actionBtn;
                })

                ->addIndexColumn()
                ->make(true); 

    }
    public static function teamdisplay(){
        $teamname = DB::table('teams')
                    ->get();
        
                    return DataTables::of($teamname)
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })

                    ->addIndexColumn()
                    ->make(true);           

    }

    public function biolocdisplay(){
        $bioloc = DB::table('tbl_bioloc_list')
                ->get();

                return DataTables::of($bioloc)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function biolocalldisplay(){
        $bioloc = DB::Connection('mysql')
                ->table('tbl_bioloc_list')
                ->get();

                return DataTables::of($bioloc)
                ->addColumn('action', function($row){
                    $actionBtn = '<button type="button"  onclick="editbiolocmodals(`'.$row->id.'`,`'.$row->serialno.'`,`'.$row->location.'`)" class="edit btn btn-success btn-sm">Edit</button>';
                    return $actionBtn;
                })
                ->addIndexColumn()
                ->make(true);
    }

    public function departmentcontent(){
        return view('section.departmentcontent');
    }

    public static function teamcontent(){
        return view('section.teamcontent');
    }

    public static function operationmanager(){
        $operationmanager = DB::table('operationmanagers')
                    ->join('users', 'users.id', 'operationmanagers.user_id')
                    ->get();                    
                    return DataTables::of($operationmanager)
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->addColumn('teamid', function($row){
                        $teamcheck = DB::table('teams')
                        ->select('id', 'teamname')
                        ->where('id' , $row->teamid)
                        ->first();
                       
                       
                           $actionBtn = $teamcheck->teamname;
                      
                        return $actionBtn;
                    })
                    ->addIndexColumn()
                    ->make(true);  

                        

    }

    public function editcompanyfetch(Request $request){
        $companyid = $request->editcompany_id;
       
        $fetchdata = DB::table('tbl_company_name')
                    ->where('company_id',$companyid)
                    ->first();

         return $fetchdata;

    }

    public static function projectmanager(){
        $projectmanager = DB::table('projectmanagers')
                    ->join('users', 'users.id', 'projectmanagers.user_id')
                    ->get();
        return DataTables::of($projectmanager)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('teamid', function($row){
            $teamcheck = DB::table('teams')
            ->select('id', 'teamname')
            ->where('id', $row->teamid)
            ->first();
            $actionBtn = $teamcheck->teamname;
            return $actionBtn;
        })
        ->addColumn('oicid', function($row){
            $oiccheck = User::find($row->oicid);

          
           
                $actionBtn = $oiccheck->name;
                return $actionBtn;
     
        })
      
        ->addIndexColumn()
        ->make(true);

    }

    public static function engineer(){
        $engineer = DB::table('projectengineers')
                ->join('users', 'users.id', 'projectengineers.user_id')
                ->get();

        return DataTables::of($engineer)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('teamid', function($row){
            $teamcheck = DB::table('teams')
            ->select('id', 'teamname')
            ->where('id', $row->teamid)
            ->first();
            $actionBtn = $teamcheck->teamname;
            return $actionBtn;
        })
        ->addColumn('oicid', function($row){
            $oiccheck = $oiccheck = User::find($row->oicid);
            $actionBtn = $oiccheck->name;
            return $actionBtn;
        })
        ->addColumn('pmid', function($row){
            $pmcheck = User::find($row->pmid);
            $actionBtn = $pmcheck->name;
            return $actionBtn;
        })

        ->addIndexColumn()
        ->make(true);
    }

    public function editcompanyfunction(Request $request){
      

        DB::table('tbl_company_name')
                ->where('company_id', $request->editcompany_id)
                ->update(['company_name' => $request->editcompanyname]);
                

        return response()->json(["message" => "Success"], 200);
    }



    public static function companydisplay(){
      
        $company = DB::table('tbl_company_name')
                ->get();
        
        return DataTables::of($company)
            ->addColumn('action', function($row){
                $actionBtn = '<button type="button"  onclick="editcompanymodal(`'.$row->company_id.'`,`'.$row->company_name.'`)" class="edit btn btn-success btn-sm">Edit</button>';
                return $actionBtn;
            })
            ->addIndexColumn()
            ->make(true);

        

    }

    public function editbiolocfunction(Request $request){
        $biolocexist = DB::table('tbl_bioloc_list')
        ->where('serialno', $request->editbiolocserial)
        ->Where('location', $request->editbiolocname)
        ->exists();

        if(!$biolocexist){
            DB::table('tbl_bioloc_list')
            ->where('id', $request->editbioloc_iddisplay)
            ->update(['location' => $request->editbiolocname]);

            return response()->json(["message" => "Success"], 200);
        }else{
            return response()->json(["message" => "Failed"], 404);
        }
    }
  

    public function adddepartmentfunction(Request $request){
        
        $this->validate($request, [
            'adddepartmentname'=>'required'
        ]);
        DB::table('tbl_department_list')->insert(['department_name' => $request->adddepartmentname]);
        return response()->json(['message' => 'Success'], 200);
    }

    public function addpositionsfunction(Request $request){
        $this->validate($request, [
            'positiondepartment' => 'required',
            'addpositionsname' => 'required'
        ]);

        DB::table('tbl_position_list')->insert(['department_id' => $request->positiondepartment, 'position_name' => $request->addpositionsname]);
        return response()->json(['message' => 'Success'], 200);
    }

    public function addnewcompanyfunction(Request $request){
        $this->validate($request, [
            'addcompanyname'=>'required'
        ]);
        DB::table('tbl_company_name')->insert(['company_name' => $request->addcompanyname]);
        return response()->json(['message' => 'Success'], 200);
    }

    public function addnewdepartment(Request $request){
            $this->validate($request, [
                'addteamname'=>'required'
            ]);
            DB::table('teams')->insert(['teamname' => $request->addteamname]);
            return response()->json(['message' => 'Success'], 200);
    }

    public function addnewemployeefunction(Request $request){
        $existingdata = DB::Connection('mysql')
        ->table('users')
        ->where('empid', $request->addEmpid)
        ->orWhere('name', $request->AddNameUser)
        ->orWhere('username', $request->AddUsernameUser)
        ->orWhere('email', $request->AddEmailUser)
        ->exists();

        
            try {
        
                $this->validate($request,[
                        'AddNameUser'=>'required',
                        'addEmpid'=>'required',
                        'addcompany'=>'required',
                        'addbranchline'=>'required',
                        'addroleline'=>'required',
                        'copydetails'=>'required'
        
                ]);
                    if($request->addbranchline == "HeadOffice"){
                        $this->validate($request,[
                            'addEmpid'=>'required',
                            'addposition'=>'required'
                        ]);
                    }
                    elseif($request->addbranchline == "ProjectSite"){
                        $this->validate($request,[
                            'addEmpid'=>'required',
                            'addprojectlines'=>'required',
                            'addteam'=>'required'
                        ]);
                    }elseif($request->addbranchline == "Everfirst"){
                        $this->validate($request,[
                            'addEmpid'=>'required',
                            'adddistrict'=>'required',
                            'addarea'=>'required',
                            'addbranch'=>'required'
                        ]);
                    }
                    
            
        
                $fetchid = User::max('id') + 1;
                
        
                if($request->addbranchline == "ProjectSite"){
        
                    $position = $request->addprojectlines;
                    
                    $user = User::insert(['empid'=>$request->addEmpid,'role'=>$request->addroleline, 
                    'company_id'=>$request->addcompany, 'name'=>$request->AddNameUser, 'email'=>$request->AddEmailUser, 'username'=>$request->AddUsernameUser,
                    'password'=>$request->AddPasswordUser]);
        
                    if($position == "ProjectEngineer"){
                        DB::table('projectengineers')
                                            ->insert(['empid'=>$request->addEmpid, 'user_id'=>$fetchid, 'teamid'=>$request->addteam, 'oicid'=>$request->addOIC,
                                                        'pmid'=>$request->addProjectManager]);
                                                        
                    }elseif($position == "ProjectManager"){
                        DB::table('projectmanagers')
                                            ->insert(['empid'=>$request->addEmpid, 'user_id'=>$fetchid, 'teamid'=>$request->addteam, 'oicid'=>$request->addOIC]);
                    }elseif($position == "OperationManager")
                    {
                        DB::table('operationmanagers')
                        ->insert(['empid'=>$request->addEmpid ,'user_id'=>$fetchid, 'teamid'=>$request->addteam]);
                    }
        
                }elseif($request->addbranchline == "EverFirst"){
        
                    $user = DB::Connection('mysql')
                    ->table('users')
                    ->insert(['bioloc_id'=>$request->copydetails,'empid'=>$request->addEmpid,'role'=>$request->addroleline, 
                    'company_id'=>$request->addcompany, 'name'=>$request->AddNameUser, 'email'=>$request->AddEmailUser, 'username'=>$request->AddUsernameUser,
                'password'=>$request->AddPasswordUser, 'district_code'=>$request->adddistrict, 'area_code'=>$request->addarea, 'branch_code'=>$request->addbranch]);
                
                }elseif($request->addbranchline == "HeadOffice"){
                    $user = User::insert(['empid'=>$request->addEmpid,'role'=>$request->addroleline, 
                    'company_id'=>$request->addcompany, 'name'=>$request->AddNameUser, 'email'=>$request->AddEmailUser, 'username'=>$request->AddUsernameUser,
                'password'=>$request->AddPasswordUser, 'user_code'=>$request->addposition]);
                
                }   
        
                return response()->json(['message' => 'Success'], 200);
           
            }
            catch (ValidationException $exception) {
                return response()->json(['errors' => $exception->errors()], 422);
            }
            catch(\Throwable $th){
                return response()->json(['error' => $th->getMessage()],500);
            }
        
        
        
             
        
        
            // if(){
        
        
        
   
    // }
    
    }


    public function piechartwithtext(){
        return view('login.piechartwithtext');
    }


    public static function projectengineercontent(){
        return view('section.projectengineercontent');
    }

    public static function companycontents(){
        return view('section.companycontents');
    }
    public static function mainpage() {
    //     $users = zkfetch::get();
    //    return $users; 
   
 

        $var2 = DB::table('tbl_branch_list')
        ->select('branch_loc')
        ->where('branch_code' , Auth::user()->branch_code)
        ->first();

        

        $company = DB::table('tbl_company_name')
        ->select('company_name', 'company_id')
        ->where('company_id', Auth::user()->company_id)
        ->first();

    
        
        $branch = DB::table('tbl_branch_list')
        ->select('branch_code', 'branch_loc', 'branch_head')
        ->get();

        $district = DB::table('tbl_district_list')
        ->select('district_code', 'district_number')
        ->get();


        $area = DB::table('tbl_area')
        ->select('area_code', 'area_no')
        ->get();

        
    
        $team = DB::table('teams')
        ->get();

        $operationmanager = DB::table('operationmanagers')
        ->get();

        $position = DB::table('tbl_usergroup')
        ->get();

        $companyread = DB::table('tbl_company_name')
        ->get();

        $checking = DB::table('projectmanagers')
        ->get();
     
        $exist = DB::table('users')
        ->get();   

        $department = DB::table('tbl_department_list')
        ->get();
        
        $departmentposition = DB::table('tbl_position_list')
        ->join('tbl_department_list', 'tbl_department_list.id', 'tbl_position_list.department_id')
        ->select('tbl_position_list.id as id', 'tbl_department_list.department_name as name', 'tbl_position_list.position_name as posname')
        ->get();
        
        // Checking if you have an internet access
        if(!$sock = @fsockopen('www.google.com', 80))
        {
        //no Internet access
        $locationfilter = [""];
        $userchecking = [""];
        }
        else
        {
        //Have an internet access
        $locationfilter = DB::Connection('mysql')
        ->table('tbl_bioloc_list')
        ->select('id','serialno','location')
        ->get();


        $userchecking = DB::table('users')
                        ->get();
        }




        
     

        return view('section.dashboard', compact('var2' , 'company','companyread', 'branch', 'district', 'area', 'team', 'operationmanager', 'position', 'exist', 'checking', 
                                                'department', 'departmentposition', 'locationfilter', 'userchecking'));

     }
     //Per Branch

     public static function unregistered(Request $request){
        
        $fetchunregistered = DB::table('projectmanagers')
                        ->where('empid' , $request->empid)
                        ->first();
                        return $fetchunregistered;

     }

     public static function area(Request $request){
       
        $area = DB::table('tbl_area')
        ->select('area_code', 'area_no', 'area_name')
        ->where('district_code' , $request->district)
        ->get();
        return $area;
     }

     public function positions(Request $request){
        $departmentposition = DB::table('tbl_position_list')
                            ->where('department_id', $request->department)
                            ->get();
        return $departmentposition;
     }

     public static function branch(Request $request){
       
        $branch = DB::table('tbl_branch_list')
        ->select('branch_code', 'branch_head', 'branch_loc')
        ->where('area_code' , $request->area_code)
        ->get();
        return $branch;
     }

     //Project Site
     public static function oic(Request $request){
    
     
        $oic = DB::table('operationmanagers')
        ->join('users' , 'users.id', 'operationmanagers.user_id')
        ->where('teamid', $request->teamid)
        ->get();
        return $oic;
     }


     public static function pm(Request $request){
  
        $pm = DB::table('projectmanagers')
            ->join('users' , 'users.id', 'projectmanagers.user_id')
            ->where('oicid', $request->oicid)
            ->get();

 
        return $pm;
     }


     public static function branchcode(){


        $var = User::select('branch_code', 'empid')
            ->where('empid' , Auth::user()->empid)
            ->get();

        $var2 = DB::table('tbl_branch_list')
            ->select('branch_loc')
            ->where('branch_code' , Auth::user()->branch_code)
            ->get();
        return $var2;

      

     }

     public function syncbio(){

        $fetchlocation = DB::table('tbl_bioloc_list')
                        ->get();

        return $fetchlocation;
        return Http::get('https://www.acs.multi-linegroupofcompanies.com/logstocloud');
     }

     public function userssyncingfunction(Request $request){
       
        // $userscount = 0;
        // foreach($request->req as $value){ 
        
            // $usersdata = DB::table('users')
            // ->where('empid', $value['empid'])
            // ->where('bioloc_id', Auth::user()->bioloc_id)
            // ->get()
            // ->count();
   
    $userscount = array_count_values(array_column($request->req, 'bioloc_id'))[Auth::user()->bioloc_id];

            // $userscount = $usersdata + $userscount;
        // }

        return $userscount;
            // foreach($request->req as $value){
            
        // }
     }

     public function userscounts(){

    $usersdata = DB::table('users')
                ->count();
            return $usersdata;

     }
     
     public function userscloudfunction(Request $request){
        // return $request->req;
        $arr = [];

        foreach($request->req as $value){
        $usersdata = DB::table('users')
                        ->where('empid', $value['empid'])
                        ->orWhere('username', $value['username'])
                        ->orWhere('email', $value['email'])
                        ->exists();

        
                        

                            if(!$usersdata){

                             $checkinglocation = $value['bioloc_id'];
                                
                                                    if($checkinglocation == Auth::user()->bioloc_id){
                                                        DB::table('users')
                                                        ->insert(['bioloc_id' => $value['bioloc_id'],
                                                                    'role' => $value['role'], 
                                                                        'empid' => $value['empid'], 
                                                                            'district_code' => $value['district_code'],
                                                                                'area_code' => $value['area_code'],
                                                                                    'branch_code' => $value['branch_code'], 
                                                                                        'company_id' => $value['company_id'], 
                                                                                            'user_code' => $value['user_code'],
                                                                                                'name' => $value['name'], 
                                                                                                    'email' => $value['email'],
                                                                                                        'username' => $value['username'],
                                                                                                            'password' => $value['password']]);
                                                    }

                            }
                    }
        // event(new ReloadEvent());
        return response()->json(["message" => "Success"], 200);
     }

     public function webhooktesting(){
        return WebhookCall::create()
        ->url('https://other-app.com/webhooks')
        ->payload(['key' => 'value'])
        ->useSecret('sign-using-this-secret')
        ->dispatch();;

     }
     public static function sample(){
        return view('login.sample');
     }

     public static function lol(){
     

     }
     public static function cloud(){
            $biodata = DB::Connection('mysql')->table('zkfetches')->get();

        

            foreach($biodata as $item) { 
            // for($i = 0;$i<=count($biodata);$i++){

             

            $checks = DB::Connection('mysql')
            ->table('zkfetches')
            ->where('id' , $item->id)
            ->where('biometricsuid' , $item->biometricsuid)
            ->exists();
            
         
                if(!$checks){
                    $users = DB::Connection('mysql')
                    ->table('zkfetches')
                    ->insert(['id'=> $item->id, 'biometricsuid'=>$item->biometricsuid, 'empid'=>$item->empid, 'logs'=>$item->logs,
                     'status'=>$item->status, 'type'=>$item->type, 'created_at'=>$item->created_at, 'updated_at'=>$item->updated_at]);
                }
             
          
            }
            return response()->json(['message' => 'Success'], 200);
            // \DB::connection('mysql')->getPDO();
            // echo \DB::connection('mysql')->getDatabaseName();
         
          
           
        //    return $users;

      
     }
  

     public function apicloud(){
    //   $get =  WebhookCall::get()
    //   ->url('188.166.180.113')
    //   ->useSecret('sign-using-this-secret')
    //   ->dispatch();
//    ->payload(['key' => 'value'])
//    ->useSecret('sign-using-this-secret')
//    
     echo $get;
     return ;   
}

public function routeNotificationForSlack()
{
    return 'https://www.acs.multi-linegroupofcompanies.com/';
}

public function addmaxteamid(){
    $maxteam = DB::table('teams')
                ->max('id');
                return response()->json(['id' => $maxteam], 200);

}

public function addmaxpositionsid(){
    $maxpositions = DB::table('tbl_position_list')
                    ->max('id');
                    return response()->json(['id' => $maxpositions], 200);
}

public function addmaxcompanyid(){
    $maxcompany = DB::table('tbl_company_name')
                ->max('company_id');
                return response()->json(['id' => $maxcompany], 200);
}

public function addmaxdepartmentid(){
    $maxdepartment = DB::table('tbl_department_list')
                    ->max('id');
                    return response()->json(['id' =>$maxdepartment], 200);
                    
}
    public function getbiometrics(Request $request)
    {
        if ($request->ajax()) {
            $data = zkfetch::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


 
public function absentscount(){
    $absentscount = DB::table('zkabsents')
    ->where('empid', Auth::user()->empid)->count();
    return $absentscount;

}   
}


