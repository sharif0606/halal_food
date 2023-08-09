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
      <h1>
        <?=$page_title;?>
        <small>View/Search Transactions</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
			
			</div>
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Transaction Info</h3>
						<div class="box-tools">
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default" id="modalOpenBtn" onClick="formClear()">
								<i class="fa fa-plus">Add Transaction</i>
							</button>
						</div>
					</div>
					<?php include"comman/code_flashdata.php"; ?>
					<div class="box-body">
						<table class="table table-bordered" id="example2">
                            <thead>
                                <tr class="bg-primary">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Bank Name</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center" >Actions</th>
                                </tr>
                            </thead>
							<tbody>
								<?php
									$type = [
										'1'=>'From Bank to Cash',
										'2'=>'From Cash to Bank'
									];
								foreach($transactions as $index=>$transaction){
								?>
								<tr> 
									<td class="text-center"><?=$index+1?></td>
									<td class="text-center"><?=$type[$transaction->type]?></td>
									<td class="text-center"><?=$transaction->payment_type?></td>
									<td class="text-center"><?=$transaction->date?></td>
									<td class="text-center"><?=$transaction->amount?></td>
									<td class="text-center">
										<button type="button" onclick="edit(<?=$transaction->id?>)" class="btn btn-sm btn-warning editTrans">
											<i class="fa fa-pencil"></i>
										</button>
										<!--<a href="<?=$transaction->id?>" onclick="return confirm('Are you sure to delete this transaction?')" class="btn btn-sm btn-danger deleteTrans">
											<i class="fa fa-trash"></i>
										</a>-->
									</td>
								</tr>
								<?php }?>
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
            <form method="post" id="transactionAddingForm" action="<?php echo base_url()?>/transactions/add/">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" >
				<input type="hidden" name="rowId" id="rowId" value="" />
                <div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="trans_type">Transaction Type</label>
								<select name="type" title="Trnsaction Type" class="form-control" required id="trans_type">
									<option value="">Select A Type</option>
									<option value="1">From Bank To cash</option>
									<option value="2">From Cash To Bank</option>
								</select>	
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="trans_bank_id">Bank name</label>
								<select name="bank_id" class="form-control" Title="Bank Name" required id="trans_bank_id">
									<option value="">Select A Bank</option>
									<?php foreach($banks as $bank){ ?>
										<option value="<?= $bank->id ?>"><?= $bank->payment_type ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="trans_amount">Amount</label>
								<input type="number" name="amount" title="Amount" class="form-control" id="trans_amount" placeholder="Amount" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Date</label>
								<input type="date" name="date" title="Date" class="form-control" id="trans_date"  value="<?=date('Y-m-d')?>" required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Description</label>
								<textarea name="description" class="form-control" id="" cols="5" rows="2" id="trans_descrip"></textarea>
							</div>
						</div>
					</div>
                </div>
                <div class="card-footer">
                  
                </div>
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" onclick="form_submit()" class="btn btn-primary">Submit</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  </div>
  <?php include"footer.php"; ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
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
});
function form_submit(){
	var checking = true;
	$("#transactionAddingForm select,#transactionAddingForm input").each(function(index,item){
		if(item.id!="rowId"){
			if(item.value==''){
				toastr.error("Please Select "+item.title);
				checking = false;
			};
		}
	})
	if(checking){
		$("#transactionAddingForm").submit();
	}
	//
}
function formClear(){
	var idLists="#rowId,#trans_type,#trans_bank_id,#trans_amount,#trans_date,#trans_descript";
	$(idLists).each(function(index,item){
		item.value='';
	})
}
function edit(id){
	var url = "<?php echo base_url();?>/transactions/edit/"+id;
	$.ajax({
		headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
		url : url,
		method : 'GET',
		beforeSend:function(){
		},
		success:function(response){
			//console.log(response);
			var response  = jQuery.parseJSON(response);
			if(response.success){
				result = response.data;
				$("#rowId").val(result.id);
				$("#trans_type").val(result.type);
				$("#trans_bank_id").val(result.bank_id);
				$("#trans_amount").val(result.amount);
				$("#trans_date").val(result.date);
				$("#trans_descript").val(result.description);
				$("#modal-default").modal('show')
				//alert('')
			}
		},
		error:function(errorCatch){
			if(errorCatch){
				//Code goes Here;
			}
		},
		complete:function(){
		}
	})
}
</script>
<!-- Make sidebar menu highlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
		
</body>
</html>
