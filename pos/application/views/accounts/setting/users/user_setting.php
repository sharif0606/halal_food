<!-- Page Specific CSS -->
<style>
.header {
	line-height:40px;
}
input[type=checkbox].ace.ace-switch.ace-switch-5+.lbl::before {
    content: "YES\a0\a0\a0\a0\a0\a0\a0\a0\a0\a0\a0NO";
}
input[type=checkbox].ace{
	opacity: 1;
	position: relative;
	height:14px;
}
.hides{
	display:none;
}
.overflow table tbody tr td:last-child{
	min-width:60px;
}
</style>
<!-- Page Specific CSS -->

<div class="row">
	<div class="col-xs-12">
		<h3 class="header smaller lighter blue">
			User Setting 
			<button class="btn btn-info btn-bold pull-right" data-toggle="modal" data-target="#modal-wizard" onmouseover="get_user_add_json()" >Add New User</button>
		</h3>
		<?php if($this->session->flashdata('message')):?>
			<?=$this->session->flashdata('message')?>
		<?php endif?>
		<div class="clearfix">
			<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header">
			Results for "All Users"
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div class="overflow">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover table-responsive">
				<thead>
					<tr>
						<th>#SL</th>
						<th>Name</th>
						<th>Bangla</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Image</th>
						<th>Last Login Time</th>
						<th>Last Login IP</th>
						<th>Active</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>
					<?php if($userList){ $i=1; foreach($userList as $data){ ?>
					<tr>
						<td><?= $i ?></td>
						<td><?= $data['name'] ?></td>
						<td><?= $data['u_name'] ?></td>
						<td><?= $data['email'] ?></td>
						<td><?= $data['contact'] ?></td>
						<td><img src="<?= base_url()?>upolad/setting/employees/<?php if(empty($data['image'])) echo "noimg.gif"; else echo $data['image']; ?>" width="50" height="50"/>
						
						<!--<//?= implode(', ',explode(',',$data['accessArea'])); ?>--></td>
						<td><?= $data['lastLoginTime'] ?></td>
						<td><?= $data['lastLoginIp'] ?></td>
						<td>
							<?php if($data['active']==1){ ?>
							<label style="width:100%">
								<input class="ace ace-switch ace-switch-5" type="checkbox" checked="true" value="<?= $data['id'] ?>"/>
								<span class="lbl"></span>
							</label>
							<?php }else{ ?>
							<label style="width:100%">
								<input class="ace ace-switch ace-switch-5" type="checkbox" value="<?= $data['id'] ?>" />
								<span class="lbl"></span>
							</label>
							<?php } ?>
						</td>
						<td>
							<a href="javascript:void()" data-toggle="modal" data-target="#modal-wizard" onclick="get_user_edit_json(<?= $data['id'] ?>)" title="Edit">
								<i class="ace-icon fa fa-edit bigger-120"></i>
							</a>
							<a href="<?= base_url() ?>setting/user_setting/user_delete/<?= $data['id'] ?>" onclick="return confirm('Do you want to delete this record?');" title="Delete">
								<i class="ace-icon fa fa-trash bigger-120"></i>
							</a>
						</td>
					</tr>
					<?php $i++; } }?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<input type="hidden" id="baseurl" name="" value="<?= base_url()?>"/>
<!-- Modal -->
<div id="modal-wizard" class="modal">
	<div class="modal-dialog add_content_show">
	
    
	
  </div>
</div>						





<!-- inline scripts related to this page -->
<script type="text/javascript">
function get_user_add_json(){
var baseUrl = document.getElementById('baseurl').value;
$('.add_content_show').html('<div class="loader"></div>');

	$.ajax({ 
        url: baseUrl+'setting/user_setting/user_add_json',
        data:
            {                  
                
            }, 
            dataType: 'json',
            success: function(data)
            {
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                {
                    $('.add_content_show').html(mainContent);     
                }                
            }
        });
        return false; // keeps the page from not refreshing     

}

function get_user_edit_json(id){
	
var baseUrl = document.getElementById('baseurl').value;	
$('.add_content_show').html('<div class="loader"></div>');
	
	$.ajax({ 
        url: baseUrl+'setting/user_setting/user_edit_json',
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
                    $('.add_content_show').html(mainContent);     
                }                
            }
        });
        //return false; // keeps the page from not refreshing     

}

window.onload = function() {
	
	
	jQuery(function($) {
		
		/* this is for user activation work */
		$('.ace-switch-5').click(function(){
			var arr=new Array('deactive','active');
			var act=Number($(this).is(':checked'));
			var con=confirm("Are you sure you want to "+arr[act]+" this user ?");
			if(con){
				var id=$(this).val();
				var submi=$.post( baseUrl+'setting/user_setting/inactive_user', { active: act, id: id } );
					submi.done(function(message) {
						$('.header').after( message );
					})
			}
			else{
				return false;
			}
		})
		//initiate dataTables plugin
		var myTable = 
		$('#dynamic-table')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.DataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null,null, null, null,null,null,null,
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