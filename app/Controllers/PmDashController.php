<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\AppraisalModel;

class PmDashController extends Controller
{
    public function index()
    {
        $session = session();
        $uid = $session->get('id');
        $appModel = new AppraisalModel();
        $data['engineers'] = $appModel->getEngineers();
        $data['templates'] = $appModel->getTemplates();
        $data['submissions'] = $appModel->getSubmitted();
        $data['lastApp'] = $appModel->getLastApp();
        $data['pendingReview'] = $appModel->getReviewItems();
        $data['actionCount'] = $appModel->getActionCount($uid);
        $data['review_count'] = $appModel->getReviewsThisWeek($uid);
        $data['report'] = $appModel->getReport($uid);
        
        return view('myTeam', $data);

    }
}