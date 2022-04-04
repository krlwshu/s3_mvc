<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AppraisalModel;
  
class Appraisal extends Controller
{
    public function index()
    {

    } 
  
    public function AssignAppraisal()
    {
        $session = session();
        $AppraisalModel = new AppraisalModel();


        $uid = $this->request->getVar('uid');
        $tempId = $this->request->getVar('tempId');

        $data = [
            'user_id' => $uid,
            'template_id'  => $tempId,
        ];

        $res = $AppraisalModel->assignAppraisal($data);

        return $this->response->setJSON($res);
    }

    public function Template(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        $uri = service('uri');
        
        $appId = $uri->getSegment(3);
        if (!$appId) {
            return redirect()->back();
        }
        

        $data['appId'] = $appId;
        $data['option_groups'] = $AppraisalModel->getQuestionOptions();
        $data['reviewComments'] = $AppraisalModel->getAppraisalComments($appId);
        $data['appraisalData'] = $AppraisalModel->getAppraisalData($appId);
        $data['percent'] = $AppraisalModel->getAppCompStatus($appId);
        $data['appProcessStatus'] = $AppraisalModel->getAppProcessStatus($appId);

        // Quick fix to handle invalid tempaltes
        if (!$data['appProcessStatus']) {
            return redirect()->back();
        } else{
            echo view("appraisal",$data);
        }
    }
    public function submitAppraisal(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        $appId = intval($this->request->getVar('appId'));
        $payload = $this->request->getVar('data');

        
        // Process updates, returns: affected rows, percent complete
        $data = $AppraisalModel->processAppraisal($appId, $payload);
        
        return $this->response->setJSON($data);
    }
    public function completeAppraisal(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        $appId = intval($this->request->getVar('appId'));
        $data = $AppraisalModel->updateAppraisalState($appId,'Review');
        return $this->response->setJSON($data);
    }
    public function schReview(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        
        $appId = $this->request->getVar('appId');
        $time = $this->request->getVar('time');
        $date = $this->request->getVar('date');
        
        $data = [
            'app_id' => $appId,
            'date' => $date,
            'time'  => $time,
        ];

        $res = $AppraisalModel->schReview($data);
        return $this->response->setJSON($res);
    }
    public function createAction(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        
        // Payload contains respId (to associate action), targetDate and action summary
        $payload = $this->request->getVar('data');
        $payload['userId'] = $session->get('id');
        $res = $AppraisalModel->createAction($payload);
        return $this->response->setJSON($res);
    }
    public function addReviewComment(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        
        // Payload contains comment and response id
        $payload = $this->request->getVar('data');
        $payload['userId'] = $session->get('id');
        $payload['name'] = $session->get('name');
        $payload['avatar_url'] = base_url(). $session->get('avatar');
        $payload['success'] = $AppraisalModel->addReviewComment($payload);

        // Enriched payload returned, for quickness
        return $this->response->setJSON($payload);
    }


    public function completeAction(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        $action = intval($this->request->getVar('action_id'));
        $resp['status'] = $AppraisalModel->completeAction($action);
        $resp['action_id'] = $action;

        return $this->response->setJSON($resp);
    }

}