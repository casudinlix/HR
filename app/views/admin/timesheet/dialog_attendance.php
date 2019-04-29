<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (isset($_GET['jd']) && isset($_GET['employee_id']) && $_GET['data'] == 'add_attendance') {
	// get addd by > template
	$user = $this->Xin_model->read_user_info($_GET['employee_id']);
	$ful_name = $user[0]->first_name . ' ' . $user[0]->last_name;
	?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_add_attendance_for'); ?> <?php echo $ful_name; ?></h4>
</div>
<?php $attributes = array('name' => 'add_attendance', 'id' => 'add_attendance', 'autocomplete' => 'off', 'class' => 'm-b-1');?>
<?php $hidden = array('_method' => 'ADD');?>
<?php echo form_open('admin/timesheet/add_attendance/', $attributes, $hidden); ?>
<?php
$data = array(
		'name' => 'employee_id_m',
		'id' => 'employee_id_m',
		'value' => $_GET['employee_id'],
		'type' => 'hidden',
		'class' => 'form-control',
	);

	echo form_input($data);
	?>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group"> </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="date"><?php echo $this->lang->line('xin_attendance_date'); ?></label>
              <input class="form-control attendance_date_m" placeholder="<?php echo $this->lang->line('xin_attendance_date'); ?>" readonly="true" id="attendance_date_m" name="attendance_date_m" type="text">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="clock_in"><?php echo $this->lang->line('xin_office_in_time'); ?></label>
              <input class="form-control timepicker_m" placeholder="<?php echo $this->lang->line('xin_office_in_time'); ?>" readonly="true" id="clock_in_m" name="clock_in_m" type="text">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="clock_out"><?php echo $this->lang->line('xin_office_out_time'); ?></label>
              <input class="form-control timepicker_m" placeholder="<?php echo $this->lang->line('xin_office_out_time'); ?>" readonly="true" id="clock_out_m" name="clock_out_m" type="text">
            </div>
          </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="clock_out">Shift</label>
             <select data-plugin="select_hrm"  class="form-control" name="shift_id">
             	<?php foreach ($all_shift->result() as $key): ?>
             		<option value="<?php echo $key->office_shift_id ?>"> <?php echo $key->shift_name . " - " . $key->monday_in_time . " - " . $key->monday_out_time ?></option>
             	<?php endforeach?>
             </select>
            </div>
          </div>
           <div class="form-group">
			<label for="clock_out">Overtime Holiday</label>
             <input type="hidden" name="lembur" value="" placeholder="0"  class="form-control">


            </div>
        </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="clock_out"><?php echo $this->lang->line('dashboard_xin_status'); ?></label>
              <select data-plugin="select_hrm" class="form-control" name="status">
              	<option>--</option>
              	<option value="Libur">Libur</option>
              	<option value="Hadir">Hadir</option>
              	<option value="Sakit">Sakit</option>
              	<option value="Ijin Khusus">Ijin Khusus</option>
              	<option value="Ijin">Ijin</option>
              	<option value="Alpa">Alpa</option>
              	<option value="Tidak Absen Datang">Tidak Absen Datang</option>
              	<option value="Tidak Absen Pulang">Tidak Absen Pulang</option>
              	<option value="Overtime">Overtime</option>
              	<option value="Overtime Holidays">Overtime Holidays</option>
              	<option value="Pulang Awal">Pulang Awal</option>
              	<option value="Terlambat">Terlambat</option>
                <option value="Ganti Hari">Ganti Hari</option>

              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close'); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('xin_save'); ?></button>
  </div>
<?php echo form_close(); ?>
<script type="text/javascript">
 $(document).ready(function(){

		// Clock
		var input = $('.timepicker_m').clockpicker({
			placement: 'bottom',
			align: 'left',
			autoclose: true,
			'default': 'now'
		});

		// attendance date
		$('.attendance_date_m').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat:'yy-mm-dd',
			altField: "#date_format",
			altFormat: "d M, yy",
			yearRange: '1970:' + new Date().getFullYear(),
			beforeShow: function(input) {
				$(input).datepicker("widget").show();
			}
		});

		/* Add Attendance*/
		$("#add_attendance").submit(function(e){
			var attendance_date_m = $("#attendance_date_m").val();
			var emp_id = $("#employee_id_m").val();
			var clock_in_m = $("#clock_in_m").val();
			var clock_out_m = $("#clock_out_m").val();
			if(attendance_date_m!='' && emp_id!='' && clock_in_m!='' && clock_out_m!='') {
				var xin_table = $('#xin_table').dataTable({
				"bDestroy": true,
				"ajax": {
					//url : "<?php echo site_url("admin/timesheet/update_attendance_list") ?>?employee_id="+emp_id+"&attendance_date="+attendance_date_m,
					url : site_url+"timesheet/updateabsen/?start_date="+$('#start_date').val()+"&end_date="+$("#end_date").val()+"&user_id="+$('#employee_id').val(),
					cache: false,
					type : 'GET'
				},
				dom: 'lBfrtip',
				"buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
				"fnDrawCallback": function(settings){
				$('[data-toggle="tooltip"]').tooltip();
				}
			});
			}
		/*Form Submit*/
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=4&add_type=attendance&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					} else {
						$('.add-modal-data').modal('toggle');
							xin_table.api().ajax.reload(function(){
								toastr.success(JSON.result);
							}, true);
							$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});
  </script>
<?php } else if (isset($_GET['jd']) && isset($_GET['attendance_id']) && $_GET['type'] == 'attendance' && $_GET['data'] == 'attendance') {
	?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_edit_attendance_for'); ?> <?php echo $full_name; ?></h4>
</div>
<?php $attributes = array('name' => 'edit_attendance', 'id' => 'edit_attendance', 'autocomplete' => 'off', 'class' => 'm-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $_GET['attendance_id']);?>
<?php echo form_open('admin/timesheet/edit_attendance/' . $time_attendance_id, $attributes, $hidden); ?>
<?php
$data = array(
		'name' => 'emp_att',
		'id' => 'emp_att',
		'value' => $employee_id,
		'type' => 'hidden',
		'class' => 'form-control',
	);

	echo form_input($data);
	?>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="date"><?php echo $this->lang->line('xin_attendance_date'); ?></label>
          <input class="form-control attendance_date_e" placeholder="<?php echo $this->lang->line('xin_attendance_date'); ?>" readonly="true" id="attendance_date_e" name="attendance_date_e" type="text" value="<?php echo $attendance_date; ?>">
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="clock_in"><?php echo $this->lang->line('xin_office_in_time'); ?></label>
              <input class="form-control timepicker" placeholder="<?php echo $this->lang->line('xin_office_in_time'); ?>" readonly="true" name="clock_in" type="text" value="<?php echo $clock_in; ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="clock_out"><?php echo $this->lang->line('xin_office_out_time'); ?></label>
              <input class="form-control timepicker" placeholder="<?php echo $this->lang->line('xin_office_out_time'); ?>" readonly="true" name="clock_out" type="text" value="<?php echo $clock_out; ?>">
            </div>
          </div>
           <div class="col-md-6">
            <div class="form-group">
			<label for="clock_out">Shift</label>
             <select data-plugin="select_hrm"  class="form-control" name="shift_id" required="">
             	<?php foreach ($all_shift->result() as $key): ?>
             	<option value="<?php echo $key->code ?>" <?php echo ($code == $key->code) ? "selected" : "" ?>> <?php echo $key->shift_name . " - " . $key->monday_in_time . " - " . $key->monday_out_time ?></option>

             	<?php endforeach?>
             </select>


            </div>

          </div>
 <div class="form-group">
			<label for="clock_out">Overtime Holiday</label>
             <input type="hidden" name="lembur" value="<?php echo $lembur ?>" placeholder="0"  class="form-control">


            </div>
        </div>
               <div class="form-group">
              <label for="clock_out"><?php echo $this->lang->line('dashboard_xin_status'); ?></label>
              <select data-plugin="select_hrm" class="form-control" name="status">
              	<option>--</option>
              	<option value="Libur" <?php echo ($status == 'Libur') ? 'selected' : '' ?>>Libur</option>
              	<option value="Hadir" <?php echo ($status == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
              	<option value="Sakit" <?php echo ($status == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
              	<option value="Ijin Khusus" <?php echo ($status == 'Ijin Khusus') ? 'selected' : '' ?>>Ijin Khusus</option>
              	<option value="Ijin" <?php echo ($status == 'Ijin') ? 'selected' : '' ?>>Ijin</option>
              	<option value="Alpa" <?php echo ($status == 'Alpa') ? 'selected' : '' ?>>Alpa</option>
              	<option value="Tidak Absen Datang" <?php echo ($status == 'Tidak Absen Datang') ? 'selected' : '' ?>>Tidak Absen Datang</option>
              	<option value="Tidak Absen Pulang" <?php echo ($status == 'Tidak Absen Pulang') ? 'selected' : '' ?>>Tidak Absen Pulang</option>
              	<option value="Overtime" <?php echo ($status == 'Overtime') ? 'selected' : '' ?>>Overtime</option>
              	<option value="Overtime Holidays" <?php echo ($status == 'Overtime Holidays') ? 'selected' : '' ?>>Overtime Holidays</option>
              	<option value="Pulang Awal" <?php echo ($status == 'Pulang Awal') ? 'selected' : '' ?>>Pulang Awal</option>
              	<option value="Terlambat" <?php echo ($status == 'Terlambat') ? 'selected' : '' ?>>Terlambat</option>
                <option value="Ganti Hari" <?php echo ($status == 'Ganti Hari') ? 'selected' : '' ?>>Ganti Hari</option>

              </select>
            </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close'); ?></button>
    <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_update'); ?></button>
  </div>
<?php echo form_close(); ?>
<script type="text/javascript">
$(document).ready(function(){

	// Clock
	var input = $('.timepicker').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		'default': 'now'
	});

	// attendance date
	$('.attendance_date_e').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'yy-mm-dd',
		altField: "#date_format",
		altFormat: "d M, yy",
		yearRange: '1970:' + new Date().getFullYear(),
		beforeShow: function(input) {
			$(input).datepicker("widget").show();
		}
	});

	/* Edit Attendance*/
		$("#edit_attendance").submit(function(e){
		var attendance_date_e = $("#attendance_date_e").val();
		var emp_att = $("#emp_att").val();
		var xin_table2 = $('#xin_table').dataTable({
			"bDestroy": true,
			"ajax": {
				// url : "<?php echo site_url("admin/timesheet/update_attendance_list") ?>?employee_id="+emp_att+"&attendance_date="+attendance_date_e,
				url : site_url+"timesheet/updateabsen/?start_date="+$('#start_date').val()+"&end_date="+$("#end_date").val()+"&user_id="+$('#employee_id').val(),
				cache: false,
				type : 'GET'
			},
			dom: 'lBfrtip',
			"buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
			"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();
			}
		});
		/*Form Submit*/
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=3&edit_type=attendance&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					} else {
						$('.edit-modal-data').modal('toggle');
						xin_table2.api().ajax.reload(function(){
							toastr.success(JSON.result);
						}, true);
						$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					}
				}
			});
		});
});
</script>
<?php }
?>
