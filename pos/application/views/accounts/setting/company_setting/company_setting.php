<!-- Page Specific CSS -->
<style>
.header {
	line-height:40px;
}
input[type=checkbox].ace.ace-switch.ace-switch-5+.lbl::before {
    content: "YES\a0\a0\a0\a0\a0\a0\a0\a0\a0\a0\a0NO";
}
.btn-group{
	width:100%;
	text-align:left;
}
.overflow table tbody tr td:last-child{
	min-width:60px;
}
</style>
<!-- Page Specific CSS -->

<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">
			Company Setting 
			<button class="btn btn-info btn-bold pull-right" data-toggle="modal" data-target="#myModal">Add New</button>
		</h3>
		<?php if($this->session->flashdata('message')):?>
			<?=$this->session->flashdata('message')?>
		<?php endif?>
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Results for "All Company"
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div class="overflow">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#SL</th>
						<th>Name</th>
						<th>Bangla</th>
						<th>Profession</th>
						<th>Country</th>
						<th>Representative Name</th>
						<th>designations</th>
						<th>contact</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
				<?php if($companyList){ $i=1; foreach($companyList as $data){ ?>
					<tr>
						<td><?= $i ?></td>
						<td><?= $data['name'] ?></td>
						<td><?= $data['shortName'] ?></td>
						<td><?= $data['Pro_name'] ?></td>
						<td><?= $data['country_name'] ?></td>
						<td><?= $data['representativeName'] ?></td>
						<td><?= $data['designations'] ?></td>
						<td><?= $data['contact'] ?></td>
						<td>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#myModalEdit" onclick="edit_comp(<?= $data['id'] ?>)" title="Edit">
								<i class="ace-icon fa fa-edit bigger-120 "></i>
							</a>|
							<a href="<?= base_url() ?>setting/company_setting/company_delete/<?= $data['id'] ?>" onclick="return confirm('Do you want to delete this record?');" title="Delete">
								<i class="ace-icon fa fa-trash bigger-120 "></i>
							</a>
						</td>
					</tr>
				<?php $i++; } }?>
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
	<form method="post" action="<?= base_url() ?>setting/company_setting/company_save">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Company Add</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="name">Name </label>
					<input type="hidden" name="id" id="id" value="0" />
					<input type="text" name="name" id="name" class="form-control" required />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="shortName">Name In Bangla</label>
					<input type="text" name="shortName" id="shortName" class="form-control" required />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="country">Country </label>
					<select name="country" id="country" class="form-control">
						<?php if($countryList){ foreach($countryList as $cL){?>
						<option value="<?= $cL->id?>"><?= $cL->name?></option>
						<?php } } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="address">Address </label>
					<textarea name="address" id="address" class="form-control"></textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="representativeName">Representative Name </label>
					<input type="text" name="representativeName" id="representativeName" class="form-control" />
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="designations">Designations</label>
					<input type="text" name="designations" id="designations" class="form-control" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="contact">Contact</label>
					<input type="text" name="contact" id="contact" class="form-control" />
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" class="form-control" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="profession">Profession </label>
					<select id="profession" class="form-control multiselect" multiple="">
						<?php if($professionList){ foreach($professionList as $pL){?>
						<option value="<?= $pL->id ?>"><?= $pL->name ?></option>
						<?php } } ?>
					</select>
					<input type="hidden" name="profession" class="profession"/>
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

	<script src="<?php echo base_url();?>/assets/js/bootstrap-multiselect.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">

function edit_comp(id){

	$.ajax({ 
        url: baseUrl+'setting/company_setting/edit_com_json',
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

function get_all_selected(){
	var brands = $('.multiselect-selected .ace');
	var selected = [];
	$(brands).each(function(index, brand){
		selected.push([$(this).val()]);
	});
	$('.profession').val(selected);
}
window.onload = function() {
	jQuery(function($) {
		
		////////////////// Datatables Multiselect
		$('.multiselect').multiselect({
		 enableFiltering: true,
		 enableHTML: true,
		 selectedClass: 'multiselect-selected',
		 buttonClass: 'btn btn-white btn-primary',
		 onChange: function(option, checked, select) {
                get_all_selected();
            },
		 templates: {
			button: '<button style="width:100%" type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
			ul: '<ul style="width:100%" class="multiselect-container dropdown-menu"></ul>',
			filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
			filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
			li: '<li><a tabindex="0"><label></label></a></li>',
	        divider: '<li class="multiselect-item divider"></li>',
	        liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
		 }
		});
		
		//initiate dataTables plugin
		var myTable = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.DataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null,null,null,null,null,null,
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