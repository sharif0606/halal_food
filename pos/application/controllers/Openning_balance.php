<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Openning_balance extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('openning_balance_model','openningBalance');
	}

	public function index(){
		//$this->permission_check('purchase_return_view');
		$data=$this->data;
		//$data['page_title']=$this->lang->line('purchase_returns_list');
		$data['page_title']="Openning Balance";
		//$data['banks']=$this->openningBalance->bankList();
		$data['paymenttypes']=$this->openningBalance->paymenttypeList();
		$data['balances'] = $this->openningBalance->balances();
		//echo "<pre>";print_r($data['balances']);echo "</pre>";exit;
		$this->load->view('openning-balance',$data);
	}
	
	public function add(){
		$insert = $this->openningBalance->balance_insert();
		if($insert){
			//return redirect()->to($_SERVER['HTTP_REFERER']);
			return redirect(base_url()."/openning_balance/");
		}
	}
}
