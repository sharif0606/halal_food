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
			Sub2 Head List
			<button class="btn btn-info btn-bold pull-right" data-toggle="modal" onmouseover="clear_input_box()" data-target="#myModal">Add New</button>
		</h3>
		<?php if($this->session->flashdata('message')):?>
			<?=$this->session->flashdata('message')?>
		<?php endif?>
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Results for "All Sub2 Head"
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div class="overflow">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>SL #</th>
						<th>Master Head</th>
						<th>Sub1 Head</th>
						<th>Sub2 Head</th>
						<th>Opening Balance</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach($sub2_head_list as $row){ 
						
					?>
						<tr>
							<td><?= $row['fcoa_bkdn_id'];?></td>
							<td><?= $row['master_code']."-".$row['fcoa_master'];?></td>
							<td><?= $row['fcoa_code']."-".$row['fcoa'];?></td>
							<td><?= $row['bkdn_code']."-".$row['fcoa_bkdn'];?></td>
							<td><?= $row['bkdn_balance'];?></td>
							<td>
								<a data-toggle="modal" data-target="#myModalEdit" onclick="edit_head(<?= $row['fcoa_bkdn_id'] ?>)" title="Edit">
									<i class="ace-icon fa fa-edit bigger-120 "></i>
								</a>
								<!--<a onClick='return delete_alert("Are you sure Delete Sub2 Head ????");' href="<?php echo base_url();?>accounts/sub2_head_delete/<?php echo $row['fcoa_bkdn_id'];?>" title="Delete"><i class="fa fa-remove"></i></a> -->
							</td>
						</tr>
					<?php 	} ?>
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
	<?php echo form_open('accounts/accounts/sub2_head_list','id=sub2_head_list'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create head</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<input type="hidden" name="fcoa_id" id="fcoa_id" value="" />
					<label for="fcoa_master_id">Master Head</label>
					 <select class="form-control" name="fcoa_master_id" id="fcoa_master_id_sub2" required>
						<option value="">Select Master Head</option>
						<?php 
						$code_head='';
						foreach($master_head_list as $row){ 
						$code_head=$row['master_code']."-".$row['fcoa_master'];
						?>
							<option value="<?php echo $row['fcoa_master_id'];?>"><?php echo $code_head;?></option>
						<?php } ?>
					</select>	
				</div>
				<div class="col-sm-6">
					<label>Sub1 Head Name <span style="color:red;">*</span></label>
					<select class="form-control" name="fcoa_id" id="fcoa_id_sub2" required>
						<option value="">Select COA-SUB1</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<label for="fcoa_bkdn">Sub2 Head Name <span style="color:red;">*</span></label>
					<input type="text" class="form-control" name="fcoa_bkdn" id="fcoa_bkdn" required>
				</div>
				
				<div class="col-sm-6">
					<label for="bkdn_code">Sub2 Head Code <span style="color:red;">*</span></label>
					<input type="text" class="form-control" name="bkdn_code" id="bkdn_code" onkeyup="removeChar(this)" required>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<label>Opening Balance</label>
					<input type="text" class="form-control" name="bkdn_balance" id="bkdn_balance" onkeyup="removeChar(this)">
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
		<script src="<?= base_url();?>assets/js/tree.min.js"></script>
<!-- page specific plugin scripts -->

<!-- inline scripts related to this page -->
<script type="text/javascript">


function edit_head(id){
	$.ajax({ 
        url: baseUrl+'accounts/sub2_head_edit',
        data:
            {                  
                'id':id
            }, 
            dataType: 'json',
            success: function(data)
            {
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                {
                    $('.edit_content').html(mainContent);
                }
            }
        });
        return false; // keeps the page from not refreshing     
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
			  null, null,null,null,
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