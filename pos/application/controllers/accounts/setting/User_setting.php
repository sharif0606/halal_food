<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_setting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		if(!$this->session->userdata('admin_logged_in')){
			redirect('auth_login');
			exit;
		}
		if ($this->session->userdata('admin_logged_in')['super_admin']!=1 && !in_array("user_management", $this->session->userdata('admin_logged_in')['accessArea'])){
			$this->session->set_flashdata('AccessDenied', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>You do not have permission to visit that page.</div>');
			redirect('dashboard');
			exit;
		}
	}
	public function index(){
		$status['status'] = 1;
		$data['userList']=$this->Common_model->common_select_by_condition('tbl_auth_supper','*',$status);
		$data['page']='setting/users/user_setting.php';
		$this->load->view('template',$data);
	}
	
	// user edit portion
	public function user_add_json(){
		$tbl_section= $this->Common_model->show('tbl_section','status',1);
		$tbl_designation= $this->Common_model->show('tbl_designation','status',1);
		$data['sectionList'] = MyList::selectOptionList(MyList::getArray($tbl_section,'id','name'));
		$data['designationList'] = MyList::selectOptionList(MyList::getArray($tbl_designation,'id','designation'));
			$mainContent=$this->load->view('setting/users/add_user_setting', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;   
    }
	
	public function user_save(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('contact', 'Phone', 'trim|required');
		$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
		$this->form_validation->set_rules('section', 'Section', 'trim|required');
		// check when add new user
		if($this->input->post('id')==0){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_auth_supper.email]');
			//$this->form_validation->set_rules('u_name', 'User Name', 'trim|required|is_unique[tbl_auth_supper.u_name]');
			$this->form_validation->set_rules('password', 'password', 'trim|required|max_length[20]');
			$this->form_validation->set_rules('cPassword', 'Password Confirmation', 'trim|required|matches[password]');
		}
		elseif(!empty($this->input->post('password'))){
			$this->form_validation->set_rules('password', 'password', 'trim|max_length[20]');
			$this->form_validation->set_rules('cPassword', 'Password Confirmation', 'trim|matches[password]');
		}
		// check validation
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was not saved. '.validation_errors().'</div>');
			redirect('setting/user_setting','refresh'); 
		}
		else{
			
			$file='';
			//check is new user or not
			if($this->input->post('id')==0){
				if (!empty($_FILES['image']['name'])){
					$this->load->library('upload');
					$folderName="upolad/setting/employees";
					$config['upload_path'] = $folderName;
					$config['encrypt_name'] = False;
					$config['file_name'] =  uniqid();
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = 0;
					$config['overwrite'] = TRUE;
					
					$dir = $folderName;
					if (!file_exists($dir)) {
						mkdir($dir);
					}

					//print_r($config);die();
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('image')) {
						$status = 'error';
						$msg = $this->upload->display_errors();
						//print_r($msg);//die();
					}else {
						$data = $this->upload->data();
						$file = $data['file_name'];
					}
				}
				
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['designation'] = $this->input->post('designation');
				$data['section'] = $this->input->post('section');
				//$data['u_name'] = $this->input->post('u_name');
				$data['image'] = $file;
				$data['contact'] = $this->input->post('contact');
				$data['password'] = md5(sha1($this->input->post('password')));
				$data['active'] = 1;
				$data['status'] = 1;
				$data['createdOn'] = date('Y-m-d H:i:s');
				$data['createdBy'] = $this->session->userdata('admin_logged_in')['id'];
				$data['accessArea'] = $this->input->post('accessArea')!=''?implode(',',$this->input->post('accessArea')):'';
				
				//print_r($data);die();
				if($this->Common_model->common_insert($data,'tbl_auth_supper')){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was saved successfully.</div>');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was not saved. Please try again.</div>');
				}
			}
			else{
				
				if (!empty($_FILES['image']['name'])){
				    if($this->input->post('oldImage'))
				        $img=$this->input->post('oldImage');
				    else
				        $img=uniqid();
					$this->load->library('upload');
					$folderName="upolad/setting/employees";
					$config['upload_path'] = $folderName;
					$config['encrypt_name'] = False;
					$config['file_name'] =  $img;
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = 0;
					$config['overwrite'] = TRUE;
					
					$dir = $folderName;
					if (!file_exists($dir)) {
						mkdir($dir);
					}

					//print_r($config);die();
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('image')) {
						$status = 'error';
						$msg = $this->upload->display_errors();
						//print_r($msg);//die();
					}else {
						$imgdata = $this->upload->data();
						$file = $imgdata['file_name'];
					}
				}
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['designation'] = $this->input->post('designation');
				$data['section'] = $this->input->post('section');
				//$data['u_name'] = $this->input->post('u_name');
				
				if(!empty($file)){
					$data['image'] = $file;
				}
				$data['contact'] = $this->input->post('contact');
				
				if(!empty($this->input->post('password'))){
					$data['password'] = md5(sha1($this->input->post('password')));
				}
				$data['updatedOn'] = date('Y-m-d H:i:s');
				$data['updatedBy'] = $this->session->userdata('admin_logged_in')['id'];
				$data['accessArea'] = $this->input->post('accessArea')!=''?implode(',',$this->input->post('accessArea')):'';
				
				
				if($this->Common_model->common_update($data,$this->input->post('id'),'id','tbl_auth_supper')){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was saved successfully.</div>');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was not saved. Please try again.</div>');
				}
			}
				redirect('setting/user_setting','refresh'); 
		}
	}

	// user edit portion
	public function user_edit_json(){
		$a['id'] = $_GET['id'];
		$sdata['status']=1;
		$data['sectionList']=$this->Common_model->common_select_field_by_condition('tbl_section',$sdata,'id','ASC','id,name');
		$data['designationList']=$this->Common_model->common_select_field_by_condition('tbl_designation',$sdata,'id','ASC','id,designation');
		$data['userData']=$this->Common_model->common_select_by_condition('tbl_auth_supper','*',$a);

			$mainContent=$this->load->view('setting/users/edit_user_setting', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);

       print json_encode($return);
       exit;   
    }
	/* Delete function */
	public function user_delete($id){
		$d_data['status']=0;
		$d_data['updatedBy'] =$this->session->userdata('admin_logged_in')['id'];
		$d_data['updatedOn'] = date('Y-m-d H:i:s');
		if($this->Common_model->common_update($d_data,$id,'id','tbl_auth_supper')){
			$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been deleted.</div>');
		}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been deleted. Please try again.</div>');
		}
			redirect('setting/user_setting','refresh'); 
	}
	/* user active inactive function */
	public function inactive_user(){
		$acti=array('Deactivated','Activated');
		$id=$_POST['id'];
		$u_data['active']=$_POST['active'];
		$u_data['updatedBy'] =$this->session->userdata('admin_logged_in')['id'];
		$u_data['updatedOn'] = date('Y-m-d H:i:s');
		if($this->Common_model->common_update($u_data,$id,'id','tbl_auth_supper')){
			echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>User has been '.$acti[$_POST['active']].' successfully.</div>';
		}
		else{
			echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>User has not been '.$acti[$_POST['active']].' successfully. Please try again.</div>';
		}
		
	}
	/* user profile change by user */
	
	public function user_data_update(){
		
		$this->form_validation->set_rules('contact', 'Phone', 'trim|required');
		
		if(!empty($this->input->post('password'))){
			$this->form_validation->set_rules('password', 'password', 'trim|max_length[20]');
			$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|matches[password]');
		}
		// check validation
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was not saved. '.validation_errors().'</div>');
			redirect($this->input->post('crurl'),'refresh'); 
		}
		else{
			
			$file='';
			$passflag=0;
				
				if (!empty($_FILES['image']['name'])){
					$this->load->library('upload');
					$folderName="upolad/setting/employees";
					$config['upload_path'] = $folderName;
					$config['encrypt_name'] = False;
					$config['file_name'] =  $this->input->post('oldImage');
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['max_size'] = 0;
					$config['overwrite'] = TRUE;
					
					$dir = $folderName;
					if (!file_exists($dir)) {
						mkdir($dir);
					}

					//print_r($config);die();
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('image')) {
						$status = 'error';
						$msg = $this->upload->display_errors();
						print_r($msg);//die();
					}else {
						$imgdata = $this->upload->data();
						$file = $imgdata['file_name'];
					}
				}
				
				if(!empty($file)){
					$data['image'] = $file;
				}
				$data['contact'] = $this->input->post('contact');
				
				if(!empty($this->input->post('password'))){
					$data['password'] = md5(sha1($this->input->post('password')));
					$passflag=1;
				}
				$data['updatedOn'] = date('Y-m-d H:i:s');
				$data['updatedBy'] = $this->session->userdata('admin_logged_in')['id'];
				
				if($this->Common_model->common_update($data,$this->session->userdata('admin_logged_in')['id'],'id','tbl_auth_supper')){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was saved successfully. To see the change please logout and login again.</div>');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was not saved. Please try again.</div>');
				}
			if($passflag==1)
				redirect('auth_login/logout','refresh'); 
			else
				redirect($this->input->post('crurl'),'refresh'); 
		}
	}

}
