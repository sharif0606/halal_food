<style>
	
</style>
<?php 
$date = new DateTime( $year.'-'.$month.'-01');
$date->modify("last day of previous month");
$lm= $date->format("Y-m-d");
$cm= date('Y-m-t');
?>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
	    Savings & Loan Report
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
		<div id="display">
					<h4 class="vHide">Probati Somobay Somity Ltd</h4>
					<p class="vHide">Probati Laborer Co-Operative Organization</p>
					<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
					<p class="text-center vHide">Savings & Loan Report</p>
			<table id="" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th rowspan="2">Programme Name</th>
						<th colspan="2">Savings status up to last month</th>
						<th colspan="2">Current month's savings(Receive)</th>
						<th colspan="2">Current month's savings(Return)</th>
						<th colspan="2">Savings status at the end of the month</th>
					</tr>
					<tr>
						<th>Male</th>
						<th>Female</th>
						<th>Male</th>
						<th>Female</th>
						<th>Male</th>
						<th>Female</th>
						<th>Male</th>
						<th>Female</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Restrict Savings</td>
						<td>
							<?php 
							//last month male
							$res_sav_lm_m=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (15)")->row();
							
							$res_sav_lm_m_b=($res_sav_lm_m->cr - $res_sav_lm_m->dr);
							echo $res_sav_lm_m_b;
							?>
						</td>
						<td>
							<?php
							//last month female
							$res_sav_lm_f=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (16)")->row();
							
							$res_sav_lm_f_b=($res_sav_lm_f->cr - $res_sav_lm_f->dr);
							echo $res_sav_lm_f_b;
							?>
						</td>
						<td>
							<?php 
							//current month male (Receive)
							$res_sav_cm_m_rec=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (15)")->row();
							
							$res_sav_cm_m_rec_b=$res_sav_cm_m_rec->cr;
							echo $res_sav_cm_m_rec_b;
							?>
						</td>
						<td>
							<?php 
							//current month female (Receive)
							$res_sav_cm_f_rec=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (16)")->row();
							
							$res_sav_cm_f_rec_b=$res_sav_cm_f_rec->cr;
							echo $res_sav_cm_f_rec_b;
							?>
						</td>
						<td>
							<?php 
							//current month male (Return)
							$res_sav_cm_m_ret=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (15)")->row();
							
							$res_sav_cm_m_ret_b=$res_sav_cm_m_ret->dr;
							echo $res_sav_cm_m_ret_b;
							?>
						</td>
						<td>
							<?php 
							//current month female (Return)
							$res_sav_cm_f_ret=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (16)")->row();
							
							$res_sav_cm_f_ret_b=$res_sav_cm_f_ret->dr;
							echo $res_sav_cm_f_ret_b;
							?>
						</td>
						<td><?= $t_res_sav_em_m_b=(($res_sav_lm_m_b+$res_sav_cm_m_rec_b)-$res_sav_cm_m_ret_b) ?></td>
						<td><?= $t_res_sav_em_f_b=(($res_sav_lm_f_b+$res_sav_cm_f_rec_b)-$res_sav_cm_f_ret_b) ?></td>
					</tr>
					
					<tr>
						<td>Voluntary Savings</td>
						<td>
							<?php 
							//last month male
							$vol_sav_lm_m=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (23)")->row();
							
							$vol_sav_lm_m_b=($vol_sav_lm_m->cr - $vol_sav_lm_m->dr);
							echo $vol_sav_lm_m_b;
							?>
						</td>
						<td>
							<?php
							//last month female
							$vol_sav_lm_f=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (24)")->row();
							
							$vol_sav_lm_f_b=($vol_sav_lm_f->cr - $vol_sav_lm_f->dr);
							echo $vol_sav_lm_f_b;
							?>
						</td>
						<td>
							<?php 
							//current month male (Receive)
							$vol_sav_cm_m_rec=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (23)")->row();
							
							$vol_sav_cm_m_rec_b=$vol_sav_cm_m_rec->cr;
							echo $vol_sav_cm_m_rec_b;
							?>
						</td>
						<td>
							<?php 
							//current month female (Receive)
							$vol_sav_cm_f_rec=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (24)")->row();
							
							$vol_sav_cm_f_rec_b=$vol_sav_cm_f_rec->cr;
							echo $vol_sav_cm_f_rec_b;
							?>
						</td>
						<td>
							<?php 
							//current month male (Return)
							$vol_sav_cm_m_ret=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (23)")->row();
							
							$vol_sav_cm_m_ret_b=$vol_sav_cm_m_ret->dr;
							echo $vol_sav_cm_m_ret_b;
							?>
						</td>
						<td>
							<?php 
							//current month female (Return)
							$vol_sav_cm_f_ret=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (24)")->row();
							
							$vol_sav_cm_f_ret_b=$vol_sav_cm_f_ret->dr;
							echo $vol_sav_cm_f_ret_b;
							?>
						</td>
						<td><?= $t_vol_sav_em_m_b=(($vol_sav_lm_m_b+$vol_sav_cm_m_rec_b)-$vol_sav_cm_m_ret_b) ?></td>
						<td><?= $t_vol_sav_em_f_b=(($vol_sav_lm_f_b+$vol_sav_cm_f_rec_b)-$vol_sav_cm_f_ret_b) ?></td>
					</tr>			
					<tr>
						<td>Total</td>
						<td><?= $t_res_sav_lm_m_b=$res_sav_lm_m_b+$vol_sav_lm_m_b ?></td>
						<td><?= $t_res_sav_lm_f_b=$res_sav_lm_f_b+$vol_sav_lm_f_b ?></td>
						<td><?= $t_res_sav_cm_m_rec_b=$res_sav_cm_m_rec_b+$vol_sav_cm_m_rec_b ?></td>
						<td><?= $t_res_sav_cm_f_rec_b=$res_sav_cm_f_rec_b+$vol_sav_cm_f_rec_b ?></td>
						<td><?= $t_res_sav_cm_m_ret_b=$res_sav_cm_m_ret_b+$vol_sav_cm_m_ret_b ?></td>
						<td><?= $t_res_sav_cm_f_ret_b=$res_sav_cm_f_ret_b+$vol_sav_cm_f_ret_b ?></td>
						<td><?= $t_t_vol_sav_em_m_b=$t_res_sav_em_m_b+$t_vol_sav_em_m_b ?></td>
						<td><?= $t_t_vol_sav_em_f_b=$t_res_sav_em_f_b+$t_vol_sav_em_f_b ?></td>
					</tr>
					<tr>
						<td>Long Term Deposit</td>
						<td>
							<?php 
							//last month male
							$lts_lm_m=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (13)")->row();
							
							$lts_lm_m_b=($lts_lm_m->cr - $lts_lm_m->dr);
							echo $lts_lm_m_b;
							?>
						</td>
						<td>
							<?php
							//last month female
							$lts_lm_f=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE DATE(`rec_date`)<='$lm' and `fcoa_bkdn_sub_id` in (14)")->row();
							
							$lts_lm_f_b=($lts_lm_f->cr - $lts_lm_f->dr);
							echo $lts_lm_f_b;
							?>
						</td>
						<td>
							<?php 
							//current month male (Receive)
							$lts_cm_m_rec=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (13)")->row();
							
							$lts_cm_m_rec_b=$lts_cm_m_rec->cr;
							echo $lts_cm_m_rec_b;
							?>
						</td>
						<td>
							<?php 
							//current month female (Receive)
							$lts_cm_f_rec=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (14)")->row();
							
							$lts_cm_f_rec_b=$lts_cm_f_rec->cr;
							echo $lts_cm_f_rec_b;
							?>
						</td>
						<td>
							<?php 
							//current month male (Return)
							$lts_cm_m_ret=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (13)")->row();
							
							$lts_cm_m_ret_b=$lts_cm_m_ret->dr;
							echo $lts_cm_m_ret_b;
							?>
						</td>
						<td>
							<?php 
							//current month female (Return)
							$lts_cm_f_ret=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` where DATE(`rec_date`)>'$lm' and DATE(`rec_date`)<='$cm' and `fcoa_bkdn_sub_id` in (14)")->row();
							
							$lts_cm_f_ret_b=$lts_cm_f_ret->dr;
							echo $lts_cm_f_ret_b;
							?>
						</td>
						<td><?= $t_lts_em_m_b=(($lts_lm_m_b+$lts_cm_m_rec_b)-$lts_cm_m_ret_b) ?></td>
						<td><?= $t_lts_em_f_b=(($lts_lm_f_b+$lts_cm_f_rec_b)-$lts_cm_f_ret_b) ?></td>
					</tr>
					<tr>
						<td>Grand Total</td>
						<td><?= $t_res_sav_lm_m_b+$lts_lm_m_b ?></td>
						<td><?= $t_res_sav_lm_f_b+$lts_lm_f_b ?></td>
						<td><?= $t_res_sav_cm_m_rec_b+$lts_cm_m_rec_b ?></td>
						<td><?= $t_res_sav_cm_f_rec_b+$lts_cm_f_rec_b ?></td>
						<td><?= $t_res_sav_cm_m_ret_b+$lts_cm_m_ret_b ?></td>
						<td><?= $t_res_sav_cm_f_ret_b+$lts_cm_f_ret_b ?></td>
						<td><?= $t_t_vol_sav_em_m_b+$t_lts_em_m_b ?></td>
						<td><?= $t_t_vol_sav_em_f_b+$t_lts_em_f_b ?></td>
					</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>Manager Signature</td>
					<td colspan="4"></td>
					<td>Date & Time:</td>
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