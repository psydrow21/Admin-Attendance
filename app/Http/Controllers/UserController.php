<?php  
    
namespace App\Http\Controllers;  
    
use Illuminate\Http\Request;  
use App\DataTables\UsersDataTable;  
    
class UserController extends Controller  
{  
    /**  
     * It is used to display a listing of the resource.  
     *  
     * @return \Illuminate\Http\Response  
     */  
    public function index(UsersDataTable $dataTable)  
    {  
        return $dataTable->render('users');  
    }  

    public static function sample(){
        return view('section.sample');

    }
}  