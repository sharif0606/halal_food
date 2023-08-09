<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banks extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('banks_model','banks');
	}

	public function add(){
		//$this->permission_check('feeSettings_add');
		//$data['page_title']=$this->lang->line('banks');
		$data=$this->data;
		$data['page_title']=$this->lang->line('banks');
		$this->load->view('bank', $data);
	}

	//ITS FROM POP UP MODAL
    public function add_unit_modal(){

      $this->form_validation->set_rules('bank_name', 'bank Name', 'trim|required');
      if ($this->form_validation->run() == TRUE) {
      	
        $result=$this->banks->verify_and_save();
        //fetch latest item details
        $res=array();
        $query=$this->db->query("select id,bank_name from db_banks order by id desc limit 1");
        $res['id']=$query->row()->id;
        $res['bank']=$query->row()->bank_name;
        $res['result']=$result;
        echo json_encode($res);
      } 
      else {
        echo "Please Fill Compulsory(* marked) Fields.";
      }
    }
    //END

	public function new_bank(){

		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		//$this->form_validation->set_rules('description', 'Description', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			
			$result=$this->banks->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter Bank Name.";
		}
	}
	public function update($id){
		//echo $id;exit;
		$this->permission_check('banks_edit');
		$data=$this->data;
		$result=$this->banks->get_details($id,$data);
		//echo $result;exit;
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('banks');
		$this->load->view('bank',$data);
	}
	public function update_Bank(){
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->banks->update_Bank();
			echo $result;
		} else {
			echo "Please Enter Bank name.";
		}
	}
	public function index(){
		$this->permission_check('banks_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('banks_list');
		$this->load->view('banks-list', $data);
	}

	public function ajax_list()
	{
		$list = $this->banks->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $bank) {
			$no++;
			$row = array();
			$row[] = $bank->bank_name;
			$row[] = $bank->description;

			 		if($bank->status==1){ 
			 			$str= "<span onclick='update_status(".$bank->id.",0)' id='span_".$bank->id."'  class='label label-success' style='cursor:pointer'>Active </span>";}
					else{ 
						$str = "<span onclick='update_status(".$bank->id.",1)' id='span_".$bank->id."'  class='label label-danger' style='cursor:pointer'> Inactive </span>";
					}
			$row[] = $str;			
			         $str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('banks_edit'))
											$str2.='<li>
												<a title="Editd Record ?" href="'.base_url('banks/update/'.$bank->id).'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('banks_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_bank('.$bank->id.')">
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
						"recordsTotal" => $this->banks->count_all(),
						"recordsFiltered" => $this->banks->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function update_status(){
		$this->permission_check_with_msg('banks_edit');
		$id=$this->input->post('id');
		$status=$this->input->post('status');
		$result=$this->banks->update_status($id,$status);
		return $result;
	}
	public function delete_bank(){
		$this->permission_check_with_msg('banks_delete');
		$id=$this->input->post('q_id');
		$result=$this->banks->delete_bank($id);
		return $result;
	}
}

