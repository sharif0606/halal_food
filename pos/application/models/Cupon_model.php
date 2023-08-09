<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cupon_model extends CI_Model {

	var $table = 'db_cupon';
	var $column_order = array(null,'cupon_code','cupon_name','number_of','start_date','finish_date','discount_type','discount','status'); //set column field database for datatable orderable
	var $column_search = array('cupon_code','cupon_name','number_of','start_date','finish_date','discount_type','discount','status'); //set column field database for datatable searchable
	var $order = array('id' => 'desc'); // default order

	private function _get_datatables_query()
	{

		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{

				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		// if($_POST['length'] != -1)
		// $this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	public function verify_and_save(){
		//Filtering XSS and html escape from user inputs
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

			$query1="insert into db_cupon(cupon_code,cupon_name,number_of,start_date,finish_date,discount_type,discount,status)
								values('$cupon_code','$cupon_name','$number_of','$start_date','$finish_date','$discount_type','$discount',1)";
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! New cupon Added Successfully!');
			        return "success";
			}
			else{
			        return "failed";
			}
		}

	//Get cupon_details
	public function get_details($id,$data){
		//Validate This cupon already exist or not
		$query=$this->db->query("select * from db_cupon where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['cupon_code']=$query->cupon_code;
			$data['cupon_name']=$query->cupon_name;
			$data['number_of']=$query->number_of;
			$data['start_date']=$query->start_date;
			$data['finish_date']=$query->finish_date;
			$data['discount_type']=$query->discount_type;
			$data['discount']=$query->discount;
			$data['status']=$query->status;
			return $data;
		}
	}
	public function update_cupon(){
		//Filtering XSS and html escape from user inputs
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

        $query1="update db_cupon set cupon_name='$cupon_name',cupon_code='$cupon_code',number_of='$number_of',start_date='$start_date',finish_date='$finish_date',discount_type='$discount_type',discount='$discount',status=1 where id=$q_id";
        if ($this->db->simple_query($query1)){
                $this->session->set_flashdata('success', 'Success!! cupon Updated Successfully!');
                return "success";
        }
        else{
                return "failed";
        }
	}
	public function delete_cupon_from_table($ids){
        $query1="delete from db_cupon where id in($ids)";
        if ($this->db->simple_query($query1)){
            echo "success";
        }
        else{
            echo "failed";
        }
	}


}
