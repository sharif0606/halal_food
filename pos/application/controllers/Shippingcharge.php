<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shippingcharge extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Shippingcharge_model','shippingcharge');
	}

	public function add(){
		$this->permission_check('items_category_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('shippingcharge');
		$this->load->view('shippingcharge', $data);
	}


	public function newShipping(){
		$this->form_validation->set_rules('district_id', 'District', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->shippingcharge->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter District name.";
		}
	}
	public function update($id){
		$this->permission_check('items_category_edit');
		$data=$this->data;

		$result=$this->shippingcharge->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('shippingcharge');
		$this->load->view('shippingcharge', $data);
	}
	public function update_shipping(){
		$this->form_validation->set_rules('district_id', 'District', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->shippingcharge->update_shipping();
			echo $result;
		} else {
			echo "Please Enter District.";
		}
	}
	public function view(){
		$this->permission_check('items_category_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('shippingcharge_list');
		$this->load->view('shippingcharge-view', $data);
	}

	public function ajax_list()
	{
		$list = $this->shippingcharge->get_datatables();

		$data = array();
		//$no = $_POST['start'];
        //echo $this->db->last_query();
        //print_r($list);

		foreach ($list as $shippingcharge) {
			//$no++;
			$row = array();
			$row[] = $shippingcharge->bn_name;
			$row[] = $shippingcharge->shipping_charge;

					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('items_category_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="update/'.$shippingcharge->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('items_category_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_shipping('.$shippingcharge->id.')">
													<i class="fa fa-fw fa-trash text-red"></i>Delete
												</a>
											</li>

										</ul>
									</div>';

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
						"draw" => "",//$_POST['draw'],
						"recordsTotal" => $this->shippingcharge->count_all(),
						"recordsFiltered" => $this->shippingcharge->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function delete_shipping(){
        $this->load->model('shippingcharge_model');
		$this->permission_check_with_msg('items_category_delete');
		$id=$this->input->post('q_id');
		return $this->shippingcharge_model->delete_shipping_from_table($id);
	}


}

