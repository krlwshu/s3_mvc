<?php

namespace App\Controllers;
use App\Models\AppraisalModel;
class Analysis extends BaseController
{
    
    public function index()
    {
        $session = session();
        $data['user'] = $session->get('name');

        return view('analysis', $data);
    }

    public function searchData(){
        $AppraisalModel = new AppraisalModel();
        $searchTerm = $this->request->getVar('searchTerm');
        $data['data'] = $AppraisalModel->searchData($searchTerm);
        return $this->response->setJSON($data);

    }
}