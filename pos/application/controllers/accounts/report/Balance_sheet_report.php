<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance_sheet_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
		$this->load->model('accounts_model', 'Accounts_model', true);
		$this->load->model('acc_rep_model', 'Acc_rep_model', true);
		
	}
	public function index(){
		$data['page']="accounts/report/balance_sheet_report/rpr";
		$this->load->view('accounts/template',$data);
	}
	
	public function grpr(){
		$data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		
		$m=$this->input->get('rMonth');
		$y=$this->input->get('rYear');
		if($m>6) {
    		$qy=" date(tbl_general_ledger.rec_date) BETWEEN '".$y."-07-01' and '".$y."-".$m."-31"."' ";
    		$qm=" date(tbl_general_ledger.rec_date) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31"."' ";
    	}else{
    		$qy=" date(tbl_general_ledger.rec_date) BETWEEN '".($y-1)."-07-01' and '".$y."-".$m."-31"."' ";
    		$qm=" date(tbl_general_ledger.rec_date) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31' ";
    	}
		
		//$c_data['year(tbl_debit_voucher.current_date)'] = $year;
		$data['expDataYear']=$this->Acc_rep_model->gplre_bal($qy);// yearly Expenses
		
		$data['incDataYear']=$this->Acc_rep_model->gplri_bal($qy);// yearly Income
		
		$data['cqy']=$qy;
		$data['cqm']=$qm;
		$mainContent=$this->load->view('accounts/report/balance_sheet_report/grpr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
}
