<?php if($this->session->flashdata('message')): ?>
	<?php echo $this->session->flashdata('message'); ?>
<?php endif;?> 
<div class="row">
									<div class="col-xs-12">

										<div class="clearfix">
											<div class="tableTools-container">
											        <button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
											</div>
										</div>
										<div class="table-header">
											Results for "Auto Process Lists"
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div id="display">
                            <table id="example" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
																							<th class="center aHide">
															<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
															<th>Sl#</th>

                                        <th>Samity Code</th>
										<th>Samity Name</th>
                                        <th>Field Officer</th>
                                        <th>Samity Day</th>
                                        <th>Report Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
								//print_r($payment_Date);
								$sl = 1;
								if($samity_Lists){
									foreach($samity_Lists as $row){ ?>
                                                               <tr>
																<td class="center aHide">
								<label class="pos-rel">
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
								</td>
								<td><?= $sl++;?></td>
									<td><?= $row['samity_Code'];?></td>
									<td><?= $row['samity_Name'];?></td>
									<td><?= $row['officer_Name'];?></td>
									<td>
									<script>
									var date = <?= $row['samity_Day'];?>;
									//var a= moment().day(all).format('dddd');
									//$('.all').text(a);
									if(date ==6){
										document.write('Saturday');

									}else if(date ==7){
										document.write('Sunday');

									}else if(date ==1){
										document.write('Monday');

									}else if(date ==2){
										document.write('Tuesday');
									}else if(date ==3){
										document.write('Wednesday');
									}
									else{
										document.write('Thursday');
									}
									
									</script>
									</td>
									<td>
									  
                                        <?php 
                                            $a = getSamity($row['samity_Code'],$row['samity_Day'],'2020-06-01',$report); 
                                            
                                            
                                           foreach($a as $avl){
                                                echo $avl;
                                            }
                                            ?>
										
										<!--<a class="btn btn-success" href="<?= base_url();?>auto_Process/auto_Process/search?samity_Name=<?= $row['samity_Code'];?>"><font style="vertical-align: inherit;">Auto Process</a>-->
									</td>
								</tr>
								<?php } ?>
							<?php }else{ ?>
							<?php } ?>
								</tbody>
                            </table>
<?php
function getSamity($samitycode,$day,$op,$report){
   $data['day'] = $day;
   $data['op'] = $op;
   $data['samitycode'] = $samitycode;
  // print_r($report);
   //return $data;
$baseUrlr = base_url().'report/Auto_Process_Report/view_loan_Lists';   
$baseUrlp = base_url().'auto_Process/auto_Process/view_loan_Lists';
$start = new DateTime($data['op']);
$a = Date('Y-m-d  h:i:sa');

$end =new DateTime( $a );

$interval = new DateInterval('P1D');

$period = new DatePeriod($start, $interval, $end);


// only trigger every three weeks...
$weekInterval = 1;

// initialize fake week
$fakeWeek = 0;
$currentWeek = $start->format('W');
$i=0;
$a = [];
$c = [];

//echo $data['samitycode'];
foreach ($period as $date) {
  $e =[];  
    $dayOfWeek = $date->format('N');
    if ($dayOfWeek == $data['day']) {
        $b = $date->format('Y-m-d');
            foreach($report as $row2){
                if($samitycode == $row2['samity_Code'] && $b == $row2['payment_Date']){
                    $updated_on = $row2['updated_on'];
                    $proType = $row2['proType'];
                    $payment_Date = $row2['payment_Date'];
                   $a[]= "<a target=\"_blank]\" class=\"btn btn-xs btn-white btn-round\" href='$baseUrlr?samity_Name=$samitycode&samity_Day=$day&date=$updated_on&proType=$proType&payment_Date=$payment_Date&updated_on=$updated_on&actual_payment_Date=$payment_Date'><i class=\"ace-icon fa fa-print bigger-110 icon-only blue\"></i>$b</a>"; 
                   $e[]= $b;
                }
            }
			
                    /*if(!in_array($b,$e)){
                    $c[] = "<a target=\"_blank]\" class=\"btn btn-xs btn-white btn-round\" href='$baseUrlp?samity_Name=$samitycode&samity_Day=$day&date=$b'><i class=\"ace-icon fa fa-times bigger-110 red2\"></i>$b</a>";
                    }*/
					
              
            /**/
		$i++;
		//$d =  array_diff($c,$a);
		//$d = array_merge($a,$c);
    }
	
}
return $a;
}
?>
	
							<script>
							$(document).ready(function(){

	$('input[name="disbursement_Date"]').daterangepicker({
	"singleDatePicker": true,
    "showDropdowns": true,
    "minYear":2018,
    "minDate": 2017/01/01,
    "maxDate": moment(new Date()).format("YYYY/MM/DD"),
	 locale: {
		//format: 'YYYY/MM/DD HH:mm'
		format: 'YYYY/MM/DD'
		},
	});

});
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
					  null, null,null, null, null,
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