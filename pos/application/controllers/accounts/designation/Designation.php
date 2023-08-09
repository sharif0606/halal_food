<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
		
	}
	public function index()
	{
		$data['page']="accounts/designation/add_Designation";
		$this->load->view('accounts/template',$data);
	}
	public function add(){
		//$data = MyList::input($_POST);
		/*$this->form_validation->set_rules('member_Name', 'Member name', 'required');
		if ($this->form_validation->run() == FALSE)
        {
			$data['page']="member/member_Admission";
			$this->load->view('template',$data);
		}else{*/
			$data = $this->input->post(NULL, TRUE);
			$data['created_by']=$this->session->userdata('admin_logged_in')['id'];
            $data['created_on']=date('Y-m-d H:i:s',time());
			$result = $this->Common_model->common_insert($data,'tbl_designation');
			redirect('accounts/designation/Designation/Lists');
		//}	
	}
	public function lists(){
		//$data['status'] = 1;
		//$data['designation_Lists'] = $this->Common_model->common_select_by_condition('tbl_designation','*',$data);
		$data['designation_Lists'] = $this->Common_model->common_result_array('tbl_designation');
		//print_r($data);
		$data['page']="accounts/designation/designation_Lists";
		$this->load->view('accounts/template',$data);	
	}
	public function edit(){
		$id['id'] = $_GET['id'];
		$data['designation_By_id'] =  $this->Common_model->common_select_by_condition_row('tbl_designation','*',$id);
		$data['page'] = 'accounts/designation/edit_designation_By_Id';
		$this->load->view('accounts/template',$data);
	}
	public function update(){
		$id =$this->input->post('id', TRUE);
		$data = $this->input->post(NULL, TRUE);
		$data['updated_by']=$this->session->userdata('admin_logged_in')['id'];
		$data['updated_on']=date('Y-m-d H:i:s',time());
		$result = $this->Common_model->common_update($data,$id,'id','tbl_designation');
		redirect('accounts/designation/Designation/Lists');
	}
	public function inactive()
	{
		$id = $_GET['id'];
		$status = $_GET['status'];
		if($status == 1){
		$data['status'] = 0;
		$data['updated_by']=$this->session->userdata('admin_logged_in')['id'];
		$data['updated_on']=date('Y-m-d H:i:s',time());
		$result = $this->Common_model->common_update($data,$id,'id','tbl_designation');
		}else{
			$data['status'] = 1;
			$data['updated_by']=$this->session->userdata('admin_logged_in')['id'];
			$data['updated_on']=date('Y-m-d H:i:s',time());
			$result = $this->Common_model->common_update($data,$id,'id','tbl_designation');
		}
		redirect('accounts/designation/Designation/Lists');
	}
}
