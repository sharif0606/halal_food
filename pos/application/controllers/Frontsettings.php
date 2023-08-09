<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontsettings extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Frontsettings_model','fsettings');
	}

	public function add(){
		$this->permission_check('items_category_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('frontsettings');
		$this->load->view('frontsettings', $data);
	}


	public function newfsettings(){
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->fsettings->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter Phone number.";
		}
	}
	public function update($id){
		$this->permission_check('items_category_edit');
		$data=$this->data;

		$result=$this->fsettings->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('frontsettings');
		$this->load->view('frontsettings', $data);
	}
	public function update_frontsettings(){
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->fsettings->update_settings();
			echo $result;
		} else {
			echo "Please Enter Phone.";
		}
	}
	public function view(){
		$this->permission_check('items_category_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('frontsettings_list');
		$this->load->view('frontsettings-view', $data);
	}

	public function ajax_list()
	{
		$list = $this->fsettings->get_datatables();

		$data = array();
		//$no = $_POST['start'];
        //echo $this->db->last_query();
        //print_r($list);

		foreach ($list as $fsettings) {
			//$no++;
			$row = array();
			$row[] = $fsettings->phone;
			$row[] = $fsettings->email;
			$row[] = $fsettings->address;
			$row[] = $fsettings->description;
			$row[] = "<img src='".base_url('uploads/fsettings_image/').$fsettings->logo_img."' width='50px'>";
			$row[] = "<img src='".base_url('uploads/fsettings_image/').$fsettings->offer_icon."' width='20px'>";
			$row[] = "<img src='".base_url('uploads/fsettings_image/').$fsettings->popular_icon."' width='20px'>";
            $row[] = $fsettings->facebooklink;
            $row[] = $fsettings->twitterlink;
            $row[] = $fsettings->linkdinlink;
            $row[] = $fsettings->youtubelink;

					$str2 = '<div class="btn-group" title="View Account">
                        <a class="btn btn-primary" title="Edit Record ?" href="update/'.$fsettings->id.'">
                        <i class="fa fa-fw fa-edit text-blue"></i>Edit
                        </a>

									</div>';

			$row[] = $str2;
			$data[] = $row;
		}

		$output = array(
						"draw" => "",//$_POST['draw'],
						"recordsTotal" => $this->fsettings->count_all(),
						"recordsFiltered" => $this->fsettings->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function delete_fsettings(){
        $this->load->model('frontsettings_model');
		$this->permission_check_with_msg('items_category_delete');
		$id=$this->input->post('q_id');
		return $this->frontsettings_model->delete_fsettings_from_table($id);
	}


}

