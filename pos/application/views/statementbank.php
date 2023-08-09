<!DOCTYPE html>
<html>
<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->
<style>
	#statementTable th,#statementTable td{
		text-align:center;
		border:1px solid #000;
		padding:1px 5px;
	}
	.expenses-headline,
	.revenue-headline,
	.banktrans-headline{
		text-align:left !important;
		font-size: 16px;
	}
	.invoice-td{
		text-align:left !important;

	}
	.no-border{
		border-style: none !important
	}
	.expenses-headline strong,
	.revenue-headline strong{
		text-decoration:underline;
	}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">


<div class="wrapper">
 <?php include"sidebar.php"; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body table-responsive no-padding">
				<div>
					<form method="GET" action="">
						<div class="col-md-3">
							<div class="form-group">
								<label>Start Date</label>
								<input type="date" class="form-control"  placeholder="mm/dd/yyyy" value="<?= isset($_GET['start_date'])?$_GET['start_date']:'' ?>" name="start_date" required />
							 </div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="exampleInputEmail1">End Date</label>
								<input type="date" class="form-control"  placeholder="mm/dd/yyyy" value="<?= isset($_GET['end_date'])?$_GET['end_date']:'' ?>" name="end_date" required />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label for="">Bank Name</label>
								<select class="form-control"  name="payment_type">
								    <?php
                                        $query1="select payment_type from db_paymenttypes where status=1 and bank_cash=2";
                                        $q1=$this->db->query($query1);
                                        if($q1->num_rows($q1)>0){
                                            echo '<option value="">-Select-</option>';
                                            foreach($q1->result() as $res1){ ?>
                                                <option <?= isset($_GET['pay_type_name']) && $_GET['pay_type_name'] == $res1->payment_type ? 'selected' : '' ?> value='<?= $res1->payment_type ?>'><?= $res1->payment_type ?></option>
                                                <!-- <option <?= $_GET['pay_type_name']?$_GET['pay_type_name']==$res1->payment_type?'selected':'':'' ?> value='<?= $res1->payment_type ?>'><?= $res1->payment_type ?></option> -->
                                        <?php   }
                                        } else {
                                    ?>
                                    <option value="">No Records Found</option>
                                    <?php } ?>
								</select>
							</div>
						</div>
						<div class="col-md-2 mt-5">
							<br/><button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
          </div>
          </div>
        </div>
        <!-- left column -->
			<div class="col-md-12">
				 <div class="box box-primary">
					<div class="box-header">
					   <!--<button type="button" class="btn btn-info pull-right btnExport" title="Download Data in Excel Format">Excel</button>-->
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">

					<p class="text-right" style="width:60%;margin:0 auto">Date : <?= isset($_GET['start_date'])?$_GET['start_date']:"" ?> To <?= isset($_GET['end_date'])?$_GET['end_date']:"" ?></p>
					<table class="table table-bordered" style="width:60%;margin:0 auto" id="statementTable">
						<thead>
							<tr>
								<th class="text-center">Date</th>
								<th class="text-center" width="50%">Particular</th>
								<th class="text-center" >Taka</th>
								<th class="text-center" >Taka</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td></td>
								<?php
									if(isset($_GET['start_date'])){
										$lastdate = date('Y-m-d', strtotime($_GET['start_date'].'-1 days'));
									}else{$lastdate=NULL;}
								?>
								<td>Openning Balance: <?=$lastdate?></td>
								<td></td>
								<td>
									<?php echo $lastOpenningBalance = $statement['last_openning_balance'];?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td class="revenue-headline">
									<strong>Online Sales</strong>
								</td>
								<td></td>
								<td></td>
							</tr>
							<?php
								$totalPaymentonlone = 0;
								foreach($statement['order_payments'] as $order_payments){
									$totalPaymentonlone+=$order_payments->payment;
							?>
							<tr>
								<td class='text-center'><?=$order_payments->payment_date?></td>
								<td class='invoice-td'><?=$order_payments->invoice_no?></td>
								<td class='text-center'><?=$order_payments->payment?></td>
								<td class='text-center'></td>
							</tr>
							<?php }?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Revenue</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalPaymentonlone?></strong>
								</td>
							</tr>
							<tr>
								<td></td>
								<td class="revenue-headline">
									<strong>Revenue</strong>
								</td>
								<td></td>
								<td></td>
							</tr>
							<?php
								$totalPayments = 0;
								foreach($statement['sales_payments'] as $salesPayments){
									$totalPayments+=$salesPayments->payment;
							?>
							<tr>
								<td class='text-center'><?=$salesPayments->payment_date?></td>
								<td class='invoice-td'>Invoice#<?=$salesPayments->sales_code?></td>
								<td class='text-center'><?=$salesPayments->payment?></td>
								<td class='text-center'></td>
							</tr>
							<?php }?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Revenue</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalPayments?></strong>
								</td>
							</tr>

							<tr>
								<td></td>
								<td class="revenue-headline">
									<strong>Revenue Return</strong>
								</td>
								<td></td>
								<td></td>
							</tr>
							<?php
								$totalPaymentsReturn = 0;
								foreach($statement['sales_paymentsreturn'] as $salesPaymentsreturn){
									$totalPaymentsReturn+=$salesPaymentsreturn->payment;
							?>
							<tr>
								<td class='text-center'><?=$salesPaymentsreturn->payment_date?></td>
								<td class='invoice-td'>Invoice#<?=$salesPaymentsreturn->sales_code?></td>
								<td class='text-center'><?=$salesPaymentsreturn->payment?></td>
								<td class='text-center'></td>
							</tr>
							<?php }?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Revenue Return</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalPaymentsReturn?></strong>
								</td>
							</tr>



							<tr>
								<td></td>
								<td class="banktrans-headline">
									<strong>Bank Tranasction</strong>
								</td>
								<td></td>
								<td></td>
							</tr>
							<?php
								$totalWithDraw = 0;
								foreach($statement['transactions'] as $transaction){
									//1== From Bank To cash...2=From cash To Bank
									if($transaction->type==2){continue;}
									$totalWithDraw+=$transaction->amount;
							?>
							<tr>
								<td class='text-center'><?=$transaction->date?></td>
								<td class='invoice-td'>Bank Withdraw</td>
								<td class='text-center'><?=$transaction->amount?></td>
								<td class='text-center'></td>
							</tr>
							<?php }?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Withdraw</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalWithDraw?></strong>
								</td>
							</tr>
							<tr>
								<td class='text-center'></td>
								<td class="expenses-headline">
									<strong style="">Expenses</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'></td>
							</tr>
							<?php
								$totalExpense = 0;
								foreach($statement['purchase_payments'] as $purchasePayments){
									$totalExpense+=$purchasePayments->payment;
							?>
							<tr>
								<td class='text-center'><?=$purchasePayments->payment_date?></td>
								<td class="invoice-td">Invoice#<?=$purchasePayments->purchase_code?></td>
								<td class='text-center'><?=$purchasePayments->payment?></td>
								<td class='text-center'></td>
							</tr>
							<?php }?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Expenses</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalExpense?></strong>
								</td>
							</tr>


							<tr>
								<td class='text-center'></td>
								<td class="expenses-headline">
									<strong style="">Expenses Return</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'></td>
							</tr>
							<?php
								$totalExpenseReturn = 0;
								foreach($statement['purchase_paymentsreturn'] as $purchasePaymentsreturn){
									$totalExpenseReturn+=$purchasePaymentsreturn->payment;
							?>
							<tr>
								<td class='text-center'><?=$purchasePaymentsreturn->payment_date?></td>
								<td class="invoice-td">Invoice#<?=$purchasePaymentsreturn->purchase_code?></td>
								<td class='text-center'><?=$purchasePaymentsreturn->payment?></td>
								<td class='text-center'></td>
							</tr>
							<?php } ?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Purchase Return</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalExpenseReturn?></strong>
								</td>
							</tr>

							<tr>
								<td></td>
								<td class="banktrans-headline">
									<strong>Bank Tranasction</strong>
								</td>
								<td></td>
								<td></td>
							</tr>
							<?php
								$totalDeposit = 0;
								foreach($statement['transactions'] as $transaction){
									//1== From Bank To cash...2=From cash To Bank
									if($transaction->type==1){continue;}
									$totalDeposit+=$transaction->amount;
							?>
							<tr>
								<td class='text-center'><?=$transaction->date?></td>
								<td class='invoice-td'>Bank Deposit</td>
								<td class='text-center'><?=$transaction->amount?></td>
								<td class='text-center'></td>
							</tr>
							<?php }?>
							<tr>
								<td class='text-center'></td>
								<td class='text-center' style="text-align:right;font-size:16px">
									<strong>Total Deposit</strong>
								</td>
								<td class='text-center'></td>
								<td class='text-center'>
									<strong><?=$totalDeposit?></strong>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<?php
								$netcashBalance = ($lastOpenningBalance+$totalPaymentonlone+$totalPayments+$totalDeposit+$totalExpenseReturn)-($totalPaymentsReturn+$totalExpense+$totalWithDraw);
							?>
							<tr>
								<td class='text-center' style="text-align:right;font-size:16px" colspan="2">
									<h4><strong>Net Cash Balance</strong></h4>
								</td>
								<td class='text-center' colspan="2">
									<h4>
										<strong><?=$netcashBalance?></strong>
									</h4>
								</td>
							</tr>
						</tfoot>
					</table>
					</div>
					<!-- /.box-body -->
				 </div>
				 <!-- /.box -->
			  </div>
		</div>
    </section>

  </div>
  <!-- /.content-wrapper -->

 <?php include"footer.php"; ?>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- TABLES CODE -->
