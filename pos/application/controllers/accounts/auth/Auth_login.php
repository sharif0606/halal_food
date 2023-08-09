<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
	}
	public function index(){
		$this->load->view('auth/login');
	}
/* login section start */
	public function login_check()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|callback_check_database');
		 
		if($this->form_validation->run() == FALSE){
			//Field validation failed. User redirected to login page
			$this->load->view('auth/login');
		}
		else{
			//Go to private area
			redirect('dashboard', 'refresh');
		}
 
	}
 
	public function check_database($id)
	{
		//query the database
		$result = $this->db->query("select a.*,(select GROUP_CONCAT(permissions) from db_permissions where db_permissions.role_id=a.role_id GROUP by db_permissions.role_id) as accessArea from db_users a where a.id='$id' and a.status=1");
		if($result->num_rows()==1){
				$accessArea = explode(',',$result->row()->accessArea);
				$sess_array = array(
					'id' => $result->row()->id,
					'name' => $result->row()->firstname.' '.$result->row()->lastname,
					'email' => $result->row()->email,
					'contact' => $result->row()->mobile,
					'image' => $result->row()->photo,
					'super_admin' => 1,
					'accessArea' => $accessArea
				);
				$this->session->set_userdata('admin_logged_in', $sess_array);
				redirect('dashboard', 'refresh');
		}
		else{
			$this->form_validation->set_message('check_database', '<p class="btn-link"><b> Ether Invalid username or password.</b></p>');
			echo "<script> window.location.href = 'http://162.0.226.157/pos104/dashboard'; </script>";
		}
	}
/* login section end */
/* logout section start */
	public function logout()
	{
		$this->session->unset_userdata('admin_logged_in');
		$this->session->sess_destroy();
		redirect('http://103.174.152.19/mariumfashion'); 
		//redirect('auth/auth_login', 'refresh');
	}
/* logout section end */
/* forget pass section start */
	public function forget_pass()
	{
		$this->load->view('auth/forget_pass');
	}
	public function forget_pass_email(){
		$this->form_validation->set_rules('email', 'email', 'trim|required|valiu_email|callback_check_email_if');

			if ($this->form_validation->run() === FALSE){
				$this->load->view('auth/forget_pass');
			}
			else{
				$this->session->set_flashdata('message', 'An link has been send to your email address. Please check your Email');
				redirect('auth/auth_login');
			}
	}
	
	public function check_email_if($email){
		$new_key=md5(uniqid());
		$data_c['email']=$email;
		$user_id=$this->Common_model->common_select_by_condition('tbl_auth_supper','*',$data_c,'id','DESC');
		
		if($user_id){
			$id=$user_id[0]['id'];
			$data['forgetKey'] = $new_key;
			
			if($this->Common_model->common_update($data,$id,'id','tbl_auth_supper')){
				if($this->send_forget_pass_email($email,$new_key)){
					return true;
				}
				else{
					$this->form_validation->set_message('check_email_if', 'Email was not sent successfully. Please try again.');
					return false;
				}
			}
			else{
				$this->form_validation->set_message('check_email_if', 'Password was not reset successfully. Please try again.');
				return false;
			}
		}
		else{
			$this->form_validation->set_message('check_email_if', 'This email address is not correct.');
			return false;
		}
	}
	public function send_forget_pass_email($email,$new_key){
		$this->load->library('email');
		$this->email->from('info@probatiltd.com', 'Probati Admin');
		$this->email->to($email);
		$this->email->subject('Password change');
		$this->email->message('To change your password visit this link '.base_url().'auth_login/change_password/'.$new_key);

		if($this->email->send()){
			return true;
		}
		else{
			return false;
		}
	}
	public function change_password($forgetKey){
		$data['forgetKey']=$forgetKey;
		$this->load->view('auth/change_password',$data);
	}
	public function save_change_pass(){
		$this->form_validation->set_rules('forgetKey', 'Key', 'trim|required|max_length[50]|callback_key_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|min_length[5]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE){
				 $this->change_password($this->input->post('forgetKey'));
			}
			else{
				$forgetKey=$this->input->post('forgetKey');
				$data['password'] = md5(sha1($this->input->post('password')));
				$data['forgetKey'] = '';
				if($this->Common_model->common_update($data,$forgetKey,'forgetKey','tbl_auth_supper')){
					/*$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been saved successfully</div>');*/
				}
				else{
					/*$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been saved. Please try again.</div>');*/
				}
				redirect('auth/auth_login','refresh'); 
			}
	}
	function key_check($key){
		if($this->Common_model->common_row_by_condition($key,'forgetKey','tbl_auth_supper')){
			
			return TRUE;
		}
		else{
			$this->form_validation->set_message('key_check', 'This url is not valid any more.');
			return FALSE;
		}
	}
/* forget pass section end */
/* change password section start */
public function change_password_admin(){
		$this->load->view('auth_login/change_password_admin');
	}
	public function save_change_pass_admin(){
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|max_length[20]|callback_oldpassword_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[20]|min_length[8]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE){
				 $this->change_password_admin();
			}
			else{
				$id=$this->session->userdata('admin_logged_in')['id'];
				$data['password'] = md5(sha1($this->input->post('password')));
				
				if($this->Common_model->common_update($data,$id,'id','admin_supper')){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been saved successfully</div>');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been saved. Please try again.</div>');
				}
				redirect('auth/auth_login/logout','refresh'); 
			}
	}
	function oldpassword_check($oldpass){
		$username=$this->session->userdata('admin_logged_in')['username'];
		
		if($this->Admin->login($username, md5(sha1($oldpass)))){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('oldpassword_check', 'This password is not correct.');
			return FALSE;
		}
	}
	/* change password section end */
	
}
