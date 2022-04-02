<?php

namespace App\Controllers;
use App\Models\Test;

class Analysis extends BaseController
{
    
    public function index()
    {
        $session = session();
        // echo view('templates/header');
        // echo view('templates/footer');
        // echo view('news/overview', $data);
        // echo view('templates/footer', $data);
        $data['user'] = $session->get('name');

        return view('analysis', $data);
    }
}