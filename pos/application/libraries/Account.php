<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Accounting
*
* Version: 2.5.2
*
* Author: Shariful Islam
*Email:shariful_islam0606@yahoo.com

* Requirements: PHP5 or above
*
*/
class account
{
	public $coahead = array();

	public function __construct()
	{
		$this->load->config('account', TRUE);
		//$this->load->library('email');
		//$this->lang->load('ion_auth');
		//$this->load->helper('cookie');
		//$this->load->helper('language');
		$this->load->helper('url');

		// Load the session, CI2 as a library, CI3 uses it as a driver
		if (substr(CI_VERSION, 0, 1) == '2'){
			$this->load->library('session');
		}
		else{
			$this->load->driver('session');
		}

		$this->load->model('accounts_model');
	}

	
	
	public function __call($method, $arguments)
	{
		if(method_exists( $this->accounts_model, $method)){
			return call_user_func_array( array($this->accounts_model, $method), $arguments);
		}
		else {
			throw new Exception('Undefined method Accounting::' . $method . '() called');
		}	
	}
	
	public function user_fun($method, $arg)
	{
		return call_user_func_array(array($this->accounts_model, $method), $arg);
	}
	
	
	public function __get($var)
	{
		return get_instance()->$var;
	}
	
	
	public function get_chart_of_account($my_id,$rec_date=false)
	{
		if($rec_date){
			$current_date=explode(' / ',$rec_date);
			$startDate=date('Y-m-d',strtotime($current_date[0]));
			$endDate=date('Y-m-d',strtotime($current_date[1]));
			$rec_date="and gl.rec_date>=$startDate and gl.rec_date<=$endDate ";
		}
		$this->coahead = $this->accounts_model->chart_of_account_value($my_id,$rec_date);
		//$this->coahead =& $this->accounts_model->chart_of_account_value($my_id,$rec_date);
		//return $this->coahead;
	}
	
	
	function search_arr($array, $key, $value){
		$results = array();
		if (is_array($array))
		{
			if (isset($array[$key]) && $array[$key] == $value){
				$results[] = $array;
			}
			foreach ($array as $subarray){
				$results = array_merge($results, $this->search_arr($subarray, $key, $value));
			}
		}
		return $results;
	}
	
	function get_master_head_total_drcr($get_master_head){
		/*
		echo "<pre>";
			print_r($get_master_head);
		echo "</pre>";
		*/
		$drcr=array();
		$dr=0;
		$cr=0;
		foreach($get_master_head as $info){
			
			$dr+=$info["dr"];
			$cr+=$info["cr"];
		}
		
		$drcr[]=$dr;
		$drcr[]=$cr;
		return $drcr;
	}
	
	function get_fcoa_bkdn($fcoabkdnid,$fcoaid,$fcoabkdn,$sub_fcoa_bkdn_arr){
		$arr_result=$this->search_arr($sub_fcoa_bkdn_arr, 'parent', $fcoabkdnid);
		return $arr_result;
	}
	
	function master_head_total_drcr_exception($get_master_head){
		
		$drcr=array();
		$dr="";
		$cr="";
		
		$Cash_at_Bank_dr='';
		$Cash_at_Bank_cr='';
		
		foreach($get_master_head as $info){
			
			if($info["id"]=='383'){	
				$Cash_at_Bank_dr+=$info["dr"];
				$Cash_at_Bank_cr+=$info["cr"];
			}
			else {
				$dr+=$info["dr"];
				$cr+=$info["cr"];
			}	
		}
		
		$drcr[]=$dr;
		$drcr[]=$cr;
		$drcr[]=$Cash_at_Bank_dr;
		$drcr[]=$Cash_at_Bank_cr;
		
		return $drcr;
	}
	
	function test_access(){
		echo "sdfs";
	}
}
