<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_book_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
	}
	public function index()
	{
        $data['page']="accounts/report/cash_book_report/cbr";
		$this->load->view('accounts/template',$data);
	}
	
	public function gcbrm(){
		$data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		
		$mainContent=$this->load->view('accounts/report/cash_book_report/gcbr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
	public function gcbrd(){
		$data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		
		$mainContent=$this->load->view('accounts/report/cash_book_report/gcbr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
}
