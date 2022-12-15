<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ZKFetching;

use App\Models\User;

use App\Http\Middleware\CheckStatus;
use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Support\Facades\DB;


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

Route::get('/attendancefilter', [ZKFetching::class, 'attendancefilter'])->name('attendancefilter');

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
Route::post('/addnewemployeefunction' , [AdminController::class, 'addnewemployeefunction'])->name('addnewemployeefunction');

Route::get('/adddata', [AdminController::class, 'adddata'])->name('adddata');
Route::post('/addnewdepartment', [AdminController::class, 'addnewdepartment'])->name('addnewdepartment');


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
Route::get('/', function () {
    return view('login.login');
});
