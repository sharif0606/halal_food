<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
	}
	public function index()
	{
		$data['page']="accounts/report/loan_report/lr";
		$this->load->view('accounts/template',$data);
	}
	
	public function glrm(){
		$data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		
		$mainContent=$this->load->view('accounts/report/loan_report/glrm', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
	
	public function glrd(){
		$month=$this->input->get('rMonth');
		$year=$this->input->get('rYear');
		
		$date = new DateTime( $year.'-'.$month.'-01');
		$cml= $date->format("Y-m-t");
		$cmf= $date->format("Y-m-d");

		$data['data']=$this->db->query("SELECT `paid_Date`,
										( SELECT sum(`paid_Amount`) from tbl_loan_assign_details tlad WHERE tlad.`loan_No` in (SELECT `tbl_loan_assign`.`loan_No` FROM `tbl_loan_assign` where member_Id in (select member_Id from tbl_members WHERE tbl_members.gender=2)) and tlad.`paid_Date`=tbl_loan_assign_details.`paid_Date`) as pafm,
										( SELECT sum(`paid_Amount`) from tbl_loan_assign_details tlad WHERE tlad.`loan_No` in (SELECT `tbl_loan_assign`.`loan_No` FROM `tbl_loan_assign` where member_Id in (select member_Id from tbl_members WHERE tbl_members.gender=1)) and tlad.`paid_Date`=tbl_loan_assign_details.`paid_Date`) as pam
										FROM `tbl_loan_assign_details` WHERE `paid_Date` >= '$cmf' and `paid_Date` <= '$cml'  group by `paid_Date`")->result_array();
		
		$mainContent=$this->load->view('accounts/report/loan_report/glrd', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
	public function glrbd(){
		$month=$this->input->get('rMonth');
		$year=$this->input->get('rYear');
		
		$date = new DateTime( $year.'-'.$month.'-01');
		$cml= $date->format("Y-m-t");
		$cmf= $date->format("Y-m-d");
		
        $data['user_info'] = $this->Common_model->common_select_by_condition('tbl_auth_supper','id,name');
		$data['data']=$this->db->query("SELECT *
										FROM `tbl_loan_assign_details` WHERE `paid_Date` >= '$cmf' and `paid_Date` <= '$cml' and paid_Amount<>0")->result_array();
										//echo $this->db->last_query();die();
										
		$mainContent=$this->load->view('accounts/report/loan_report/lrbd', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
	}

}
