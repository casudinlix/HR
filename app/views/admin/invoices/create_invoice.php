<?php
// Create Invoice Page

$system_setting = $this->Xin_model->read_setting_info(1);
?>

<div class="row">
  <div class="col-md-12">
    <div class="card">
        <h6 class="card-header"><?php echo $this->lang->line('xin_invoice_create');?></h6>
      <div class="card-body" aria-expanded="true" style="">
          <div class="row m-b-1">
            <div class="col-md-12">
              <?php $attributes = array('name' => 'create_invoice', 'id' => 'xin-form', 'autocomplete' => 'off', 'class' => 'form');?>
              <?php $hidden = array('user_id' => 0);?>
              <?php echo form_open('admin/invoices/create_new_invoice', $attributes, $hidden);?>
              <div class="bg-white">
                <div class="box-block">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_date"><?php echo $this->lang->line('xin_invoice_number');?></label>
                        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_invoice_number');?>" name="invoice_number" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="project"><?php echo $this->lang->line('xin_project');?></label>
                        <select class="form-control" name="project" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_project');?>">
                          <?php foreach($all_projects->result() as $project) {?>
                          <option value="<?php echo $project->project_id?>"><?php echo $project->title?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_date"><?php echo $this->lang->line('xin_invoice_date');?></label>
                        <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_invoice_date');?>" readonly="readonly" name="invoice_date" type="text" value="">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="invoice_due_date"><?php echo $this->lang->line('xin_invoice_due_date');?></label>
                        <input class="form-control date" placeholder="<?php echo $this->lang->line('xin_invoice_due_date');?>" readonly="readonly" name="invoice_due_date" type="text" value="">
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="hrsale-item-values">
                          <div data-repeater-list="items">
                            <div data-repeater-item="">
                              <div class="row item-row">
                                <div class="form-group mb-1 col-sm-12 col-md-3">
                                  <label for="item_name">Item</label>
                                  <br>
                                  <input type="text" class="form-control item_name" name="item_name[]" id="item_name" placeholder="Item Name">
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                  <label for="tax_type">Tax Type</label>
                                  <br>
                                  <select class="form-control tax_type" name="tax_type[]" id="tax_type">
                                    <?php foreach($all_taxes as $_tax){?>
                                    <?php
										if($_tax->type=='percentage') {
											$_tax_type = $_tax->rate.'%';
										} else {
											$_tax_type = $this->Xin_model->currency_sign($_tax->rate);
										}
									?>
                                    <option tax-type="<?php echo $_tax->type;?>" tax-rate="<?php echo $_tax->rate;?>" value="<?php echo $_tax->tax_id;?>"> <?php echo $_tax->name;?> (<?php echo $_tax_type;?>)</option>
                                    <?php } ?>
                                  </select>
                                 </div> 
                                  <div class="form-group mb-1 col-sm-12 col-md-1">
                                  <label for="tax_type">Tax Rate</label>
                                  <br>
                                  <input type="text" readonly="readonly" class="form-control tax-rate-item" name="tax_rate_item[]" value="0" />
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-1">
                                  <label for="qty_hrs" class="cursor-pointer">Qty/Hrs</label>
                                  <br>
                                  <input type="text" class="form-control qty_hrs" name="qty_hrs[]" id="qty_hrs" value="1">
                                </div>
                                <div class="skin skin-flat form-group mb-1 col-sm-12 col-md-2">
                                  <label for="unit_price">Unit Price</label>
                                  <br>
                                  <input class="form-control unit_price" type="text" name="unit_price[]" value="0" id="unit_price" />
                                </div>
                                <div class="form-group mb-1 col-sm-12 col-md-2">
                                  <label for="profession">Subtotal</label>
                                  <input type="text" class="form-control sub-total-item" readonly="readonly" name="sub_total_item[]" value="0" />
                                 <!-- <br>-->
                                  <p style="display:none" class="form-control-static"><span class="amount-html">0</span></p>
                                </div>
                                <div class="form-group col-sm-12 col-md-1 text-xs-center mt-2">
                                  <label for="profession">&nbsp;</label><br>
                                  <button type="button" class="btn icon-btn btn-xs btn-outline-danger waves-effect waves-light remove-invoice-item" data-repeater-delete=""> <span class="far fa-trash-alt"></span></button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div id="item-list"></div>
                          <div class="form-group overflow-hidden1">
                            <div class="col-xs-12">
                              <button type="button" data-repeater-create="" class="btn btn-primary" id="add-invoice-item"> <i class="fa fa-plus"></i> Add Item</button>
                            </div>
                          </div>
                        <?php
						$ar_sc = explode('- ',$system_setting[0]->default_currency_symbol);
						$sc_show = $ar_sc[1];
						?>
                        <input type="hidden" class="items-sub-total" name="items_sub_total" value="0" />
                        <input type="hidden" class="items-tax-total" name="items_tax_total" value="0" />
                        <div class="row">
                          <div class="col-md-7 col-sm-12 text-xs-center text-md-left">&nbsp; </div>
                          <div class="col-md-5 col-sm-12">
                            <div class="table-responsive">
                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>Sub Total</td>
                                    <td class="text-xs-right"><?php echo $sc_show;?> <span class="sub_total">0</span></td>
                                  </tr>
                                  <tr>
                                    <td>TAX</td>
                                    <td class="text-xs-right"><?php echo $sc_show;?> <span class="tax_total">0</span></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2" style="border-bottom:1px solid #dddddd; padding:0px !important; text-align:left"><table class="table table-bordered">
                                        <tbody>
                                          <tr>
                                            <td width="30%" style="border-bottom:1px solid #dddddd; text-align:left"><strong>Discount Type</strong></td>
                                            <td style="border-bottom:1px solid #dddddd; text-align:center"><strong>Discount</strong></td>
                                            <td style="border-bottom:1px solid #dddddd; text-align:left"><strong>Discount Amount</strong></td>
                                          </tr>
                                          <tr>
                                            <td><div class="form-group">
                                                <select name="discount_type" class="form-control discount_type">
                                                  <option value="1"> Flat</option>
                                                  <option value="2"> Percent</option>
                                                </select>
                                              </div></td>
                                            <td align="right"><div class="form-group">
                                                <input style="text-align:right" type="text" name="discount_figure" class="form-control discount_figure" value="0" data-valid-num="required">
                                              </div></td>
                                            <td align="right"><div class="form-group">
                                                <input type="text" style="text-align:right" readonly="" name="discount_amount" value="0" class="discount_amount form-control">
                                              </div></td>
                                          </tr>
                                        </tbody>
                                      </table></td>
                                  </tr>
                                <input type="hidden" class="fgrand_total" name="fgrand_total" value="0" />
                                <tr>
                                  <td>Grand Total</td>
                                  <td class="text-xs-right"><?php echo $sc_show;?> <span class="grand_total">0</span></td>
                                </tr>
                                  </tbody>
                                
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-xs-12 mb-2 file-repeaters">                          
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <label for="invoice_note"><?php echo $this->lang->line('xin_invoice_note');?></label>
                            <textarea name="invoice_note" class="form-control"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="invoice-footer">
                    <div class="row">
                      <div class="col-md-7 col-sm-12">
                        <h6>Terms &amp; Condition</h6>
                        <p>You know, being a test pilot isn't always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
                      </div>
                      <div class="col-md-5 col-sm-12 text-xs-center">
                        <button type="submit" name="invoice_submit" class="btn btn-primary btn-lg my-1"><i class="fa fa fa-check-square-o"></i> Submit Invoice</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php echo form_close(); ?> </div>
          </div>
      </div>
    </div>
  </div>
</div>
