<?php

namespace App\Controllers;
use App\Models\Test;

class Home extends BaseController
{
    public function index()
    {
        echo view('templates/header');
        echo view('templates/footer');
        // echo view('news/overview', $data);
        // echo view('templates/footer', $data);
    }
    public function Test()
    {
        $crudModel = new Test();

		$data['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);

		// $data['pagination_link'] = $crudModel->pager;

		return view('home', $data);
	}
}