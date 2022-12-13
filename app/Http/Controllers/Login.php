<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;use Illuminate\Support\Facades\Route;
use Rats\Zkteco\Lib\ZKTeco;
use App\Http\Controllers\ZKFetchingController;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;


class Login extends Controller
{

 
    //
    public static function loginpage() {
      return  view('login.login');
    }

    public static function logout(Request $request){
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return view('login.login');    

    }
  
    
 

    public function authenticate(Request $request)
    {    
        $this->validate($request, [
            "username" => "required",
            "password" => "required"
        ]);

         
        try {
            if ($data = User::where('username', $request->username)->where('password', $request->password)->first()) {
                
         
                Auth::login($data);
        
                
                return redirect()->intended('main');   

            }else {
                Session::flash("error", "Invalid Credentials");
                return redirect()->back()->withInput($request->only('username'));
            }
            }
            catch (ValidationException $ex) {
                return response()->json(['errors'=>$ex->errors()], 422);
            }
            catch (\Throwable $th) {
                return response()->json(['error'=>$th->getMessage()], 500);
            }
            // catch (\Throwable $th) {
            //     // Session::flash("error", $th->getMessage());
            //     // return redirect()->back();

            // }
    
    }
    

}
