<?php
/* Payslip view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php
	$gd = '';
	if($hourly_rate == '') {
		$gd = 'sl';
	} else {
		$gd = 'hr';
	}
?>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('xin_payslip');?> - </strong><?php echo date("F, Y", strtotime($payment_date));?></span>
        <div class="card-header-elements ml-md-auto"> <a href="<?php echo site_url();?>admin/payroll/slip_gaji/<?php echo $gd;?>/<?php echo $make_payment_id;?>/" class="btn btn-social-icon mb-1 btn-outline-github" data-toggle="tooltip" data-placement="top" title="PRINT" target="_blank" data-original-title="<?php echo $this->lang->line('xin_pdf');?>"><i class="far fa-file-pdf d-block"></i></a> </div>
      </div>
      <div class="card-body">
        <div class="table-responsive" data-pattern="priority-columns">
          <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
            <tbody>
              <tr>
                <td><strong class="help-split">NIP </strong>#<?php echo $employee_id;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_employee_name');?>: </strong><?php echo $first_name.' '.$first_name;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_payslip_number');?>: </strong><?php echo $make_payment_id;?></td>
              </tr>
              <tr>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_phone');?>: </strong><?php echo $contact_no;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_joining_date');?>: </strong><?php echo $this->Xin_model->set_date_format($date_of_joining);?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_payslip_payment_by');?>: </strong><?php echo $payment_method;?></td>
              </tr>
              <tr>
                <td><strong class="help-split"><?php echo $this->lang->line('left_department');?>: </strong><?php echo $department_name->department_id;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('left_designation');?>: </strong><?php echo $designation_name;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_work_total');?>: </strong><?php echo $total_kerja;?></td>
                
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row m-b-1">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('xin_payment_details');?></span> </div>
      <div class="card-body">
        <div class="table-responsive" data-pattern="priority-columns">
          <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
            <tbody>
              <tr>
                <td><strong><?php echo $this->lang->line('xin_Payroll_house_rent_allowance');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($house_rent_allowance);?></span></td>
              </tr>
              <tr>
                <td><strong><?php echo $this->lang->line('xin_payroll_medical_allowance');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($medical_allowance);?></span></td>
              </tr>
              <tr>
                <td><strong><?php echo $this->lang->line('xin_payroll_travel_allowance');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($travelling_allowance);?></span></td>
              </tr>
              <tr>
                <td><strong><?php echo $this->lang->line('xin_payroll_dearness_allowance');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($dearness_allowance);?></span></td>
              </tr>
              <?php if($hourly_rate!=0 || $hourly_rate!=''):?>

              <tr>
                <td><strong><?php echo $this->lang->line('xin_payroll_hourly_rate');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($hourly_rate);?></span></td>
              </tr>
              <?php endif;?>
              <?php if($total_hours_work!=0 || $total_hours_work!=''):?>
              <tr>
                <td><strong><?php echo $this->lang->line('xin_total_hours_worked');?>:</strong> <span class="pull-right"><?php echo $total_hours_work;?></span></td>
              </tr>
              <?php endif;?>
              <?php if($overtime_rate!=0 || $overtime_rate!=''):?>
              <tr>
                <td><strong><?php echo $this->lang->line('xin_Payslip_overtime_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($overtime_rate);?> (<?php echo $this->lang->line('xin_payroll_hourly');?> )</span></td>
              </tr>
              <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('xin_payslip_earning');?></span> </div>
          <div class="card-body">
            <div class="table-responsive" data-pattern="priority-columns">
              <?php if($hourly_rate==0 && $hourly_rate==''):?>
              <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                <tbody>
                  <?php if($overtime_rate!=0 || $overtime_rate!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_gross_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($gross_salary);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_allowances!=0 || $total_allowances!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_total_allowance');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($total_allowances);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_deductions!=0 || $total_deductions!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_total_deduction');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($total_deductions);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($net_salary!=0 || $net_salary!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_net_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($net_salary);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($is_advance_salary_deduct==1):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_advance_deducted_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($advance_salary_amount);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($net_salary!=0 || $net_salary!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_paid_amount');?>:</strong> <span class="pull-right">
                      <?php if($is_advance_salary_deduct==1): ?>
                      <?php $re_paid_amount = $net_salary - $advance_salary_amount;?>
                      <?php else:?>
                      <?php $re_paid_amount = $net_salary;?>
                      <?php endif;?>
                      <?php echo $this->Xin_model->currency_sign($payment_amount);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($payment_method):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_method');?>:</strong> <span class="pull-right"><?php echo $payment_method;?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($net_salary!=0 || $net_salary!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_comment');?>:</strong> <span class="pull-right"><?php echo $comments;?></span></td>
                  </tr>
                  <?php endif;?>
                </tbody>
              </table>
              <?php else:?>
              <table class="table table-condensed">
                <tbody>
                  <?php if($payment_amount!=0 || $payment_amount!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_gross_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($payment_amount);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_hours_work!=0 || $total_hours_work!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_net_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($payment_amount);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_hours_work!=0 || $total_hours_work!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_paid_amount');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($payment_amount);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($payment_method):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_method');?>:</strong> <span class="pull-right"><?php echo $payment_method;?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_hours_work!=0 || $total_hours_work!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_comment');?>:</strong> <span class="pull-right"><?php echo $comments;?></span></td>
                  </tr>
                  <?php endif;?>
                </tbody>
              </table>
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('left_leave');?></span> </div>
          <div class="card-body">
            <div class="table-responsive" data-pattern="priority-columns">
              <table class="table table-bordered">
                <th>Leave type</th><th>Total Days</th>
                <tbody>
                  <tr>
                    <?php if ($hitung_cuti==FALSE): ?>
                      <td></td>
                      <td></td>
                    <?php else: ?>
                      <?php foreach ($hitung_cuti as $key): ?>
                     <td><?php echo $key->type_name ?> </td>
                     <td><?php echo $key->total_days ?></td>
                     </tr> 
                    <?php endforeach ?>
                    <?php endif ?>
                    
                  
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
  </div>
</div>
<!-- pd--> 
<script>
  var base_url ="<?php echo base_url()."admin/payroll/slip_gaji/".$gd."/".$make_payment_id?>/";
function print_slip() {
  window.open(base_url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=500,height=500");
}
</script>