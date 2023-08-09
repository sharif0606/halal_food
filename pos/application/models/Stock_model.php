<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

	//Datatable start
	var $table = 'db_stock_exc';
	var $column_order = array( 'id','exc_date','exc_note','created_by','(select warehouse_name from db_warehouse where db_warehouse.id=db_stock_exc.warehouse_from) as warf','(select warehouse_name from db_warehouse where db_warehouse.id=db_stock_exc.warehouse_to) as wart'); //set column field database for datatable orderable
	var $column_search = array('exc_date','exc_note','created_by'); //set column field database for datatable searchable 
	var $order = array('id' => 'desc'); // default order  

	public function __construct(){
		parent::__construct();
		$CI =& get_instance();
	}

	private function _get_datatables_query(){
		$this->db->select($this->column_order);
		$this->db->from($this->table);
		$i = 0;
		foreach ($this->column_search as $item){ // loop column 
			if($_POST['search']['value']){ // if datatable send POST for search
				if($i===0){ // first loop
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				
				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}$i++;
		}
		
		if(isset($_POST['order'])){ // here order processing
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->order)){
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables(){
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered(){
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all(){
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	//Datatable end

	public function xss_html_filter($input){
		return $this->security->xss_clean(html_escape($input));
	}

	//Save Sales
	public function verify_save_and_update(){
		//Filtering XSS and html escape from user inputs 
		extract($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));
		//echo "<pre>";print_r($this->xss_html_filter(array_merge($this->data,$_POST,$_GET)));exit();
		
		$this->db->trans_begin();
		$entry_date=date('Y-m-d',strtotime($entry_date));
        
        $exc_entry = array(
		    				'exc_date' 			=> $entry_date, 
		    				'warehouse_from' 	=> $warehouse_from, 
		    				'warehouse_to' 		=> $warehouse_to,
		    				'exc_note' 			=> $exc_note,
		    				'created_date' 		=> $CUR_DATE,
		    				'created_time' 		=> $CUR_TIME,
		    				'created_by' 		=> $CUR_USERNAME,
		    				'system_ip' 		=> $SYSTEM_IP,
		    				'system_name' 		=> $SYSTEM_NAME,
		    				'status' 			=> 1
		    			);

			$q1 = $this->db->insert('db_stock_exc', $exc_entry);
			$stock_ex_id = $this->db->insert_id();
			
        if($stock_ex_id){
    		//Import post data from form
    		for($i=0;$i<=$rowcount;$i++){
    			if(isset($_REQUEST['tr_item_id_'.$i]) && !empty($_REQUEST['tr_item_id_'.$i])){
    			    
    				$item_id =$this->xss_html_filter(trim($_REQUEST['tr_item_id_'.$i]));
    				$qty	 =$this->xss_html_filter(trim($_REQUEST['td_data_'.$i.'_3']));
    				
    				$to_entry = array(
    		    				'entry_date' 	=> $entry_date, 
    		    				'item_id' 		=> $item_id, 
    		    				'qty' 		    => $qty,
    		    				'note' 	        => "Exchange From ".$warehouse_from,
    		    				'warehouse_id' 	=> $warehouse_to,
    		    				'status'	 		=> 1,
    		    				'exc_id'	 		=> $stock_ex_id,
    		    			);
    				$from_entry = array(
    		    				'entry_date' 	=> $entry_date, 
    		    				'item_id' 		=> $item_id, 
    		    				'qty' 		    => "-".$qty,
    		    				'note' 	        => "Exchange To ".$warehouse_to,
    		    				'warehouse_id' 	=> $warehouse_from,
    		    				'status'	 		=> 1,
    		    				'exc_id'	 		=> $stock_ex_id,
    		    			);
    				
    				$q2 = $this->db->insert('db_stockentry', $to_entry);
    				$q2 = $this->db->insert('db_stockentry', $from_entry);
    			}
    		
    		}//for end
    		
    		$this->db->trans_commit();
    	}
		$this->session->set_flashdata('success', 'Success!! Record Saved Successfully! ');
		return "success<<<###>>>";
		
	}//verify_save_and_update() function end

	
	public function delete_stock($ids){
      	$this->db->trans_begin();
		$q7=$this->db->query("delete from db_stockentry where exc_id =$ids");
		$q3=$this->db->query("delete from db_stock_exc where id=$ids");
		$this->db->trans_commit();
		return "success";
	}
	public function search_item($q){
		$json_array=array();
        $query1="select id,item_name from db_items where (upper(item_name) like upper('%$q%') or upper(item_code) like upper('%$q%'))";

        $q1=$this->db->query($query1);
        if($q1->num_rows()>0){
            foreach ($q1->result() as $value) {
            	$json_array[]=['id'=>(int)$value->id, 'text'=>$value->item_name];
            }
        }
        return json_encode($json_array);
	}
	
	public function find_item_details($id){
		$json_array=array();
        $query1="select id,hsn,alert_qty,unit_name,sales_price,sales_price,gst_percentage,available_qty from db_items where id=$id";

        $q1=$this->db->query($query1);
        if($q1->num_rows()>0){
            foreach ($q1->result() as $value) {
            	$json_array=['id'=>$value->id, 
        			 'hsn'=>$value->hsn,
        			 'alert_qty'=>$value->alert_qty,
        			 'unit_name'=>$value->unit_name,
        			 'sales_price'=>$value->sales_price,
        			 'sales_price'=>$value->sales_price,
        			 'gst_percentage'=>$value->gst_percentage,
        			 'available_qty'=>$value->available_qty,
        			];
            }
        }
        return json_encode($json_array);
	}

	public function get_items_info($rowcount,$item_id,$stock){
		$q1=$this->db->select('*')->from('db_items')->where("id=$item_id")->get();
		$q3=$this->db->query("select * from db_tax where id=".$q1->row()->tax_id)->row();

		//$stock	=	$q1->row()->stock;

		$qty = ($stock>1) ? 1 : $stock;
	      
		$info['item_id'] = $q1->row()->id;
		$info['item_name'] = $q1->row()->item_name;
		$info['item_sales_qty'] = $qty;
		$info['item_available_qty'] = $stock;
        if($stock>0)
		    $this->return_row_with_data($rowcount,$info);
		else
		    return false;
	}
}
