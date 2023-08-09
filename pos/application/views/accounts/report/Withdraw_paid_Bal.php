<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Withdraw_paid_Bal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
		$this->load->library('session');
		if(MyAuth::getAccess('admin')){
			redirect('auth/auth_login');
			exit;
		}
		/*
		if(MyAuth::getPageAccess("category")){
			redirect('dashboard');
			exit;
		}*/
	}
	public function index()
	{
		/*$data['member_Info'] = $this->db->query("SELECT tbl_members.member_Id, tbl_samity.samity_Name, tbl_members.member_Id,tbl_members.present_Address  FROM tbl_members INNER JOIN tbl_samity on tbl_samity.samity_Code = tbl_members.samity_Name where member_Id = '001-01-01'")->result_array();*/

		$data['deposit_Info'] = $this->db->query('SELECT distinct samity_Name,samity_Code from tbl_samity')->result_array();
		/*$data['id'] = $this->Common_model->id_Increment('tbl_loan_assign','id');
		$data['loan_Cycle'] = $this->Common_model->id_Increment('tbl_loan_assign','loan_Cycle');
		$data['product_Lists'] = $this->Common_model->common_result_array('tbl_loan_type');	
		$status['status'] = 1;		
		$data['loan_Purpose'] = $this->Common_model->common_select_by_condition('tbl_loan_purpose','*',$status);
		$a['status'] = 1;		
		$data['payment_Frequency'] = $this->Common_model->common_select_by_condition('tbl_payment_mode','*',$status);	*/	
		$data['page']="withdraw/withdraw_paid_Bal";
		$this->load->view('template',$data);
	}
	public function paid(){
			$saving_Code = $this->input->post('saving_Code');
			$member_Id = $this->input->post('member_Id');
			$profit = $this->input->post('profit');
			$dep_Avil=  $this->db->query("select (select 
					sum(p_Amt) from tbl_deposit_paid where saving_Code = '$saving_Code') -
					(select COALESCE(sum(w_Amt),0) from tbl_savings_withdraw_details where saving_Code = '$saving_Code') as total")->row();
			$w_Amt = $this->input->post('w_Amt');
			if($dep_Avil->total==0){
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>No Deposit Amount Available of Memeber Id#'.$member_Id.'</div>');
				redirect('withdraw/Withdraw_paid_Bal');
			}else if($w_Amt>$dep_Avil->total+$profit){
				$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Withdrawn Amount exceed Available Amount for Member Id'.$member_Id.'</div>');
				redirect('withdraw/Withdraw_paid_Bal');
			}else{
			$data = $this->input->post(NULL, TRUE);
			$data['samity_Code'] = $this->input->post('samity_Code');
			$data['member_Id'] = $this->input->post('member_Id');
			$data['saving_Code'] = $saving_Code;
			if(!empty($profit)){
				$amt = $w_Amt-$profit;
			}else{
				$amt = $w_Amt;
			}
			$data['w_Amt'] = $amt;
			$data['profit'] = $profit;
			$data['rate'] = $w_Amt == $dep_Avil->total+$profit?$this->input->post('rate'):0;
			$data['payment_Date'] = $this->input->post('payment_Date');
			$data['created_by']=$this->session->userdata('admin_logged_in')['id'];
            $data['created_on']=date('Y-m-d H:i:s',time());
			$result = $this->Common_model->common_insert($data,'tbl_savings_withdraw_details');
			$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>'.$member_Id.' '.$amt.' Tk  Withdrawn successfully.</div>');
			redirect('withdraw/Withdraw_paid_Bal');
			}
	}
	public function paidDepositBalance(){
		$saving_Code = $this->input->get('saving_Code');
		$data=  $this->db->query("select (select 
					sum(p_Amt) from tbl_deposit_paid where saving_Code = '$saving_Code') -
					(select COALESCE(sum(w_Amt),0) from tbl_savings_withdraw_details where saving_Code = '$saving_Code') as total")->row();
		//echo $this->db->last_query();
    	echo json_encode($data);
	}
		
	public function view_member_info(){
		$member_Id = $this->input->get('member_Id');
		//print_r($postData);
		$data=  $this->db->query("SELECT tbl_members.member_Id, tbl_samity.samity_Name, tbl_members.member_Id,tbl_members.present_Address  FROM tbl_members INNER JOIN tbl_samity on tbl_samity.samity_Code = tbl_members.samity_Name where member_Id = '$member_Id'")->row();
		echo json_encode($data);
	}	
	public function view_member_info_by_samity(){
		$samity_Name = $this->input->get('samity_Name');
		//print_r($postData);
	
		$data=  $this->db->query("	SELECT tbl_members.member_Name, tbl_members.member_Id, tbl_members.present_Address, tbl_deposit_paid.payment_Date from tbl_members left join tbl_deposit_paid on tbl_deposit_paid.member_Id = tbl_members.member_Id WHERE tbl_members.samity_Name ='$samity_Name' && tbl_members.status=1 ORDER by tbl_members.id")->result_array();
		echo json_encode($data);
	}	
	public function view_due_info(){
		$member_Id = $this->input->get('member_Id');
		$data= $this->db->query("SELECT saving_Code from tbl_members where member_Id = '$member_Id'")->row();
		echo json_encode($data);
	}
	
	/*List Of Withdraw_paid_Bal*/
	public function withdrawList(){
		$data['withdrawList'] = $this->Common_model->common_result_array('tbl_savings_withdraw_details');
		$data['user_info'] = $this->Common_model->common_select_by_condition('tbl_auth_supper','id,name');
		$data['page']="withdraw/withdrawList";
		$this->load->view('template',$data);
	}

}
