<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\AppraisalModel;

class ProfileController extends Controller
{
    public function index()
    {
        // Used as routing mechanism, PM or eng still protected by authGuard
        $session = session();
        $role = $session->get('role');
        if($role == "pm"){
            return redirect()->to('/PmDash');
        } elseif($role == "eng") {
            return redirect()->to('/EngDash');
        } elseif($role == "rep" ){
            return redirect()->to('/RepDash');
        } else {
            // Don't know if this actually works, but shouldn't be needed
            return redirect()->to('/LoginController/Logout');
        }



    }
}