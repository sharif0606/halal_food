<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		Loan Report
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->

		<div id="display">
			<h4 class="vHide">Probati Somobay Somity Ltd</h4>
			<p class="vHide">Probati Laborer Co-Operative Organization</p>
			<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
			<p class="text-center vHide">Loan Report (Daily)</p>
			<table id="" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th>Loan collection Date</th>
						<th>Male</th>
						<th>Female</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php if($data){ $pam=$pafm=$pm=0; ?>
					<?php foreach($data as $d){ $pam+=$d['pam']; $pafm+=$d['pafm'];$pm+=$d['pam']+$d['pafm']; ?>
					<tr>
						<td><?= $d['paid_Date']; ?></td>
						<td><?= $d['pam']; ?></td>
						<td><?= $d['pafm']; ?></td>
						<td><?= $d['pam']+$d['pafm']; ?></td>
					</tr>					
					<?php } ?>
					<tr>
						<td>Total</td>
						<td><?= $pam ?></td>
						<td><?= $pafm ?></td>
						<td><?= $pm ?></td>
					</tr>
					<?php }else{?>
					
					<?php } ?>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="2">Manager signature</td>
					<td colspan="2">Date and time <?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
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
		WinPrint.document.write('<style type="text/css" media="print"> @page { font-size:12px; } table{font-size:12px;border-collapse: collapse;} table, td, th {border: 1px solid black;} table>thead>tr{border:none;} h4,p{text-align:center;padding:0;margin:0}</style>');
		WinPrint.document.write(printContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
	
</script>
