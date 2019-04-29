
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myerror extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('error/index');
	}
function xx(){
	$table->bigInteger('votes')->nullable()->default(12);;
}
}

/* End of file Myerror.php */
/* Location: ./application/controllers/Myerror.php */