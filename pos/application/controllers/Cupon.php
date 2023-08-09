<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cupon extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Cupon_model','cupon');
	}

	public function add(){
		$this->permission_check('items_cupon_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('cupon');
		$this->load->view('cupon', $data);
	}

	//ITS FROM POP UP MODAL
	//   public function add_cupon_modal(){
	//     $this->form_validation->set_rules('cupon_name', 'Cupon Name', 'trim|required');
	//     if ($this->form_validation->run() == TRUE) {
	//       $result=$this->cupon->verify_and_save();
	//       //fetch latest item details
	//       $res=array();
	//       $query=$this->db->query("select id,cupon_name from db_cupon order by id desc limit 1");
	//       $res['id']=$query->row()->id;
	//       $res['cupon']=$query->row()->cupon_name;
	//       $res['result']=$result;

	//       echo json_encode($res);

	//     }
	//     else {
	//       echo "Please Fill Compulsory(* marked) Fields.";
	//     }
	//   }
	  //END

	public function newCupon(){
		$this->form_validation->set_rules('cupon_name', 'Cupon Name', 'trim|required');


		if ($this->form_validation->run() == TRUE) {

			$result=$this->cupon->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter cupon name.";
		}
	}
	public function update($id){
		$this->permission_check('items_cupon_edit');
		$data=$this->data;

		$result=$this->cupon->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('cupon');
		$this->load->view('cupon', $data);
	}
	public function update_cupon(){
		$this->form_validation->set_rules('cupon_name', 'Cupon Name', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->cupon->update_cupon();
			echo $result;
		} else {
			echo "Please Enter cupon name.";
		}
	}
	public function view(){
		$this->permission_check('items_cupon_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('cupon_list');
		$this->load->view('cupon-view', $data);
	}

	public function ajax_list()
	{
		$list = $this->cupon->get_datatables();

		$data = array();
		// $no = $_POST['start'];
		foreach ($list as $cupon) {
			// $no++;
			$row = array();
			// $row[] = '<input type="checkbox" name="checkbox[]" value='.$cupon->id.' class="checkbox column_checkbox" >';
			$row[] = $cupon->cupon_code;
			$row[] = $cupon->cupon_name;
			$row[] = $cupon->number_of;
			$row[] = $cupon->start_date;
			$row[] = $cupon->finish_date;
			if($cupon->discount_type==0){
                    $strs= "<span class='label label-success' style='cursor:pointer'>% </span>";}
                else{
                    $strs = "<span class='label label-success' style='cursor:pointer'> BDT </span>";
                }
			$row[] = $strs;

			$row[] = $cupon->discount;


					$str2 = '<div class="btn-group" title="View Account">
                                <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                    Action <span class="caret"></span>
                                </a>
                                <ul role="menu" class="dropdown-menu dropdown-light pull-right">';

                                    if($this->permissions('items_cupon_edit'))
                                    $str2.='<li>
                                        <a title="Edit Record ?" href="update/'.$cupon->id.'">
                                            <i class="fa fa-fw fa-edit text-blue"></i>Edit
                                        </a>
                                    </li>';

                                    if($this->permissions('items_cupon_delete'))
                                    $str2.='<li>
                                        <a style="cursor:pointer" title="Delete Record ?" onclick="delete_cupon('.$cupon->id.')">
                                            <i class="fa fa-fw fa-trash text-red"></i>Delete
                                        </a>
                                    </li>

                                </ul>
                            </div>';

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cupon->count_all(),
						"recordsFiltered" => $this->cupon->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function delete_cupon(){
        $this->load->model('cupon_model');
		$this->permission_check_with_msg('items_cupon_delete');
		$id=$this->input->post('q_id');
		return $this->cupon_model->delete_cupon_from_table($id);
	}

}

