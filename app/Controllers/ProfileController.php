<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\AppraisalModel;

class ProfileController extends Controller
{
    public function index()
    {
        $session = session();
        $appModel = new AppraisalModel();

        if($session->get('role') == "pm"){
            $data['engineers'] = $appModel->getUsers();
            $data['templates'] = $appModel->getTemplates();
            $data['submissions'] = $appModel->getSubmitted();

            return view('myTeam', $data);
        } else {
            $id = intval($session->get('id'));
            $data['engAppraisals'] = $appModel->getEngAppraisals($id);

            return view('engDash', $data);
        }



    }
}