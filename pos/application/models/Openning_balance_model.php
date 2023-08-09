<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Openning_balance_model extends CI_Model {

	//Datatable start
	var $table = 'db_openning_balance as openningBalance';
	
	public function __construct()
	{
		parent::__construct();
	}
	/*public function bankList(){
		$this->db->select('*');
		$this->db->from('db_banks');
		$banks = $this->db->get();
		if($banks->num_rows()>0){
			return $banks->result();
		}else{
			return [];
		}
	}*/
	public function paymenttypeList(){
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('db_paymenttypes');
		$paymenttypes = $this->db->get();
		if($paymenttypes->num_rows()>0){
			return $paymenttypes->result();
		}else{
			return [];
		}
	}
	public function balances(){
		$this->db->select('*');
		$this->db->from('db_openning_balance_info');
		$this->db->join('db_paymenttypes','db_paymenttypes.id = db_openning_balance_info.bank_id','left');
		$balances = $this->db->get();
		
		if($balances->num_rows()>0){
			return $balances->result();
		}else{
			return false;
		}
	}
	public function balance_insert(){
		$batchData =array();
		$data=[];
		/*$batchData[]=[
			'bank_id'=>'0',
			'amount'=>$this->input->post('cash_amount')
		];*/
		$selectedBanks = $this->input->post('bank_id');
		$amounts = $this->input->post('bank_amount');
		foreach($selectedBanks as $index=>$bank){
			if($bank and $amounts[$index]){
				$data['bank_id']  = $bank;
				$data['amount']  = $amounts[$index];
				$batchData[] = $data;
			}
		}
		if(count($batchData) > 0){
    		$this->db->truncate('db_openning_balance_info');
    		$insert = $this->db->insert_batch('db_openning_balance_info',$batchData);
    		if($insert){
    			$this->session->set_flashdata('success', 'Success!! Openning Balance added Successfully!');
    			return true;
    		}else{
    			$this->session->set_flashdata('error', 'Error!! Please try again!');
			    return true;
    		}
		}else{
		    $this->session->set_flashdata('error', 'Error!! No data changed!');
			return true;
		}
	}
}
