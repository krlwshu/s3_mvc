<?php

namespace App\Models;

use CodeIgniter\Model;

class AppraisalModel extends Model
{

    function getUsers()
    {

        $db = db_connect();
        $getStaffSQl = "
        SELECT 
        s.name,
        s.belt,
        s.id,
        a.due_date,
        a.status,
        GROUP_CONCAT(atemp.template_name) AS template_names,
        GROUP_CONCAT(atemp.id) AS template_ids
        FROM staff s
        LEFT JOIN appraisals a ON
        a.user_id = s.id
        LEFT JOIN app_templates atemp ON atemp.id = a.template_id
        GROUP BY s.name";
        
        $results = $db->query($getStaffSQl)->getResult('array');

        return $results;
    }

    function getTemplates()
    {

        $db = db_connect();
        $sql = "select * from app_templates";
        $results = $db->query($sql)->getResult('array');
        return $results;
    }
    function getSubmitted()
    {

        $db = db_connect();
        $sql = "SELECT staff.id, staff.name, appraisals.due_date, appraisals.status FROM staff JOIN appraisals WHERE staff.id=appraisals.user_id  ORDER BY appraisals.due_date ASC";
        $results = $db->query($sql)->getResult('array');
        return $results;
    }


    function assignAppraisal($data)
    {      
        $db = db_connect();
        $builder = $db->table('appraisals');

        
        $builder->insert($data);

        return $builder->insert($data);

        
    }

    function getEngAppraisals($id)
    {      
        $db = db_connect();

        $sql = "
            SELECT 
            a.id,
            atemp.template_name,
            count(ad.appraisal_id) AS question_count,
            COUNT(ad.response) AS completed_count,
            a.date_created,
            a.assigned_by,
            a.status
        
        
            FROM appraisals a
        
            LEFT JOIN app_data ad ON
            
            
            ad.appraisal_id = a.id
        
            LEFT JOIN app_templates atemp ON
            a.template_id = atemp.id
        
        
            WHERE a.user_id = $id
            GROUP BY a.id
        ";
        $results = $db->query($sql)->getResult('array');
        return $results;

        
    }
    function getAppraisalData($id)
    {      
        // Gets appraisal by appraisal ID
        $db = db_connect();

        $sql = "
        SELECT * FROM app_data_view where id = $id
        ";
        $results = $db->query($sql)->getResult('array');
        return $results;
    }
    function getQuestionOptions()
    {      
        $db = db_connect();

        $sql = "SELECT * FROM question_options";
        $results = $db->query($sql)->getResult('array');
        return $results;

        
    }
    function processAppraisal($appId, $payload){      
        $db = db_connect();

        $appraisalData = $this->getAppraisalData($appId);

        $dbUpdArr = array();

        foreach ($payload as $resp){
            $str = $resp['name'];
            $startPos = strpos($str, "-");
            $strLen = strlen($str);
            $qId  = intval(substr($str, ($startPos + 1) - $strLen));
            
            foreach($appraisalData as $aItem){
                // Initialise DB item to be appended to main arr
                $dbUpdItem = array('id'=>$qId,'response'=>($resp['value'])?$resp['value']:Null,'resp_value'=>(Null));

                // Verify tempalte type (i.e. which field to insert to)
                if($aItem['resp_id'] == $qId){
                    // Loop through appraisal data, store integer in value field (quick metric use)
                    
                    if($aItem['question_type'] != "FT"){
                        $dbUpdItem['resp_value'] = intval($resp['value']);
                    }
                    $dbUpdArr[] = $dbUpdItem;
                }
            }
        }
        $updStatus = false;
        $builder = $db->table('app_data');
        
        $data['updates'] = $builder->updateBatch($dbUpdArr, 'id');
        $data['percent'] = $this->getAppCompStatus($appId);
        $data['success'] = ($data['updates'] > 0) ? true: false;
        $data['message'] = ($data['updates']) ? "Item Updated":'Error updating item';
        return  $data;
    }

    function getAppCompStatus($appId){
        $db = db_connect();
        $sql = "
        SELECT COUNT(id) AS qCount, COUNT(response) AS qComp FROM app_data_view where id = $appId GROUP BY id limit 1";
        $results = $db->query($sql)->getResult('array');

        $percent = 0;
        // Protect div zero
        if($results){
            $denom = $results[0]['qCount'];
            $percent = (intval($results[0]['qComp']) != 0) ? (100/ $denom ) * intval($results[0]['qComp']) : 0;
        } 
        return $percent;
    }
    function updateAppraisalState($appId, $status){
        $db = db_connect();
        $sql = "update appraisals set status = '$status' where id = $appId";

        $results['success'] = $db->query($sql);
        $results['message'] = ($results['success'])? "Appraisal submitted for review" : "Unable to close appraisal, please check that all fields have been completed";
        return $results;
    }
    function getAppProcessStatus($appId){
        $db = db_connect();
        $sql = "select status from appraisals where id = $appId";
        $results = $db->query($sql)->getResult('array');
        return $results[0]['status'];
    }
}