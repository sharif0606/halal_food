<?php 
$y=$year;
$m=str_pad($month,2,"0",STR_PAD_LEFT);
	if($m>6) {
		//$qy=" date(`rec_date`) BETWEEN '".$y."-07-01' and '".($y+1)."-06-30"."' ";
		$qy=" date(`rec_date`) BETWEEN '".$y."-07-01' and '".$y."-".$m."-31"."' ";
		$qm=" date(`rec_date`) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31"."' ";
		$qly=" date(`rec_date`) <= '".$y."-06-30"."' ";
		$qlm=" date(`rec_date`) < '".$y."-".$m."-01' ";
		$qlml=" date(`rec_date`) <= '".$y."-".$m."-31' ";
	}else{
		$qy=" date(`rec_date`) BETWEEN '".($y-1)."-07-01' and '".$y."-".$m."-31"."' ";
		$qm=" date(`rec_date`) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31' ";
	    $qly=" date(`rec_date`) <= '".($y-1)."-06-30"."' ";
	    $qlm=" date(`rec_date`) < '".$y."-".$m."-01' ";
		$qlml=" date(`rec_date`) <= '".$y."-".$m."-31' ";
	}
	/*echo $qy;
	echo '<br>';
	echo $qm;
	echo '<br>';
	echo $qlm;
	echo '<br>';
	echo $qlml;*/

