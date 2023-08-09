<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt_payment_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
		$this->load->model('accounts_model', 'Accounts_model', true);
		$this->load->model('acc_rep_model', 'Acc_rep_model', true);
		
	}
	public function index(){
		$data['page']="accounts/report/receipt_payment_report/rpr";
		$this->load->view('accounts/template',$data);
	}
	
	public function grpr(){
		$data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		
		
		$mainContent=$this->load->view('accounts/report/receipt_payment_report/grpr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
}
