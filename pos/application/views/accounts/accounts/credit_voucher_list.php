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
			Receive Voucher List
			<a class="btn btn-info btn-bold pull-right" href="<?= base_url('accounts/');?>accounts/credit_voucher_entry">Add New</a>
		</h3>
		<?php if($this->session->flashdata('message')):?>
			<?=$this->session->flashdata('message')?>
		<?php endif?>
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div class="overflow">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>SL #</th>
						<th>Voucher No</th>
						<th>Date</th>
						<th>Pay Name</th>
						<th>Purpose</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>
		 
				<tbody>
					<?php
						foreach($credit_voucher_list as $row){ 
					?>
						<tr>
							<td><?= $row['id'];?></td>
							<td><?= $row['voucher_no'];?></td>
							<td><?= $row['current_date'];?></td>
							<td><?= $row['pay_name'];?></td>
							<td><?= $row['purpose'];?></td>
							<td><?= $row['amount'];?></td>
							<td>
								<a class="btn btn-primary btn-xs" href="<?= base_url('accounts/');?>accounts/credit_voucher_edit/<?= $row['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
								|
								<a class="btn btn-danger btn-xs" href="<?= base_url('accounts/');?>accounts/credit_voucher_delete/<?= $row['id'];?>" onclick="return confirm('are you sure want to delete this record?');" title="Delete"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php 	} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- page specific plugin scripts -->
	<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/buttons.flash.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/buttons.colVis.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/dataTables.select.min.js"></script>


<!-- inline scripts related to this page -->
<script type="text/javascript">

window.onload = function() {
	jQuery(function($) {

		//initiate dataTables plugin
		var myTable = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.DataTable({
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null,null,null,null,
			  { "bSortable": false } 
			],
			"aaSorting": [],
			
			
			//"bProcessing": true,
	        //"bServerSide": true,
	        //"sAjaxSource": "http://127.0.0.1/table.php"	,
	
			//,
			//"sScrollY": "200px",
			//"bPaginate": false,
	
			//"sScrollX": "100%",
			//"sScrollXInner": "120%",
			//"bScrollCollapse": true,
			//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
			//you may want to wrap the table inside a "div.dataTables_borderWrap" element
	
			//"iDisplayLength": 50
	
	
			/*select: {
				style: 'multi'
			}*/
	    } );
	
		
		
		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
		
		new $.fn.dataTable.Buttons( myTable, {
			buttons: [
			  {
				"extend": "colvis",
				"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
				"className": "btn btn-white btn-primary btn-bold",
				columns: ':not(:first):not(:last)'
			  },
			  {
				"extend": "copy",
				"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "csv",
				"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "print",
				"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
				"className": "btn btn-white btn-primary btn-bold",
				autoPrint: false,
				message: 'This print was produced using the Print button for DataTables'
			  }		  
			]
		} );
		myTable.buttons().container().appendTo( $('.tableTools-container') );
		
		//style the message box
		var defaultCopyAction = myTable.button(1).action();
		myTable.button(1).action(function (e, dt, button, config) {
			defaultCopyAction(e, dt, button, config);
			$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
		});
		
		
		var defaultColvisAction = myTable.button(0).action();
		myTable.button(0).action(function (e, dt, button, config) {
			
			defaultColvisAction(e, dt, button, config);
			
			
			if($('.dt-button-collection > .dropdown-menu').length == 0) {
				$('.dt-button-collection')
				.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
				.find('a').attr('href', '#').wrap("<li />")
			}
			$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
		});
	
		////
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
		setTimeout(function() {
			$($('.tableTools-container')).find('a.dt-button').each(function() {
				var div = $(this).find(' > div').first();
				if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
				else $(this).tooltip({container: 'body', title: $(this).text()});
			});
		}, 500);
	
		setTimeout(function() {
			$('.alert').hide('slowly');
		}, 3000);
		
	})
}
</script>