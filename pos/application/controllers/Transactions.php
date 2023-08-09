<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('transactions_model','transactions');
	}

	public function index(){
		$this->permission_check('transactions_view');
		$data=$this->data;
		//$data['page_title']=$this->lang->line('purchase_returns_list');
		$data['page_title']="Transaction History";
		$data['banks']=$this->transactions->bankList();
		$data['transactions'] = $this->transactions->transHistory();
		//echo "<pre>";print_r($data['balances']);echo "</pre>";exit;
		$this->load->view('transactions',$data);
	}
	
	public function add(){
		$data = [
			'type'=>$this->input->post('type'),
			'bank_id'=>$this->input->post('bank_id'),
			'amount'=>$this->input->post('amount'),
			'date'=>$this->input->post('date'),
			'description'=>$this->input->post('description')
		];
		if($this->input->post('rowId')){
			$id = $this->input->post('rowId');
			$operation = $this->transactions->trans_update($id,$data);
		}else{
			$operation = $this->transactions->trans_insert($data);
		}
		
		if($operation){
			//return redirect()->to($_SERVER['HTTP_REFERER']);
			return redirect(base_url()."/transactions/");
		}
	}
	public function edit($id){
		$data = $this->transactions->getData($id);
		if($data){
			$sendData = [
				'success'=>true,
				'data'=>$data,
			];
			echo json_encode($sendData);
		}else{
			return false;
		}
	}
}
