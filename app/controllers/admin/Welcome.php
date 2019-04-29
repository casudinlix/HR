<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->model('Employees_model');
		 $this->load->model('Xin_model');
	}
	
	public function index()
	{		
		$data['title'] = 'HR MII';
		$this->load->view('admin/auth/login', $data);
	}
}