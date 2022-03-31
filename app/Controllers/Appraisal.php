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

        $res['created'] = $AppraisalModel->assignAppraisal($data);

        return $this->response->setJSON($res);
    }

    public function Template(){
        $session = session();
        $AppraisalModel = new AppraisalModel();
        $uri = service('uri');
        
        $appId = $uri->getSegment(3) ?? 0;
        

        $data['option_groups'] = $AppraisalModel->getQuestionOptions();
        $data['appraisalData'] = $AppraisalModel->getAppraisalData($appId);
        

        echo view("appraisal",$data);
    }


}