<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_head_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		$this->load->model('acc_rep_model', 'Acc_rep_model', true);
		
	}
	
	/*********************** Account Head Report ************************/
	public function index(){
		$data['accHead']=$this->Common_model->common_select_by_condition('tbl_devoucher_bkdn','DISTINCT(`account_code`) as ac,`table_name`,`table_id`',false,'devoucher_bkdn_id','ASC');
		$data['page']='accounts/report/acc_head_report/acc_head_report.php';
		$this->load->view('accounts/template',$data);
		
		// $cb_data['table_id'] = 1;
		// $cb_data['table_name'] = 'tbl_fcoa_bkdn_sub';
		// $where_in= date('Y-m-d');
		// $data['accBalData']=$this->Acc_rep_model->get_acc_report_balance($cb_data,$where_in);
		// print_r($data['accBalData']);
	}
	
	public function get_acc_report(){
		$current_date=explode(' / ',$_GET['rDate']);
		$startDate=date('Y-m-d',strtotime($current_date[0]));
		$endDate=date('Y-m-d',strtotime($current_date[1]));
		
		$idtab = explode(",",$_GET['accHead']);
		$c_data['tbl_devoucher_bkdn.table_id'] = $idtab[0];
		$c_data['tbl_devoucher_bkdn.table_name'] = $idtab[1];
		$c_data['tbl_debit_voucher.current_date>='] = $startDate;
		$c_data['tbl_debit_voucher.current_date<='] = $endDate;
		$data['accData']=$this->Acc_rep_model->get_acc_report_head($c_data);
		
		$cb_data['table_id'] = $idtab[0];
		$cb_data['table_name'] = $idtab[1];
		$where_in= date('Y-m-d', strtotime('-1 day', strtotime($startDate)));
		$data['startDate']=$startDate;
		$data['accBalData']=$this->Acc_rep_model->get_acc_report_balance($cb_data,$where_in);
		
		$mainContent=$this->load->view('accounts/report/acc_head_report/get_acc_report_head', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;   
    }
	/*********************** Account Head Report / ************************/
}
