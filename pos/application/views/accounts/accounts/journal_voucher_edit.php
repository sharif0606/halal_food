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
			 Journal Voucher Edit/View
		</h3>    
        
		<div class="row">
			<div class="col-sm-12">
				<div class="widget" style="min-height:500px;">
					<div class="widget-content padding">
						
						<div class="form-group" style="margin-bottom: 0px;">
							<div class="row">
							<div class="col-sm-4">
							<ul class="list-inline">
								<li><a href="<?= base_url('accounts/');?>accounts/journal_voucher_list" class="text-muted small">Journal Voucher List</a> </li> |
								<li><a href="<?= base_url('accounts/');?>accounts/journal_voucher_entry" class="text-muted small">Journal Voucher Create</a> </li>
							</ul>
							</div>
							
							<div class="col-sm-4"></div>
							<div class="col-sm-4" style="text-align:right;">
								<a href="<?php echo base_url();?>accounts/journal_voucher_print/<?php echo $vdata['id']; ?>" class="text-muted small">
								<img width='24' border='0' style='' title='Print' src='<?php echo base_url();?>assets/images/pdf.png'>
								</a>
							</div>
							</div>
						</div>
					<?= form_open('accounts/accounts/journal_voucher_edit/'.$vdata['id'],'id="detvoucherform" name="detvoucherform"'); ?>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label>Voucher No:</label>
										<input type="text" class="form-control" name="voucher_no" id="voucher_no" value="<?php echo $vdata["voucher_no"];?>" readonly>
									</div>
									<div class="col-sm-4">
										<label>Date:</label>
										<?php 
										$current_date = $vdata["current_date"];
										$current_dateArr=explode("-",$current_date);
										$current_date = $current_dateArr[2]."-".$current_dateArr[1]."-".$current_dateArr[0]; 
										?>
										<input type="text" class="form-control" name="current_date" id="current_date" value="<?php echo $current_date;?>" readonly> 
									</div>
								</div>
							</div>	
							
						
							<div class="form-group">
								<label>Purpose: </label>
								<input type="text" class="form-control" name="purpose" id="purpose" value="<?php echo $vdata["purpose"];?>" required>
							</div>
							
							<div class="table-responsive">
								<table class="table table-bordered" id='area' cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>SN#</th>
											<th>Particulars <span style="color:red;">*</span></th>
											<th>A/C Name</th>
											<th>Debit (Tk)</th>
											<th>Credit (Tk)</th>
										</tr>
									</thead>
									
									<tfoot>
										<tr>
											<th style="text-align:right;" colspan="3">Total Amount Tk.</th>
											<th>
												<?= $vdata["amount"];?>
											</th>
											<th>
												<?= $vdata["amount"];?>
												<input type='hidden' name='id' value='<?php echo $vdata['id']; ?>' />
											</th>
										</tr>
									</tfoot>
								
									<tbody style="background:#eee;">
										<?php $inc=1;
										    foreach($bkdndata as $row2){ 
										?>
											<tr>
												<td style='text-align:center;' id='increment_1'><?php echo $inc; ?></td>
												<td style='text-align:left;'>
													<input type='text' name='particulars[]' value="<?php echo $row2['particulars'];?>" maxlength='50' style='text-align:left;border:none;' required />
												</td>
												<td style='text-align:left;'><?php echo $row2['account_code'];?></td>
												<td style='text-align:left;'><?php echo $row2['debit'];?></td>
												<td style='text-align:left;'><?php echo $row2['credit'];?>
													<input type='hidden' name='bkdn_id[]' value='<?php echo $row2['id']; ?>' />
												</td>
											</tr>
										<?php  $inc++; } ?>
									</tbody>
								</table>
							</div>
							<br>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-4">
										<label>Cheque No:</label>
										<input type="text" class="form-control" name="cheque_no" id="cheque_no" value="<?php echo $vdata["cheque_no"];?>">
									</div>
									<div class="col-sm-4">
										<label>Cheque Date:</label>
										<?php 
										$cheque_dt = $vdata["cheque_dt"];
										if(!empty($cheque_dt)){
										$cheque_dtArr=explode("-",$cheque_dt);
										$cheque_dt = $cheque_dtArr[1]."/".$cheque_dtArr[2]."/".$cheque_dtArr[0]; 
										}
										else {
											$cheque_dt='';
										}
										?>
										<input type="text" class="form-control datepicker-input" name="cheque_dt" id="cheque_dt" value="<?php echo $cheque_dt;?>" placeholder="mm/dd/yyyy"> 
									</div>
									<div class="col-sm-4">
										<label>Bank:</label>
										<input type="text" class="form-control" name="bank" id="bank" value="<?php echo $vdata["bank"];?>">
									</div>
								</div>
							</div>
							<button type="button" class="btn btn-primary" onClick="return entry_validation(this.form)">Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Added for accounts -->
	<script src="<?= base_url();?>assets/js/valid-functions_journal.js"></script>
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
}
</script>