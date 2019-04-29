<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TesModel extends CI_Model {

	//public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	function getpulang($em_id,$from_date,$to_date){
		

		$start_date = new DateTime($from_date);
		$end_date = new DateTime($to_date);
		$end_date = $end_date->modify( '+1 day' ); 
		
		$interval_re = new DateInterval('P1D');
		$date_range = new DatePeriod($start_date, $interval_re ,$end_date);
		$attendance_arr = array();		
		$data = array();
		$employee = $this->db->get_where('xin_employees',['user_id'=>$em_id]);
		
foreach($date_range as $date) {
	$data['data'] =  $date->format("Y-m-d");
	// $get_day = strtotime($attendance_date);
	// $day = date('l', $get_day);
	//$office_shift = $this->db->get_where('xin_employee_shift',['']);


	}
	return $data;
	}
function tes(){
		echo "HAI";
	}
}

/* End of file TesModel.php */
/* Location: ./application/models/TesModel.php */