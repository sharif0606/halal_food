<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onlineorder_model extends CI_Model {

	var $table = 'orders';
	var $column_order = array(null,'orders.user_id','orders.billing_id','orders.sub_total','orders.total','orders.status'); //set column field database for datatable orderable
	var $column_search = array('orders.user_id','orders.billing_id','orders.sub_total','orders.total','orders.status'); //set column field database for datatable searchable
	var $order = array('orders.id' => 'desc'); // default order

	private function _get_datatables_query()
	{
        $this->db->select('orders.*,db_customers.customer_name,db_customers.mobile');
		$this->db->from($this->table);
	    $this->db->join('db_customers','orders.user_id=db_customers.id');

		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if(isset($_POST['search']['value'])) // if datatable send POST for search
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
		//if($_POST['length'] != -1)
		//$this->db->limit($_POST['length'], $_POST['start']);
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


        $query1="insert into orders(user_id,billing_id,sub_total,total,paymenttype_id,status)
                            values('$user_id','$billing_id','$sub_total','$total','$paymenttype_id','$status')";
        if ($this->db->simple_query($query1)){
                $this->session->set_flashdata('success', 'Success!! New Added Successfully!');
                return "success";
        }
        else{
                return "failed";
        }

	}

	//Get category_details
	public function get_details($id,$data){
		//Validate This category already exist or not
		$query=$this->db->query("select * from orders where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['user_id']=$query->user_id;
			$data['billing_id']=$query->billing_id;
			$data['sub_total']=$query->sub_total;
			$data['total']=$query->total;
			$data['status']=$query->status;
			$data['paymenttype_id']=$query->paymenttype_id;
			return $data;
		}
	}
	public function update_onlineorder(){
		//Filtering XSS and html escape from user inputs
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));
        $stockflag="";
            $stock_qury="SELECT order_details.product_id, db_items.item_code,db_items.item_name, sum((select sum(qty) from db_stockentry where db_stockentry.item_id=order_details.product_id) - `product_qty`) as stock FROM `order_details` join db_items on db_items.id=order_details.product_id WHERE order_details.order_id=$q_id";
            if($stock=$this->db->query($stock_qury)){
                foreach($stock->result() as $st){
                    if($st->stock < 0){
                        $stockflag.= $st->item_code." - ".$st->item_name;

                    }
                }
            }
            if($stockflag!=""){
                return "$stockflag  is/are not in stock. Add product in stock then try again";
            }

			$query1="update orders set status='$status',paymenttype_id='$paymenttype_id' where id=$q_id";
			if ($this->db->simple_query($query1)){
                if($status==2){
                    $order_item=$this->db->query("select * from order_details where order_id=$q_id")->result();
                    if($order_item){
                        $this->db->query("delete from db_stockentry where order_id=$q_id");// delete if old data found under this order
                        foreach($order_item as $items){
                            $to_entry = array(
    		    				'entry_date' 	=> date('Y-m-d'),
    		    				'item_id' 		=> $items->product_id,
    		    				'qty' 		    => "-".$items->product_qty,
    		    				'note' 	        => "Online Order",
    		    				'warehouse_id' 	=> 1,
    		    				'status'	 	=> 1,
    		    				'order_id' 		=> $q_id,
    		    			);
    		                $qtoentry = $this->db->insert('db_stockentry', $to_entry);
                        }
						$orderdata=$this->db->query("select * from orders where id=$q_id")->row();
						//$billing=$this->db->query("select * from billings where id='".$orderdata->billing_id."'")->row();
						$customer_payment = array(
							'order_id' 			=> $orderdata->id,
							'customer_id' 		=> $orderdata->user_id,
							'payment_date' 		=> date("Y-m-d"),
							'payment_type' 		=> $paymenttype_id,//$billing->payment_method
							'payment' 			=> $orderdata->total,
							'payment_note' 		=> "Full Pay",
							'created_date' 		=> $CUR_DATE,
							'created_time' 		=> $CUR_TIME,
							'created_by' 		=> $CUR_USERNAME,
							'system_ip' 		=> $SYSTEM_IP,
							'system_name' 		=> $SYSTEM_NAME,
							'status' 			=> 1,
						);
						$q1=$this->db->insert("order_payments",$customer_payment);
                    }
                }else{

                    $this->db->query("delete from order_payments where order_id=$q_id");// delete if old data found under this order
                    $this->db->query("delete from db_stockentry where order_id=$q_id");// delete if old data found under this order
                }

                $this->session->set_flashdata('success', 'Success!! Updated Successfully!');
                return "success";
			}
			else{
			    return "failed";
			}

	}

	public function delete_order_from_table($ids){
		$this->db->query("delete from order_payments where order_id in ($ids)");// delete if old data found under this order
		$query1="delete from orders where id in($ids)";
		if ($this->db->simple_query($query1))
			echo "success";
		else
			echo "failed";
	}


}
