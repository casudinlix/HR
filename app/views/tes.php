<table border="1">
	<thead>
<th>ID Absen</th>
<th>USER NAME</th>
<th>import DATE</th>
<th>IN Import</th>
<th>OUT Import</th>
<th>Shift DaTE</th>
<th>Shift IN</th>
<th>Shift OUT</th>
<th>selisih</th>
<th>jam</th>
<th>menit</th>
<th>detik</th>
<th>terlambat</th>
<th>Pulang CEpat</th>
<th>HARI</th>
</thead>
<tbody>
	<tr>
	<?php foreach ($list as $key): ?>
		<?php $user = $this->Xin_model->read_user_by_employee_id($key['A']);
//$user = $this->Xin_model->read_user_by_employee_id($key['A']);
//$real=$this->db->get_where('xin_attendance_time',['attendance_date'=>$key['B']])->row();
$shiftin      = $this->Xin_model->ambilin($key['B'], $user[0]->user_id);
$shiftout     = $this->Xin_model->ambilout($key['B'], $user[0]->user_id);
$tanggalshift = $this->Xin_model->tanggalshift($key['B'], $user[0]->user_id);
$telat        = $this->Xin_model->gettelatdatang($user[0]->user_id, substr($tanggalshift, 0, 7), $shiftin, $key['C']);

if (empty($telat->jam_telat) AND $telat->menit_telat>3) {
	if ($telat->menit_telat>=30) {
		$pulang=0.5;
	}
}else{
$pulang=0;
}
//$libur=libur($key['B']);
$get_day = strtotime($key['B']);
$day     = date('l', $get_day);
if ($day == "Saturday" or $day == "Sunday") {
    $status = "Libur";
    if (!empty($key['C']) and !empty($key['D'])) {
        $status = "OT Holiday";
    }
} elseif ($key['C'] == "" and $key['D'] == "") {
    if ($day != "Saturday" and $day != "Sunday") {
        $status = "Alpa";
    }
} elseif ($key['C'] == "") {
    if ($day != "Saturday" and $day != "Sunday") {
        $status = "Tidak Absen Datang";
    }
} elseif ($key['D'] == "") {
    if ($day != "Saturday" and $day != "Sunday") {
        $status = "Tidak Absen Pulang";
    }
} else {
    $status = "Hadir";
}
?>
<td><?php echo $key['A'] ?></td>
<td><?php echo $user[0]->first_name ?></td>
<td><?php echo $key['B'] ?></td>
<td><?php echo $key['C'] ?></td>
<td><?php echo $key['D'] ?></td>
<td><?php echo $tanggalshift ?></td>
<td><?php echo $shiftin ?></td>
<td><?php echo $shiftout ?></td>
 <td><?php echo $selisih ?></td>
<td><?php echo $jam ?></td>
<td><?php echo $menit ?></td>
<td><?php echo $detik ?></td>
<td><?php echo $pulang?></td>
<td></td>
<td colspan="" rowspan="" headers=""><?php echo $day . " " . $status ?></td>
		</tr>
	<?php endforeach?>
</tbody>
</table>
<ht