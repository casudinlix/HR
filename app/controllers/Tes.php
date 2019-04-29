
<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

use PhpOffice\PhpSpreadsheet\IOFactory as baca;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

class Tes extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('TesModel', 'model');
		$this->load->model('Xin_model');
		$this->load->model('Timesheet_model');
	}

	public function index() {
		$options = array('cost' => 10);
		$password_hash = password_hash("admin", PASSWORD_BCRYPT, $options);
		//$hash = '$2y$12$T3Btm1CpzH8sT0se/IPOruv8BKOiildqjP3LFfpV3UQ6jsaNK.I7e';
		//password_verify($hash, $options);
		//echo password_verify('123', $password_hash);
		echo $password_hash;

	}
	function cek() {

		echo $password = $this->hash(123);
	}
	public function hash($string) {
		$encryption_key = 'I6PnEPbQNLslYMj7ChKxDJ2yenuHLkXn';
		return hash('sha512', $string . $encryption_key);
	}

	function duludansekarang() {
		$year = 2009; //5.2
		// [17-Dec-2009]
		// The PHP development team would like to announce the immediate availability of PHP 5.2.12. This release focuses on improving the stability of the PHP 5.2.x branch with over 60 bug fixes, some of which are security related. All users of PHP 5.2 are encouraged to upgrade to this release.
		if (condition) {
			# code...
		} else {
			# code...
		}
////////

		$year = 2019; //7.2 - 7.3
		// //10 Jan 2019
		// The PHP development team announces the immediate availability of PHP 7.2.14. This is a security release which also contains several minor bug fixes.
		$sekarang = (condition) ? a : b;

	}
	function xls() {

		$csvFile = 'absen.ods';
		$this->load->model("Xin_model");
		$reader = baca::createReader("Ods");

// $reader=baca::createReader("Xls");
		// $reader=baca::createReader("Xlsx");
		// $reader=baca::createReader("Csv");
		$spreadsheet = $reader->load($csvFile);
//$data['list'] = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$data['list'] = $this->Xin_model->hitungtelat();
		$data['list1'] = $this->Xin_model->hitungcepat();
		$data['ot'] = $this->Xin_model->hitungot_otomatis();

		$data['xls'] = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

//  foreach ($sheetData as $key ) {
		//  $user = $this->Xin_model->read_user_by_employee_id($key['A']);
		// //$user = $this->Xin_model->read_user_by_employee_id($key['A']);
		// $data['in']=$this->Xin_model->ambilin($key['B'],$user[0]->user_id);
		// $data['out']=$this->Xin_model->ambilout($key['B'],$user[0]->user_id);
		// // $tgl_shift=$this->Xin_model->tanggalshift($key['B'],$user[0]->user_id);
		// // $telat=$this->Xin_model->gettelatdatang($user[0]->user_id,$tgl_shift,$in);

//  }

		$this->load->view('tes1', $data);
	}
	function oth8() {
		$data['ot'] = $this->Xin_model->lemburholidays();
		$this->load->view('tes/oth', $data);
	}
	function array1() {
		$this->load->model('Employees_model');
		$result = $this->Employees_model->read_employee_information(196);
		echo $dept = $result[0]->department_id . "</br>";
		$deptid = explode(",", $dept);

		foreach ($deptid as $key) {
			echo $dept_id = $key . "</br>";
		}
		$dept_id;
	}
	function testanggal() {
		$from = "2019-01-01";
		$to = "2019-01-31";
		$id = 1;
		//var_dump($this->model->getpulang($id,$from,$to));
		$start_date = new DateTime($from);
		$end_date = new DateTime($to);
		$end_date = $end_date->modify('+1 day');

		$interval_re = new DateInterval('P1D');
		$date_range = new DatePeriod($start_date, $interval_re, $end_date);
		$attendance_arr = array();
		$data = array();
		$employee = $this->db->get_where('xin_employees', ['user_id' => $id]);

		foreach ($date_range as $date) {
			$attendance_date = $date->format("Y-m-d");
			$get_day = strtotime($attendance_date);
			$day = date('l', $get_day);
			//$office_shift = $this->db->query("SELECT * FROM view_shift WHERE employee_id='$id' AND bulan=MONTH('$start_date')")->result();//$this->db->get_where('view_shift',['employee_id'=>$id,'bulan'=>])->result();

			echo $attendance_date . "</br>";
		}
	}
	function cuti() {
		$from = "2019-02-01";
		$to = "2019-02-03";
		$tgl = "2019-02-01";
		$csvFile = 'absen.ods';
		$reader = baca::createReader("Ods");
		$spreadsheet = $reader->load($csvFile);
		$this->load->model("Xin_model");
		$data['list'] = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		$this->load->view('tes/cuti', $data);

	}
}

/* End of file Tes.php */
/* Location: ./application/controllers/Tes.php */