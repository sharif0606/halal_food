<!DOCTYPE html>
<html>

    <head>
        <!-- TABLES CSS CODE -->
        <?php include"comman/code_css_datatable.php"; ?>
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo $theme_link; ?>plugins/datepicker/datepicker3.css">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include"sidebar.php"; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?=$page_title;?> <small>View/Search Openning Balance</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><?=$page_title;?></li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12"></div>
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Openning Balance Info</h3>
                                    <div class="box-tools">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                            <i class="fa fa-pencil">Update Openning Balance</i>
                                        </button>
                                    </div>
                                </div>
            					<?php include"comman/code_flashdata.php"; ?>
            					<div class="box-body">
            						<!--<h5 class="text-center">Cash Balance <strong><?=isset($balances[0]->amount)?$balances[0]->amount:null?></strong></h5>-->
            						<table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>#</th>
                                                <th>Payment Type Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            //unset($balances[0]);
                                            $totalBankBalance=0;
                                            if($balances){
                                                foreach($balances as $index=>$balance){
                                                    $totalBankBalance+=$balance->amount;
            							?>
            								<tr> 
            									<td><?= ++$index ?></td>
            									<td><?= $balance->payment_type ?></td>
            									<td><?= $balance->amount ?></td>
            								</tr>
            								<?php } } ?>
            								<tr> 
            									<td colspan='2' class="text-right">Total Balance</td>
            									<td><strong><?=$totalBankBalance?></strong></td>
            								</tr>
            							</tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
	            <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" id="openningBalanceAddingForm" action="<?php echo base_url()?>/openning_balance/add/">
				                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                            	<label for="">Payment Type Name</label>
                                            </div>
                                            <div class="col-md-4">
                                            	<label for="">Amount</label>
                                            </div>
                                            <div class="col-md-2">
                                            	<label for="">***</label>
                                            </div>
                                        </div>
                                        <div id="bankListContainer">
                                            <?php 
                                                if($balances){
                                                    foreach($balances as $index=>$balance){
            							    ?>
                                            <div class="row bankListSingleItem">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="bank_id[]" class="form-control">
                                                            <option value="">Select A Payment Type</option>
                                                            <?php foreach($paymenttypes as $paymenttype){ ?>
                                                                <option <?= $paymenttype->id==$balance->bank_id?"selected":"" ?> value="<?= $paymenttype->id ?>"><?= $paymenttype->payment_type ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                    							<div class="col-md-4">
                    								<div class="form-group">
                    									<input type="number" name="bank_amount[]" class="form-control" value="<?= $balance->amount ?>" placeholder="Amount" />
                    								</div>
                    							</div>
                    							<div class="col-md-2">
                    								<button type="button" class="btn btn-sm btn-danger pull-left bankRmvBtn">
                    									<i class="fa fa-minus" ></i>
                    								</button>
                    							</div>
                    						</div>
                    					    <?php } }else{ ?>
                    					    <div class="row bankListSingleItem">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <select name="bank_id[]" class="form-control">
                                                            <option value="">Select A Payment Type</option>
                                                            <?php foreach($paymenttypes as $paymenttype){ ?>
                                                                <option value="<?= $paymenttype->id ?>"><?= $paymenttype->payment_type ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                    							<div class="col-md-4">
                    								<div class="form-group">
                    									<input type="number" name="bank_amount[]" class="form-control" placeholder="Amount" />
                    								</div>
                    							</div>
                    							<div class="col-md-2">
                    								<button type="button" class="btn btn-sm btn-danger pull-left bankRmvBtn">
                    									<i class="fa fa-minus" ></i>
                    								</button>
                    							</div>
                    						</div>
                    					    <?php } ?>
                    					</div>
                    					<button type="button" class="btn btn-sm btn-success pull-left" id="bankAddBtn">
                    						<i class="fa fa-plus" ></i>
                    					</button>
                                    </div>
                                    <div class="card-footer"></div>
                                </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" onclick="form_submit('openningBalanceAddingForm')" class="btn btn-primary">Change</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
            </div>
            <?php include"footer.php"; ?>
            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        
        <!-- SOUND CODE -->
        <?php include"comman/code_js_sound.php"; ?>
        <!-- TABLES CODE -->
        <?php include"comman/code_js_datatable.php"; ?>
        <!-- bootstrap datepicker -->
        <script src="<?php echo $theme_link; ?>plugins/datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript">
          //Date picker
            $('.datepicker').datepicker({
              autoclose: true,
            format: 'dd-mm-yyyy',
             todayHighlight: true
            });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example2').DataTable();
        	$(document).on('click','#bankAddBtn',function(){
        		let element = $("#bankListContainer");
        		let copied=$(".bankListSingleItem:last").clone();
        		copied.find("input[name='bank_amount[]']").val('');
        		copied.find("input[name='bank_id[]']").val('');
        		element.append(copied);
        	})
        	$(document).on('click','.bankRmvBtn',function(){
        		let length=$(".bankListSingleItem").length
        		if(length<2){ 
        			toastr.error('Sorry you cannot delete the first Field')
        		}else{ $(this).closest('.bankListSingleItem').remove(); }
        	})
        });
        function form_submit(formId){
        	$("#"+formId).submit();
        }
</script>
        <!-- Make sidebar menu highlighter/selector -->
        <script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
    </body>
</html>
