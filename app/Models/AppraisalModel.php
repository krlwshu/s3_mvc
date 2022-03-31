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
            a.assigned_by


            FROM app_data ad

            LEFT JOIN appraisals a ON
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
}