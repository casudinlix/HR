<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['project_id']) && $_GET['data']=='view_project'){
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_view');?> <?php echo $this->lang->line('xin_project');?></h4>
</div>
<form class="m-b-1">
  <div class="modal-body">
    <table class="footable-details table table-striped table-hover toggle-circle">
      <tbody>
      <?php
	 	 if($project_progress <= 20) {
			$progress_class = 'progress-danger';
			$txt_class = 'text-danger';
		} else if($project_progress > 20 && $project_progress <= 50){
			$progress_class = 'progress-warning';
			$txt_class = 'text-warning';
		} else if($project_progress > 50 && $project_progress <= 75){
			$progress_class = 'progress-info';
			$txt_class = 'text-info';
		} else {
			$progress_class = 'progress-success';
			$txt_class = 'text-success';
		}
		?>
        <tr>
          <th><?php echo $this->lang->line('module_company_title');?></th>
          <td style="display: table-cell;"><?php foreach($all_companies as $company) {?>
            <?php if($company_id==$company->company_id):?>
            <?php echo $company->name;?>
            <?php endif;?>
            <?php } ?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_title');?></th>
          <td style="display: table-cell;"><?php echo $title;?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_client_name');?></th>
          <td style="display: table-cell;"><?php echo $client_name;?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_start_date');?></th>
          <td style="display: table-cell;"><?php echo $this->Xin_model->set_date_format($start_date);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_end_date');?></th>
          <td style="display: table-cell;"><?php echo $this->Xin_model->set_date_format($end_date);?></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('dashboard_xin_progress');?></th>
          <td style="display: table-cell;"><?php echo $this->lang->line('xin_completed').' '.$project_progress;?>%</td>
        </tr>
        <?php if($status=='0'):?> <?php $projectStatus = $this->lang->line('xin_not_started');?> <?php endif; ?>
        <?php if($status=='1'):?> <?php $projectStatus = $this->lang->line('xin_in_progress');?> <?php endif; ?>
        <?php if($status=='2'):?> <?php $projectStatus = $this->lang->line('xin_completed');?> <?php endif; ?>
        <?php if($status=='3'):?> <?php $projectStatus = $this->lang->line('xin_deffered');?> <?php endif; ?>
        <tr>
          <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
          <td style="display: table-cell;"><?php echo $projectStatus;?></td>
        </tr>
        <?php if($priority==1):?> <?php $projectPriority = $this->lang->line('xin_highest');?> <?php endif;?>
        <?php if($priority==2):?> <?php $projectPriority = $this->lang->line('xin_high');?> <?php endif;?>
        <?php if($priority==3):?> <?php $projectPriority = $this->lang->line('xin_normal');?> <?php endif;?>
        <?php if($priority==4):?> <?php $projectPriority = $this->lang->line('xin_low');?> <?php endif;?>
        <tr>
          <th><?php echo $this->lang->line('xin_p_priority');?></th>
          <td style="display: table-cell;"><?php echo $projectPriority;?></td>
        </tr>
         <?php $result = $this->Department_model->ajax_company_employee_info($company_id);?>
        <?php $assigned_ids = explode(',',$assigned_to); ?>
        <tr>
          <th><?php echo $this->lang->line('xin_project_manager');?></th>
          <td style="display: table-cell;"><ol><?php foreach($result as $employee) {?><?php if(isset($_GET)) { if(in_array($employee->user_id,$assigned_ids)):?> <li><?php echo $employee->first_name.' '.$employee->last_name;?></li> <?php endif; } } ?></ol></td>
        </tr>
        <tr>
          <th><?php echo $this->lang->line('xin_description');?></th>
          <td style="display: table-cell;">
          <?php if(str_word_count($description) > 65) { ?>
		  <div style="overflow:auto; height:200px;"><?php echo html_entity_decode($description);?></div>
          <?php } else { ?> <?php echo html_entity_decode($description);?> <?php } ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
  </div>
<?php echo form_close(); ?>
<?php } else if(isset($_GET['jd']) && isset($_GET['project_id']) && $_GET['data']=='project'){
	$assigned_ids = explode(',',$assigned_to)
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_edit_project');?></h4>
</div>
<?php $attributes = array('name' => 'edit_project', 'id' => 'edit_project', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $project_id, 'ext_name' => $title);?>
<?php echo form_open('admin/project/update/'.$project_id, $attributes, $hidden);?>
  <div class="modal-body">
     <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="title"><?php echo $this->lang->line('xin_title');?></label>
            <input class="form-control" placeholder="<?php echo $this->lang->line('xin_title');?>" name="title" type="text" value="<?php echo $title;?>">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="client_name"><?php echo $this->lang->line('xin_client_name');?></label>
                <select name="client_id" id="client_id" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_client_name');?>">
                <option value=""></option>
                <?php foreach($all_clients as $client) {?>
                <option value="<?php echo $client->client_id;?>" <?php if($client_id == $client->client_id):?> selected="selected" <?php endif;?>> <?php echo $client->name;?></option>
                <?php } ?>
              </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="award_date"><?php echo $this->lang->line('module_company_title');?></label>
                <select name="company_id" id="ajx_company" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                  <option value=""></option>
                  <?php foreach($all_companies as $company) {?>
                  <option value="<?php echo $company->company_id;?>" <?php if($company->company_id==$company_id):?> selected="selected" <?php endif;?>> <?php echo $company->name;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start_date"><?php echo $this->lang->line('xin_start_date');?></label>
                <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_start_date');?>" readonly name="start_date" type="text" value="<?php echo $start_date;?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="end_date"><?php echo $this->lang->line('xin_end_date');?></label>
                <input class="form-control edate" placeholder="<?php echo $this->lang->line('xin_end_date');?>" readonly name="end_date" type="text" value="<?php echo $end_date;?>">
              </div>
            </div>
          </div>
          
          
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="description"><?php echo $this->lang->line('xin_description');?></label>
            <textarea class="form-control textarea" placeholder="<?php echo $this->lang->line('xin_description');?>" name="description" cols="30" rows="15" id="description2"><?php echo $description;?></textarea>
          </div>
        </div>
      </div>
      <div class="row">
            <div class="col-md-6">
              <div class="form-group" id="employee_ajx">
               <?php $result = $this->Department_model->ajax_company_employee_info($company_id);?>
                <label for="employee"><?php echo $this->lang->line('xin_project_manager');?></label>
                <select multiple name="assigned_to[]" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_project_manager');?>">
                  <option value=""></option>
                  <?php foreach($result as $employee) {?>
                  <option value="<?php echo $employee->user_id?>" <?php if(isset($_GET)) { if(in_array($employee->user_id,$assigned_ids)):?> selected <?php endif; }?>> <?php echo $employee->first_name.' '.$employee->last_name;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
              <label for="status"><?php echo $this->lang->line('dashboard_xin_status');?></label>
              <select name="status" id="select2-demo-6" class="form-control" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_choose_status');?>...">
                <option value="0" <?php if($status=='0'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_not_started');?></option>
                <option value="1" <?php if($status=='1'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_in_progress');?></option>
                <option value="2" <?php if($status=='2'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_completed');?></option>
                <option value="3" <?php if($status=='3'):?> selected <?php endif; ?>><?php echo $this->lang->line('xin_deffered');?></option>
              </select>
              <input type="hidden" id="progres_val" name="progres_val" value="<?php echo $project_progress;?>">
            </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="employee"><?php echo $this->lang->line('xin_p_priority');?></label>
                  <select name="priority" id="select2-demo-6" class="form-control select-border-color border-warning" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_p_priority');?>">
                    <option value="1" <?php if($priority==1):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_highest');?></option>
                    <option value="2" <?php if($priority==2):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_high');?></option>
                    <option value="3" <?php if($priority==3):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_normal');?></option>
                    <option value="4" <?php if($priority==4):?> selected="selected"<?php endif;?>><?php echo $this->lang->line('xin_low');?></option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="summary"><?php echo $this->lang->line('xin_summary');?></label>
                  <textarea class="form-control" placeholder="<?php echo $this->lang->line('xin_summary');?>" name="summary" cols="30" rows="1" id="summary"><?php echo $summary;?></textarea>
                </div>
              </div>
            </div>
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="progress"><?php echo $this->lang->line('dashboard_xin_progress');?></label>
                  <input type="text" id="range_grid">
                </div>
              </div>
        </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
    <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('xin_update');?></button>
  </div>
<?php echo form_close(); ?>
<script type="text/javascript">
 $(document).ready(function(){
					
		jQuery("#ajx_company").change(function(){
			jQuery.get(base_url+"/get_employees/"+jQuery(this).val(), function(data, status){
				jQuery('#employee_ajx').html(data);
			});
		});
		$('#description2').trumbowyg();
		
		$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 
		
		$('.edate').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat:'yy-mm-dd',
		yearRange: '1900:' + (new Date().getFullYear() + 10),
		beforeShow: function(input) {
			$(input).datepicker("widget").show();
		}
		});

		/* Edit data */
		$("#edit_project").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=project&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.save').prop('disabled', false);
					} else {
						// On page load: datatable
						var xin_table = $('#xin_table').dataTable({
							"bDestroy": true,
							"ajax": {
								url : "<?php echo site_url("admin/project/project_list") ?>",
								type : 'GET'
							},
							"fnDrawCallback": function(settings){
							$('[data-toggle="tooltip"]').tooltip();          
							}
						});
						xin_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
	});	
  </script>
  <script type="text/javascript">
$(document).ready(function(){	
	$("#range_grid").ionRangeSlider({
		type: "single",
		min: 0,
		max: 100,
		from: '<?php echo $project_progress;?>',
		grid: true,
		force_edges: true,
		onChange: function (data) {
			$('#progres_val').val(data.from);
		}
	});
});
</script>
<?php }
?>