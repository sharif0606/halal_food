<?php 
			$table='';
			$school_id=1;
			$CI =& get_instance();
												
			$masterArr = $CI->db->query("SELECT fcoa_master_id, fcoa_master, master_code, master_balance, rec_date FROM tbl_fcoa_master WHERE school_id = $school_id ORDER BY fcoa_master_id ASC");
			if ($masterArr->num_rows() > 0)
			{
								$table_view.="
									<table class='table table-bordered'>
									<thead>
									  <tr>
										<th>Master Head</th>
										<th>Sub1 Head</th>
										<th>Sub2 Head</th>
										<th>Sub3 Head</th>
									  </tr>
									</thead>
									<tbody>
									";
									 
				foreach ($masterArr->result() as $master_row)
				{
				$table_view.="<tr>
									<td style=''>{$master_row->master_code}-{$master_row->fcoa_master}</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>" ;
								
					$sub1Arr = $CI->db->query("SELECT 	mt.fcoa_master_id, 
												mt.fcoa_master, 
												mt.master_code,
												mt.master_balance,
												s1.fcoa_id,
												s1.fcoa,
												s1.fcoa_code,
												s1.fcoa_balance
										FROM 	tbl_fcoa_master mt
										inner join tbl_fcoa as s1 
											on s1.fcoa_master_id = mt.fcoa_master_id
										WHERE 	s1.school_id = {$school_id} 
											and mt.fcoa_master_id = {$master_row->fcoa_master_id}
											ORDER BY s1.fcoa_id ASC");
					if ($sub1Arr->num_rows() > 0)
					{
						foreach ($sub1Arr->result() as $sub1_row)
						{
							$table_view.=" <tr>
									<td></td>
									<td style=''>{$sub1_row->fcoa_code}-{$sub1_row->fcoa}</td>
									<td></td>
									<td></td>
								  </tr>" ;
							  
							$sub2Arr = $CI->db->query("SELECT 	mt.fcoa_master_id, 
														mt.fcoa_master, 
														mt.master_code,
														mt.master_balance,
														s1.fcoa_id,
														s1.fcoa,
														s1.fcoa_code,
														s1.fcoa_balance,
														s2.fcoa_bkdn_id,
														s2.fcoa_bkdn,
														s2.bkdn_code,
														s2.bkdn_balance
												FROM 	tbl_fcoa_master mt
												inner join tbl_fcoa as s1 
													on s1.fcoa_master_id = mt.fcoa_master_id
												inner join tbl_fcoa_bkdn as s2 
													on s2.fcoa_id = s1.fcoa_id
												WHERE 	s2.school_id = {$school_id} 
													and s1.fcoa_id = {$sub1_row->fcoa_id}
													ORDER BY s2.fcoa_bkdn_id ASC");
							if ($sub2Arr->num_rows() > 0)
							{
								foreach ($sub2Arr->result() as $sub2_row)
								{
									$table_view.="<tr>
														 <td></td>
														 <td></td>
														 <td style=''>{$sub2_row->bkdn_code}-{$sub2_row->fcoa_bkdn}</td>
														<td></td>
													  </tr>" ;
									$sub3Arr = $CI->db->query("SELECT mt.fcoa_master_id, 
															mt.fcoa_master, 
															mt.master_code,
															mt.master_balance,
															s1.fcoa_id,
															s1.fcoa,
															s1.fcoa_code,
															s1.fcoa_balance,
															s2.fcoa_bkdn_id,
															s2.fcoa_bkdn,
															s2.bkdn_code,
															s2.bkdn_balance,
															s3.fcoa_bkdn_sub_id,
															s3.fcoa_bkdn_sub,
															s3.sub_code,
															s3.sub_balance
													FROM 	tbl_fcoa_master mt
													inner join tbl_fcoa as s1 
														on s1.fcoa_master_id = mt.fcoa_master_id
													inner join tbl_fcoa_bkdn as s2 
														on s2.fcoa_id = s1.fcoa_id
													inner join tbl_fcoa_bkdn_sub as s3 
														on s3.fcoa_bkdn_id = s2.fcoa_bkdn_id
													WHERE 	s3.school_id = {$school_id} 
														and s2.fcoa_bkdn_id = {$sub2_row->fcoa_bkdn_id}
														ORDER BY s3.fcoa_bkdn_sub_id ASC");
									if ($sub3Arr->num_rows() > 0)
									{
										foreach ($sub3Arr->result() as $sub3_row)
										{
											  
										$table_view.="<tr>
												 <td></td>
												 <td></td>
												 <td></td>
												 <td style=''>{$sub3_row->sub_code}-{$sub3_row->fcoa_bkdn_sub}</td>
											  </tr>";
												  
										}
									}
								}
							} 
						}
					}
				}
				$table_view.="</tbody>"; 	
			}
						
			$table_view.="</table>";
			echo $table_view;
			?>