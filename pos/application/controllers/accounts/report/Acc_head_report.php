<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_head_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		$this->load->model('acc_rep_model', 'Acc_rep_model', true);
		
	}
	
	/*********************** Account Head Report ************************/
	public function index(){
		$data['accHead']=$this->db->query("SELECT DISTINCT(`account_code`) as ac                     ,`table_name`,`table_id` FROM tbl_crvoucher_bkdn
                            UNION
                            SELECT DISTINCT(`account_code`) as ac,`table_name`,`table_id` FROM tbl_devoucher_bkdn
                            UNION
                            SELECT DISTINCT(`account_code`) as ac,`table_name`,`table_id` FROM tbl_jrvoucher_bkdn order by ac")->result_array();
		
		$data['page']='accounts/report/acc_head_report/acc_head_report.php';
		$this->load->view('accounts/template',$data);
	}
	
	public function get_acc_report(){
		$current_date=explode(' / ',$_GET['rDate']);
		$startDate=date('Y-m-d',strtotime($current_date[0]));
		$endDate=date('Y-m-d',strtotime($current_date[1]));
		
		$idtab = explode(",",$_GET['accHead']);
		
		if($idtab[1]=="tbl_fcoa_master")
			$field_name="fcoa_master_id";
		elseif($idtab[1]=="tbl_fcoa")
			$field_name="fcoa_id";
		elseif($idtab[1]=="tbl_fcoa_bkdn")
			$field_name="fcoa_bkdn_id";
		elseif($idtab[1]=="tbl_fcoa_bkdn_sub")
			$field_name="fcoa_bkdn_sub_id";
    								
		$table_id = $idtab[0];
		
		$data['accData']=$this->db->query("SELECT gl.`journal_title`,gl.`dr`,gl.`cr`,gl.`rec_date`,gl.`jv_id`,gl.debit_voucher_id,gl.credit_voucher_id,gl.journal_voucher_id FROM `tbl_general_ledger` as gl left join tbl_debit_voucher on tbl_debit_voucher.id=gl.`debit_voucher_id` left join tbl_credit_voucher on tbl_credit_voucher.id=gl.`credit_voucher_id` left join tbl_journal_voucher on tbl_journal_voucher.id=gl.`journal_voucher_id` WHERE gl.{$field_name}=$table_id and gl.rec_date>='$startDate' and gl.rec_date<='$endDate' order by gl.`rec_date`
		")->result_array();
		$bstart= date('Y-m-d', strtotime('-1 day', strtotime($startDate)));
		$data['accBalData']=$this->db->query("SELECT (COALESCE(sum(`dr`),0) - COALESCE(sum(`cr`),0) ) as balance from tbl_general_ledger WHERE {$field_name}=$table_id and date(rec_date)<'$startDate'")->row_array();
		/*
		$data['accBalData']=$this->Acc_rep_model->get_acc_report_balance($cb_data,$where_in);*/
		$data['startDate']=$startDate;
		$mainContent=$this->load->view('accounts/report/acc_head_report/get_acc_report_head', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;   
    }
	/*********************** Account Head Report / ************************/
}
