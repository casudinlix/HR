<?php $result = $this->Company_model->ajax_company_departments_info($company_id);?>

<div class="form-group">
  <label for="designation"><?php echo $this->lang->line('xin_department');?></label>
  <select class="select2" data-plugin="select_hrm" multiple data-placeholder="<?php echo $this->lang->line('xin_select_department');?>" name="department_id[]" id="aj_department" >
    <option value=""></option>
    <?php foreach($result as $deparment) {?>
    <option value="<?php echo $deparment->department_name?>"><?php echo $deparment->department_name?></option>
    <?php } ?>
  </select>
</div>
<?php
//}
?>
<script type="text/javascript">
$(document).ready(function(){
// get designations
jQuery("#aj_department").change(function(){
	jQuery.get(base_url+"/designation/", function(data, status){
		jQuery('#designation_ajax').html(data);
	});
});
$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
});
</script>