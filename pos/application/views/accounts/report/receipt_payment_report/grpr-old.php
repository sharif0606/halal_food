
<?php 
$y=$year;
$m=$month;
	if($m>6) {
		$qy=" date(`rec_date`) <= '".$y."-".$m."-31"."' ";
		$qm=" date(`rec_date`) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31"."' ";
		$qly=" date(`rec_date`) <= '".$y."-06-30"."' ";
	}else{
		$qy=" date(`rec_date`) <= '".$y."-".$m."-31' ";
		$qm=" date(`rec_date`) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31' ";
	    $qly=" date(`rec_date`) <= '".($y-1)."-06-30"."' ";
	}
	
	echo $qy;
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
						$cashym=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (1,2)")->row();
                        if($cashym)
                            if($month == 7 && $year == 2020)
						        $cashymb=($cashym->dr-$cashym->cr) + $cashym->oldb;
						    else
						        $cashymb=($cashym->dr-$cashym->cr);
						else
						    $cashymb=0;
						echo $cashymb;
						?>
					</td>
					<td>
						<?php 
						$cashy=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (1,2)")->row();
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
						$bankym=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (3)")->row();
						if($month == 7 && $year == 2020)
					        $bankymb=($bankym->dr-$bankym->cr) + $bankym->oldb;
					    else
					        $bankymb=($bankym->dr-$bankym->cr);
					        
						echo $bankymb;
						?>
					</td>
					<td>
						<?php 
						$banky=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (3)")->row();
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
					<td><strong>SubTotal</strong></td>
					<td><?= $fsavingmyb+$msavingmyb+$ltsmyb ?></td>
					<td><?= $fsavingyb+$msavingyb+$ltsyb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $fsavingpmyb+$msavingpmyb+$ltsmydrb ?></td>
					<td><?= $fsavingpyb+$msavingpyb+$lstydrb ?></td>
				</tr>
				<tr>
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
						$riskydr=$this->db->query("SELECT sum(`dr`) as dr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (6)) as oldb FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (6)")->row();
						$riskydrb=$riskydr->dr + $riskydr->oldb ;
						echo $riskydrb;
						?>
					</td>
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
				</tr>
				<tr>
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
					<td>Employee Deposit</td>
					<td>
						<?php 
						$empdepomycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (30)")->row();
						$empdepomycrb=$empdepomycr->cr;
						echo $empdepomycrb;
						?>
					</td>
					<td>
						<?php 
						$empdepoycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (30)")->row();
						$empdepoycrb=$empdepoycr->cr;
						echo $empdepoycrb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $riskmydrb+$empdepomydrb ?></td>
					<td><?= $riskydrb+$empdepoydrb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $riskmycrb+$empdepomycrb ?></td>
					<td><?= $riskycrb+$empdepoycrb ?></td>
				</tr>
				<tr>
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
				</tr>
				<tr>
					<td>Motor Cycle Advance</td>
					<td>
						<?php 
						$motorcycleadvmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (18)")->row();
						$motorcycleadvmydrb=$motorcycleadvmydr->dr;
						echo $motorcycleadvmydrb;
						?>
					</td>
					<td>
						<?php 
						$motorcycleadvydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (18)")->row();
						$motorcycleadvydrb=$motorcycleadvydr->dr;
						echo $motorcycleadvydrb;
						?>
					</td>
					<td>Motor Cycle Advance</td>
					<td>
						<?php 
						$motorcycleadvmycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (18)")->row();
						$motorcycleadvmycrb=$motorcycleadvmycr->cr;
						echo $motorcycleadvmycrb;
						?>
					</td>
					<td>
						<?php 
						$motorcycleadvycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (18)")->row();
						$motorcycleadvycrb=$motorcycleadvycr->cr;
						echo $motorcycleadvycrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Bye Cycle Advance</td>
					<td>
						<?php 
						$bycycleadvmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (19)")->row();
						$bycycleadvmydrb=$bycycleadvmydr->dr;
						echo $bycycleadvmydrb;
						?>
					</td>
					<td>
						<?php 
						$bycycleadvydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (19)")->row();
						$bycycleadvydrb=$bycycleadvydr->dr;
						echo $bycycleadvydrb;
						?>
					</td>
					<td>Bye Cycle Advance</td>
					<td>
						<?php 
						$bycycleadvmycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (19)")->row();
						$bycycleadvmycrb=$bycycleadvmycr->cr;
						echo $bycycleadvmycrb;
						?>
					</td>
					<td>
						<?php 
						$bycycleadvycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (19)")->row();
						$bycycleadvycrb=$bycycleadvycr->cr;
						echo $bycycleadvycrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Provident Fund</td>
					<td>
						<?php 
						$pfmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (25)")->row();
						$pfmydrb=$pfmydr->dr;
						echo $pfmydrb;
						?>
					</td>
					<td>
						<?php 
						$pfydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (25)")->row();
						$pfydrb=$pfydr->dr;
						echo $pfydrb;
						?>
					</td>
					<td>Provident Fund</td>
					<td>
						<?php 
						$pfmycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (25)")->row();
						$pfmycrb=$pfmycr->cr;
						echo $pfmycrb;
						?>
					</td>
					<td>
						<?php 
						$pfycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (25)")->row();
						$pfycrb=$pfycr->cr;
						echo $pfycrb;
						?>
					</td>
				</tr>
				<tr>
					<td>Medical Fund</td>
					<td>
						<?php 
						$mfmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (24)")->row();
						$mfmydrb=$mfmydr->dr;
						echo $mfmydrb;
						?>
					</td>
					<td>
						<?php 
						$mfydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (24)")->row();
						$mfydrb=$mfydr->dr;
						echo $mfydrb;
						?>
					</td>
					<td>Medical Fund</td>
					<td>
						<?php 
						$mfmycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_id` in (24)")->row();
						$mfmycrb=$mfmycr->cr;
						echo $mfmycrb;
						?>
					</td>
					<td>
						<?php 
						$mfycr=$this->db->query("SELECT sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (24)")->row();
						$mfycrb=$mfycr->cr;
						echo $mfycrb;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>SubTotal</strong></td>
					<td><?= $shorttermadvmydrb+$motorcycleadvmydrb+$bycycleadvmydrb+$pfmydrb+$mfmydrb ?></td>
					<td><?= $shorttermadvydrb+$motorcycleadvydrb+$bycycleadvydrb+$pfydrb+$mfydrb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $shorttermadvmycrb+$motorcycleadvmycrb+$bycycleadvmycrb+$pfmycrb+$mfmycrb ?></td>
					<td><?= $shorttermadvycrb+$motorcycleadvycrb+$bycycleadvycrb+$pfycrb+$mfycrb ?></td>
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
						$managsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (7)")->row();
						$managsalmydrb=$managsalmydr->dr;
						echo $managsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$managsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (7)")->row();
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
						$assistmanagsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (8)")->row();
						$assistmanagsalmydrb=$assistmanagsalmydr->dr;
						echo $assistmanagsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$assistmanagsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (8)")->row();
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
						$areamanagsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (9)")->row();
						$areamanagsalmydrb=$areamanagsalmydr->dr;
						echo $areamanagsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$areamanagsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (9)")->row();
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
						$branchaccsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (10)")->row();
						$branchaccsalmydrb=$branchaccsalmydr->dr;
						echo $branchaccsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$branchaccsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (10)")->row();
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
						$fieldoffsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (11)")->row();
						$fieldoffsalmydrb=$fieldoffsalmydr->dr;
						echo $fieldoffsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$fieldoffsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (11)")->row();
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
						$officepeonsalmydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (12)")->row();
						$officepeonsalmydrb=$officepeonsalmydr->dr;
						echo $officepeonsalmydrb;
						?>
					</td>
					<td>
						<?php 
						$officepeonsalydr=$this->db->query("SELECT sum(`dr`) as dr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (12)")->row();
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
					<td></td>
					<td></td>
					<td></td>
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
					<td><strong>SubTotal</strong></td>
					<td><?= $fmlscmyb+$mlscmyb+$irfbmyb+$passbooksellmyb+$admitfeemyb+$loanformfeemyb ?></td>
					<td><?= $fmlscyb+$mlscyb+$irfbyb+$passbooksellyb+$admitfeeyb+$loanformfeeyb ?></td>
					<td><strong>SubTotal</strong></td>
					<td><?= $managsalmydrb+$assistmanagsalmydrb+$areamanagsalmydrb+$branchaccsalmydrb+$fieldoffsalmydrb+$officepeonsalmydrb+$officerentmydrb+$mobilebillmyb+$transbillmyb+$electricitybillmyb+$stationerybillmyb+$photocopybillmyb ?></td>
					<td><?= $managsalydrb+$assistmanagsalydrb+$areamanagsalydrb+$branchaccsalydrb+$fieldoffsalydrb+$officepeonsalydrb+$officerentydrb+$mobilebillyb+$transbillyb+$electricitybillyb+$stationerybillyb+$photocopybillyb ?></td>
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
					<td> </td>
					<td> </td>
					<td><strong>Sub Total</strong></td>
					<td><?= ($my1210b+$my1220b+$my1230b+$my1240b+$my1250b+$my1260b+$my1261b);?></td>
					
					<td><?= ($y1210b+$y1220b+$y1230b+$y1240b+$y1250b+$y1260b+$y1261b); ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>Cash</td>
					<td>
						<?php 
						$ym1110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (1,2)")->row();
                        if($ym1110)
                            if($month == 7 && $year == 2020)
						        $ym1110b=($ym1110->dr-$ym1110->cr) + $ym1110->oldb;
						    else
						        $ym1110b=($ym1110->dr-$ym1110->cr);
						else
						    $ym1110b=0;
						echo $ym1110b;
						?>
					</td>
					<td>
						<?php 
						$y1110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (1,2)")->row();
						$y1110b=($y1110->dr-$y1110->cr) + $y1110->oldb;
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
						$ym1120=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb FROM `tbl_general_ledger` WHERE $qm and `fcoa_bkdn_sub_id` in (3)")->row();
						if($month == 7 && $year == 2020)
					        $ym1120b=($ym1120->dr-$ym1120->cr) + $ym1120->oldb;
					    else
					        $ym1120b=($ym1120->dr-$ym1120->cr);
					        
						echo $ym1120b;
						?>
					</td>
					<td>
						<?php 
						$y1120=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (3)")->row();
						$y1120b=($y1120->dr-$y1120->cr) + $y1120->oldb;
						echo $y1120b;
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Total</strong></td>
					<td>
						<?php $totalrmy= $cashymb+$bankymb+$fselpmyb+$mselpmyb+$fsavingmyb+$msavingmyb+$ltsmyb+$riskmydrb+$empdepomydrb+$shorttermadvmydrb+$motorcycleadvmydrb+$bycycleadvmydrb+$pfmydrb+$mfmydrb+$fmlscmyb+$mlscmyb+$irfbmyb+$passbooksellmyb+$admitfeemyb+$loanformfeemyb;
						echo $totalrmy;
						?>
					</td>
					
					<td>
						<?php $totalry= $cashyb+$bankyb+$fselpyb+$mselpyb+$fsavingyb+$msavingyb+$ltsyb+$riskydrb+$empdepoydrb+$shorttermadvydrb+$motorcycleadvydrb+$bycycleadvydrb+$pfydrb+$mfydrb+$fmlscyb+$mlscyb+$irfbyb+$passbooksellyb+$admitfeeyb+$loanformfeeyb;
						echo $totalry;
						?>
					</td>
					
					<td><strong>Total</strong></td>
					<td>
						<?php $totalpmy= $fselmyb+$mselmyb+$fsavingpmyb+$msavingpmyb+$ltsmydrb+$riskmycrb+$empdepomycrb+$shorttermadvmycrb+$motorcycleadvmycrb+$bycycleadvmycrb+$pfmycrb+$mfmycrb+$managsalmydrb+$assistmanagsalmydrb+$areamanagsalmydrb+$branchaccsalmydrb+$fieldoffsalmydrb+$officepeonsalmydrb+$officerentmydrb+$mobilebillmyb+$transbillmyb+$electricitybillmyb+$stationerybillmyb+$photocopybillmyb+$my1210b+$my1220b+$my1230b+$my1240b+$my1250b+$my1260b+$my1261b+$ym1110b+$ym1120b;
						echo $totalpmy;
						?>
					</td>
					
					<td>
						<?php $totalpy= $fselyb+$mselyb+$fsavingpyb+$msavingpyb+$lstydrb+$riskycrb+$empdepoycrb+$shorttermadvycrb+$motorcycleadvycrb+$bycycleadvycrb+$pfycrb+$mfycrb+$managsalydrb+$assistmanagsalydrb+$areamanagsalydrb+$branchaccsalydrb+$fieldoffsalydrb+$officepeonsalydrb+$officerentydrb+$mobilebillyb+$transbillyb+$electricitybillyb+$stationerybillyb+$photocopybillyb+$y1210b+$y1220b+$y1230b+$y1240b+$y1250b+$y1260b+$y1261b+$y1110b+$y1120b;
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