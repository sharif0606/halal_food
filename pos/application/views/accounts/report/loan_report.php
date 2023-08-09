<style>
	
</style>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		ঋণ সংক্ৰান্ত  প্রতিবেদন
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
<?php 
$date = new DateTime();
$date->modify("last day of previous month");
$lm= $date->format("Y-m-d");
$cm= date('Y-m-t');
?>
		<div id="display">
					<h4 class="vHide">Probati Somobay Somity Ltd</h4>
					<p class="vHide">Probati Laborer Co-Operative Organization</p>
					<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
					<p class="text-center vHide">ঋণ সংক্ৰান্ত  প্রতিবেদন</p>
			<table id="" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th rowspan="2">কর্মসূচির নাম</th>
						<th colspan="2">বিগত মাস শেষে সদস্য</th>
						<th colspan="2">ঋণ বিতরণ</th>
						<th rowspan="2">এ মাসে ঋণ আদায়</th>
						<th rowspan="2">পরিশোধকৃত  জন</th>
						<th colspan="2"> মাস শেষে </th>
					</tr>
					<tr>
						<td>ঋণী</td>
						<td>ঋণ কিস্তি</td>
						<td>জন</td>
						<td>টাকা</td>
						<td>ঋণী</td>
						<td>ঋণ কিস্তি</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>মহিলা</td>
						<td>
							<?php 
							$countylmf=$this->db->query("SELECT count(id) as tm FROM `tbl_loan_assign` WHERE `disbursement_Date`<='$lm' and status=1 and `member_Id` in (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
							
							$countylmfb=$countylmf->tm;
							echo $countylmfb;
							?>
						</td>
						<td>
							<?php 
							$loanylmf=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (21)")->row();
							
							$loanylmfb=($loanylmf->dr - $loanylmf->cr);
							echo $loanylmfb;
							?>
						</td>
						<td>
							<?php 
							$countycmf=$this->db->query("SELECT count(id) as tm FROM `tbl_loan_assign` WHERE `disbursement_Date`>'$lm' and `disbursement_Date`<='$cm' and status=1  and `member_Id` in (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
							
							$countycmfb=$countycmf->tm;
							echo $countycmfb;
							?>
						</td>
						<td><?php 
							$loanycmfdr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (21)")->row();
							$loanycmfdrb=$loanycmfdr->dr;
							echo $loanycmfdrb;
							?>
						</td>
						<td>
							<?php 
							$loanycmfcr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (21)")->row();
							
							$loanycmfcrb=$loanycmfcr->cr;
							echo $loanycmfcrb;
							?>
						</td>
						<td>
						
						</td>
						<td>
							<?php
								// col 2 + col 4
								$endOfMonthLoanMemberF=$countylmfb+$countycmfb;
								echo $endOfMonthLoanMemberF;
							?>
						</td>
						<td>
							<?php
								// col 3 + col 5 - col 6
								$endOfMonthLoanF=($loanylmfb+$loanycmfdrb)-$loanycmfcrb;
								echo $endOfMonthLoanF;
							?>
						</td>
					</tr>					
					
					<tr>
						<td>পুরুষ</td>
						<td>
							<?php 
							$countylmm=$this->db->query("SELECT count(id) as tm FROM `tbl_loan_assign` WHERE status=1  and `member_Id` in (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
							
							$countylmmb=$countylmm->tm;
							echo $countylmmb;
							?>
						</td>
						<td>
							<?php 
							$loanylmm=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (22)")->row();
							
							$loanylmmb=($loanylmm->dr - $loanylmm->cr);
							echo $loanylmmb;
							?>
						</td>
						<td>
							<?php 
							$countycmm=$this->db->query("SELECT count(id) as tm FROM `tbl_loan_assign` WHERE `disbursement_Date`>'$lm' and `disbursement_Date`<='$cm' and status=1  and `member_Id` in (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
							
							$countycmmb=$countycmm->tm;
							echo $countycmmb;
							?>
						</td>
						<td><?php 
							$loanycmmdr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (22)")->row();
							$loanycmmdrb=$loanycmmdr->dr;
							echo $loanycmmdrb;
							?>
						</td>
						<td>
							<?php 
							$loanycmmcr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (22)")->row();
							
							$loanycmmcrb=$loanycmmcr->cr;
							echo $loanycmmcrb;
							?>
						</td>
						<td>
						
						</td>
						<td>
							<?php
								// col 2 + col 4
								$endOfMonthLoanMemberM=$countylmmb+$countycmmb;
								echo $endOfMonthLoanMemberM;
							?>
						</td>
						<td>
							<?php
								// col 3 + col 5 - col 6
								$endOfMonthLoanM=($loanylmmb+$loanycmmdrb)-$loanycmmcrb;
								echo $endOfMonthLoanM;
							?>
						</td>
					</tr>
					<tr>
						<td>সর্বমোট</td>
						<td><?= $countylmfb+$countylmmb ?></td>
						<td><?= $loanylmfb+$loanylmmb ?></td>
						<td><?= $countycmfb+$countycmmb?></td>
						<td><?= $loanycmfdrb+$loanycmmdrb?></td>
						<td><?= $loanycmmcrb+$loanycmfcrb?></td>
						<td></td>
						<td><?= $endOfMonthLoanMemberF+$endOfMonthLoanMemberM ?></td>
						<td><?= $endOfMonthLoanF+$endOfMonthLoanM ?></td>
					</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>ম্যানেজার সাক্ষর</td>
					<td colspan="6"></td>
					<td>তারিখ এবং সময়</td>
					<td colspan="4"><?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
				</tr>
				</tfoot>
			</table>
		</div>
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
