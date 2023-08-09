<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('Faq_model','faq');
	}

	public function add(){
		$this->permission_check('items_category_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('faq');
		$this->load->view('faq', $data);
	}


	public function newfaq(){
		$this->form_validation->set_rules('question', 'Question', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->faq->verify_and_save();
			echo $result;
		} else {
			echo "Please Enter Question name.";
		}
	}
	public function update($id){
		$this->permission_check('items_category_edit');
		$data=$this->data;

		$result=$this->faq->get_details($id,$data);
		$data=array_merge($data,$result);
		$data['page_title']=$this->lang->line('faq');
		$this->load->view('faq', $data);
	}
	public function update_faq(){
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('q_id', '', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$result=$this->faq->update_faq();
			echo $result;
		} else {
			echo "Please Enter Question.";
		}
	}
	public function view(){
		$this->permission_check('items_category_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('faq_list');
		$this->load->view('faq-view', $data);
	}

	public function ajax_list()
	{
		$list = $this->faq->get_datatables();

		$data = array();
		//$no = $_POST['start'];
        //echo $this->db->last_query();
        //print_r($list);

		foreach ($list as $faq) {
			//$no++;
			$row = array();
			$row[] = $faq->question;
			$row[] = $faq->description;

					$str2 = '<div class="btn-group" title="View Account">
										<a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
											Action <span class="caret"></span>
										</a>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">';

											if($this->permissions('items_category_edit'))
											$str2.='<li>
												<a title="Edit Record ?" href="update/'.$faq->id.'">
													<i class="fa fa-fw fa-edit text-blue"></i>Edit
												</a>
											</li>';

											if($this->permissions('items_category_delete'))
											$str2.='<li>
												<a style="cursor:pointer" title="Delete Record ?" onclick="delete_faq('.$faq->id.')">
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
						"recordsTotal" => $this->faq->count_all(),
						"recordsFiltered" => $this->faq->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}



	public function delete_faq(){
        $this->load->model('faq_model');
		$this->permission_check_with_msg('items_category_delete');
		$id=$this->input->post('q_id');
		return $this->faq_model->delete_faq_from_table($id);
	}


}

