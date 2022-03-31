<?php

namespace App\Controllers;
use App\Models\Test;

class Home extends BaseController
{
    
    public function index()
    {
        $session = session();
        // echo view('templates/header');
        // echo view('templates/footer');
        // echo view('news/overview', $data);
        // echo view('templates/footer', $data);
        $data['user'] = $session->get('name');

        return view('home', $data);
    }
    public function MyTeam()
    {
        // $crudModel = new Test();
        $session = session();
        $data['user'] = $session->get('name');

		// $data['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);

		// $data['pagination_link'] = $crudModel->pager;

		return view('myTeam', $data);
	}
}