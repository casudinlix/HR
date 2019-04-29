<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

function libur($date) {
	$ci = &get_instance();
	$ci->load->model('Timesheet_model');
	$h_date_chck = $ci->Timesheet_model->holiday_date_check($date);
	$holiday_arr = array();
	if ($h_date_chck->num_rows() == 1) {
		$h_date = $ci->Timesheet_model->holiday_date($attendance_date);
		$begin = new DateTime($h_date[0]->start_date);
		$end = new DateTime($h_date[0]->end_date);
		$end = $end->modify('+1 day');

		$interval = new DateInterval('P1D');
		$daterange = new DatePeriod($begin, $interval, $end);

		foreach ($daterange as $date) {
			$holiday_arr[] = $date->format("Y-m-d");
		}
	} else {
		$holiday_arr[] = '99-99-99';
	}
	return $holiday_arr;
}
function cek_cuti($emp_id, $date) {
	$ci = &get_instance();
	$ci->load->model('Timesheet_model');
	$ci->load->model('Employees_model');
	$employee = $ci->employee_model->read_employee_information($emp_id);
	foreach ($employee as $r) {
		$leave_date_chck = $ci->Timesheet_model->leave_date_check($r->user_id, $date);
		$leave_arr = array();
		if ($leave_date_chck->num_rows() >= 1) {
			$leave_date = $ci->Timesheet_model->leave_date($r->user_id, $date);
			$begin1 = new DateTime($leave_date[0]->from_date);
			$end1 = new DateTime($leave_date[0]->to_date);
			$end1 = $end1->modify('+1 day');

			$interval1 = new DateInterval('P1D');
			$daterange1 = new DatePeriod($begin1, $interval1, $end1);

			foreach ($daterange1 as $date1) {
				$leave_arr[] = $date1->format("Y-m-d");
			}
		} else {
			$leave_arr[] = '99-99-99';
		}
		return $leave_arr;

	}
}
