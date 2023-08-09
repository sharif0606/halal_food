<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_setting extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		
	}
	public function index($id=false){
		$status['status'] = 1;
		$data['designationList']=$this->Common_model->common_select_by_condition('tbl_designation','*',$status);
		$data['sectionList']=$this->Common_model->common_select_by_condition('tbl_section','*',$status);
		$data['profileData']=$this->Common_model->common_select_by_condition_row('tbl_company_profile','*',$status);
		
		$cdata['status']=1;
		$cdata['logInBy']=$this->session->userdata('admin_logged_in')['id'];
		/*$data['smsData']=$this->Common_model->common_select_field_by_condition('tbl_sms',$cdata,'id','ASC','*');
		if($data['smsData']){
			echo $this->sms_balance_chech($data['smsData'][0]->base);
		}*/
		
		$data['page']='setting/profile';
		$this->load->view('template',$data);
	}
	public function sms_balance_chech($base){

		/*$request = new HttpRequest();
		$request->setUrl('https://107.20.199.106/account/1/balance');
		$request->setMethod(HTTP_METH_GET);

		$request->setHeaders(array(
		  'accept' => 'application/json',
		  'authorization' => 'Basic '.$base
		));

		try {
		  $response = $request->send();

		  return $response->getBody();
		} catch (HttpException $ex) {
		  return $ex;
		}*/
	}
	public function profile_save(){
		
			$insert_data = Mylist::input($_POST);
			$id=$insert_data['id'];
			$file='';
			if (!empty($_FILES['image']['name'])){
					$this->load->library('upload');
					$folderName="upolad/setting/company";
					$config['upload_path'] = $folderName;
					$config['encrypt_name'] = False;
					$config['file_name'] =  $id;
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
					$insert_data['logo']=$folderName.'/'.$file;
					unset($insert_data['image']);
				}
			unset($insert_data['id']);
			/*print "<pre>";
			echo $id;
			print_r($insert_data);
			print "</pre>";
			die();*/
			if($id==0){
				$insert_data['status']=1;
				if($this->Common_model->common_insert($insert_data,'tbl_company_profile')){
						$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been saved successfully</div>');
					}
					else{
						$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been saved. Please try again.</div>');
					}
			}
			else{
				if($this->Common_model->common_update($insert_data,$id,'id','tbl_company_profile')){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been saved successfully</div>');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been saved. Please try again.</div>');
				}
			}
		redirect('setting/profile_setting','refresh'); 
		
	}
	
	public function data_save(){
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
			
		if ($this->form_validation->run() == FALSE){
			
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data was not saved. '.validation_errors().'</div>');
			
			redirect('setting/profile_setting','refresh'); 
		}
		else{
				$t=$this->input->post('tsn');
				if($t==1)
					$table='tbl_designation';
				elseif($t==2)
					$table='tbl_section';
					
				$data['name'] = $this->input->post('name');
				
			if($this->input->post('id')==0){
				/* save function */
				$data['status']=1;
				$data['createdBy'] =$this->session->userdata('admin_logged_in')['id'];
				$data['createdOn'] = date('Y-m-d H:i:s');
					if($this->Common_model->common_insert($data,$table)){
						$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been saved successfully</div>');
					}
					else{
						$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been saved. Please try again.</div>');
					}
			}
			else{
				/* update function */
				$data['updatedBy'] =$this->session->userdata('admin_logged_in')['id'];
				$data['updatedOn'] = date('Y-m-d H:i:s');
				
				if($this->Common_model->common_update($data,$this->input->post('id'),'id',$table)){
					$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been saved successfully</div>');
				}
				else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been saved. Please try again.</div>');
				}
			}
			redirect('setting/profile_setting/index/'.$t,'refresh'); 
		}
	}
	
	/* Delete Country */
	public function data_delete($id,$t){
		if($t==1)
			$table='tbl_designation';
		elseif($t==2)
			$table='tbl_section';
			
		$d_data['status']=0;
		$d_data['updatedBy'] =$this->session->userdata('admin_logged_in')['id'];
		$d_data['updatedOn'] = date('Y-m-d H:i:s');
		if($this->Common_model->common_update($d_data,$id,'id',$table)){
			$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has been deleted.</div>');
		}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Data has not been deleted. Please try again.</div>');
		}
			redirect('setting/profile_setting','refresh'); 
	}
	
	
	/* sms login check */
	public function sms_check()
	{/*
		$curl = curl_init();
		$auth=base64_encode($this->input->post('uName').':'.$this->input->post('uPass'));
		
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.infobip.com/account/1/balance",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"accept: application/json",
			//"authorization: Basic a2FqLmJhbmdsYTpCSnI2RXhMRw==",
			"authorization: Basic $auth",
			"cache-control: no-cache",
			"content-type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  echo $response;
		}
*/
		$this->form_validation->set_rules('uName', 'User Name', 'trim|required');
		$this->form_validation->set_rules('uPass', 'Password', 'trim|required|max_length[20]|callback_check_database');
		 
		if($this->form_validation->run() == FALSE){
			//Field validation failed. User redirected to login page
			redirect('setting/profile_setting/index/3','refresh'); 
		}
		else{
			redirect('setting/profile_setting/index/3','refresh'); 
		}
 
	}
	
	function check_database($uPass)
	{
		//Field validation succeeded. Validate against database
		$data_c['uName'] = $this->input->post('uName');
		$data_c['uPass'] = $uPass;
		$data_c['status'] = 1;
		 
		//query the database
		$result = $this->Common_model->common_select_by_multycondition($data_c,'tbl_sms','id','DESC');
		if($result){
			$data['base']=base64_encode($this->input->post('uName').':'.$uPass);
			$data['lastLoginIp']=$_SERVER['REMOTE_ADDR'];
			$data['lastLoginTime']=date('Y-m-d H:i:s');
			$data['logInBy']=$this->session->userdata('admin_logged_in')['id'];
			$data['loginStatus']=1;
			$this->Common_model->common_update($data,$result[0]['id'],'id','tbl_sms');
			return TRUE;
		}
		else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>Ether Invalid username or password.</div>');
			return false;
		}
	}
	
	function sms_logout()
	{
		$logInBy=$this->session->userdata('admin_logged_in')['id'];
		$data['loginStatus']=0;
		$this->Common_model->common_update($data,$logInBy,'logInBy','tbl_sms');

		redirect('setting/profile_setting/index/3','refresh'); 
		
	}
	
}