?>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		Payment & Receipt Account
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
	<div id="display">
		<h4 class="vHide">Probati Somobay Somity Ltd</h4>
		<p class="vHide">Probati Laborer Co-Operative Organization</p>
		<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
		<p class="text-center vHide">Payment & Receipt Account</p>
		<table id="" class="table table-striped table-bordered table-hover" width="100%">
			<thead>
				<tr>
					<th>Receipt</th>
					<th>Running Month</th>
					<th>Running Year</th>
					<th>Payment</th>
					<th>Running Month</th>
					<th>Running Year</th>
				</tr>
			</thead>				
			<tbody>
				<tr>
					<td>Cash</td>
					<td>
						<?php 
						$cashym=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb
						                            FROM `tbl_general_ledger` WHERE $qlm and `fcoa_bkdn_sub_id` in (1,2)")->row();
                        if($cashym)
						    $cashymb=($cashym->dr-$cashym->cr) + $cashym->oldb;
						else
						    $cashymb=0;
						echo $cashymb;
						//echo "SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (1,2)";
						?>
					</td>
					<td>
						<?php 
						$cashy=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb
						                            FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (1,2)")->row();
						$cashyb=($cashy->dr-$cashy->cr) + $cashym->oldb;
						echo $cashyb;
						?>
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Bank</td>
					<td>
						<?php 
						$bankym=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb 
						                            FROM `tbl_general_ledger` WHERE $qlm and `fcoa_bkdn_sub_id` in (3)")->row();
						$bankymb=($bankym->dr-$bankym->cr) + $bankym->oldb;
						echo $bankymb;
						//echo "SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb 
						                           // FROM `tbl_general_ledger` WHERE $qlm and `fcoa_bkdn_sub_id` in (3)";
						?>
					</td>
					<td>
						<?php 
						$banky=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb 
						                            FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (3)")->row();
						$bankyb=($banky->dr-$banky->cr) + $banky->oldb;
						echo $bankyb;
						?>
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $cashymb+$bankymb ?></td>
					<td><?= $cashyb+$bankyb ?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><strong>Loan Account(Principal)</strong></td>
					<td></td>
					<td></td>
					<td><strong>Loan Distribution(Principal)</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Loan (Female)</td>
					<td><?php 
							$fselpmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (21)")->row();
							$fselpmyb=$fselpmy->cr;
							echo $fselpmyb;
						?>
					</td>
					<td>
						<?php 
							$fselpy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (21)")->row();
							$fselpyb=$fselpy->cr;
							echo $fselpyb;
						?>
					</td>
					<td>Loan (Female)</td>
					<td>
						<?php 
							$fselmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (21)")->row();
							$fselmyb=$fselmy->dr;
							echo $fselmyb;
						?>
					</td>
					<td>
						<?php 
							$fselmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (21)")->row();
							$fselyb=$fselmy->dr;
							echo $fselyb;
						?>
					</td>
				</tr>
				<tr>
					<td>Loan (male)</td>
					<td>
						<?php 
							$mselpmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (22)")->row();
							$mselpmyb=$mselpmy->cr;
							echo $mselpmyb;
						?>
					</td>
					<td>
						<?php 
							$mselpy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (22)")->row();
							$mselpyb=$mselpy->cr;
							echo $mselpyb;
						?>
					</td>
					<td>Loan (male)</td>
					<td>
						<?php 
						$mselmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (22)")->row();
						$mselmyb=$mselmy->dr;
						echo $mselmyb;
						?>
					</td>
					<td><?php 
						$msely=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (22)")->row();
						$mselyb=$msely->dr;
						echo $mselyb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $fselpmyb+$mselpmyb ?></td>
					<td><?= $fselpyb+$mselpyb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $fselmyb+$mselmyb ?></td>
					<td><?= $fselyb+$mselyb ?></td>
				</tr>
				<tr>
					<td><strong>Savings Account</strong></td>
					<td></td>
					<td></td>
					<td><strong>Savings Account</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Female Saivings</td>
					<td>
						<?php 
						$fsavingmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (16,24)")->row();
						$fsavingmyb=$fsavingmy->cr;
						echo $fsavingmyb;
						?>
					</td>
					<td>
						<?php 
						$fsavingy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (16,24)")->row();
						$fsavingyb=$fsavingy->cr;
						echo $fsavingyb;
						?>
					</td>
					<td>Female Savings</td>
					<td>
						<?php 
						$fsavingpmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (16,24)")->row();
						$fsavingpmyb=$fsavingpmy->dr;
						echo $fsavingpmyb;
						?>
					</td>
					<td>
						<?php 
						$fsavingpy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (16,24)")->row();
						$fsavingpyb=$fsavingpy->dr;
						echo $fsavingpyb;
						?>
					</td>
				</tr>
				<tr>
					<td>Male Savings</td>
					<td>
						<?php 
						$msavingmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (15,23)")->row();
						$msavingmyb=$msavingmy->cr;
						echo $msavingmyb;
						?>
					</td>
					<td>
						<?php 
						$msavingy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (15,23)")->row();
						$msavingyb=$msavingy->cr;
						echo $msavingyb;
						?>
					</td>
					<td>Male Savings</td>
					<td>
						<?php 
						$msavingpmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (15,23)")->row();
						$msavingpmyb=$msavingpmy->dr;
						echo $msavingpmyb;
						?>
					</td>
					<td>
						<?php 
						$msavingpy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (15,23)")->row();
						$msavingpyb=$msavingpy->dr;
						echo $msavingpyb;
						?>
					</td>
				</tr>
				<tr>
					<td>L.T.S Receive</td>
					<td>
						<?php 
						$ltsmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (13,14)")->row();
						$ltsmyb=$ltsmy->cr;
						echo $ltsmyb;
						?>
					</td>
					<td>
						<?php 
						$ltsy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (13,14)")->row();
						$ltsyb=$ltsy->cr;
						echo $ltsyb;
						?>
					</td>
					<td>L.T.S Return</td>
					<td>
						<?php 
						$ltsmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (13,14)")->row();
						$ltsmydrb=$ltsmydr->dr;
						echo $ltsmydrb;
						?>
					</td>
					<td>
						<?php 
						$lstydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (13,14)")->row();
						$lstydrb=$lstydr->dr;
						echo $lstydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Share Capital</td>
					<td>
						<?php 
						$my2220cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (27)")->row();
						$my2220crb=$my2220cr->cr;
						echo $my2220crb;
						?>
					</td>
					<td>
						<?php 
						$y2220cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (27)")->row();
						$y2220crb=$y2220cr->cr;
						echo $y2220crb;
						?>
					</td>
					<td>Share Capital</td>
					<td>
						<?php 
						$my2220dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (27)")->row();
						$my2220drb=$my2220dr->dr;
						echo $my2220drb;
						?>
					</td>
					<td>
						<?php 
						$y2220dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (27)")->row();
						$y2220drb=$y2220dr->dr;
						echo $y2220drb;
						?>
					</td>
				</tr>
				<tr>
					<td>FDR Capital</td>
					<td>
						<?php 
						$my2260cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (31)")->row();
						$my2260crb=$my2260cr->cr;
						echo $my2260crb;
						?>
					</td>
					<td>
						<?php 
						$y2260cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (31)")->row();
						$y2260crb=$y2260cr->cr;
						echo $y2260crb;
						?>
					</td>
					<td>FDR Capital</td>
					<td>
						<?php 
						$my2260dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (31)")->row();
						$my2260drb=$my2260dr->dr;
						echo $my2260drb;
						?>
					</td>
					<td>
						<?php 
						$y2260dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (31)")->row();
						$y2260drb=$y2260dr->dr;
						echo $y2260drb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $fsavingmyb+$msavingmyb+$ltsmyb+$my2260crb+$my2220crb ?></td>
					<td><?= $fsavingyb+$msavingyb+$ltsyb+$y2260crb+$y2220crb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $fsavingpmyb+$msavingpmyb+$ltsmydrb+$my2220drb+$my2260drb ?></td>
					<td><?= $fsavingpyb+$msavingpyb+$lstydrb+$y2220drb+$y2260drb ?></td>
				</tr>
				<tr>
					<td>Risk Fund</td>
					<td>
						<?php 
						$riskmycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (6)")->row();
						$riskmycrb=$riskmycr->cr;
						echo $riskmycrb;
						?>
					</td>
					<td>
						<?php 
						$riskycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (6)")->row();
						$riskycrb=$riskycr->cr;
						echo $riskycrb;
						?>
					</td>
					<td>Risk Fund</td>
					<td>
						<?php 
						$riskmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (6)")->row();
						$riskmydrb=$riskmydr->dr;
						echo $riskmydrb;
						?>
					</td>
					<td>
						<?php 
						$riskydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (6)")->row();
						$riskydrb=$riskydr->dr;
						echo $riskydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Employee Deposit</td>
					<td>
						<?php 
						$empdepomycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (30)")->row();
						$empdepomycrb=$empdepomycr->cr;
						echo $empdepomycrb;
						?>
					</td>
					<td>
						<?php 
						$empdepoycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (30)")->row();
						$empdepoycrb=$empdepoycr->cr;
						echo $empdepoycrb;
						?>
					</td>
					<td>Employee Deposit</td>
					<td>
						<?php 
						$empdepomydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (30)")->row();
						$empdepomydrb=$empdepomydr->dr;
						echo $empdepomydrb;
						?>
					</td>
					<td>
						<?php 
						$empdepoydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (30)")->row();
						$empdepoydrb=$empdepoydr->dr;
						echo $empdepoydrb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $riskmycrb+$empdepomycrb ?></td>
					<td><?= $riskycrb+$empdepoycrb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $riskmydrb+$empdepomydrb ?></td>
					<td><?= $riskydrb+$empdepoydrb ?></td>
				</tr>
				<tr>
					<td>Short term advance</td>
					<td>
						<?php 
						$shorttermadvmycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (20)")->row();
						$shorttermadvmycrb=$shorttermadvmycr->cr;
						echo $shorttermadvmycrb;
						?>
					</td>
					<td>
						<?php 
						$shorttermadvycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (20)")->row();
						$shorttermadvycrb=$shorttermadvycr->cr;
						echo $shorttermadvycrb;
						?>
					</td>
					<td>Short term advance</td>
					<td>
						<?php 
						$shorttermadvmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (20)")->row();
						$shorttermadvmydrb=$shorttermadvmydr->dr;
						echo $shorttermadvmydrb;
						?>
					</td>
					<td>
						<?php 
						$shorttermadvydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (20)")->row();
						$shorttermadvydrb=$shorttermadvydr->dr;
						echo $shorttermadvydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Advance Office Rent</td>
					<td>
						<?php 
						$mycr11301=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (17)")->row();
						$mycr11301b=$mycr11301->cr;
						echo $mycr11301b;
						?>
					</td>
					<td>
						<?php 
						$ycr11301=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (17)")->row();
						$ycr11301b=$ycr11301->cr;
						echo $ycr11301b;
						?>
					</td>
					<td>Advance Office Rent</td>
					<td>
						<?php 
						$mydr11301=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (17)")->row();
						$mydr11301b=$mydr11301->dr;
						echo $mydr11301b;
						?>
					</td>
					<td>
						<?php 
						$ydr11301=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (17)")->row();
						$ydr11301b=$ydr11301->dr;
						echo $ydr11301b;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $shorttermadvmycrb+$mycr11301b ?></td>
					<td><?= $shorttermadvycrb+$ycr11301b ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $shorttermadvmydrb+$mydr11301b ?></td>
					<td><?= $shorttermadvydrb+$ydr11301b ?></td>
				</tr>
				
				<tr>
					<td>Provident Fund</td>
					<td>
						<?php 
						/*$my2115cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (25)")->row();
						$my2115crb=$my2115cr->cr;
						echo $my2115crb;*/
						?>
					</td>
					<td>
						<?php 
						/*$y2115cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (25)")->row();
						$y2115crb=$y2115cr->cr;
						echo $y2115crb;*/
						?>
					</td>
					<td>Provident Fund</td>
					<td>
						<?php 
						$my2115dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (25)")->row();
						$my2115drb=$my2115dr->dr;
						echo $my2115drb;
						?>
					</td>
					<td>
						<?php 
						$y2115dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (25)")->row();
						$y2115drb=$y2115dr->dr;
						echo $y2115drb;
						?>
					</td>
				</tr>
				
				<tr>
					<td>Medical Fund</td>
					<td>
						<?php 
						/*$my2114cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (24)")->row();
						$my2114crb=$my2114cr->cr;
						echo $my2114crb;*/
						?>
					</td>
					<td>
						<?php 
						/*$y2114cr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (24)")->row();
						$y2114crb=$y2114cr->cr;
						echo $y2114crb;*/
						?>
					</td>
					<td>Medical Fund</td>
					<td>
						<?php 
						$my2114dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (24)")->row();
						$my2114drb=$my2114dr->dr;
						echo $my2114drb;
						?>
					</td>
					<td>
						<?php 
						$y2114dr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (24)")->row();
						$y2114drb=$y2114dr->dr;
						echo $y2114drb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?php //$my2114crb+$my2115crb ?></td>
					<td><?php //$y2114crb+$y2115crb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $my2114drb+$my2115drb ?></td>
					<td><?= $y2114drb+$y2115drb ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Salary Account</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Manager</td>
					<td>
						<?php 
						$managsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (25)")->row();
						$managsalmydrb=$managsalmydr->dr;
						echo $managsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$managsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (25)")->row();
						$managsalydrb=$managsalydr->dr;
						echo $managsalydrb;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Assistant Manager</td>
					<td>
						<?php 
						$assistmanagsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (26)")->row();
						$assistmanagsalmydrb=$assistmanagsalmydr->dr;
						echo $assistmanagsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$assistmanagsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (26)")->row();
						$assistmanagsalydrb=$assistmanagsalydr->dr;
						echo $assistmanagsalydrb;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Area Manager</td>
					<td>
						<?php 
						$areamanagsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (27)")->row();
						$areamanagsalmydrb=$areamanagsalmydr->dr;
						echo $areamanagsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$areamanagsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (27)")->row();
						$areamanagsalydrb=$areamanagsalydr->dr;
						echo $areamanagsalydrb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Service Chare Receive</strong></td>
					<td></td>
					<td></td>
					<td>Branch Accountant</td>
					<td>
						<?php 
						$branchaccsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (28)")->row();
						$branchaccsalmydrb=$branchaccsalmydr->dr;
						echo $branchaccsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$branchaccsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (28)")->row();
						$branchaccsalydrb=$branchaccsalydr->dr;
						echo $branchaccsalydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Loan Female</td>
					<td>
						<?php 
							$fmlscmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (4)")->row();
							$fmlscmyb=$fmlscmy->cr;
							echo $fmlscmyb;
						?>
					</td>
					<td>
						<?php 
							$fmlscy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (4)")->row();
							$fmlscyb=$fmlscy->cr;
							echo $fmlscyb;
						?>
					</td>
					<td>Field Officer</td>
					<td>
						<?php 
						$fieldoffsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (29)")->row();
						$fieldoffsalmydrb=$fieldoffsalmydr->dr;
						echo $fieldoffsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$fieldoffsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (29)")->row();
						$fieldoffsalydrb=$fieldoffsalydr->dr;
						echo $fieldoffsalydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Loan Male</td>
					<td>
						<?php 
							$mlscmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (5)")->row();
							$mlscmyb=$mlscmy->cr;
							echo $mlscmyb;
						?>
					</td>
					<td>
						<?php 
							$mlscy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (5)")->row();
							$mlscyb=$mlscy->cr;
							echo $mlscyb;
						?>
					</td>
					<td>Office Peon</td>
					<td>
						<?php 
						$officepeonsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (30)")->row();
						$officepeonsalmydrb=$officepeonsalmydr->dr;
						echo $officepeonsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$officepeonsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (30)")->row();
						$officepeonsalydrb=$officepeonsalydr->dr;
						echo $officepeonsalydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Interest Receive (From Bank)</td>
					<td>
						<?php 
							$irfbmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (35)")->row();
							$irfbmyb=$irfbmy->cr;
							echo $irfbmyb;
						?>
					</td>
					<td>
						<?php 
							$irfby=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (35)")->row();
							$irfbyb=$irfby->cr;
							echo $irfbyb;
						?>
					</td>
					<td>Office Rent</td>
					<td>
						<?php 
						$officerentmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (57)")->row();
						$officerentmydrb=$officerentmydr->dr;
						echo $officerentmydrb;
						?>
					</td>
					<td>
						<?php 
						$officerentydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (57)")->row();
						$officerentydrb=$officerentydr->dr;
						echo $officerentydrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Pass Book Sale</td>
					<td>
						<?php 
							$passbooksellmy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (37)")->row();
							$passbooksellmyb=$passbooksellmy->cr;
							echo $passbooksellmyb;
						?>
					</td>
					<td>
						<?php 
							$passbookselly=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (37)")->row();
							$passbooksellyb=$passbookselly->cr;
							echo $passbooksellyb;
						?>
					</td>
					<td>Mobile Allowance</td>
					<td>
						<?php 
							$mobilebillmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (44)")->row();
							$mobilebillmyb=$mobilebillmy->dr;
							echo $mobilebillmyb;
						?>
					</td>
					<td>
						<?php 
							$mobilebilly=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (44)")->row();
							$mobilebillyb=$mobilebilly->dr;
							echo $mobilebillyb;
						?>
					</td>
				</tr>
				<tr>
					<td>Admission Fee</td>
					<td>
						<?php 
							$admitfeemy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (38)")->row();
							$admitfeemyb=$admitfeemy->cr;
							echo $admitfeemyb;
						?>
					</td>
					<td>
						<?php 
							$admitfeey=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (38)")->row();
							$admitfeeyb=$admitfeey->cr;
							echo $admitfeeyb;
						?>
					</td>
					<td>Transportation allowance</td>
					<td>
						<?php 
							$transbillmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (41)")->row();
							$transbillmyb=$transbillmy->dr;
							echo $transbillmyb;
						?>
					</td>
					<td>
						<?php 
							$transbilly=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (41)")->row();
							$transbillyb=$transbilly->dr;
							echo $transbillyb;
						?>
					</td>
				</tr>
				<tr>
					<td>Loan Form Fee</td>
					<td>
						<?php 
							$loanformfeemy=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (39)")->row();
							$loanformfeemyb=$loanformfeemy->cr;
							echo $loanformfeemyb;
						?>
					</td>
					<td>
						<?php 
							$loanformfeey=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (39)")->row();
							$loanformfeeyb=$loanformfeey->cr;
							echo $loanformfeeyb;
						?>
					</td>
					<td>Electricity Bill</td>
					<td>
						<?php 
							$electricitybillmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (55)")->row();
							$electricitybillmyb=$electricitybillmy->dr;
							echo $electricitybillmyb;
						?>
					</td>
					<td>
						<?php 
							$electricitybilly=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (55)")->row();
							$electricitybillyb=$electricitybilly->dr;
							echo $electricitybillyb;
						?>
					</td>
				</tr>
				<tr>
					<td>Other Income</td>
					<td>
						<?php 
							$my4307=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (40)")->row();
							$my4307b=$my4307->cr;
							echo $my4307b;
						?>
					</td>
					<td>
						<?php 
							$y4307=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (40)")->row();
							$y4307b=$y4307->cr;
							echo $y4307b;
						?>
					</td>
					<td>Stationery bill</td>
					<td>
						<?php 
							$stationerybillmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (42)")->row();
							$stationerybillmyb=$stationerybillmy->dr;
							echo $stationerybillmyb;
						?>
					</td>
					<td>
						<?php 
							$stationerybilly=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (42)")->row();
							$stationerybillyb=$stationerybilly->dr;
							echo $stationerybillyb;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Photocopy Bill</td>
					<td>
						<?php 
							$photocopybillmy=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (50)")->row();
							$photocopybillmyb=$photocopybillmy->dr;
							echo $photocopybillmyb;
						?>
					</td>
					<td>
						<?php 
							$photocopybilly=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (50)")->row();
							$photocopybillyb=$photocopybilly->dr;
							echo $photocopybillyb;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Food Expense(Entertainment)</td>
					<td>
						<?php 
							$my5220=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (62)")->row();
							$my5220b=$my5220->dr;
							echo $my5220b;
						?>
					</td>
					<td>
						<?php 
							$y5220=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (62)")->row();
							$y5220b=$y5220->dr;
							echo $y5220b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Repair & Maintenance</td>
					<td>
						<?php 
							$my5205=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (45)")->row();
							$my5205b=$my5205->dr;
							echo $my5205b;
						?>
					</td>
					<td>
						<?php 
							$y5205=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (45)")->row();
							$y5205b=$y5205->dr;
							echo $y5205b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Share Capital Service Charge</td>
					<td>
						<?php 
							$my51002=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (61)")->row();
							$my51002b=$my51002->dr - $my51002->cr;
							echo $my51002b;
						?>
					</td>
					<td>
						<?php 
							$y51002=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (61)")->row();
							$y51002b=$y51002->dr - $y51002->cr;
							echo $y51002b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Fdr Service Charge</td>
					<td>
						<?php 
							$my51001=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (60)")->row();
							$my51001b=$my51001->dr - $my51001->cr;
							echo $my51001b;
						?>
					</td>
					<td>
						<?php 
							$y51001=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (60)")->row();
							$y51001b=$y51001->dr - $y51001->cr;
							echo $y51001b;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $fmlscmyb+$mlscmyb+$irfbmyb+$passbooksellmyb+$admitfeemyb+$loanformfeemyb+$my4307b ?></td>
					<td><?= $fmlscyb+$mlscyb+$irfbyb+$passbooksellyb+$admitfeeyb+$loanformfeeyb+$y4307b ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $my51001b+$my51002b+$managsalmydrb+$assistmanagsalmydrb+$areamanagsalmydrb+$branchaccsalmydrb+$fieldoffsalmydrb+$officepeonsalmydrb+$officerentmydrb+$mobilebillmyb+$transbillmyb+$electricitybillmyb+$stationerybillmyb+$photocopybillmyb+$my5220b+$my5205b ?></td>
					<td><?= $y51001b+$y51002b+$managsalydrb+$assistmanagsalydrb+$areamanagsalydrb+$branchaccsalydrb+$fieldoffsalydrb+$officepeonsalydrb+$officerentydrb+$mobilebillyb+$transbillyb+$electricitybillyb+$stationerybillyb+$photocopybillyb+$y5220b+$y5205b ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><strong>Capital expenditure</strong></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Computer</td>
					<td>
						<?php 
							$my1210=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (6)")->row();
							$my1210b=$my1210->dr - $my1210->cr;
							echo $my1210b;
						?>
					</td>
					<td>
						<?php 
							$y1210=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (6)")->row();
							$y1210b=$y1210->dr - $y1210->cr;
							echo $y1210b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Furniture</td>
					<td>
						<?php 
							$my1220=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (7)")->row();
							$my1220b=$my1220->dr - $my1220->cr;
							echo $my1220b;
						?>
					</td>
					<td>
						<?php 
							$y1220=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (7)")->row();
							$y1220b=$y1220->dr - $y1220->cr;
							echo $y1220b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Electric Parts</td>
					<td>
						<?php 
							$my1230=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (8)")->row();
							$my1230b=$my1230->dr - $my1230->cr;
							echo $my1230b;
						?>
					</td>
					<td>
						<?php 
							$y1230=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (8)")->row();
							$y1230b=$y1230->dr - $y1230->cr;
							echo $y1230b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Printer</td>
					<td>
						<?php 
							$my1240=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (9)")->row();
							$my1240b=$my1240->dr - $my1240->cr;
							echo $my1240b;
						?>
					</td>
					<td>
						<?php 
							$y1240=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (9)")->row();
							$y1240b=$y1240->dr - $y1240->cr;
							echo $y1240b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Motorcycle</td>
					<td>
						<?php 
							$my1250=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (10)")->row();
							$my1250b=$my1250->dr - $my1250->cr;
							echo $my1250b;
						?>
					</td>
					<td>
						<?php 
							$y1250=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (10)")->row();
							$y1250b=$y1250->dr - $y1250->cr;
							echo $y1250b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Bycycle</td>
					<td>
						<?php 
							$my1260=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (11)")->row();
							$my1260b=$my1260->dr - $my1260->cr;
							echo $my1260b;
						?>
					</td>
					<td>
						<?php 
							$y1260=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (11)")->row();
							$y1260b=$y1260->dr - $y1260->cr;
							echo $y1260b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Software</td>
					<td>
						<?php 
							$my1261=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (12)")->row();
							$my1261b=$my1261->dr - $my1261->cr;
							echo $my1261b;
						?>
					</td>
					<td>
						<?php 
							$y1261=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (12)")->row();
							$y1261b=$y1261->dr - $y1261->cr;
							echo $y1261b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Bank Charge</td>
					<td>
						<?php 
							$my5213=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (53)")->row();
							$my5213b=$my5213->dr - $my5213->cr;
							echo $my5213b;
						?>
					</td>
					<td>
						<?php 
							$y5213=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (53)")->row();
							$y5213b=$y5213->dr - $y5213->cr;
							echo $y5213b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td> </td>
					<td> </td>
					<td><strong>Sub Total</strong></td>
					<td><?= ($my1210b+$my1220b+$my1230b+$my1240b+$my1250b+$my1260b+$my1261b+$my5213b);?></td>
					
					<td><?= ($y1210b+$y1220b+$y1230b+$y1240b+$y1250b+$y1260b+$y1261b+$y5213b); ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Cash</td>
					<td>
						<?php 
						$ym1110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qlml and `fcoa_bkdn_sub_id` in (1,2)")->row();
                        if($ym1110)
						        $ym1110b=($ym1110->dr-$ym1110->cr) + $ym1110->oldb;
						else
						    $ym1110b=0;
						    
						echo $ym1110b;
						?>
					</td>
					<td>
						<?php 
						$y1110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qlml and `fcoa_bkdn_sub_id` in (1,2)")->row();
						if($y1110)
						    $y1110b=($y1110->dr-$y1110->cr) + $y1110->oldb;
						else
						    $y1110b=0;
						    
						echo $y1110b;
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Bank</td>
					<td>
						<?php 
						$ym1120=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb
						                            FROM `tbl_general_ledger` WHERE $qlml and `fcoa_bkdn_sub_id` in (3)")->row();
						
					    $ym1120b=($ym1120->dr-$ym1120->cr) + $ym1120->oldb;
						echo $ym1120b;
						//echo "SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb
						                           // FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (3)";
						?>
					</td>
					<td>
						<?php 
						$y1120=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb 
						                            FROM `tbl_general_ledger` WHERE $qlml and `fcoa_bkdn_sub_id` in (3)")->row();
						$y1120b=($y1120->dr-$y1120->cr) + $y1120->oldb;
						echo $y1120b;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Total</strong></td>
					<td>
						<?php $totalrmy= $cashymb+$bankymb+$fselpmyb+$mselpmyb+$fsavingmyb+$msavingmyb+$ltsmyb+$my2260crb+$riskmycrb+$empdepomycrb+$shorttermadvmycrb+$mycr11301b+
						                    $fmlscmyb+$mlscmyb+$irfbmyb+$passbooksellmyb+$admitfeemyb+$loanformfeemyb+$my4307b+$my2220crb;
						echo $totalrmy;
						?>
					</td>
					
					<td>
						<?php $totalry= $cashyb+$bankyb+$fselpyb+$mselpyb+$fsavingyb+$msavingyb+$ltsyb+$y2260crb+$riskycrb+$empdepoycrb+$shorttermadvycrb+$ycr11301b+$fmlscyb+$mlscyb+
						                $irfbyb+$passbooksellyb+$admitfeeyb+$loanformfeeyb+$y4307b+$y2220crb;
						echo $totalry;
						?>
					</td>
					
					<td><strong>Total</strong></td>
					<td>
						<?php $totalpmy= $fselmyb+$mselmyb+$fsavingpmyb+$msavingpmyb+$ltsmydrb+$riskmydrb+$empdepomydrb+$shorttermadvmydrb+$mydr11301b+
						                    $my51001b+$my51002b+$managsalmydrb+$assistmanagsalmydrb+$areamanagsalmydrb+$branchaccsalmydrb+$fieldoffsalmydrb+$officepeonsalmydrb+
						                    $officerentmydrb+$mobilebillmyb+$transbillmyb+$electricitybillmyb+$stationerybillmyb+$photocopybillmyb+$my1210b+
						                    $my1220b+$my1230b+$my1240b+$my1250b+$my1260b+$my1261b+$my5213b+$ym1110b+$ym1120b+$my2220drb+$my2260drb+$my5220b+$my5205b+$my2114drb+$my2115drb;
						echo $totalpmy;
						?>
					</td>
					
					<td>
						<?php $totalpy= $fselyb+$mselyb+$fsavingpyb+$msavingpyb+$lstydrb+$riskydrb+$empdepoydrb+$shorttermadvydrb+$ydr11301b+$y51001b+$y51002b+$managsalydrb+
						                $assistmanagsalydrb+$areamanagsalydrb+$branchaccsalydrb+$fieldoffsalydrb+$officepeonsalydrb+$officerentydrb+
						                $mobilebillyb+$transbillyb+$electricitybillyb+$stationerybillyb+$photocopybillyb+$y1210b+$y1220b+$y1230b+
						                $y1240b+$y1250b+$y1260b+$y1261b+$y5213b+$y1110b+$y1120b+$y2220drb+$y2260drb+$y5220b+$y5205b+$y2114drb+$y2115drb;
							echo $totalpy;
						?></td>
				</tr>
			</tbody>
			<tfoot>
			<tr>
				<td>Manager Signature</td>
				<td colspan="2"></td>
				<td>Date & Time</td>
				<td colspan="2"><?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
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