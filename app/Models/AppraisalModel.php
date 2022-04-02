<?php

namespace App\Models;

use CodeIgniter\Model;

class AppraisalModel extends Model
{

    function getEngineers()
    {

        $db = db_connect();
        $getStaffSQl = "
        SELECT 
        s.id, 
        s.name,
        s.belt,
        s.id,
        a.due_date,
        a.status,
        su.avatar,
        DATEDIFF(NOW(), max(a.date_created) ) AS last_app,
        s.appraisal_period_days AS app_cycle
        FROM staff s
        LEFT JOIN appraisals a ON 
        a.user_id = s.id
        LEFT JOIN sys_users su ON s.user_id = su.id
        GROUP BY s.id
        ORDER BY last_app asc";
        
        // $getStaffSQl = "
        // SELECT 
        // s.name,
        // s.belt,
        // s.id,
        // a.due_date,
        // a.status,
        // su.avatar,
        // GROUP_CONCAT(atemp.template_name) AS template_names,
        // GROUP_CONCAT(atemp.id) AS template_ids
        // FROM staff s
        // LEFT JOIN appraisals a ON
        // a.user_id = s.id
        // LEFT JOIN app_templates atemp ON atemp.id = a.template_id
        // left join sys_users su on s.user_id = su.id
        // GROUP BY s.name";
        
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
            a.status,
            a.last_updated
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
        if($results){
            return $results[0]['status'];
        } 
    }
    function getLastApp(){
        $db = db_connect();
        $sql = "SELECT 
            s.id, s.name, 
            DATEDIFF(NOW(), max(a.date_created) ) AS lapsed,
            s.appraisal_period_days AS cycle
            FROM staff s
            LEFT JOIN appraisals a ON 
            a.user_id = s.id
            
            GROUP BY s.id";

        $results = $db->query($sql)->getResult('array');
        return $results;
    }
    function getReviewItems(){
        $db = db_connect();
        $sql = "SELECT 
        s.id AS staff_id,
        s.name,
        a.id AS app_id,
        atemp.template_name,
        a.date_created,
        a.assigned_by,
        a.status,
        a.last_updated
        FROM appraisals a
        LEFT JOIN app_templates atemp ON
        a.template_id = atemp.id
        LEFT JOIN staff s ON s.id = a.user_id";

        $results = $db->query($sql)->getResult('array');
        return $results;
    }


    function searchData($searchTerm){
        $db = db_connect();
        $sql = "SELECT template_name, question, response 
        FROM app_data_view WHERE 
        question_type = 'FT' and response like '%$searchTerm%'";

        $results = $db->query($sql)->getResult('array');
        return $results;
    }
    function schReview($data){
        $db = db_connect();
        $schDate = $data['date'] ." ". $data['time'];
        $id = $data['app_id'];
        $sql = "update appraisals set scheduled_date = '$schDate' where id = $id";

        $results['updated'] = $db->query($sql);
        return $results;
    }
    function getAppraisalComments($appId){
        $db = db_connect();

        $sql = "SELECT
            su.id AS user_id,
            adc.comment,
            adc.comment_date,
            su.role,
            su.name,
            adc.id AS comment_id,
            ad.appraisal_id,
            su.avatar,
            ad.id AS ad_id
            FROM app_review_comments adc
            LEFT JOIN sys_users su
            ON adc.user_id = su.id
            left JOIN app_data ad ON adc.app_data_id = ad.id
            WHERE ad.appraisal_id = $appId";

        $results = $db->query($sql)->getResult('array');

        return $results;
    }
    function createAction($data){
        $db = db_connect();

        $action = $data['actionSum'];
        $targDate = $data['targDate'];
        $assignee = $data['userId'];
        $respId  = $data['respIdAct'];
        $category  = $data['category'];

        $sql = "insert into app_review_actions 
        (action, target_date,assigned_to, app_data_id, category) values
        ('$action','$targDate', $assignee,$respId,'$category')
        
        ";

        $results['success'] = $db->query($sql);
        if($results['success']){
            $results['message'] = "Action Assigned";
        } else {
            $results['message'] = "Error creating action";
        }

        return $results;
    }

    function addReviewComment($data){
        $db = db_connect();

        $userId = $data['userId'];
        $comment = $data['comment'];
        $respId = $data['respId'];

        $sql = "insert into app_review_comments 
        (user_id, comment,app_data_id) values
        ($userId,'$comment',$respId)";

        $results = $db->query($sql);

        return $results;
    }
}