<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<link href="<?php echo base_url();?>template/css/style-pdf.css" rel="stylesheet" />
	

<body class="fixed-left">
<div id="wrapper">
<div class="content">
	<div class="page-heading" style="text-align:center;">
	<b>Credit Voucher</b>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="widget" style="min-height:500px;">
				<div class="widget-content padding">
						
						<div class="table-responsive">
							<table border="0" style="border-collapse:collapse;" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<tr>
									<td style="width:33%; text-align:left;">
										<label><B>Voucher No: </b></label>
										<?php echo $credit_voucher_row_edit["voucher_no"];?>
									</td>
									<td style="width:33%;"></td>
									<td style="width:33%; text-align:right;">
										<label><b>Date: </b></label>
										<?php echo $credit_voucher_row_edit["current_date"];?>
									</td>
								</tr>
								<tr>
									<td>
										<label><b>Pay To: </b></label>
										<?php echo $credit_voucher_row_edit["pay_to"];?>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<label><b>Purpose: </b></label>
										<?php echo $credit_voucher_row_edit["purpose"];?>
									</td>
									<td></td>
									<td></td>
								</tr>
							</table>
						</div>
						
						<div> <br></div>
						
						
						<div class="table-responsive">
							<table border="1" style="border-collapse:collapse;" class="table table-striped table-bordered" id='area' cellspacing="0" width="100%">
								
								<tr>
									<td style='text-align:center;'><b>SN#</b></td>
									<td style='text-align:center;'><b>Particulars</b></td>
									<td style='text-align:center;'><b>A/C Name</b></td>
									<td style='text-align:center;'><b>Debit (Tk)</b></td>
									<td style='text-align:center;'><b>Credit (Tk)</b></td>
								</tr>
							
							
									<?php
									$inc=1;
									foreach($crvoucher_bkdn_row_edit as $row2){ 
										
									?>
									<tr>
										<td style='text-align:center;' id='increment_1'><?php echo $inc; ?></td>
										<td style='text-align:left;'><?php echo $row2['particulars'];?></td>
										<td style='text-align:left;'><?php echo $row2['account_code'];?></td>
										<td style='text-align:right;'><?php 
																		if($row2['debit']>0)
																		echo number_format($row2['debit'],2);
																		?>
										</td>
										<td style='text-align:right;'><?php 
																		if($row2['credit']>0)
																		echo number_format($row2['credit'],2);
																		?>
										</td>
									</tr>
									<?php 
									$inc++;
									} ?>
								
								<tr>
									<td style="text-align:right;" colspan="3"><b>Total Amount Tk.</b></td>
									<td style='text-align:right;'>
										<?php echo number_format($credit_voucher_row_edit["debit_sum"],2);?>
									</td>
									<td style='text-align:right;'>
										<?php echo number_format($credit_voucher_row_edit["credit_sum"],2);?>
									</td>
								</tr>
							</table>
						</div>
						
						<div><br></div>
						
						<div class="table-responsive">
						<table border="0" style="border-collapse:collapse;" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr>
								<td style="width:33%; text-align:left;">
									<label><b>Cheque No:</b></label>
									<?php echo $credit_voucher_row_edit["cheque_no"];?>
								</td>
								<td style="width:33%; text-align:left;">
									<label><b>Cheque Date:</b></label>
									<?php 
									$cheque_dtArr=explode("-",$credit_voucher_row_edit["cheque_dt"]);
									if($cheque_dtArr[0]>0) 
										echo $credit_voucher_row_edit["cheque_dt"];
									?>
								</td>
								<td style="width:33%; text-align:left;">
									<label><b>Bank:</b></label>
									<?php echo $credit_voucher_row_edit["bank"];?>
								</td>
							</tr>
						</table>		
						</div>
						
						<div><br></div>
						
						<div class="table-responsive">
						<table border="0" style="border-collapse:collapse;" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<tr>
								<td style="width:22%; text-align:left;">
									<div style="width:100%;height:50px;"></div>
									<div style="width:70%;border-top:dotted;text-align:center;"><b>Received By</b></div>
								</td>
								<td style="width:34%; text-align:left;">
									<div style="width:100%;height:50px;"></div>
									<div style="width:70%;border-top:dotted;text-align:center;"><b>Prepared By/Accountant</b></div>
								</td>
								<td style="width:24%; text-align:left;">
									<div style="width:100%;height:50px;"></div>
									<div style="width:70%;border-top:dotted;text-align:center;"><b>Academic Director</b></div>
								</td>
								<td style="width:20%; text-align:left;">
									<div style="width:100%;height:50px;"></div>
									<div style="width:70%;border-top:dotted;text-align:center;"><b>CEO</b></div>
								</td>
							</tr>
						</table>		
						</div>
						
						
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</body>
</html>