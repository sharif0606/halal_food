<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Headslider extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Headslider_model','slider');
	}

	public function add(){
		$this->permission_check('items_category_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('Headslider');
		$this->load->view('headslider', $data);
	}


	public function newslider(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->slider->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter Title name.";
		}
	}
	public function update($id){
		$this->permission_check('items_category_edit');
		$data=$this->data;

		$result=$this->slider->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('headslider');
		$this->load->view('headslider', $data);
	}
	public function update_headslider(){
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->slider->update_slider();
			echo $result;
		} else {
			echo "Please Enter Title.";
		}
	}
	public function view(){
		$this->permission_check('items_category_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('headslider_list');
		$this->load->view('headslider-view', $data);
	}

	public function ajax_list()
	{
		$list = $this->slider->get_datatables();

		$data = array();
		//$no = $_POST['start'];
        //echo $this->db->last_query();
        //print_r($list);

		foreach ($list as $slider) {
			//$no++;
			$row = array();
			$row[] = $slider->title;
			$row[] = $slider->short_description;
			$row[] = $slider->link;
			$row[] = "<img src='".base_url('uploads/slider_image/').$slider->slider_image."' width='80px'>";

					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('items_category_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="update/'.$slider->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('items_category_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_slider('.$slider->id.')">
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
						"recordsTotal" => $this->slider->count_all(),
						"recordsFiltered" => $this->slider->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function delete_slider(){
        $this->load->model('headslider_model');
		$this->permission_check_with_msg('items_category_delete');
		$id=$this->input->post('q_id');
		return $this->headslider_model->delete_slider_from_table($id);
	}


}

