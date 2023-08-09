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
			Master Head List
			<button class="btn btn-info btn-bold pull-right" data-toggle="modal" onmouseover="clear_input_box()" data-target="#myModal">Add New</button>
		</h3>
		<?php if($this->session->flashdata('message')):?>
			<?=$this->session->flashdata('message')?>
		<?php endif?>
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Results for "All Master Head"
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div class="overflow">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>SL #</th>
						<th>Master Head</th>
						<th>Master Code</th>
						<th>Action</th>
					</tr>
				</thead>
		 
				<tbody>
					<?php
						foreach($master_head_list as $row){ ?>
						<tr>
							<td><?= $row['fcoa_master_id'];?></td>
							<td><?= $row['fcoa_master'];?></td>
							<td><?= $row['master_code'];?></td>
							<td>
								<a data-toggle="modal" data-target="#myModal" onclick="edit_doc(<?= $row['fcoa_master_id'];?>)" title="Edit">
									<i class="ace-icon fa fa-edit bigger-120 "></i>
								</a>
								<!--<a onClick='return delete_alert("Are you sure Delete Master Head ????");' href="<?php echo base_url();?>accounts/master_head_delete/<?php echo $row['fcoa_master_id'];?>" title="Delete"class="btn btn-danger btn-bold"><i class="fa fa-remove"></i></a> -->
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <?= form_open('accounts/accounts/master_head_list','id=loanAssign'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<input type="hidden" name="fcoa_master_id" id="fcoa_master_id" value="" />
					<label for="fcoa_master">Master Head Name </label>
					<input type="text" class="form-control" name="fcoa_master" id="fcoa_master" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="company">Master Head Code</label>
					<input type="text" class="form-control" name="master_code" id="master_code" onkeyup="removeChar(this)" required>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
	</form>
    </div>

  </div>
</div>						

<!-- edit -->
<div id="myModalEdit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content edit_content">
		<!-- edit content will be displayed here -->
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

	<!-- page specific plugin scripts -->
		<script src="<?php echo base_url();?>assets/js/tree.min.js"></script>
<!-- page specific plugin scripts -->

<!-- inline scripts related to this page -->
<script type="text/javascript">


function edit_doc(fcoa_master_id){
	/* change add screen to update screen */
	$('.modal-title').html('Update Head');
	$('.save_btn').html('Update');
	
	var mhlArray=<?php echo json_encode($master_head_list) ?>;
	
	for(i=0; i < mhlArray.length; i++)
	{
		if(mhlArray[i].fcoa_master_id==fcoa_master_id){
			var fcoa_master_id=mhlArray[i].fcoa_master_id;
			var fcoa_master=mhlArray[i].fcoa_master;
			var master_code=mhlArray[i].master_code;
		}
	}
		$('[name=fcoa_master_id]').val(fcoa_master_id);
		$('[name=fcoa_master]').val(fcoa_master);
		$('[name=master_code]').val(master_code);
		
		
		$('[name=fcoa_master]').focus();
}

function clear_input_box(){
	$('.modal-title').html('Create New Head');
	$('.save_btn').html('Save');
	document.getElementById("form").reset();
}

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
			  null, null,
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
<!-- Added for accounts -->
	<script src="<?= base_url();?>assets/js/valid-functions.js"></script>
	<!-- Added for accounts --> 