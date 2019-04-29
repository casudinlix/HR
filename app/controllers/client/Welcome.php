<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->model('Login_model');
			$this->load->model('Employees_model');
			$this->load->model('Users_model');
			$this->load->library('email');
			$this->load->model("Xin_model");
			$this->load->model("Designation_model");
			$this->load->model("Department_model");
			$this->load->model("Location_model");
			$this->load->model("Clients_model");
	}
	
	public function index()
	{		
		$data['title'] = 'HR MII';
		$this->load->view('client/auth/login', $data);	
	}
}