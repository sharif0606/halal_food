<?php 
$date = new DateTime( $year.'-'.$month.'-01');
$cm= $date->format( 'Y-m-t' );

$date->modify("last day of previous month");
$lm= $date->format("Y-m-d");


?>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		সদস্য ভর্তি, বাতিল, সঞ্চয়কারী ও উপস্থিথি সংক্ৰান্ত  তথ্য
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
		<div id="display">
					<h4 class="vHide">Probati Somobay Somity Ltd</h4>
					<p class="vHide">Probati Laborer Co-Operative Organization</p>
					<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
					<p class="text-center vHide">সঞ্চয় এবং ঋণ সংক্ৰান্ত  তথ্য</p>
			<table id="" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th rowspan="2">কর্মসূচির নাম</th>
						<th>বিগত মাস শেষে সদস্য</th>
						<th>নুতন ভর্তি</th>
						<th>বাতিলকৃত</th>
						<th>মাস শেষে সদস্য</th>
						<th>সঞ্চয়কারী সংখ্যা</th>
						<th>ফেরত সদস্য</th>
						<th>গড় উপস্থিতি</th>
					</tr>
				</thead>	
					<tr>
						<td>R.S Savings Women</td>
						<td>
				    		<?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_members  WHERE `application_Date` <= '$lm'  and gender=2 and status=1")->row();
							$tlmMemberfemale=$lmMember->tlmMemberfemale;
							echo $tlmMemberfemale;
							?>
						</td>
						<td>
						    <?php 
						    $date = new DateTime( $year.'-'.$month.'-01');
						    $cmf = $date->format("Y-m-d");
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_members  WHERE `application_Date`>='$cmf' and `application_Date` <= '$cm' and gender=2 and status=1")->row();
							$tcmMemberfemale=$lmMember->tlmMemberfemale;
							echo $tcmMemberfemale;
							?>
						</td>
						<td>
						    <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMembermale from tbl_members  WHERE member_closing_date>= '$cmf' and `member_closing_date` <= '$cm'  and gender=2 and status=0")->row();
							$tclMemberfemale=$lmMember->tlmMembermale;
							echo $tclMemberfemale;
							?>
						</td>
						<td><?= $tlmMemberfemale+$tcmMemberfemale - $tclMemberfemale?></td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(member_Id) as tlmMembermale from tbl_deposit_paid where  payment_Date>= '$cmf' and payment_Date<= '$cm'and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2) group by tbl_deposit_paid.member_Id")->row();
						    //echo $this->db->last_query();die();
						    	$tnsMemberfemale=$lmMember->tlmMembermale;
							    echo $tnsMemberfemale;
						    ?>
						</td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_savings_withdraw_details where  payment_Date  >= '$cmf' and payment_Date<= '$cm' and wStatus=1 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
						    	$trsMemberfemale=$lmMember->tlmMembermale;
							    echo $trsMemberfemale;
						    ?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>R.S Men</td>
						<td>
						    <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMembermale from tbl_members  WHERE `application_Date` <= '$lm'  and gender=1 and status=1")->row();
							$tlmMembermale=$lmMember->tlmMembermale;
							echo $tlmMembermale;
							?>
						</td>
						<td>
						    <?php 
						    $date = new DateTime( $year.'-'.$month.'-01');
						    $cmf = $date->format("Y-m-d");
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_members  WHERE `application_Date`>='$cmf' and `application_Date` <= '$cm' and gender=1 and status=1")->row();
							$tcmMembermale=$lmMember->tlmMemberfemale;
							echo $tcmMembermale;
							?>
						</td>
						<td>
						    <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMembermale from tbl_members  WHERE member_closing_date>= '$cmf' and `member_closing_date` <= '$cm'  and gender=1 and status=0")->row();
							$tclMembermale=$lmMember->tlmMembermale;
							echo $tclMembermale;
							?>
						</td>
						<td><?= $tlmMembermale+$tcmMembermale - 	$tclMembermale ?></td>
						<td>
						     <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_deposit_paid where  payment_Date>= '$cmf' and payment_Date<= '$cm' and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
						    	$tnsMembermale=$lmMember->tlmMembermale;
							    echo $tnsMembermale;
						    ?>
						</td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_savings_withdraw_details where  payment_Date  >= '$cmf' and payment_Date<= '$cm' and wStatus=1 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
						    	$trsMembermale=$lmMember->tlmMembermale;
							    echo $trsMembermale;
						    ?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>মোট</td>
						<td><?= $tlmMemberfemale+$tlmMembermale ?></td>
						<td><?= $tcmMemberfemale+$tcmMembermale ?></td>
					    <td><?= $tclMemberfemale+$tclMembermale ?></td>
						<td><?= $tlmMemberfemale+$tlmMembermale+$tcmMemberfemale+$tcmMembermale-($tclMemberfemale+$tclMembermale)?></td>
						<td><?= $tnsMemberfemale+$tnsMembermale?></td>
						<td><?= $trsMemberfemale+$trsMembermale?></td>
					</tr>
					<tr>
						<td>L.T.S Women</td>
						<td>
						    <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_deposit_assign  WHERE `disbursement_Date` <= '$lm' and status=1 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
							$tlmMemberfemaledps=$lmMember->tlmMemberfemale;
							echo $tlmMemberfemaledps;
							?>
						</td>
						<td>
						    <?php 
						    $date = new DateTime( $year.'-'.$month.'-01');
						    $cmf = $date->format("Y-m-d");
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_deposit_assign  WHERE `disbursement_Date`>='$cmf' and `disbursement_Date` <= '$cm' and status=1 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
							$tcmMemberfemaledps=$lmMember->tlmMemberfemale;
							echo $tcmMemberfemaledps;
							?>
						</td>
						<td>
						     <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMembermale from tbl_deposit_assign  WHERE `dps_closing_date` <= '$cm' and status=0 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
							$tclMemberfemaledps=$lmMember->tlmMembermale;
							echo $tclMemberfemaledps;
							?>
						</td>
						<td><?=  $tlmMemberfemaledps+$tcmMemberfemaledps-$tclMemberfemaledps?></td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_deposit_assign where  payment_Date  >= '$cmf' and payment_Date<= '$cm' and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
						    	$tdpsMemberfemalePaid=$lmMember->tlmMembermale;
							    echo $tdpsMemberfemalePaid;
						    ?>
						</td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_dps_withdraw_details where  payment_Date  >= '$cmf' and payment_Date<= '$cm'  and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
						    	$tdpsMemberfemaleWithdraw=$lmMember->tlmMembermale;
							    echo $tdpsMemberfemaleWithdraw;
						    ?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>L.T.S Men</td>
						<td>
						    <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_deposit_assign  WHERE `disbursement_Date` <= '$lm' and status=1 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
							$tlmMembermaledps=$lmMember->tlmMemberfemale;
							echo $tlmMembermaledps;
							?>
						</td>
						<td>
						    <?php 
						    $date = new DateTime( $year.'-'.$month.'-01');
						    $cmf = $date->format("Y-m-d");
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMemberfemale from tbl_deposit_assign  WHERE `disbursement_Date`>='$cmf' and `disbursement_Date` <= '$cm' and status=1 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=2)")->row();
							$tcmMembermaledps=$lmMember->tlmMemberfemale;
							echo $tcmMembermaledps;
							?>
						</td>
						<td>
						     <?php 
							$lmMember=$this->db->query("SELECT count(`id`)  as tlmMembermale from tbl_deposit_assign  WHERE `dps_closing_date` <= '$cm' and status=0 and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
							$tclMembermaledps=$lmMember->tlmMembermale;
							echo $tclMembermaledps;
							?>
						</td>
						<td><?= $tlmMembermaledps+$tcmMembermaledps-$tclMembermaledps?></td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_deposit_assign where  payment_Date  >= '$cmf' and payment_Date<= '$cm' and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
						    	$tdpsMembermalePaid=$lmMember->tlmMembermale;
							    echo $tdpsMembermalePaid;
						    ?>
						</td>
						<td>
						    <?php
						    $lmMember=$this->db->query("SELECT COUNT(id) as tlmMembermale from tbl_dps_withdraw_details where  payment_Date  >= '$cmf' and payment_Date<= '$cm'  and member_Id IN (select member_Id from tbl_members WHERE tbl_members.gender=1)")->row();
						    	$tdpsMembermaleWithdraw=$lmMember->tlmMembermale;
							    echo $tdpsMembermaleWithdraw;
						    ?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td>মোট</td>
						<td><?= $tlmMemberfemaledps+$tlmMembermaledps?></td>
						<td><?= $tcmMemberfemaledps+$tcmMembermaledps?></td>
						<td><?= $tclMemberfemaledps+$tclMembermaledps?></td>
						<td>
						   <?= $tlmMemberfemaledps+$tlmMembermaledps+ $tcmMemberfemaledps+$tcmMembermaledps -($tclMemberfemaledps+$tclMembermaledps)?> 
						</td>
						<td><?= $tdpsMemberfemalePaid+$tdpsMembermalePaid?></td>
						<td><?= $tdpsMemberfemaleWithdraw+$tdpsMembermaleWithdraw?></td>
						<td></td>
					</tr>
					<tr>
						<td>সর্বমোট</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>ম্যানেজার সাক্ষর</td>
					<td colspan="4"></td>
					<td>তারিখ এবং সময়</td>
					<td colspan="4"><?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>