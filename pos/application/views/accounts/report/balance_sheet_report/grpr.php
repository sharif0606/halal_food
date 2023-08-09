<?php 
$y=$year;
?>
<?php
$m=$month;
	if($m>6) {
		$qly=" date(`rec_date`) <= '".$y."-06-30"."' ";
		$qy=" date(`rec_date`) BETWEEN '".$y."-07-01' and '".$y."-".$m."-31"."' ";
	}else{
	    $qly=" date(`rec_date`) <= '".($y-1)."-06-30"."' ";
		$qy=" date(`rec_date`) BETWEEN '".($y-1)."-07-01' and '".$y."-".$m."-31' ";
	}
	/*echo $cqy;echo "<br>";
	echo $cqm;echo "<br>";
	echo $qy;echo "<br>";
	echo $qly;echo "<br>";*/
?>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		Financial Report (Adjusted Balance Sheet)
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
		<div id="display">
					<h4 class="vHide">Probati Somobay Somity Ltd</h4>
					<p class="vHide">Probati Laborer Co-Operative Organization</p>
					<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
					<p class="text-center vHide">Financial Report (Adjusted Balance Sheet)</p>
			<table id="" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th>Fund, Liablities & Owner Equity</th>
						<th>Previous Year</th>
						<th>Current Fiscal Year</th>
						<th>Assets</th>
						<th>Previous Year</th>
						<th>Current Fiscal Year</th>
					</tr>
				</thead>				
				<tbody>
				    <tr>
					    <td><strong>Fund</strong></td>
					    <td></td>
					    <td></td>
					    <td><strong>Loan</strong></td>
					    <td></td>
					    <td></td>
					</tr>
					<tr>
						<td>Last Fiscal Year Fund</td>
						<td>
						    <?php 
        						$ly3110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id in (32)) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (32)")->row();
                                if($ly3110)
        						    $ly3110b=($ly3110->dr-$ly3110->cr) + $ly3110->oldb;
        						else
        						    $ly3110b=0;
        						echo $ly3110b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy3110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (32)")->row();
                                if($cy3110)
        						    $cy3110b=$ly3110b+($cy3110->dr-$cy3110->cr);
        						else
        						    $cy3110b=0;
        						echo $cy3110b;
        					?>
						</td>
						<td>R.M.Woman (Loan)</td>
						<td>
						    <?php 
        						$ly11401=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (21)")->row();
                                if($ly11401)
        						    $ly11401b=($ly11401->dr-$ly11401->cr);
        						else
        						    $ly11401b=0;
        						    
        						echo $ly11401b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11401=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (21)")->row();
                                if($cy11401)
        						    $cy11401b=$ly11401b + ($cy11401->dr-$cy11401->cr);
        						else
        						    $cy11401b=0;
        						echo $cy11401b;
        					?>
						</td>
					</tr>
					<tr>
						<td>Current Fiscal Year Fund</td>
						<td></td>
						<td>
						    <?php
						        $cy3110bprofit=($incDataYear['income']-$expDataYear['cost']);
						        echo $cy3110bprofit;
						    ?>
						</td>
						<td>S.E.L.Man (Loan)</td>
						<td><?php 
        						$ly11402=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (22)")->row();
                                if($ly11402)
        						    $ly11402b=($ly11402->dr-$ly11402->cr);
        						else
        						    $ly11402b=0;
        						    
        						echo $ly11402b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11402=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (22)")->row();
                                if($cy11402)
        						    $cy11402b=$ly11402b + ($cy11402->dr-$cy11402->cr);
        						else
        						    $cy11402b=0;
        						    
        						echo $cy11402b;
        					?>
						</td>
					</tr>
					<tr>
						<td><strong>Total Fund Balance</strong></td>
						<td><?= $ly3110b ?></td>
						<td> <?= ($cy3110b +$cy3110bprofit ) ?></td>
					    <td><strong>Total Loan Balance</strong></td>
						<td> <?= ($ly11402b +$ly11401b ) ?></td>
						<td> <?= ($cy11402b+$cy11401b) ?></td>
					</tr>
					<tr>
						<td><strong>Reserves Account</strong></td>
						<td></td>
						<td></td>
						<td><strong>Fixed Assets</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td title="ঋণ ক্ষয় সঞ্চিতি হিসাব ">Loan Debt Consolidation Accounts</td>
						<td><?php 
        						$ly2106=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 16) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (16)")->row();
                                if($ly2106)
        						    $ly2106b=($ly2106->cr-$ly2106->dr) + $ly2106->oldb;
        						else
        						    $ly2106b=0;
        						    
        						echo $ly2106b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2106=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (16)")->row();
                                if($cy2106)
        						    $cy2106b=$ly2106b + ($cy2106->cr-$cy2106->dr);
        						else
        						    $cy2106b=0;
        						echo $cy2106b;
        					?>
						</td>
						<td title="">Computer</td>
						<td><?php 
        						$ly1210=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 6) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (6)")->row();
                                if($ly1210)
        						    $ly1210b=($ly1210->dr-$ly1210->cr) + $ly1210->oldb;
        						else
        						    $ly1210b=0;
        						    
        						echo $ly1210b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy1210=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (6)")->row();
                                if($cy1210)
        						    $cy1210b=$ly1210b + ($cy1210->dr-$cy1210->cr);
        						else
        						    $cy1210b=0;
        						echo $cy1210b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="অবচয় সঞ্চিতি হিসাব ">Depreciation reserve account</td>
						<td><?php 
        						$ly2107=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 17) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (17)")->row();
                                if($ly2107)
        						    $ly2107b=($ly2107->cr-$ly2107->dr) + $ly2107->oldb;
        						else
        						    $ly2107b=0;
        						    
        						echo $ly2107b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2107=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (17)")->row();
                                if($cy2107)
        						    $cy2107b=$ly2107b + ($cy2107->cr-$cy2107->dr);
        						else
        						    $cy2107b=0;
        						echo $cy2107b;
        					?>
						</td>
						<td>Furniture</td>
						<td><?php 
        						$ly1220=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 7) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (7)")->row();
                                if($ly1220)
        						    $ly1220b=($ly1220->dr-$ly1220->cr) + $ly1220->oldb;
        						else
        						    $ly1220b=0;
        						    
        						echo $ly1220b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy1220=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (7)")->row();
                                if($cy1220)
        						    $cy1220b=$ly1220b + ($cy1220->dr-$cy1220->cr);
        						else
        						    $cy1220b=0;
        						echo $cy1220b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="খরচ সঞ্চিতি হিসাব  ">Expense reserve Account</td>
						<td><?php 
        						$ly2105=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 15) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (15)")->row();
                                if($ly2105)
        						    $ly2105b=($ly2105->cr-$ly2105->dr) + $ly2105->oldb;
        						else
        						    $ly2105b=0;
        						    
        						echo $ly2105b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2105=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (15)")->row();
                                if($cy2105)
        						    $cy2105b=$ly2105b + ($cy2105->cr-$cy2105->dr);
        						else
        						    $cy2105b=0;
        						echo $cy2105b;
        					?>
						</td>
						<td>Electric Equipment</td>
						<td><?php 
        						$ly1230=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 8) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (8)")->row();
                                if($ly1230)
        						    $ly1230b=($ly1230->dr-$ly1230->cr) + $ly1230->oldb;
        						else
        						    $ly1230b=0;
        						    
        						echo $ly1230b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy1230=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (8)")->row();
                                if($cy1230)
        						    $cy1230b=$ly1230b + ($cy1230->dr-$cy1230->cr);
        						else
        						    $cy1230b=0;
        						echo $cy1230b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="সঞ্চয় সুদ সঞ্চিতি হিসাব  ">Savings Interest Reserve Account</td>
						<td><?php 
        						$ly2108=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 18) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (18)")->row();
                                if($ly2108)
        						    $ly2108b=($ly2108->cr-$ly2108->dr) + $ly2108->oldb;
        						else
        						    $ly2108b=0;
        						    
        						echo $ly2108b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2108=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (18)")->row();
                                if($cy2108)
        						    $cy2108b=$ly2108b + ($cy2108->cr-$cy2108->dr);
        						else
        						    $cy2108b=0;
        						echo $cy2108b;
        					?>
						</td>
						<td>Printer</td>
						<td><?php 
        						$ly1240=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 9) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (9)")->row();
                                if($ly1240)
        						    $ly1240b=($ly1240->dr-$ly1240->cr) + $ly1240->oldb;
        						else
        						    $ly1240b=0;
        						    
        						echo $ly1240b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy1240=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (9)")->row();
                                if($cy1240)
        						    $cy1240b=$ly1240b + ($cy1240->dr-$cy1240->cr);
        						else
        						    $cy1240b=0;
        						echo $cy1240b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="এল টি এস সুদ সঞ্চিতি হিসাব  ">L.T.S Interest Reverse Account</td>
						<td><?php 
        						$ly2109=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 19) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (19)")->row();
                                if($ly2109)
        						    $ly2109b=($ly2109->cr-$ly2109->dr) + $ly2109->oldb;
        						else
        						    $ly2109b=0;
        						    
        						echo $ly2109b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2109=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (19)")->row();
                                if($cy2109)
        						    $cy2109b=$ly2109b + ($cy2109->cr-$cy2109->dr);
        						else
        						    $cy2109b=0;
        						echo $cy2109b;
        					?>
						</td>
						<td>Software</td>
						<td><?php 
        						$ly1261=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 12) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (12)")->row();
                                if($ly1261)
        						    $ly1261b=($ly1261->dr-$ly1261->cr) + $ly1261->oldb;
        						else
        						    $ly1261b=0;
        						    
        						echo $ly1261b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy1261=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (12)")->row();
                                if($cy1261)
        						    $cy1261b=$ly1261b + ($cy1261->dr-$cy1261->cr);
        						else
        						    $cy1261b=0;
        						echo $cy1261b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="সংরক্ষিত তহবিল  ">Reserve Fund</td>
						<td><?php 
        						$ly2110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 20) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (20)")->row();
                                if($ly2110)
        						    $ly2110b=($ly2110->cr-$ly2110->dr) + $ly2110->oldb;
        						else
        						    $ly2110b=0;
        						    
        						echo $ly2110b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2110=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (20)")->row();
                                if($cy2110)
        						    $cy2110b=$ly2110b + ($cy2110->cr-$cy2110->dr);
        						else
        						    $cy2110b=0;
        						echo $cy2110b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td title="সেবামূলক তহবিল ">Service Fund</td>
						<td><?php 
        						$ly2111=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 21) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (21)")->row();
                                if($ly2111)
        						    $ly2111b=($ly2111->cr-$ly2111->dr) + $ly2111->oldb;
        						else
        						    $ly2111b=0;
        						    
        						echo $ly2111b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2111=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (21)")->row();
                                if($cy2111)
        						    $cy2111b=$ly2111b + ($cy2111->cr-$cy2111->dr);
        						else
        						    $cy2111b=0;
        						echo $cy2111b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td title="শিক্ষামূলক তহবিল ">Educational Fund</td>
						<td><?php 
        						$ly2112=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 22) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (22)")->row();
                                if($ly2112)
        						    $ly2112b=($ly2112->cr-$ly2112->dr) + $ly2112->oldb;
        						else
        						    $ly2112b=0;
        						    
        						echo $ly2112b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2112=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (22)")->row();
                                if($cy2112)
        						    $cy2112b=$ly2112b + ($cy2112->cr-$cy2112->dr);
        						else
        						    $cy2112b=0;
        						echo $cy2112b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td title="সমবায় উন্নয়ন তহবিল  ">Co-operative Development Fund</td>
						<td><?php 
        						$ly2113=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 23) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (23)")->row();
                                if($ly2113)
        						    $ly2113b=($ly2113->cr-$ly2113->dr) + $ly2113->oldb;
        						else
        						    $ly2113b=0;
        						    
        						echo $ly2113b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2113=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (23)")->row();
                                if($cy2113)
        						    $cy2113b=$ly2113b + ($cy2113->cr-$cy2113->dr);
        						else
        						    $cy2113b=0;
        						echo $cy2113b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>SubTotal</strong></td>
						<td><?= $ly2106b+$ly2107b+$ly2105b+$ly2108b+$ly2109b+$ly2110b+$ly2111b+$ly2112b+$ly2113b ?></td>
						<td><?= $cy2106b+$cy2107b+$cy2105b+$cy2108b+$cy2109b+$cy2110b+$cy2111b+$cy2112b+$cy2113b ?></td>
						<td><strong>SubTotal</strong></td>
						<td><?= $ly1210b+$ly1220b+$ly1230b+$ly1240b+$ly1261b ?></td>
						<td><?= $cy1210b+$cy1220b+$cy1230b+$cy1240b+$cy1261b ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td title="অগ্রিম হিসাব"><strong>Advance Account</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td title="শেয়ার আমানত  ">Share Capital</td>
						<td><?php 
        						$ly2220=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 27) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (27)")->row();
                                if($ly2220)
        						    $ly2220b=($ly2220->cr-$ly2220->dr) + $ly2220->oldb;
        						else
        						    $ly2220b=0;
        						    
        						echo $ly2220b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2220=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (27)")->row();
                                if($cy2220)
        						    $cy2220b=$ly2220b + ($cy2220->cr-$cy2220->dr);
        						else
        						    $cy2220b=0;
        						echo $cy2220b;
        					?>
						</td>
						<td>Advance Office Rent</td>
						<td><?php 
        						$ly11301=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id = 17) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (17)")->row();
                                if($ly11301)
        						    $ly11301b=($ly11301->dr-$ly11301->cr) + $ly11301->oldb;
        						else
        						    $ly11301b=0;
        						    
        						echo $ly11301b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11301=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (17)")->row();
                                if($cy11301)
        						    $cy11301b=$ly11301b + ($cy11301->dr-$cy11301->cr);
        						else
        						    $cy11301b=0;
        						echo $cy11301b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="কর্মী জামানত">Staff Security Amount</td>
						<td><?php 
        						$ly2250=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 30) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (30)")->row();
                                if($ly2250)
        						    $ly2250b=($ly2250->cr-$ly2250->dr) + $ly2250->oldb;
        						else
        						    $ly2250b=0;
        						    
        						echo $ly2250b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2250=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (30)")->row();
                                if($cy2250)
        						    $cy2250b=$ly2250b + ($cy2250->cr-$cy2250->dr);
        						else
        						    $cy2250b=0;
        						echo $cy2250b;
        					?>
						</td>
						<td title="স্বল্প কালীন অগ্রিম ">Short Term Advance</td>
						<td><?php 
        						$ly11304=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id = 20) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (20)")->row();
                                if($ly11304)
        						    $ly11304b=($ly11304->dr-$ly11304->cr) + $ly11304->oldb;
        						else
        						    $ly11304b=0;
        						    
        						echo $ly11304b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11304=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (20)")->row();
                                if($cy11304)
        						    $cy11304b=$ly11304b + ($cy11304->dr-$cy11304->cr);
        						else
        						    $cy11304b=0;
        						echo $cy11304b;
        					?>
						</td>
					</tr>
					<tr>
						<td>Risk Fund</td>
						<td><?php 
        						$ly31201=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id = 6) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (6)")->row();
                                if($ly31201)
        						    $ly31201b=($ly31201->cr-$ly31201->dr) + $ly31201->oldb;
        						else
        						    $ly31201b=0;
        						    
        						echo $ly31201b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy31201=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (6)")->row();
                                if($cy31201)
        						    $cy31201b=$ly31201b + ($cy31201->cr-$cy31201->dr);
        						else
        						    $cy31201b=0;
        						echo $cy31201b;
        					?>
						</td>
						<td>Bycycle</td>
						<td><?php 
        						$ly11303=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id = 19) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (19)")->row();
                                if($ly11303)
        						    $ly11303b=($ly11303->dr-$ly11303->cr) + $ly11303->oldb;
        						else
        						    $ly11303b=0;
        						    
        						echo $ly11303b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11303=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (19)")->row();
                                if($cy11303)
        						    $cy11303b=$ly11303b + ($cy11303->dr-$cy11303->cr);
        						else
        						    $cy11303b=0;
        						echo $cy11303b;
        					?>
						</td>
					</tr>
					<tr>
						<td title="এফ ডি আর আদায়">F.D.R Receive</td>
						<td><?php 
        						$ly2260cr=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 31) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (31)")->row();
                                if($ly2260cr)
        						    $ly2260crb=($ly2260cr->cr - $ly2260cr->dr) + $ly2260cr->oldb;
        						else
        						    $ly2260crb=0;
        						    
        						echo $ly2260crb;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2260cr=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (31)")->row();
        						
        						if($cy2260cr)
        						    $cy2260crb=$ly2260crb + ($cy2260cr->cr - $cy2260cr->dr);
        						else
        						    $cy2260crb=0;
        						    
        						echo $cy2260crb;
        					?>
						</td>
						<td title=""></td>
						<td> </td>
						<td> </td>
					</tr>
					<tr>
						<td><strong>SubTotal</strong></td>
						<td><?= $ly2220b+$ly2250b+$ly31201b+$ly2260crb ?></td>
						<td><?= $cy2220b+$cy2250b+$cy31201b+$cy2260crb ?></td>
						<td><strong>SubTotal</strong></td>
						<td><?= $ly11301b+$ly11304b+$ly11303b ?></td>
						<td><?= $cy11301b+$cy11304b+$cy11303b ?></td>
					</tr>
					<tr>
						<td><strong>Savings Account</strong></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Savings Men</td>
						<td><?php 
        						$ly20301=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (15)")->row();
                                if($ly20301)
        						    $ly20301b=($ly20301->cr-$ly20301->dr);
        						else
        						    $ly20301b=0;
        						    
        						echo $ly20301b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy20301=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (15)")->row();
                                if($cy20301)
        						    $cy20301b=$ly20301b + ($cy20301->cr-$cy20301->dr);
        						else
        						    $cy20301b=0;
        						echo $cy20301b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Savings Women</td>
						<td><?php 
        						$ly20302=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (16)")->row();
                                if($ly20302)
        						    $ly20302b=($ly20302->cr-$ly20302->dr);
        						else
        						    $ly20302b=0;
        						    
        						echo $ly20302b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy20302=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (16)")->row();
                                if($cy20302)
        						    $cy20302b=$ly20302b + ($cy20302->cr-$cy20302->dr);
        						else
        						    $cy20302b=0;
        						echo $cy20302b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>L.T.S</td>
						<td><?php 
        						$ly22101=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (13,14)")->row();
                                if($ly22101)
        						    $ly22101b=($ly22101->cr-$ly22101->dr);
        						else
        						    $ly22101b=0;
        						    
        						echo $ly22101b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy22101=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (13,14)")->row();
                                if($cy22101)
        						    $cy22101b=$ly22101b + ($cy22101->cr-$cy22101->dr);
        						else
        						    $cy22101b=0;
        						echo $cy22101b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>SubTotal</strong></td>
						<td><?= $ly20301b+$ly20302b+$ly22101b ?></td>
						<td><?= $cy20301b+$cy20302b+$cy22101b ?></td>
						<td><strong>SubTotal</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td><strong>Closing Balance</strong></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td title="স্থায়ী সম্পদ পূর্ণমূল্যায়ন">Valuation OF Fixed Asset </td>
						<td></td>
						<td></td>
						<td>Cash In Hand</td>
						<td>
						    <?php 
        						$ly11101=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (1,2)) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (1,2)")->row();
                                if($ly11101)
        						    $ly11101b=($ly11101->dr-$ly11101->cr) + $ly11101->oldb;
        						else
        						    $ly11101b=0;
        						echo $ly11101b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11101=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (1,2)")->row();
                                if($cy11101)
        						    $cy11101b=$ly11101b + ($cy11101->dr-$cy11101->cr);
        						else
        						    $cy11101b=0;
        						echo $cy11101b;
        					?>
						</td>
					</tr>
					<tr>
						<td>Provident Fund</td>
						<td><?php 
        						$ly2115=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 25) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (25)")->row();
                                if($ly2115)
        						    $ly2115b=($ly2115->cr-$ly2115->dr) + $ly2115->oldb;
        						else
        						    $ly2115b=0;
        						    
        						echo $ly2115b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2115=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (25)")->row();
                                if($cy2115)
        						    $cy2115b=$ly2115b + ($cy2115->cr-$cy2115->dr);
        						else
        						    $cy2115b=0;
        						echo $cy2115b;
        					?>
						</td>
						<td>Bank Deposit</td>
						<td>
						    <?php 
        						$ly11201=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(sub_balance) from tbl_fcoa_bkdn_sub where fcoa_bkdn_sub_id in (3)) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_sub_id` in (3)")->row();
                                if($ly11201)
        						    $ly11201b=($ly11201->dr-$ly11201->cr) + $ly11201->oldb;
        						else
        						    $ly11201b=0;
        						echo $ly11201b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy11201=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_sub_id` in (3)")->row();
                                if($cy11201)
        						    $cy11201b=$ly11201b + ($cy11201->dr-$cy11201->cr);
        						else
        						    $cy11201b=0;
        						echo $cy11201b;
        					?>
						</td>
					</tr>
					<tr>
						<td>Medical Fund</td>
						<td><?php 
        						$ly2114=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr,(select sum(bkdn_balance) from tbl_fcoa_bkdn where fcoa_bkdn_id = 24) as oldb FROM `tbl_general_ledger` WHERE $qly and `fcoa_bkdn_id` in (24)")->row();
                                if($ly2114)
        						    $ly2114b=($ly2114->cr-$ly2114->dr) + $ly2114->oldb;
        						else
        						    $ly2114b=0;
        						    
        						echo $ly2114b;
        					?>
						</td>
						<td>
						    <?php 
        						$cy2114=$this->db->query("SELECT sum(`dr`) as dr,sum(`cr`) as cr FROM `tbl_general_ledger` WHERE $qy and `fcoa_bkdn_id` in (24)")->row();
                                if($cy2114)
        						    $cy2114b=$ly2114b + ($cy2114->cr-$cy2114->dr);
        						else
        						    $cy2114b=0;
        						echo $cy2114b;
        					?>
						</td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>SubTotal</strong></td>
						<td><?= $ly2115b+$ly2114b ?></td>
						<td><?= $cy2115b+$cy2114b ?></td>
						<td><strong>SubTotal</strong></td>
						<td> <?= $ly11101b+$ly11201b ?></td>
						<td><?= $cy11101b+$cy11201b?></td>
					</tr>
					<tr>
						<td><strong>Total</strong></td>
						<td><?= $ly2106b+$ly2107b+$ly2105b+$ly2108b+$ly2109b+$ly2110b+$ly2111b+$ly2112b+$ly2113b+$ly2220b+$ly2250b+$ly31201b+$ly2260crb+$ly20301b+$ly20302b+$ly22101b+$ly2115b+$ly2114b+$ly3110b ?></td>
						<td><?= $cy2106b+$cy2107b+$cy2105b+$cy2108b+$cy2109b+$cy2110b+$cy2111b+$cy2112b+$cy2113b+$cy2220b+$cy2250b+$cy31201b+$cy2260crb+$cy20301b+$cy20302b+$cy22101b+$cy2115b+$cy2114b+$cy3110b+$cy3110bprofit ?></td>
						<td><strong>Total</strong></td>
						<td><?= $ly11402b +$ly11401b + $ly1210b+$ly1220b+$ly1230b+$ly1240b+$ly11301b+$ly11304b+$ly11303b+$ly11101b+$ly11201b+$ly1261b ?></td>
						<td><?= $cy11402b+$cy11401b + $cy1210b+$cy1220b+$cy1230b+$cy1240b+$cy11301b+$cy11304b+$cy11303b+$cy11101b+$cy11201b+$cy1261b ?></td>
					</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>Manager Signature</td>
					<td colspan="3"></td>
					<td>Date & Time</td>
					<td colspan="3"><?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>