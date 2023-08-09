<?php if($this->session->flashdata('message')): ?>
	<?php echo $this->session->flashdata('message'); ?>
<?php endif;?> 
<div class="row">
    <div class="col-xs-12">
		<div class="clearfix">
			<div class="tableTools-container">
			<a href="<?= base_url();?>withdraw/Withdraw_paid_Bal" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" ><i class="fa fa-plus bigger-110 grey"></i> <span class="">Restrict Savings Withdraw </span></a>
			<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
			</div>
		</div>
		<div class="table-header">
			Results for "Restrict Savings Withdraw Lists"
		</div>

		<!-- div.table-responsive -->

		<!-- div.dataTables_borderWrap -->
		<div id="display">
		    <table id="example" class="table table-striped table-bordered table-hover" width="100%">
		        <thead>
		            <tr>
						<th>Sl#</th>
                        <th>Samity Code</th>
                        <th>Member Id</th>
                        <th>Savings Code</th>
                        <th>Withdraw Amt.</th>
                        <th>Payment Status.</th>
						<th>Profit</th>
						<th>Rate</th>
                        <th>Payment Date</th>
                        <th>Posted By</th>
                        <th>Status</th>
                        <th class="aHide">Action</th>
                    </tr>
                </thead>
                <tbody>
					<?php
					//print_r($withdrawList);
					$sl = 1;
					$total = 0;
					$profit = 0;
					if($withdrawList){
						foreach($withdrawList as $row){  	
						    $total +=  $row['w_Amt']; 
						    $profit +=$row['profit'];
						?>
					<tr>
					    <td><?= $sl++;?></td>
						<td><?= $row['samity_Code'];?></td>
						<td><?= $row['member_Id'];?></td>
						<td><?= $row['saving_Code'];?></td>
						<td><?= $row['w_Amt'];?></td>
						<td><?= $row['wStatus']==1?  'Full': 'Partial' ?></td>
						<td><?= $row['profit'];?></td>
						<td><?= $row['rate'];?></td>
						<td><?= $row['payment_Date'];?></td>
						<td>
						    <?php 
						        $user = array_column($user_info,'id','name');
						        //print_r($user);
					            $key = array_search($row['created_by'], $user);
					            echo $key;
						    ?>
						</td>
						<td>
							<?php if($row['status'] == 1) echo '<button class="btn btn-white btn-warning">paid</button>'; elseif($row['status'] == 2) echo '<button class="btn btn-white btn-warning">Reverse Entry</button>';
							    else{
							       echo '<button class="btn btn-white btn-success">Added To Voucher</button>'; 
							    }
							?>
						</td>

						<td class="aHide">
							    <div class="hidden-sm hidden-xs action-buttons">
							<!--	<a target="_blank"  class="green" href="<?= base_url();?>withdraw/Withdraw_paid_Bal/editRsWithdraw?id=<?= $row['id'];?>">
									<i class="ace-icon fa fa-pencil bigger-130"></i>
								</a>-->
								</div>
							</div>
						</td>
					</tr>
					<?php } ?>
					<?php }else{ ?>
					<?php } ?>
				</tbody>
	<tfoot>
				<tr>
				    <th colspan="4" class="text-right">WithDraw SubTotal</th> <th></th><th>Profit SubTotal</th> <th></th>
				</tr>
				<tr>
				    <th colspan="6" class="text-right">Total Page Wise WidthDraw+Profit</th><th  class="pagetotal"></th>
				</tr>
				<tr>
			    <th colspan="6" class="text-right">Total WidthDraw+Profit</th><th  class="total"><?php  echo $total+$profit;?></th>
				</tr>
			</tfoot>
            </table>
        </div>
    </div>
</div>
							
							<script>
//print all report
	function printPageArea(areaID){
		var printContent = document.getElementById(areaID);
		var WinPrint = window.open('', '', 'width=900,height=650');
		WinPrint.document.write('<link rel="stylesheet" type="text/css" href="http://localhost/probati_top_menu/assets/css/bootstrap.min.css" media="print" />');
		WinPrint.document.write('<style type="text/css" media="print"> @page { font-size:12px; } table{font-size:12px;} table td{padding:3px; border:1px solid black;} table th{padding:3px; border:1px solid black;} .print_button{ display:none;} .header-div-box{display:inline-block;} .header-div-box.box-left{float:left; margin-bottom:10px;} .header-div-box.box-right{float:right;} .aHide{display: none;} .table-bordered>tfoot>tr>td{border:none;}.vHide{display:block;} .dataTables_length,.dataTables_filter,.dataTables_info,.dataTables_paginate,.paging_simple_numbers{display:none} h4,p{text-align:center;margin:0;padding:0} .table>thead>tr>th:first-child{border:none;}</style>');
		WinPrint.document.write(printContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
	jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#example')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,null,null,null,null,null,
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
 
           


            // Total over this page
            withdrawTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
             profitTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            // Update footer
            $( api.column( 4 ).footer() ).html(
                'BDT '+withdrawTotal);
             $( api.column( 6 ).footer() ).html(
                'BDT '+profitTotal);
            ptotal = parseFloat(withdrawTotal)+parseFloat(profitTotal);//page wise total
        	$('.pagetotal').text('BDT '+ptotal);
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
					 /* {
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
					  /*{
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }	*/	  
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
				
			
			
			})
</script>