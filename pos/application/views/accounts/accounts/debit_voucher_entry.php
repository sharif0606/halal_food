<!-- Page Specific CSS -->
<style>
.header {
	line-height:40px;
}
</style>
<!-- Page Specific CSS -->

<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">
			Payment Voucher Create 
		</h3>
        <?php if($this->session->flashdata('message')):?>
        	<?=$this->session->flashdata('message')?>
        <?php endif?>
		<div class="row">
			<div class="col-sm-12">
				<div class="widget" style="min-height:500px;">
					<div class="widget-content padding">
					    <?php echo validation_errors(); ?>
					    <?= form_open('accounts/accounts/debit_voucher_list','id="detvoucherform" name="detvoucherform"'); ?>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label>Voucher No:</label>
										<input type="text" class="form-control" name="voucher_no" id="voucher_no" disabled>
									</div>
									<div class="col-sm-4">
										<label>Date:</label>
										<div class="input-group">
											<input class="form-control date-picker" name="current_date" id="current_date" type="text" data-date-format="dd-mm-yyyy" required readonly  placeholder="dd-mm-yyyy" autocomplete="off"/>
											<span class="input-group-addon">
												<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</div>
									<div class="col-sm-4">
									    <label>Pay Account</label>
									    <select name="credit" class="form-control">
									        <option value="">Select Type</option>
									        <?php if($ahead){
									                foreach($ahead as $ah){ ?>
									                 <option value="<?= $ah['id'] ?>-<?= $ah['table_name'] ?>-<?= $ah['head_code'] ?>-<?= $ah['head_name'] ?>"><?= $ah['head_name'] ?></option>
									       <?php } } ?>
									    </select>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label>Pay To:</label>
								<input type="text" class="form-control" name="pay_name" id="pay_name" autocomplete="off">
							</div>
							<div class="form-group">
								<label>Purpose:</label>
								<input type="text" class="form-control" name="purpose" id="purpose" required autocomplete="off">
							</div>
							<div class="table-responsive">
								<table class="table table-bordered" id='area' cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>SN#</th>
											<th>Particulars</th>
											<th>A/C Name</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th style="text-align:right;" colspan="3">Total Amount Tk.</th>
											<th><input type='text' name='amount' id='amount' value='' style='text-align:center; border:none;' readonly autocomplete="off" /></th>
										</tr>
										<tr>
											<th style="text-align:right;" colspan="5">
												<input type='button' name='add' id='add' class='add' value='Add' onClick='adddesemp();'> 
												<input type='button' name='remove' id='remove' value='Remove' onClick='return removedesemp();'>
											</th>
										</tr>
									</tfoot>
									<tbody style="background:#eee;">
										<tr>
											<td style='text-align:center;' id='increment_1'>1</td>
											<td style='text-align:left;'><input type='text' name='particulars[]' id='particulars_1' value='' maxlength='50' style='text-align:left;border:none;' /></td>
											<td style='text-align:left;'>
												<div style='width:100%;position:relative;'>
													<input type='text' name='account_code[]' id='account_code_1' class='cls_account_code' value='' style='border:none;' onkeyup="check_account_code(this.value,'1');" maxlength='100' autocomplete="off"/>
													<div id='account_code_suggestions_1' style='display:none;'>
														<div id='account_code_list_1' style='border:1px solid #3F3FFF;'></div>
													</div>
												</div>
													<input type='hidden' name='table_name[]' id='table_name_1' value=''>
													<input type='hidden' name='table_id[]' id='table_id_1' value=''>
											</td>
											<td style='text-align:left;'>
												<input type='text' name='debit[]' id='debit_1' class='cls_debit' value='' style='text-align:center; border:none;' maxlength='15' onkeyup='removeChar(this)' onBlur='return debit_entry(1);' autocomplete="off" /> 
												<input type='hidden' name='jobinc[]' id='jobinc_1' class='jobinc' value='1'>
												<input type='hidden' name='bkdn_id[]' value='' />
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<br>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label>Cheque No:</label>
										<input type="text" class="form-control" name="cheque_no" id="cheque_no" value="">
									</div>
									<div class="col-sm-4">
										<label>Cheque Date:</label>
										<input type="text" class="form-control datepicker-input" name="cheque_dt" id="cheque_dt" value="" placeholder="mm/dd/yyyy"> 
									</div>
									<div class="col-sm-4">
										<label>Bank:</label>
										<input type="text" class="form-control" name="bank" id="bank" value="">
									</div>
								</div>
							</div>
	<button type="button" class="btn btn-primary detvoucherform" onClick="return entry_validation(this.form)">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Added for accounts -->
	<script src="<?= base_url();?>assets/js/valid-functions.js"></script>
<!-- Added for accounts --> 
<script>
window.onload = function() {
	jQuery(function($) {

//datepicker plugin
		//link
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
	})
	
	setTimeout(function() {
			$('.alert').hide('slowly');
		}, 3000);
}
</script>