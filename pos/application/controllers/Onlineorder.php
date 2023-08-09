<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onlineorder extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Onlineorder_model','onlineorder');
	}

	public function add(){
		$this->permission_check('items_category_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('online_order');
		$this->load->view('onlineorder', $data);
	}

    public function online_invoice($invid){
		$data['billings']=$this->db->query("select * from billings where id=$invid")->row();
		$data['frontsettings']=$this->db->query("select logo_img from frontsettings")->row();
		$data['orders']=$this->db->query("select * from orders where billing_id=$invid")->row();
		$data['order_details']=$this->db->query("SELECT order_details.*, db_items.item_name FROM order_details LEFT JOIN db_items ON order_details.product_id = db_items.id where order_id=$invid")->result();
		$data['page_title']=$this->lang->line('online_order');
		$this->load->view('onlineorder_invoice', $data);
	}

	public function newonlineorder(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->onlineorder->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter Title name.";
		}
	}
	public function update($id){
		$this->permission_check('items_category_edit');
		$data=$this->data;

		$result=$this->onlineorder->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('online_order');
		$this->load->view('onlineorder', $data);
	}
	public function update_onlineorder(){
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->onlineorder->update_onlineorder();
			echo $result;
		} else {
			echo "Please Enter Status.";
		}
	}
	public function view(){
		$this->permission_check('items_category_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('online_order_list');
		$this->load->view('onlineorder-view', $data);
	}

	public function ajax_list()
	{
		$list = $this->onlineorder->get_datatables();

		$data = array();
		//$no = $_POST['start'];
        //echo $this->db->last_query();
        //print_r($list);

		foreach ($list as $order) {
			//$no++;
			$row = array();
			$row[] = $order->customer_name."-".$order->mobile;
			$row[] = date('d/m/Y', strtotime($order->created_at));
			$row[] = $order->billing_id;
			$row[] = $order->sub_total;
			$row[] = $order->total;
            if($order->status==0){
                $strs= "<span class='label label-warning' style='cursor:pointer'>Pending </span>";
            }else if($order->status==1){
                $strs = "<span class='label label-info' style='cursor:pointer'> Processing </span>";
            }else if($order->status==2){
                $strs = "<span class='label label-success' style='cursor:pointer'> Delivered </span>";
            }else{
                $strs = "<span class='label label-danger' style='cursor:pointer'> Cancel </span>";
            }
            $row[] = $strs;

					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('items_category_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="update/'.$order->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';
											$str2.='<li>
												<a title="Edit Record ?" href="online_invoice/'.$order->id.'">
													<i class="fa fa-fw fa-list text-blue"></i>Invoice
												</a>
											</li>';

											if($this->permissions('items_category_delete'))
											// $str2.='<li>
											// 	<a style="cursor:pointer" title="Delete Record ?" onclick="delete_order('.$order->id.')">
											// 		<i class="fa fa-fw fa-trash text-red"></i>Delete
											// 	</a>
											// </li>';

										$str2.='</ul>
									</div>';

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
						"draw" => "",//$_POST['draw'],
						"recordsTotal" => $this->onlineorder->count_all(),
						"recordsFiltered" => $this->onlineorder->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function delete_order(){
        $this->load->model('onlineorder_model');
		$this->permission_check_with_msg('items_order_delete');
		$id=$this->input->post('q_id');
		return $this->onlineorder_model->delete_order_from_table($id);
	}


}

