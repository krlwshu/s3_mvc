<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\AppraisalModel;

class EngDashController extends Controller
{
    public function index()
    {
        $session = session();
        $appModel = new AppraisalModel();
        $id = intval($session->get('id'));
        $data['engAppraisals'] = $appModel->getEngAppraisals($id);
        return view('engDash', $data);


    }
}