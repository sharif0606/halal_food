<style>

@media print {
th { font-size: 12px; }
td { font-size: 11px; }
}

</style>
<div class="row">
	<div class="clearfix">
		<div class="pull-right tableTools-container">
			<div class="dt-buttons btn-overlap btn-group">			
			</div>
		</div>
	</div>										
	<div class="col-xs-12">
		<div class="table-header">
			Results for "Restrict Savings Amount Details Date Wise"
		</div>
		<div id="display">
			<table id="dynamic-table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info">
			<thead>
				<tr role="row">
					<th class="center sorting_disabled" aria-label="">
						<label class="pos-rel">
							<input type="checkbox" class="ace">
							<span class="lbl"></span>
						</label>
					</th>
					<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Domain: activate to sort column ascending">
						Sl#
					</th>
				
					<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Price: activate to sort column ascending">
						Member Id
					</th>
					<th class="hidden-480 sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Clicks: activate to sort column ascending">
						Saving Code
					</th>
					<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Update
					: activate to sort column ascending">
						<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
						Paid Date
					</th>
					<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Update
					: activate to sort column ascending">
						Paid Amount
					</th>
					<th class="hidden-480 sorting_asc" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column descending" aria-sort="ascending">
						Paid Status
					</th>
					<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Update
					: activate to sort column ascending">
						<i class="ace-icon fa fa-user bigger-110 hidden-480"></i>
						Updated By
					</th>
					<th class="sorting" tabindex="0" aria-controls="dynamic-table" rowspan="1" colspan="1" aria-label="Update
					: activate to sort column ascending">
						Updated On
					</th>
					<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="">
						Edit & Cancel Deposit
					</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				if($data){
					$sl = 1;
			?>
			<?php foreach($data as $d){ ?>
				<tr role="row" class="odd">
				<td class="center">
					<label class="pos-rel">
						<input type="checkbox" class="ace">
						<span class="lbl"></span>
					</label>
				</td>
					<td><?= $sl++;?></td>
					<td><?= $d['member_Id']; ?></td>
					<td><?= $d['saving_Code']; ?></td>
					<td><?= $d['payment_Date']; ?></td>
					<td><?= $d['p_Amt']; ?></td>
					<td>
						<?php if( $d['p_status'] == 1 ) echo 'Full'; elseif( $d['p_status'] == 2 ) echo 'Partial'; else echo 'Zero';?>
					</td>
					<td>
						<?php 
							$user = array_column($user_info,'id','name');
							//print_r($user);
							$key = array_search($d['updated_by'], $user);
							echo $key;
						?>
					</td>
					<td><?= $d['updated_on']; ?></td>
					<?php if($d['status'] > 0) {?> 
					<td>
									   <!--<button class="green" style="outline:none;border:none;" data-toggle="modal" data-target="#myModal" onclick="changeBalance('<?= $d['saving_Code']; ?>',<?= $d['p_Amt'];?>,'<?= $d['p_status']; ?>',<?= $d['status'];?>,<?= $d['id'];?>,'<?= $d['payment_Date'];?>')">
										<i class="ace-icon fa fa-pencil bigger-130"></i>
										</button>

									<a class="red" href="<?= base_url();?>rs/View_Rs_By_Id/crsamt?id=<?= $d['id'];?>&member_Id=<?= $d['member_Id'];?>&dps_No=<?= $d['saving_Code'];?>"><i class="ace-icon fa fa-trash bigger-130"></i></a>-->
									</td>
				   <?php  } ?>
								   
								</tr>
					<?php } ?>
					<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th></th><th></th><th></th><th></th><th style="text-align:right">Sub Total</th><th></th><th colspan="4"></th>
				</tr>
				<tr>
					<th></th><th></th><th></th><th></th><th style="text-align:right">Total</th><th class="total"></th><th colspan="4"></th>
				</tr>
			</tfoot>
		   </table>
		  </div>
		  <!-- Print  Area End -->
		</div>
	</div>
</div>

<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	<?php echo form_open_multipart('rs/View_Rs_By_Id/edit'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Restrict Payment Payment Update</h4>
      </div>
      <div class="modal-body">
        
		<input type="hidden" id="baseurl" name="" value="<?= base_url()?>" />
		<div class="form-group">
			<label>DPS No</label>
			<input type="text" id="dps_No" name="saving_Code" class="form-control" readonly>
			<input type="hidden" name="id" id="id">
		</div>
		<div class="form-group">
			<label>Paid Date</label>
			<input type="text" id="paid_Date" name="payment_Date" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Deposit Amount</label>
			<input type="text" id="savings_Amount" name="" class="form-control" readonly>
		</div>
		<div class="form-group">
			<label>Payment Status</label>
			<input type="radio" id="p_status_1" name="p_status" value="1" required>Full
			<input type="radio" id="p_status_2" name="p_status" value="2" required>Partial
			<input type="radio" id="p_status_3" name="p_status" value="3" required>Zero
		</div>
		<div class="form-group">
			<label>Paid Amount</label>
			<input type="text" id="paid_Amount" name="p_Amt" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Status</label>
			<select name="status" class="form-control status" required>
			    <option value="">--Select Status--</option>
			    <option value="1">Paid</option>
			</select>
		</div>
      </div>
      <div class="modal-footer">
		<button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  <?php echo form_close(); ?>
    </div>

  </div>
</div>
<script>  

function changeBalance(a,c,d,f,g,h){
	$('input[name="payment_Date"]').val(h);
	$('input[name="payment_Date"]').daterangepicker({
	"singleDatePicker": true,
    "showDropdowns": true,
    "maxDate": moment(new Date()).format("YYYY/MM/DD"),
	 locale: {
		//format: 'YYYY/MM/DD HH:mm'
		format: 'YYYY/MM/DD'
		},
	});
	
	$('#dps_No').val(a);
	$('#savings_Amount').val(c);
	$('#id').val(g);
	if(d==1){
	    $('#p_status_1').prop("checked", true);
	}else if(d==2){
	    $('#p_status_2').prop("checked", true);
	}else if(d==3){
	    $('#p_status_3').prop("checked", true);
	    $('#paid_Amount').val('');
	}else{
		 $('#p_status_1').prop("checked", false);
		 $('#p_status_2').prop("checked", false);
		 $('#p_status_3').prop("checked", false);
	}
	/*on change function*/
	$('input[type=radio][name=p_status]').on('change', function() {
        var change = this.value;
        if(change ==1){
          $('#paid_Amount').val(30);  
        }else if(change==2){
           $('#paid_Amount').val(''); 
           $('#paid_Amount').focus(); 
        }else if(change==3){
            $('#paid_Amount').val(0);
        }else{
			$('#paid_Amount').val('');  
		}
    });
	/*============*/
	$('#paid_Amount').val(c);
	/*===*/
	if(f == 1){
	    $('.status option').filter('[value=1]').attr('selected', true);
	}
	
}
$('.modal').on('hidden.bs.modal', function(){
    $(this).find('form')[0].reset();
});

								
								
								<!-- inline scripts related to this page -->

			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					
					aLengthMenu: [
        [10,25, 50, 100, 200, -1],
        [10,25, 50, 100, 200, "All"]
    ],
					fixedHeader: true,
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,null,null,null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                'BDT '+pageTotal);
			$('.total').text('BDT '+total);
        },
					
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
			
			
					select: {
						style: 'multi'
					}
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
					  /*{
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },*/
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold",
						footer: 'true',
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: true,
						message: 'This print was produced using the Print button for DataTables',
						titleAttr: 'Print the results',
title: '',
 footer: 'false',
exportOptions: {
    columns: ':visible',
    stripHtml: true,
	 
    columns: [1, 2, 3, 4, 5,6,7,8,9],
	 modifier: {
                    page: 'current'
                },
},
   header: true,
   title: 'Probati Somobay Somity Ltd Probati Laborer Co-Operative Organization Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018 Collection Sheet',
   orientation: 'landscape',
   customize: function(doc) {
      doc.defaultStyle.fontSize = 16; //<-- set fontsize to 16 instead of 10 
   } ,
text: '<i class="fa fa-print fa-lg text-success"></i>',
message: 'Loan Reort' ,
customize: function (win) {
    $(win.document.body)
        .css('font-size', '10pt')
        .prepend(
            '<img src="" style="position:absolute; top:0; left:0;" />'
        );

},
						
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
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
		</script>

