<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['is_ajax']) && $_GET['data']=='event'){
	$session = $this->session->userdata('username');
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_hr_event');?></h4>
</div>
<?php $attributes = array('name' => 'add_event', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'm-b-1');?>
<?php $hidden = array('user_id' => $session['user_id']);?>
<?php echo form_open('admin/events/add_event', $attributes, $hidden);?>
  <div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
        <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
          <option value=""></option>
          <?php foreach($get_all_companies as $company) {?>
          <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group" id="employee_ajax">
        <label for="first_name"><?php echo $this->lang->line('dashboard_single_employee');?></label>
        <select class="form-control" name="employee_id" id="employee_id" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_choose_an_employee');?>">
          <option value=""></option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="event_title"><?php echo $this->lang->line('xin_hr_event_title');?></label>
        <input type="text" class="form-control" id="event_title" name="event_title" placeholder="<?php echo $this->lang->line('xin_hr_event_title');?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="start_date"><?php echo $this->lang->line('xin_hr_event_date');?></label>
        <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_hr_event_date');?>" readonly name="event_date" type="text" value="<?php echo $_GET['event_date'];?>" id="m_event_date">
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="event_time"><?php echo $this->lang->line('xin_hr_event_time');?></label>
        <input class="form-control etimepicker" placeholder="<?php echo $this->lang->line('xin_hr_event_time');?>" readonly name="event_time" type="text" id="m_event_time">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="event_note"><?php echo $this->lang->line('xin_hr_event_note');?></label>
        <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_hr_event_note');?>" name="event_note" id="event_note"></textarea>
      </div>
    </div>
  </div>
  <!--<div class="form-actions">
   
  </div>-->
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
   <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
</div>
<?php echo form_close(); ?>
<script type="application/javascript">
$(document).ready(function() {
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	$('#event_note').trumbowyg({
		btns: [
			['formatting'],
			'btnGrp-semantic',
			['superscript', 'subscript'],
			['removeformat'],
		],
		autogrowOnEnter: true
	});
	// Date
	$('.edate').datepicker({
	  changeMonth: true,
	  changeYear: true,
	  dateFormat:'yy-mm-dd',
	  yearRange: new Date().getFullYear() + ':' + (new Date().getFullYear() + 10),
	});
	var input = $('.etimepicker').clockpicker({
		placement: 'bottom',
		align: 'left',
		autoclose: true,
		'default': 'now'
	});
	jQuery("#aj_company").change(function(){
		jQuery.get(site_url +"events/get_employees/"+jQuery(this).val(), function(data, status){
			jQuery('#employee_ajax').html(data);
		});
	});
	/* Add data */ /*Form Submit*/
	$("#xin-form").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&add_type=event&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					var myCalendar = $('#calendar_hr'); 
					myCalendar.fullCalendar();
					var myEvent = {
					  event_id: JSON.re_event_id,
					  unq: '0',	
					  title: $('#event_title').val(),
					  allDay: true,
					  start: $('#m_event_date').val()+'T'+$('#m_event_time').val(),
					  color: '#2D95BF'
					};
					myCalendar.fullCalendar( 'renderEvent', myEvent );
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.view-modal-data').modal('toggle');
					$('#module-opt').hide();
					window.location = '';
				}
			}
		});
	});
});
</script>
<?php } ?>
