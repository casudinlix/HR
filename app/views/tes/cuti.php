<table border="1">
	<caption>table title and/or explanatory text</caption>
	<thead>
		<tr>
			<th>TGL Upload Absen</th>
			<th>cek CUTI</th>
			<th>header</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php foreach ($list as $key): ?>
<?php
$leave_date_chck = $this->Timesheet_model->leave_date_check(1, $key['B']);
$leave_arr = array();
if ($leave_date_chck->num_rows() >= 1) {
	$leave_date = $this->Timesheet_model->leave_date(1, $key['B']);
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
}?>
				<td colspan="" rowspan="" headers=""><?php echo $key['B'] ?></td>
				<td colspan="" rowspan="" headers=""><?php echo in_array($key['B'], $leave_arr) ?></td>
		</tr>
	<?php endforeach;?>
	</tbody>
</table>