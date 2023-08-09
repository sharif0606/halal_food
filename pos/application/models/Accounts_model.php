<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accounts_model extends CI_Model
{
	public $coahead = array();
	
    function __construct()
    {
        parent::__construct();
		
		$this->load->library('account');
    }
	
	/*----------------------------------- Master Head --------------------------*/
	
	function master_head_list($my_id)
    {           
        $sql = "SELECT fcoa_master_id, fcoa_master, master_code, master_balance, rec_date FROM tbl_fcoa_master WHERE my_id = $my_id ORDER BY fcoa_master_id ASC";

        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;

    }
	
	function master_head_edit($my_id, $id)
    {           
        $sql = "SELECT fcoa_master_id, fcoa_master, master_code, master_balance, rec_date FROM tbl_fcoa_master WHERE my_id = $my_id and fcoa_master_id = $id limit 1";
        $query = $this->db->query($sql);
        $row= $query->row_array();
        return $row;
    }
    
	
	/*----------------------------------- Sub1 Head --------------------------*/
	
	function sub1_head_list($my_id)
    {           
        $sql = "SELECT 	mt.fcoa_master_id, 
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
				WHERE 	s1.my_id = {$my_id} 
					ORDER BY s1.fcoa_id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	
	function sub1_head_edit($my_id, $id)
    {           
        $sql = "SELECT 	mt.fcoa_master_id, 
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
				WHERE 	s1.my_id = $my_id 
					and s1.fcoa_id = $id limit 1
					";
        $query = $this->db->query($sql);
        $row= $query->row_array();
        return $row;
    }
    
	
	/*----------------------------------- Sub2 Head --------------------------*/

	function sub2_head_list($my_id)
    {           
        $sql = "SELECT 	mt.fcoa_master_id, 
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
				WHERE 	s2.my_id = {$my_id} 
					ORDER BY s2.fcoa_bkdn_id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	function sub2_head_edit($my_id, $id)
    {           
        $sql = "SELECT 	mt.fcoa_master_id, 
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
				WHERE 	s2.my_id = $my_id 
					and s2.fcoa_bkdn_id = $id limit 1
					";
        $query = $this->db->query($sql);
        $row= $query->row_array();
        return $row;
    }
	
	
	/*----------------------------------- Sub3 Head --------------------------*/

	function sub3_head_list($my_id)
    {           
        $sql = "SELECT 	mt.fcoa_master_id, 
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
				WHERE 	s3.my_id = {$my_id} 
					ORDER BY s3.fcoa_bkdn_sub_id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	function sub3_head_edit($my_id, $id)
    {           
        $sql = "SELECT 	mt.fcoa_master_id, 
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
				WHERE 	s3.my_id = $my_id 
					and s3.fcoa_bkdn_sub_id = $id limit 1
					";
        $query = $this->db->query($sql);
        $row= $query->row_array();
        return $row;
    }
	
	/*----------------------------------- Others Ajax --------------------------*/
	function sub1_head_list_ajax($my_id,$fcoa_master_id)
    {           
        $sql = "SELECT 	s1.fcoa_id,
						s1.fcoa,
						s1.fcoa_code,
						s1.fcoa_balance
				FROM 	tbl_fcoa as s1 
				WHERE 	s1.my_id = {$my_id} 
					and s1.fcoa_master_id = {$fcoa_master_id} 
					ORDER BY s1.fcoa_id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	function sub2_head_list_ajax($my_id,$fcoa_id)
    {           
        $sql = "SELECT 	s2.fcoa_bkdn_id,
						s2.fcoa_bkdn,
						s2.bkdn_code,
						s2.bkdn_balance
				FROM 	tbl_fcoa_bkdn s2
				WHERE 	s2.my_id = {$my_id} 
					and s2.fcoa_id = {$fcoa_id} 
					ORDER BY s2.fcoa_bkdn_id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	/*
	function account_code_list_ajax($code,$increment,$my_id){
		$row='';
		$code = strtolower($code);
		
		$query = $this->db->query("
								SELECT 'tbl_fcoa_master' as table_name, fcoa_master_id as id, fcoa_master as coa_head, master_code as coa_code
								FROM tbl_fcoa_master
								WHERE LOWER(fcoa_master) LIKE '%{$code}%'
								AND my_id = {$my_id}
								UNION
								SELECT 'tbl_fcoa' as table_name, fcoa_id as id, fcoa as coa_head, fcoa_code as coa_code
								FROM tbl_fcoa
								WHERE LOWER(fcoa) LIKE '%{$code}%'
								AND my_id = {$my_id}
								UNION
								SELECT 'tbl_fcoa_bkdn' as table_name, fcoa_bkdn_id as id, fcoa_bkdn as coa_head, bkdn_code as coa_code
								FROM tbl_fcoa_bkdn
								WHERE LOWER(fcoa_bkdn) LIKE '%{$code}%'
								AND my_id = {$my_id}
								UNION
								SELECT 'tbl_fcoa_bkdn_sub' as table_name, fcoa_bkdn_sub_id as id, fcoa_bkdn_sub as coa_head, sub_code as coa_code
								FROM tbl_fcoa_bkdn_sub
								WHERE LOWER(fcoa_bkdn_sub) LIKE '%{$code}%'
								AND my_id = {$my_id}
								");
		
		if ($query->num_rows() > 0)
		{
			$row= $query->result_array();
		}
		return $row;
	}
	*/
	
	
	function account_code_list_ajax_journal($code,$increment,$my_id){
		$row='';
		//$CI =& get_instance();
		$needle = $code;
		$needle = strtolower($needle);
		
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		
		$master = $this->db->query("SELECT fcoa_master_id, fcoa_master, master_code,master_balance, rec_date FROM tbl_fcoa_master WHERE my_id = $my_id ORDER BY fcoa_master_id ASC");
		if ($master->num_rows() > 0)
		{
			foreach ($master->result() as $master_row)
			{
			$master_headArr["{$master_row->fcoa_master_id}"]=array(
															"id"=>$master_row->fcoa_master_id,
															"parent"=>"",
															"head"=>$master_row->fcoa_master,
															"coa_code"=>$master_row->master_code,
															"lavel"=>"tbl_fcoa_master"
															);
				
					
			$sub1Arr = $this->db->query("SELECT s1.fcoa_id,
												s1.fcoa,
												s1.fcoa_code,
												s1.fcoa_balance
										FROM 	tbl_fcoa s1
										WHERE 	s1.my_id = {$my_id} 
											and s1.fcoa_master_id = {$master_row->fcoa_master_id}
											ORDER BY s1.fcoa_id ASC");
			if ($sub1Arr->num_rows() > 0)
			{
				foreach ($sub1Arr->result() as $sub1_row)
				{
				
				
				$fcoaArr["{$sub1_row->fcoa_id}"]=array(
														"id"=>$sub1_row->fcoa_id,
														"parent"=>$master_row->fcoa_master_id,
														"head"=>$sub1_row->fcoa,
														"coa_code"=>$sub1_row->fcoa_code,
														"lavel"=>"tbl_fcoa"
														);
				
						  
				$sub2Arr = $this->db->query("SELECT s2.fcoa_bkdn_id,
													s2.fcoa_bkdn,
													s2.bkdn_code,
													s2.bkdn_balance
											FROM 	tbl_fcoa_bkdn as s2
											WHERE 	s2.my_id = {$my_id} 
												and s2.fcoa_id = {$sub1_row->fcoa_id}
												ORDER BY s2.fcoa_bkdn_id ASC");
				if ($sub2Arr->num_rows() > 0)
				{
					foreach ($sub2Arr->result() as $sub2_row)
					{
						
					$fcoa_bkdnArr["{$sub2_row->fcoa_bkdn_id}"]=array(
															"id"=>$sub2_row->fcoa_bkdn_id,
															"parent"=>$sub1_row->fcoa_id,
															"head"=>$sub2_row->fcoa_bkdn,
															"coa_code"=>$sub2_row->bkdn_code,
															"lavel"=>"tbl_fcoa_bkdn"
															);
		
					$sub3Arr = $this->db->query("SELECT s3.fcoa_bkdn_sub_id,
														s3.fcoa_bkdn_sub,
														s3.sub_code,
														s3.sub_balance
												FROM 	tbl_fcoa_bkdn_sub s3
												WHERE 	s3.my_id = {$my_id} 
													and s3.fcoa_bkdn_id = {$sub2_row->fcoa_bkdn_id}
													ORDER BY s3.fcoa_bkdn_sub_id ASC");
					if ($sub3Arr->num_rows() > 0)
					{
						foreach ($sub3Arr->result() as $sub3_row)
						{
			  
						  $sub_fcoa_bkdnArr["{$sub3_row->fcoa_bkdn_sub_id}"]=array(
																				"id"=>$sub3_row->fcoa_bkdn_sub_id,
																				"parent"=>$sub2_row->fcoa_bkdn_id,
																				"head"=>$sub3_row->fcoa_bkdn_sub,
																				"coa_code"=>$sub3_row->sub_code,
																				"lavel"=>"tbl_fcoa_bkdn_sub"
																				);
						}
					}
					}
				}
				}
			}
			}
		}
		
		$return_Arr=array();
		/*
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		echo "<pre>";
			print_r($sub_fcoa_bkdnArr);
		echo "</pre>";
		die();
		*/
		$return_Arr[0]=$master_headArr;
		$return_Arr[1]=$fcoaArr;
		$return_Arr[2]=$fcoa_bkdnArr;
		$return_Arr[3]=$sub_fcoa_bkdnArr;
		
		return $return_Arr;
	}
	function account_code_list_ajax($code,$increment,$my_id){
		$row='';
		//$CI =& get_instance();
		$needle = $code;
		$needle = strtolower($needle);
		
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		
		$master = $this->db->query("SELECT fcoa_master_id, fcoa_master, master_code,master_balance, rec_date FROM tbl_fcoa_master WHERE my_id = $my_id ORDER BY fcoa_master_id ASC");
		if ($master->num_rows() > 0)
		{
			foreach ($master->result() as $master_row)
			{
			$master_headArr["{$master_row->fcoa_master_id}"]=array(
															"id"=>$master_row->fcoa_master_id,
															"parent"=>"",
															"head"=>$master_row->fcoa_master,
															"coa_code"=>$master_row->master_code,
															"lavel"=>"tbl_fcoa_master"
															);
				
					
			$sub1Arr = $this->db->query("SELECT s1.fcoa_id,
												s1.fcoa,
												s1.fcoa_code,
												s1.fcoa_balance
										FROM 	tbl_fcoa s1
										WHERE 	s1.my_id = {$my_id} 
											and s1.fcoa_master_id = {$master_row->fcoa_master_id}
											ORDER BY s1.fcoa_id ASC");
			if ($sub1Arr->num_rows() > 0){
				foreach ($sub1Arr->result() as $sub1_row){
				    if($sub1_row->fcoa_code=="1001"){
				        /* nothing to print as these are cash or bank head */
				    }else{
				        $fcoaArr["{$sub1_row->fcoa_id}"]=array(
														"id"=>$sub1_row->fcoa_id,
														"parent"=>$master_row->fcoa_master_id,
														"head"=>$sub1_row->fcoa,
														"coa_code"=>$sub1_row->fcoa_code,
														"lavel"=>"tbl_fcoa"
														);
						  
				        $sub2Arr = $this->db->query("SELECT s2.fcoa_bkdn_id,
													s2.fcoa_bkdn,
													s2.bkdn_code,
													s2.bkdn_balance
											FROM 	tbl_fcoa_bkdn as s2
											WHERE 	s2.my_id = {$my_id} 
												and s2.fcoa_id = {$sub1_row->fcoa_id}
												ORDER BY s2.fcoa_bkdn_id ASC");
        				if ($sub2Arr->num_rows() > 0){
        					foreach ($sub2Arr->result() as $sub2_row){
        						
        					    $fcoa_bkdnArr["{$sub2_row->fcoa_bkdn_id}"]=array(
        															"id"=>$sub2_row->fcoa_bkdn_id,
        															"parent"=>$sub1_row->fcoa_id,
        															"head"=>$sub2_row->fcoa_bkdn,
        															"coa_code"=>$sub2_row->bkdn_code,
        															"lavel"=>"tbl_fcoa_bkdn"
        															);
        		
        					    $sub3Arr = $this->db->query("SELECT s3.fcoa_bkdn_sub_id,
        														s3.fcoa_bkdn_sub,
        														s3.sub_code,
        														s3.sub_balance
        												FROM 	tbl_fcoa_bkdn_sub s3
        												WHERE 	s3.my_id = {$my_id} 
        													and s3.fcoa_bkdn_id = {$sub2_row->fcoa_bkdn_id}
        													ORDER BY s3.fcoa_bkdn_sub_id ASC");
            					if ($sub3Arr->num_rows() > 0){
            						foreach ($sub3Arr->result() as $sub3_row){
        			  
        						        $sub_fcoa_bkdnArr["{$sub3_row->fcoa_bkdn_sub_id}"]=array(
        																				"id"=>$sub3_row->fcoa_bkdn_sub_id,
        																				"parent"=>$sub2_row->fcoa_bkdn_id,
        																				"head"=>$sub3_row->fcoa_bkdn_sub,
        																				"coa_code"=>$sub3_row->sub_code,
        																				"lavel"=>"tbl_fcoa_bkdn_sub"
        																				);
        						    }
        					    }   
        					}
        				}
				    }
				}
			}
			}
		}
		
		$return_Arr=array();
		/*
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		echo "<pre>";
			print_r($sub_fcoa_bkdnArr);
		echo "</pre>";
		die();
		*/
		$return_Arr[0]=$master_headArr;
		$return_Arr[1]=$fcoaArr;
		$return_Arr[2]=$fcoa_bkdnArr;
		$return_Arr[3]=$sub_fcoa_bkdnArr;
		
		return $return_Arr;
	}
	
	function chart_of_account_value($my_id,$where=false){
		$row='';
		//$CI =& get_instance();
		
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		
		$sub_fcoa_bkdn = $this->db->query("SELECT s3.fcoa_bkdn_sub_id, 
									s3.fcoa_bkdn_id,
									s3.fcoa_bkdn_sub,
									s3.sub_code,
									SUM(gl.dr) AS dr, 
									SUM(gl.cr) AS cr
							FROM tbl_fcoa_bkdn_sub s3
							INNER JOIN tbl_general_ledger as gl ON gl.fcoa_bkdn_sub_id = s3.fcoa_bkdn_sub_id
							WHERE s3.my_id = {$my_id} {$where}
							GROUP BY s3.fcoa_bkdn_sub_id,s3.fcoa_bkdn_id,s3.fcoa_bkdn_sub,s3.sub_code");
		if ($sub_fcoa_bkdn->num_rows() > 0)
		{
			foreach ($sub_fcoa_bkdn->result() as $sfb_row)
			{
			
			$fcoa_bkdn_sub_code = $sfb_row->sub_code."-".$sfb_row->fcoa_bkdn_sub;
			
			$sub_fcoa_bkdnArr["{$sfb_row->fcoa_bkdn_sub_id}"]=array(
															"id"=>$sfb_row->fcoa_bkdn_sub_id,
															"parent"=>$sfb_row->fcoa_bkdn_id,
															"head"=>$fcoa_bkdn_sub_code,
															"dr"=>$sfb_row->dr,
															"cr"=>$sfb_row->cr,
															"ref"=>""
															);
			}
		}
		
		
		$fcoa_bkdn = $this->db->query("SELECT s2.fcoa_bkdn_id, 
										s2.fcoa_id,
										s2.fcoa_bkdn,
										s2.bkdn_code,
										SUM(gl.dr) AS dr, 
										SUM(gl.cr) AS cr
										FROM tbl_fcoa_bkdn s2
										INNER JOIN tbl_general_ledger as gl ON gl.fcoa_bkdn_id = s2.fcoa_bkdn_id
										WHERE s2.my_id = {$my_id} {$where}
										GROUP BY s2.fcoa_bkdn_id,s2.fcoa_id,s2.fcoa_bkdn,s2.bkdn_code");
		if ($fcoa_bkdn->num_rows() > 0)
		{
			foreach ($fcoa_bkdn->result() as $fb_row)
			{
				
			$fcoa_bkdn_code = $fb_row->bkdn_code."-".$fb_row->fcoa_bkdn;
			
			$fcoa_bkdnArr["{$fb_row->fcoa_bkdn_id}"]=array(
															"id"=>$fb_row->fcoa_bkdn_id,
															"parent"=>$fb_row->fcoa_id,
															"head"=>$fcoa_bkdn_code,
															"dr"=>$fb_row->dr,
															"cr"=>$fb_row->cr,
															"ref"=>""
															);
			}
		}
		
		$fcoa_bkdn_arr_final=array();
		
		$fcoa_bkdn_sql = $this->db->query("SELECT s2.fcoa_bkdn_id, 
										s2.fcoa_id,
										s2.fcoa_bkdn,
										s2.bkdn_code
										FROM tbl_fcoa_bkdn s2
										WHERE s2.my_id = {$my_id}
										");
		if ($fcoa_bkdn_sql->num_rows() > 0)
		{
			foreach ($fcoa_bkdn_sql->result() as $fb)
			{
				$fcoabkdn = $fb->bkdn_code."-".$fb->fcoa_bkdn;
				
				$get_fcoabkdn=$this->account->get_fcoa_bkdn($fb->fcoa_bkdn_id,$fb->fcoa_id,$fb->fcoa_bkdn,$sub_fcoa_bkdnArr);

				if(sizeof($get_fcoabkdn)>0){
						/*
						echo "<pre>";
							print_r($get_fcoabkdn);
						echo "</pre>";
						*/
					$total_fcoabkdn_dr=0;
					$total_fcoabkdn_cr=0;
					$fcoabkdn_ref_string="";
					foreach($get_fcoabkdn as $get_fcoabkdn_break){
						
						$total_fcoabkdn_dr+=$get_fcoabkdn_break['dr'];
						$total_fcoabkdn_cr+=$get_fcoabkdn_break['cr'];
						$fcoabkdn_ref_string.=$get_fcoabkdn_break['id']."-";
					}
					
					$fcoa_bkdn_arr_final[$fb->fcoa_bkdn_id]=array(
														"id"=>$fb->fcoa_bkdn_id,
														"parent"=>$fb->fcoa_id,
														"head"=>$fcoabkdn,
														"dr"=>$total_fcoabkdn_dr,
														"cr"=>$total_fcoabkdn_cr,
														"ref"=>$fcoabkdn_ref_string
														);
				}
			}
		}
		
		
		foreach($fcoa_bkdn_arr_final as $fcoa_bkdn_arr_final_push){
			$fcoa_bkdn_arr_final_push_id		=$fcoa_bkdn_arr_final_push["id"];
			$fcoa_bkdn_arr_final_push_parent	=$fcoa_bkdn_arr_final_push["parent"];
			$fcoa_bkdn_arr_final_push_head	 	=$fcoa_bkdn_arr_final_push["head"];
			$fcoa_bkdn_arr_final_push_dr		=$fcoa_bkdn_arr_final_push["dr"];
			$fcoa_bkdn_arr_final_push_cr		=$fcoa_bkdn_arr_final_push["cr"];
			$fcoa_bkdn_arr_final_push_ref		=$fcoa_bkdn_arr_final_push["ref"];
			
			$fcoa_bkdnArr["$fcoa_bkdn_arr_final_push_id"]=array(
													"id"=>$fcoa_bkdn_arr_final_push_id,
													"parent"=>$fcoa_bkdn_arr_final_push_parent,
													"head"=>$fcoa_bkdn_arr_final_push_head,
													"dr"=>$fcoa_bkdn_arr_final_push_dr,
													"cr"=>$fcoa_bkdn_arr_final_push_cr,
													"ref"=>$fcoa_bkdn_arr_final_push_ref
												);
		}
		
		
		$fcoa = $this->db->query("SELECT s1.fcoa_id, 
										s1.fcoa_master_id,
										s1.fcoa,
										s1.fcoa_code,
										SUM(gl.dr) AS dr, 
										SUM(gl.cr) AS cr
									FROM tbl_fcoa s1
									INNER JOIN tbl_general_ledger as gl ON gl.fcoa_id = s1.fcoa_id
									WHERE s1.my_id = {$my_id} {$where}
									GROUP BY s1.fcoa_id,s1.fcoa_master_id,s1.fcoa,s1.fcoa_code");
		if ($fcoa->num_rows() > 0)
		{
			foreach ($fcoa->result() as $f_row)
			{
				
			$fcoa_code = $f_row->fcoa_code."-".$f_row->fcoa;
			
			$fcoaArr["{$f_row->fcoa_id}"]=array(
												"id"=>$f_row->fcoa_id,
												"parent"=>$f_row->fcoa_master_id,
												"head"=>$fcoa_code,
												"dr"=>$f_row->dr,
												"cr"=>$f_row->cr,
												"ref"=>""
												);
			}
		}
		
		
		$fcoa_arr_final=array();

		$fcoa_sql = $this->db->query("SELECT s1.fcoa_id, 
									s1.fcoa_master_id,
									s1.fcoa,
									s1.fcoa_code
									FROM tbl_fcoa s1
									WHERE s1.my_id = {$my_id} 
									");
		if ($fcoa_sql->num_rows() > 0)
		{
			foreach ($fcoa_sql->result() as $frow)
			{
				$fcoacode = $frow->fcoa_code."-".$frow->fcoa;
				
				$get_fcoa=$this->account->get_fcoa_bkdn($frow->fcoa_id,$frow->fcoa_master_id,$frow->fcoa,$fcoa_bkdnArr);

				if(sizeof($get_fcoa)>0){
					
					$total_fcoa_dr=0;
					$total_fcoa_cr=0;
					$fcoa_ref_string="";
					foreach($get_fcoa as $get_fcoa_break){
						$total_fcoa_dr+=$get_fcoa_break['dr'];
						$total_fcoa_cr+=$get_fcoa_break['cr'];
						$fcoa_ref_string.=$get_fcoa_break['id']."-";
					}
					
					$fcoa_arr_final[$frow->fcoa_id]=array(
														"id"=>$frow->fcoa_id,
														"parent"=>$frow->fcoa_master_id,
														"head"=>$fcoacode,
														"dr"=>$total_fcoa_dr,
														"cr"=>$total_fcoa_cr,
														"ref"=>$fcoa_ref_string
														);
				}
			}
		}
			
		 
		/*echo  " FFFFFFFF <pre>";
			print_r($fcoa_arr_final);
		echo "</pre>---<br><br>";*/
			  
		
		
		foreach($fcoa_arr_final as $fcoa_arr_final_push){
			
			$fcoa_arr_final_push_id		=$fcoa_arr_final_push["id"];
			$fcoa_arr_final_push_parent	=$fcoa_arr_final_push["parent"];
			$fcoa_arr_final_push_head	=$fcoa_arr_final_push["head"];
			$fcoa_arr_final_push_dr		=$fcoa_arr_final_push["dr"];
			$fcoa_arr_final_push_cr		=$fcoa_arr_final_push["cr"];
			$fcoa_arr_final_push_ref	=$fcoa_arr_final_push["ref"];
			
			$fcoaArr["$fcoa_arr_final_push_id"]=array(
													"id"=>$fcoa_arr_final_push_id,
													"parent"=>$fcoa_arr_final_push_parent,
													"head"=>$fcoa_arr_final_push_head,
													"dr"=>$fcoa_arr_final_push_dr,
													"cr"=>$fcoa_arr_final_push_cr,
													"ref"=>$fcoa_arr_final_push_ref
													);
		}
		
		
		$return_Arr=array();
		/*
		$master_headArr=array();
		$fcoaArr=array();
		$fcoa_bkdnArr=array();
		$sub_fcoa_bkdnArr=array();
		echo "<pre>";
			print_r($sub_fcoa_bkdnArr);
		echo "</pre>";
		die();
		*/
		$return_Arr[0]=$sub_fcoa_bkdnArr;
		$return_Arr[1]=$fcoa_bkdnArr;
		$return_Arr[2]=$fcoaArr;
		
		return $return_Arr;
	}
	
	/*----------------------------------- Journal Voucher --------------------------*/
	
	function journal_voucher_list($my_id)
    {           
        $sql = "SELECT 	jv.id,
						jv.voucher_no, 
						jv.current_date,
						jv.purpose,
						jv.amount,
						jv.approve
				FROM 	tbl_journal_voucher jv
				inner join tbl_general_voucher as gv 
					on jv.voucher_no = gv.voucher_no
				WHERE 	jv.my_id = {$my_id} 
					ORDER BY jv.id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	function journal_voucher_row_edit($my_id,$debit_voucher_id)
    {           
        $sql = "SELECT 	dv.id,
						dv.voucher_no,
						dv.current_date,
						dv.purpose,
						dv.amount,
						dv.cheque_no,
						dv.cheque_dt,
						dv.bank
				FROM 	tbl_journal_voucher dv
				inner join tbl_general_voucher as gv 
					on dv.voucher_no = gv.voucher_no
				WHERE 	dv.my_id = {$my_id} 
					and	dv.id = {$debit_voucher_id}
					ORDER BY dv.id ASC";
					
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row; //echo $row['field name'];
    }
	
	function jourvoucher_bkdn_row_edit($my_id,$debit_voucher_id)
    {           
        $sql = "SELECT 	bk.id,
						bk.particulars,
						bk.account_code,
						bk.table_name,
						bk.table_id,
						bk.debit,
						bk.credit
				FROM 	tbl_journal_voucher dv
				inner join tbl_jrvoucher_bkdn as bk 
					on dv.id = bk.journal_voucher_id
				WHERE 	dv.my_id = {$my_id} 
					and	dv.id = {$debit_voucher_id}
					ORDER BY bk.id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	/*----------------------------------- Debit Voucher --------------------------*/
	
	function debit_voucher_list($my_id)
    {           
        $sql = "SELECT 	dv.id,
						dv.voucher_no, 
						dv.current_date,
						dv.pay_name,
						dv.purpose,
						dv.amount,
						dv.approve
				FROM 	tbl_debit_voucher dv
				inner join tbl_general_voucher as gv 
					on dv.voucher_no = gv.voucher_no
				WHERE 	dv.my_id = {$my_id} 
					ORDER BY dv.id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	function debit_voucher_row_edit($my_id,$debit_voucher_id)
    {           
        $sql = "SELECT 	dv.id,
						dv.voucher_no,
						dv.current_date,
						dv.pay_name,
						dv.purpose,
						dv.amount,
						dv.cheque_no,
						dv.cheque_dt,
						dv.bank
				FROM 	tbl_debit_voucher dv
				inner join tbl_general_voucher as gv 
					on dv.voucher_no = gv.voucher_no
				WHERE 	dv.my_id = {$my_id} 
					and	dv.id = {$debit_voucher_id}
					ORDER BY dv.id ASC";
					
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row; //echo $row['field name'];
    }
	
	function devoucher_bkdn_row_edit($my_id,$debit_voucher_id)
    {           
        $sql = "SELECT 	bk.devoucher_bkdn_id,
						bk.particulars,
						bk.account_code,
						bk.table_name,
						bk.table_id,
						bk.debit,
						bk.credit,
						bk.hide_invoice
				FROM 	tbl_debit_voucher dv
				inner join tbl_devoucher_bkdn as bk 
					on dv.id = bk.debit_voucher_id
				WHERE 	dv.my_id = {$my_id} 
					and	dv.id = {$debit_voucher_id}
					ORDER BY bk.devoucher_bkdn_id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	/*----------------------------------- Credit Voucher --------------------------*/
	
	function credit_voucher_list($my_id)
    {           
        $sql = "SELECT 	cr.id, 
						cr.voucher_no, 
						cr.current_date,
						cr.pay_name,
						cr.purpose,
						cr.amount
				FROM 	tbl_credit_voucher cr
				inner join tbl_general_voucher as gv 
					on cr.voucher_no = gv.voucher_no
				WHERE 	cr.my_id = {$my_id} 
					ORDER BY cr.id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	function credit_voucher_row_edit($my_id,$debit_voucher_id)
    {           
        $sql = "SELECT 	cr.id, 
						cr.voucher_no, 
						cr.current_date,
						cr.pay_name,
						cr.purpose,
						cr.amount,
						cr.cheque_no,
						cr.cheque_dt,
						cr.bank
				FROM 	tbl_credit_voucher cr
				inner join tbl_general_voucher as gv 
					on cr.voucher_no = gv.voucher_no
				WHERE 	cr.my_id = {$my_id} 
					and	cr.id = {$debit_voucher_id}
					ORDER BY cr.id ASC";
					
		$query = $this->db->query($sql);
		$row = $query->row_array();
		return $row; //echo $row['field name'];
    }
	
	function crvoucher_bkdn_row_edit($my_id,$debit_voucher_id)
    {           
        $sql = "SELECT 	bk.id,
						bk.particulars,
						bk.account_code,
						bk.table_name,
						bk.table_id,
						bk.debit,
						bk.credit,
						bk.hide_invoice
				FROM 	tbl_credit_voucher cr
				inner join tbl_crvoucher_bkdn as bk 
					on cr.id = bk.credit_voucher_id
				WHERE 	cr.my_id = {$my_id} 
					and	cr.id = {$debit_voucher_id}
					ORDER BY bk.id ASC";
		
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	/*----------------------------------- Common --------------------------*/
	
	function create_voucher_no($my_id)
    {   
		$rec_date = date('Y-m-d H:i:s',time());
		$voucher_no="";
		$query = $this->db->query('SELECT MAX(voucher_no) AS Voucher_No FROM tbl_general_voucher where my_id=1');	
        $row = $query->row();
		$voucher_no = $row->Voucher_No;
		
		if($voucher_no>0){
			$voucher_no+=1;
			$sql = "INSERT INTO tbl_general_voucher (my_id,voucher_no,rec_date) VALUES ('1','".$voucher_no."','".$rec_date."')";
			$query = $this->db->query($sql);
			if($this->db->affected_rows()>0){
				return $voucher_no;
			}
			else {
				$voucher_no="";
			}
		}
		else {
			$voucher_no=1001;
			$sql = "INSERT INTO tbl_general_voucher (my_id,voucher_no,rec_date) VALUES ('1','".$voucher_no."','".$rec_date."')";
			
			$query = $this->db->query($sql);
			if($this->db->affected_rows()>0){
				return $voucher_no;
			}
			else {
				return $voucher_no;
			}
		}
    }
    
	
	
	/**************** processing charge *************************/
	
	function get_processing_charge()
    {           
        $sql = "SELECT 	workerId,sum(amount) as PayAble
				FROM tbl_processing_charge
				group by workerId
				ORDER BY workerId ASC";
        $query = $this->db->query($sql);
        $row= $query->result_array();
        return $row;
    }
	
	
}
?>