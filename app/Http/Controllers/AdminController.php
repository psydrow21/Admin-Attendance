<?php

namespace App\Http\Controllers;
use App\Models\zkfetch;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\projectmanager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use DataTables;

use Spatie\WebhookClient\Models\WebhookCall;
use DB;

class AdminController extends Controller
{
    //
    public static function attendancecontent(){
        return view('section.attendancecontent');

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

 
    
    public static function addemployeefunction(Request $request){
       
        if($request->addprojectline == "ProjectSite"){

            return "HEllo";
        }else if($request->addprojectline == "HeadOffice"){
            return "Hi";
        }else if($request->addprojectline == "Everfirst"){
            return "kol";
        }
       


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

    public static function district(){
        $district = DB::table('tbl_district_list')
                    ->get();

                    return DataTables::of($district)
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
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

    public static function branchdisplay(){
        $branch = DB::table('tbl_branch_list')
        ->get();

        return DataTables::of($branch)
        ->addColumn('action', function($row){
            $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $actionBtn;
        })
        ->addColumn('district_code', function($row){
        $districtcheck = DB::table('tbl_district_list')
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

    public static function companycount(){
        $companycount = DB::table('tbl_company_name')->count();
        return $companycount;
    }
    public static function userscount(){
        $userscount = DB::table('users')->count();
        return $userscount;
    }
    public static function branchescount(){
        $branchescount = DB::table('tbl_branch_list')->get()->count();
        return $branchescount;
    }
    public static function areadisplay(){
        $area = DB::table('tbl_area')
                ->get();

                return DataTables::of($area)
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('district_code', function($row){
                    $districtcheck = DB::table('tbl_district_list')
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



    public static function companydisplay(){
      
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
        $existingdata = User::where('empid', $request->addEmpid)
        ->orWhere('name', $request->AddNameUser)
        ->orWhere('username', $request->AddUsernameUser)
        ->orWhere('email', $request->AddEmailUser)
        ->exists();

            try {
        
                $this->validate($request,[
                        'AddNameUser'=>'required',
                        'addEmpid'=>'required',
                        'addcompany'=>'required',
                        'addbranchline'=>'required'
        
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
                    
            
        
                $fetchid = User::max('id');
                
        
                if($request->addbranchline == "ProjectSite"){
        
                    $position = $request->addprojectlines;
                    
                    $user = User::insert(['empid'=>$request->addEmpid, 
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
        
                    $user = User::insert(['empid'=>$request->addEmpid, 
                    'company_id'=>$request->addcompany, 'name'=>$request->AddNameUser, 'email'=>$request->AddEmailUser, 'username'=>$request->AddUsernameUser,
                'password'=>$request->AddPasswordUser, 'district_code'=>$request->adddistrict, 'area_code'=>$request->addarea, 'branch_code'=>$request->addbranch]);
                
                }elseif($request->addbranchline == "HeadOffice"){
                    $user = User::insert(['empid'=>$request->addEmpid, 
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

      
        
        

        return view('section.dashboard', compact('var2' , 'company','companyread', 'branch', 'district', 'area', 'team', 'operationmanager', 'position', 'exist', 'checking'));

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

     public static function sample(){
        return view('login.sample');
     }

     public static function lol(){
     

     }
     public static function cloud(){
            $biodata = DB::Connection('mysql')->table('zkfetches')->get();

        

            foreach($biodata as $item) { 
            // for($i = 0;$i<=count($biodata);$i++){

             

            $checks = DB::Connection('mysql2')
            ->table('zkfetches')
            ->where('id' , $item->id)
            ->where('biometricsuid' , $item->biometricsuid)
            ->exists();
            
         
                if(!$checks){
                    $users = DB::Connection('mysql2')
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

public function addmaxcompanyid(){
    $maxcompany = DB::table('tbl_company_name')
                ->max('company_id');
                return response()->json(['id' => $maxcompany], 200);
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
}
