<?php 
$y=$year;
?>
<?php
$m=$month;
	if($m>6) {
		$qy=" date(`rec_date`) BETWEEN '".$y."-07-01' and '".$y."-".$m."-31"."' ";
		$qm=" date(`rec_date`) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31"."' ";
	}else{
		$qy=" date(`rec_date`) BETWEEN '".($y-1)."-07-01' and '".$y."-".$m."-31"."' ";
		$qm=" date(`rec_date`) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31' ";
	}
	
?>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		Profit and Loss Statement
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
	<div id="display">
		<h4 class="vHide">Marium Fashion</h4>
		<p class="vHide"></p>
		<p class="vHide">halishahar</p>
		<p class="text-center vHide">Profit and Loss Statement</p>
		<table class="table table-bordered table-hover" width="100%">
			<tbody>
				<tr>
					<td style="vertical-align:top;padding: 0px;border:0px">
					
						<table class="table table-bordered table-hover" width="100%" style="margin-bottom:0;border:0px">
							<thead>
								<tr>
									<th width="60%">&nbsp;&nbsp;Expenses</th>
									<th width="20%">Current Month</th>
									<th width="20%">Current Year</th>
								</tr>
							</thead>				
							<tbody>
								<?php 
									$tey=0; // total expenses year
									$tem=0; // total expenses month
									$bal_e=0; // total balance from starting
									if($expDataYear){
										foreach($expDataYear as $edy){
										    if($edy){
    											if(isset($edy['table_name']) && $edy['table_name']=='tbl_fcoa_bkdn_sub'){
    												$bal_e=$this->db->query('select sub_balance from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id="'.$edy['table_id'].'" and '.$qy)->row_array()['sub_balance'];
    											}elseif(isset($edy['table_name']) && $edy['table_name']=='tbl_fcoa_bkdn'){
    												$bal_e=$this->db->query('select bkdn_balance from tbl_fcoa_bkdn where fcoa_bkdn_id="'.$edy['table_id'].'" and '.$qy)->row_array()['bkdn_balance'];
    											}
    											$tey+=$edy['cost']+$bal_e;
										    }
								?>
								<tr>
									<td><?= $edy['account_code'] ?></td>
									<td>
										<?php
											if(isset($expDataMonth[explode('-',$edy['account_code'])[0]])){
												echo $expDataMonth[explode('-',$edy['account_code'])[0]];
												$tem+=$expDataMonth[explode('-',$edy['account_code'])[0]];
											}
										?>
									</td>
									<td><?= $edy['cost'] ?></td>
								</tr>
										<?php } ?>
								<?php } ?>
							</tbody>
						</table>
						
					</td>
					<td style="vertical-align:top;padding: 0px;border:0;border-right:1px solid; width:50%">
					
						<table class="table table-bordered table-hover" width="100%" style="margin-bottom:0">
							<thead>
								<tr>
									<th width="60%">&nbsp;&nbsp;Income</th>
									<th width="20%">Current Month</th>
									<th width="20%">Current Year</th>
								</tr>
							</thead>				
							<tbody>
								<?php 
									$tiy=0; // total income year
									$tim=0; // total income month
									$bal_i=0;
									if($incDataYear){
										foreach($incDataYear as $idy){
											if(isset($idy['table_name']) && $idy['table_name']=='tbl_fcoa_bkdn_sub'){
												$bal_i=$this->db->query('select sub_balance from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id="'.$idy['table_id'].'" and '.$qy)->row_array()['sub_balance'];
											}elseif(isset($idy['table_name']) && $idy['table_name']=='tbl_fcoa_bkdn'){
												$bal_i=$this->db->query('select bkdn_balance from tbl_fcoa_bkdn where fcoa_bkdn_id="'.$idy['table_id'].'" and '.$qy)->row_array()['bkdn_balance'];
											}
											$tiy+=$idy['income']+$bal_i;
								?>
								<tr>
									<td><?= $idy['account_code'] ?></td>
									<td>
										<?php
											if(isset($incDataMonth[explode('-',$idy['account_code'])[0]])){ echo $incDataMonth[explode('-',$idy['account_code'])[0]];
											$tim+=$incDataMonth[explode('-',$idy['account_code'])[0]];
											}
										?>
									</td>
									<td><?= $idy['income'] ?></td>
								</tr>
										<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
			
			<tfoot>
				<tr>
					<td style="vertical-align:top;padding: 0px;border:0px">
					
						<table class="table table-bordered table-hover" width="100%" style="margin-bottom:0;border:0px">
							<tr>
								<th width="60%"><b>Total Expenses</b></th>
								<th width="20%"><b><?= $tem ?></b></th>
								<th width="20%"><b><?= $tey ?></b></th>
							</tr>
							<tr>
								<th width="60%"><b>Net Profite</b></th>
								<th width="20%"><b><?= $tim-$tem ?></b></th>
								<th width="20%"><b><?= $tiy-$tey ?></b></th>
							</tr>
						</table>
					</td>
					<td style="vertical-align:top;padding: 0px;border:0;border-right:1px solid; width:50%">
					
						<table class="table table-bordered table-hover" width="100%" style="margin-bottom:0">
							<tr>
								<th width="60%"><b>Total Income</b></th>
								<th width="20%"><b><?= $tim ?></b></th>
								<th width="20%"><b><?= $tiy ?></b></th>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>Manager signature</td>
					<td><?= date('m/d/Y h:i:s a', time()); ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<script type="text/javascript">
//print all report
	function printPageArea(areaID){
		var printContent = document.getElementById(areaID);
		var WinPrint = window.open('', '', 'width=900,height=650');
		WinPrint.document.write('<style type="text/css" media="print"> @page { font-size:12px; } table{font-size:12px;border-collapse: collapse;} table, td, th {border: 1px solid black;} table>thead>tr{border:none;} .table{border:0px;} h4,p{text-align:center;padding:0;margin:0}</style>');
		WinPrint.document.write(printContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>
