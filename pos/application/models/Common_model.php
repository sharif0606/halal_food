<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function common_insert($data,$table_name){
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
	function common_insert_batch($data,$table_name){
        $this->db->insert_batch($table_name, $data);
        return $this->db->insert_id();
    }
	function common_delete($data,$table_name){
        $this->db->delete($table_name, $data);
		$return = $this->db->affected_rows();
		return $return; 
    }
    
    
    function common_update($data,$condition_id_value,$condition_id,$table_name){
        $this->db->where($condition_id, $condition_id_value);
        $this->db->update($table_name, $data);
		$return = $this->db->affected_rows();
		return $return;
    }
	
	function common_update_multi_condition($data,$con,$table_name){
        $this->db->where($con);
        $this->db->update($table_name, $data);
		$return = $this->db->affected_rows();
		return $return;
    }
	
	/*
		*Generates an update string based on the data you supply, and runs the query. You can either pass an array or an object to the function.
	*/
	function common_batch_update($table_name,$data,$condition_id){
        $this->db->trans_start();
		$this->db->update_batch($table_name, $data, $condition_id);
		$this->db->trans_complete();        
    	return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }
	
	function common_update_bulk($data,$condition_id_value,$condition_id,$table_name){
        $this->db->where_in($condition_id, $condition_id_value);
        $this->db->update($table_name, $data);
		$return = $this->db->affected_rows();
		return $return;
    }
	
    function common_row_array($table_name){
        $this->db->from($table_name);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;   
    }
    function common_result_array($table_name){
        $this->db->from($table_name);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;   
    }
	
	public function common_select_by_condition($table,$select_field,$cdata=FALSE,$order_field=FALSE,$sort=FALSE,$ex_con=false){
		$this->db->select($select_field);
		
		if($cdata)
		$this->db->where($cdata);
	
		if($ex_con)
		$this->db->where($ex_con, NULL, FALSE);
		
		if($order_field && $sort)
			$this->db->order_by($order_field,$sort);
	
		$query = $this->db->get($table);
		$result = $query->result_array();
        return $result;   
    }
	/*$cdata=FALSE this argument is used by array remind it*/
	public function common_select_by_condition_row($table,$select_field,$cdata=FALSE){
		$this->db->select($select_field);
		
		if($cdata)
		$this->db->where($cdata);
	
		$query = $this->db->get($table);
		$result = $query->row_array();
        return $result;   
    }
	public function id_Increment($table_name,$select_field){
		$maxid = 0;
		$row = $this->db->query('SELECT MAX('.$select_field.') AS `maxid` FROM'.' '.$table_name)->row();
		if ($row) {
			$maxid = $row->maxid; 
			$maxid++;
			return $maxid;
		}
	}
	public function search_Ajax($table_name,$select_field,$query,$cdata){
		//$row = $this->db->query("SELECT member_Id FROM tbl_members WHERE tbl_members.member_Id LIKE '%$query%'")->row();
		/*$this->db->select($select_field);
		$this->db->like($cdata, $query, 'both'); 
		$query = $this->db->get($table_name)->row();
		if ($query) {
			return $query;
		}*/
		$this->db->select($select_field);
		$this->db->like($cdata, $query ,'both');
		$query=$this->db->get($table_name);
		$result=$query->result_array();
		if(count($result))
		{
		return $result;
		}
		else
		{
		return FALSE;
		}
	}

	
	
	
	
	
	function show($table,$field="",$id="",$select="",$order_by=""){
        
		if(!$select){ $select ="*"; } $this->db->select($select);
		if($order_by){ $orderby = explode(',',$order_by); $this->db->order_by($orderby[0],$orderby[1]); } 
		if($id) { $result = $this->db->get_where($table, array($field => $id)); 
		} else { $result = $this->db->get($table);}
	       
           if($result->num_rows()>0)
            return $result->result();

        return false;
	}

		public function common_select_field_by_condition($table,$cdata,$order_field,$sort,$select_field)
	{
		$this->db->select($select_field);
		$this->db->where($cdata);
		
		if($order_field && $sort)
			$this->db->order_by($order_field,$sort);
	
		$query = $this->db->get($table);
		if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$data[] = $row;
				}
				return $data;
			}
			else
			{
				return 0;
			}
    }
	
	
	
}
?>