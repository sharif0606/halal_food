<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profit_loss_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		$this->load->model('accounts_model', 'Accounts_model', true);
		$this->load->model('acc_rep_model', 'Acc_rep_model', true);
		
	}
	public function index(){
		$data['page']="accounts/report/profit_loss_report/plr";
		$this->load->view('accounts/template',$data);
	}

	public function gplr(){
		$month=$this->input->get('rMonth');
		$year=$this->input->get('rYear');
		
		$c_data['year(tbl_debit_voucher.current_date)'] = $year;
		$data['expDataYear']=$this->Acc_rep_model->gplre($c_data);// yearly Expenses
		
		$data['incDataYear']=$this->Acc_rep_model->gplri($c_data);// yearly Income
		
		$c_data['month(tbl_debit_voucher.current_date)'] = $month;
		$expDataMonth=$this->Acc_rep_model->gplre($c_data);// Monthly Expenses
		
		$incDataMonth=$this->Acc_rep_model->gplri($c_data);// Monthly Income
		
		// Expenses
		foreach($expDataMonth as $edm){
			$data['expDataMonth'][$edm['account_code']]=$edm['cost'];
		}
		// Income
		foreach($incDataMonth as $idm){
			$data['incDataMonth'][$idm['account_code']]=$idm['income'];
		}

		$mainContent=$this->load->view('accounts/report/profit_loss_report/gplr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
	
}