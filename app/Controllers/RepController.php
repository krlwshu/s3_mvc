<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\AppraisalModel;

class RepController extends Controller
{
    public function index()
    {
        $session = session();
        $appModel = new AppraisalModel();
        $id = intval($session->get('id'));
        $data['reportMC'] = $appModel->getReport($id);
        $data['templates'] = $appModel->getDistTemplates($id);
        return view('report', $data);


    }
}