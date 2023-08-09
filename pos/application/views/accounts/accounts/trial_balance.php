

<div class="content-page">			
	<div class="content">
	<div class="page-heading">
		<h1><i class='fa fa-check'></i> Trial Balance</h1>
	</div>
	<?php 
	$table='';
	$my_id=1;
	$CI =& get_instance();
	$CI->load->library('account');
	$sub_fcoa_bkdn_arr 	= $coahead[0];
	$fcoa_bkdn_arr 		= $coahead[1];
	$fcoa_arr 			= $coahead[2];
	
	$gtotal_dr=0;
	$gtotal_cr=0;

	$masterArr = $CI->db->query("SELECT fcoa_master_id, fcoa_master, master_code,master_balance, rec_date FROM tbl_fcoa_master WHERE my_id = $my_id ORDER BY fcoa_master_id ASC");
	if ($masterArr->num_rows() > 0)
	{
						$table.="
							<table class='table table-bordered'>
							<thead>
							  <tr>
								<th>Chart Of Account</th>
								<th>Debit Amount</th>
								<th>Credit Amount</th>
							  </tr>
							</thead>
							<tbody>
							";
							 
		foreach ($masterArr->result() as $master_row)
		{
			
			$master_head = $master_row->master_code."-".$master_row->fcoa_master;
			
			$get_master_head='';
			$get_master_head=$CI->account->search_arr($fcoa_arr,'parent',$master_row->fcoa_master_id);
			
			if(sizeof($get_master_head)>0){
				
			  
				$msater_head_ID='';
				foreach($get_master_head as $master_head_info){
				  $msater_head_ID=$master_head_info["parent"];
				}
				
				$mster_debit_credit=$CI->account->get_master_head_total_drcr($get_master_head);
				
				//$gtotal_dr+=$mster_debit_credit[0];
				//$gtotal_cr+=$mster_debit_credit[1];
				
				
				if($mster_debit_credit[0]>$mster_debit_credit[1]){
					$mster_debit_value=number_format($mster_debit_credit[0]-$mster_debit_credit[1],2);
					$mster_credit_value='';
				}
				else if($mster_debit_credit[0]<$mster_debit_credit[1]){
					$mster_debit_value='';
					$mster_credit_value=number_format($mster_debit_credit[1]-$mster_debit_credit[0],2);
				}
				else{
					$mster_debit_value='';
					$mster_credit_value='';
				}
				
				
				
				if(!empty($mster_debit_value) or !empty($mster_credit_value)){
				
					$table.="<tr valign='top'>
								 <td>".$master_head."</td> 
								 <td style='text-align:right;'>".$mster_debit_value."</td>	
								 <td style='text-align:right;'>".$mster_credit_value."</td>		
							</tr>
							";
									

					foreach($get_master_head as $fcoa_head_info){
						
						if(!empty($fcoa_head_info["dr"])){$fcoa_head_info_dr="[DR ".$fcoa_head_info["dr"]."]";}
						else {$fcoa_head_info_dr='';}
						if(!empty($fcoa_head_info["cr"])){$fcoa_head_info_cr="[CR ".$fcoa_head_info["cr"]."]";}
						else {$fcoa_head_info_cr='';}
							
						  //--
						  $devalue=0;
						  $crvalue=0;
						  if($fcoa_head_info["dr"]>$fcoa_head_info["cr"]){
							$gtotal_dr +=$fcoa_head_info["dr"]-$fcoa_head_info["cr"];// Total dr
							$devalue=number_format($fcoa_head_info["dr"]-$fcoa_head_info["cr"],2);
							$crvalue=0;
						  }
						  else if($fcoa_head_info["dr"]<$fcoa_head_info["cr"]){
							  $devalue=0;
							  $gtotal_cr +=$fcoa_head_info["cr"]-$fcoa_head_info["dr"]; // Total cr
							  $crvalue=number_format($fcoa_head_info["cr"]-$fcoa_head_info["dr"],2);
						  }
						  else{
							  $devalue=0;
							  $crvalue=0;
						  }
						  
							
						if(!empty($devalue) or !empty($crvalue)){	
						  //--
							
						if($fcoa_head_info["ref"]==''){
						  
						  
							if($fcoa_head_info_dr!="" || $fcoa_head_info_cr!=""){
							  
							$table.="<tr style='display:display;'>
										 <td>".$fcoa_head_info["head"]."</td>	
										 <td style='text-align:right;'>".$devalue."</td>
										 <td style='text-align:right;'>".$crvalue."</td>
									</tr>
									";
							}
						}
						else {
							

							if($fcoa_head_info_dr!="" || $fcoa_head_info_cr!=""){
							$table.="<tr style='display:display;'>
										<td>".$fcoa_head_info["head"]."</td>
										<td style='text-align:right;'>".$devalue."</td>
										<td style='text-align:right;'>".$crvalue."</td>
									</tr>
									";
							}
										
							$get_fcoa_bkdn='';
							$fcoa_head_ref_exp = explode("-", $fcoa_head_info['ref']);
								
							for($fcoa_head_inc=0; $fcoa_head_inc<sizeof($fcoa_head_ref_exp)-1; $fcoa_head_inc++){
								
								$fcoa_head_ref_id=$fcoa_head_ref_exp["$fcoa_head_inc"];
								$get_fcoa_bkdn=$CI->account->search_arr($fcoa_bkdn_arr,'id',$fcoa_head_ref_id);
								
								
								if(sizeof($get_fcoa_bkdn)>0){

									foreach($get_fcoa_bkdn as $fcoa_bkdn_info){
										
									if(!empty($fcoa_bkdn_info["dr"])){$fcoa_bkdn_info_dr="[DR ".$fcoa_bkdn_info["dr"]."]";}
									else {$fcoa_bkdn_info_dr='';}
									if(!empty($fcoa_bkdn_info["cr"])){$fcoa_bkdn_info_cr="[CR ".$fcoa_bkdn_info["cr"]."]";}
									else {$fcoa_bkdn_info_cr='';}	
									
									//--
									$devalue='';
									$crvalue='';
									if($fcoa_bkdn_info["dr"]>$fcoa_bkdn_info["cr"]){
									  $devalue=number_format($fcoa_bkdn_info["dr"]-$fcoa_bkdn_info["cr"],2);
									  $crvalue='';
									}
									else if($fcoa_bkdn_info["dr"]<$fcoa_bkdn_info["cr"]){
										$devalue='';
										$crvalue=number_format($fcoa_bkdn_info["cr"]-$fcoa_bkdn_info["dr"],2);
									}
									else{
										$devalue='';
										$crvalue='';
									}
									
									if(!empty($devalue) or !empty($crvalue)){
										
										
										if($fcoa_bkdn_info["ref"]==''){
											
											$table.="
												<tr style='display:display;'>
													<td>".$fcoa_bkdn_info["head"]."</td>
													<td style='text-align:right;'>".$devalue."</td>
													<td style='text-align:right;'>".$crvalue."</td>
												</tr>
											";	
										}
										else {
													
											$get_sub_fcoa_bkdn='';
											$sub_fcoa_head_ref_exp = explode("-", $fcoa_bkdn_info["ref"]);
											
											for($sub_fcoa_head_inc=0; $sub_fcoa_head_inc<sizeof($sub_fcoa_head_ref_exp)-1; $sub_fcoa_head_inc++){
												
												$sub_fcoa_head_ref_id=$sub_fcoa_head_ref_exp["$sub_fcoa_head_inc"];
												$get_sub_fcoa_bkdn=$CI->account->search_arr($sub_fcoa_bkdn_arr,'id',$sub_fcoa_head_ref_id);
												
												if(sizeof($get_sub_fcoa_bkdn)>0){
														
												foreach($get_sub_fcoa_bkdn as $sub_fcoa_bkdn_info){
													
													if(!empty($sub_fcoa_bkdn_info["dr"])){$sub_fcoa_bkdn_info_dr="[DR ".$sub_fcoa_bkdn_info["dr"]."]";}
													else {$sub_fcoa_bkdn_info_dr='';}
													
													if(!empty($sub_fcoa_bkdn_info["cr"])){$sub_fcoa_bkdn_info_cr="[CR ".$sub_fcoa_bkdn_info["cr"]."]";}
													else {$sub_fcoa_bkdn_info_cr='';}
													
													//--
													$devalue='';
													$crvalue='';
													if($sub_fcoa_bkdn_info["dr"]>$sub_fcoa_bkdn_info["cr"]){
													  $devalue=number_format($sub_fcoa_bkdn_info["dr"]-$sub_fcoa_bkdn_info["cr"],2);
													  $crvalue='';
													}
													else if($sub_fcoa_bkdn_info["dr"]<$sub_fcoa_bkdn_info["cr"]){
														$devalue='';
														$crvalue=number_format($sub_fcoa_bkdn_info["cr"]-$sub_fcoa_bkdn_info["dr"],2);
													}
													else{
														$devalue='';
														$crvalue='';
													}
													
													if(!empty($devalue) or !empty($crvalue)){
														
													
													$table.="
													<tr style='display:display;'>
														<td>".$sub_fcoa_bkdn_info["head"]."</td>
														<td style='text-align:right;'>".$devalue."</td>
														<td style='text-align:right;'>".$crvalue."</td>
													</tr>";
													
													}
												}
													
												}
												
											}
										}

									}
									
									}	
								}
								
							}	
						}
					}
					}
				}
			
			}
		}
		
		
		$gtotal_dr_show='';
		$gtotal_cr_show='';
		
		if(!empty($gtotal_dr)){
			$gtotal_dr_show=number_format($gtotal_dr,2);
		}
		if(!empty($gtotal_cr)){
			$gtotal_cr_show=number_format($gtotal_cr,2);
		}

		
		$table.="<tr>
					<td style='text-align:right;'><b>Total Balance</b></td>
					<td style='text-align:right;'>".$gtotal_dr_show."</td>
					<td style='text-align:right;'>".$gtotal_cr_show."</td>
				</tr>";
		
		$table.="</tbody>"; 	
	}
				
	$table.="</table>"; 
	echo $table;
	?>