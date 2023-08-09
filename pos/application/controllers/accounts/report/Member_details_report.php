<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_details_report extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('common_model', 'Common_model', true);
		
	}
	public function index()
	{
	    $data['page']="accounts/report/member_report/member_details_report";
		$this->load->view('accounts/template',$data);

	}
	public function mdr(){
	    
		/*$month=$this->input->get('rMonth');
		$year=$this->input->get('rYear');
		
		$date = new DateTime( $year.'-'.$month.'-01');
		$cml= $date->format("Y-m-t");
		$cmf= $date->format("Y-m-d");*/
		
		
		/*Previous month 
			
		$previous_month_first_date = date('Y-m-d', strtotime('first day of previous month',strtotime ( $cmf )));
        $previous_month_last_date = date('Y-m-d', strtotime('last day of previous month',strtotime ( $cmf )));

	  	$data['tlmMembermale']=$this->db->query("SELECT sum(`member_Id`)  as tlmMembermale from tbl_members  WHERE `application_Date` <= '$cml'  and gender=1 and status=1")->row_array();
	    $data['tlmMemberfemale']=$this->db->query("SELECT sum(`member_Id`)  as tlmMemberfemale from tbl_members  WHERE `application_Date` <= '$cml'  and gender=2 and status=1")->row_array();
	    
	    $data['tcmMembermale']=$this->db->query("SELECT sum(`member_Id`)  as tcmMembermale from tbl_members WHERE `application_Date` >= '$cmf' and `application_Date` <= '$cml'  and gender=1 and status=1")->row_array();

	    $data['tcmMemberfemale']=$this->db->query("SELECT sum(`member_Id`)  as tcmMemberfemale from tbl_members   WHERE `application_Date` >= '$cmf' and `application_Date` <= '$cml'  and gender=2 and status=1")->row_array();
		
		  $data['tcmIncmale']=$this->db->query("SELECT sum(`member_Id`)  as tcmIncmale from tbl_members WHERE DATE_FORMAT(updated_on, '%Y-%m-%d') >= '$cmf' and DATE_FORMAT(updated_on, '%Y-%m-%d') <= '$cml'  and gender=1 and status=0")->row_array();
		  
	    $data['tcmIncfemale']=$this->db->query("SELECT sum(`member_Id`)  as tcmIncfemale from tbl_members   WHERE DATE_FORMAT(updated_on, '%Y-%m-%d') >= '$cmf' and DATE_FORMAT(updated_on, '%Y-%m-%d') <= '$cml'  and gender=2 and status=0")->row_array();*/
	    
	    
	    /*$data['data']=$this->db->query("SELECT `paid_Date`,
										( SELECT sum(`member_Id`) from tbl_savings_withdraw_details tmr WHERE where member_Id in (select member_Id from tbl_members WHERE tbl_members.gender=2))  as tmrsReturn,
										
										FROM `tbl_savings_withdraw_details` WHERE `payment_Date` <= '$cml'")->row_array();*/
		
	    //echo $this->db->last_qurery();
    	$data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		$mainContent=$this->load->view('accounts/report/member_report/mdr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
	
}