<?php include"comman/code_js_form.php"; ?>


<script src="<?php echo $theme_link; ?>js/sheetjs.js" type="text/javascript"></script>
<script>


function get_reports(report_type,table_name){
  $(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
  var base_url=$("#base_url").val();
  return $.post(base_url+'reports/'+report_type, {from_date: get_start_date('pl2-daterange-btn'), to_date: get_end_date('pl2-daterange-btn')}, function(result) {
    //console.log(result);
    $("#"+table_name+" tbody").html(result);
    $(".overlay").remove();
  });
}
function get_all_reports(){
  get_reports('get_profit_by_item','profit_by_item_table');
  get_reports('get_profit_by_invoice','profit_by_invoice_table');
}
jQuery(document).ready(function($) {
  //get_pl_values();
   //get_all_reports();
});

function get_pl_values(){
  var base_url=$("#base_url").val();
  $.post(base_url+"reports/get_profit_loss_report",{from_date: get_start_date('pl-daterange-btn'), to_date: get_end_date('pl-daterange-btn')},function(result){
      var data = jQuery.parseJSON(result);
      $.each(data, function(index, element) {
              $("."+index).html(element);
      });
  });
}

/*Date Range picker event 1*/
$('#pl-daterange-btn').on('apply.daterangepicker', function(ev, picker) {
  get_pl_values();
});
/*end*/
/*Date Range picker event 2*/
$('#pl2-daterange-btn').on('apply.daterangepicker', function(ev, picker) {
  get_all_reports();
});
/*end*/

$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    function cb(start, end) {
        $('#pl-daterange-btn, #pl2-daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    cb(start, end);
});

</script>


<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>


</body>
</html>
