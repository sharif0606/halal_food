<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions_model extends CI_Model {

	//Datatable start
	var $table = 'db_transactions as transactions';
	
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
	public function bankList(){
		$this->db->select('*');
		$this->db->from('db_paymenttypes');
		$this->db->where('bank_cash',2);
		$banks = $this->db->get();
		if($banks->num_rows()>0){
			return $banks->result();
		}else{
			return [];
		}
	}
	public function transHistory(){
		$this->db->select('db_transactions.*,db_paymenttypes.payment_type');
		$this->db->from('db_transactions');
		$this->db->join('db_paymenttypes','db_paymenttypes.id = db_transactions.bank_id');
		$transHistory = $this->db->get();
		if($transHistory->num_rows()>0){
			return $transHistory->result();
		}else{
			return [];
		}
	}
	public function balances(){
		$this->db->select('*');
		$this->db->from('db_openning_balance_info');
		$this->db->join('payment_type','payment_type.id = db_openning_balance_info.bank_id','left');
		$balances = $this->db->get();
		
		if($balances->num_rows()>0){
			return $balances->result();
		}else{
			return false;
		}
	}
	public function trans_insert($data){
		$insert = $this->db->insert('db_transactions',$data);
		if($insert){
			$this->session->set_flashdata('success', 'Success!!Transaction Added Successfully!');
			return true;
		}else{
			return false;
		}
	}
	
	public function trans_update($id,$data){
		$this->db->where('id', $id);
		//echo "<pre>";print_r($data);echo "<pre/>";exit;
		$update = $this->db->update('db_transactions',$data);
		if($update){
			$this->session->set_flashdata('success', 'Success!!Transaction Updated Successfully!');
			return true;
		}else{
			return false;
		}
	}
	
	public function getData($id){
		$this->db->select('*');
		$this->db->from('db_transactions');
		//$this->db->join('db_banks','db_banks.id = db_transactions.bank_id');
		$this->db->where('id',$id);
		$transHistory = $this->db->get();
		if($transHistory->num_rows()>0){
			return $transHistory->row();
		}else{
			return [];
		}
	}
}
