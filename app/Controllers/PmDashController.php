<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\AppraisalModel;

class PmDashController extends Controller
{
    public function index()
    {
        $appModel = new AppraisalModel();
        $data['engineers'] = $appModel->getEngineers();
        $data['templates'] = $appModel->getTemplates();
        $data['submissions'] = $appModel->getSubmitted();
        $data['lastApp'] = $appModel->getLastApp();
        $data['pendingReview'] = $appModel->getReviewItems();
        
        return view('myTeam', $data);

    }
}