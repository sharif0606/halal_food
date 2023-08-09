<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acc_rep_model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	/************************ acc report for acc head ********************************
	public function get_acc_report_head($data,$where_inc=false){
		$this->db->select('`tbl_devoucher_bkdn`.*, `tbl_debit_voucher`.`voucher_no`, `tbl_debit_voucher`.`current_date`, `tbl_debit_voucher`.`rec_date`, `tbl_debit_voucher`.`purpose`');
		$this->db->from('tbl_devoucher_bkdn');
		$this->db->join('tbl_debit_voucher','tbl_devoucher_bkdn.debit_voucher_id=tbl_debit_voucher.id','left');
		$this->db->where($data);
		if($where_inc)
			$this->db->where_in('tbl_devoucher_bkdn.particulars',$where_inc);
		
		$this->db->order_by('tbl_devoucher_bkdn.devoucher_bkdn_id','ASC');
		$query = $this->db->get();
        $result = $query->result_array();
        return $result;   
    }
	public function get_acc_report_balance($data,$where_in){
		$this->db->select('(sum(`debit`)-sum(`credit`)) as balance');
		$this->db->from('tbl_devoucher_bkdn');
		$this->db->where($data);
		if($where_in)
		$this->db->where(" debit_voucher_id in (select `debit_voucher_id` from tbl_debit_voucher where tbl_debit_voucher.current_date <= '$where_in')");
		$query = $this->db->get();
        $result = $query->row_array();
        return $result;   
    }*/
	/***** acc report for acc head/ *****/
	
	/***** acc report for Profit_loss_report *****/
	public function gplre($data,$heads){
		$this->db->select('dvb.account_code,(sum(dvb.debit) - sum(dvb.credit)) as cost, mainv.current_date');
		$this->db->from('tbl_devoucher_bkdn as dvb');
		$this->db->join('tbl_debit_voucher as mainv','dvb.debit_voucher_id=mainv.id','left');
		$this->db->where($data, NULL, FALSE);
		$this->db->group_start();
		if($heads['tbl_fcoa']){
		    $this->db->or_group_start();
		    $this->db->where('dvb.table_name','tbl_fcoa');
		    $this->db->where_in('dvb.table_id',$heads['tbl_fcoa']);
		    $this->db->group_end();
		}
		if($heads['tbl_fcoa_bkdn']){
		    $this->db->or_group_start();
		    $this->db->where('dvb.table_name','tbl_fcoa_bkdn');
		    $this->db->where_in('dvb.table_id',$heads['tbl_fcoa_bkdn']);
		    $this->db->group_end();
		}
		if($heads['tbl_fcoa_bkdn_sub']){
		    $this->db->or_group_start();
		    $this->db->where('dvb.table_name','tbl_fcoa_bkdn_sub');
		    $this->db->where_in('dvb.table_id',$heads['tbl_fcoa_bkdn_sub']);
		    $this->db->group_end();
		}
		    
		$this->db->group_end();
		
		$this->db->group_by('`dvb`.`account_code`');
		$this->db->order_by('`dvb`.`account_code`','ASC');
		$query = $this->db->get();
        $result = $query->result_array();
        return $result;   
    }
	
	public function gplri($data,$heads){
		$this->db->select('cvb.account_code,(sum(cvb.credit) - sum(cvb.debit)) as income, mainv.current_date`');
		$this->db->from('tbl_crvoucher_bkdn as cvb');
		$this->db->join('tbl_credit_voucher as mainv','cvb.credit_voucher_id=mainv.id','left');
		$this->db->where($data, NULL, FALSE);

		$this->db->group_start();
		if($heads['tbl_fcoa']){
		    $this->db->or_group_start();
		    $this->db->where('cvb.table_name','tbl_fcoa');
		    $this->db->where_in('cvb.table_id',$heads['tbl_fcoa']);
		    $this->db->group_end();
		}
		if($heads['tbl_fcoa_bkdn']){
		    $this->db->or_group_start();
		    $this->db->where('cvb.table_name','tbl_fcoa_bkdn');
		    $this->db->where_in('cvb.table_id',$heads['tbl_fcoa_bkdn']);
		    $this->db->group_end();
		}
		if($heads['tbl_fcoa_bkdn_sub']){
		    $this->db->or_group_start();
		    $this->db->where('cvb.table_name','tbl_fcoa_bkdn_sub');
		    $this->db->where_in('cvb.table_id',$heads['tbl_fcoa_bkdn_sub']);
		    $this->db->group_end();
		}
		    
		$this->db->group_end();
		
		$this->db->group_by('`cvb`.`account_code`');
		$this->db->order_by('cvb.account_code','ASC');
		$query = $this->db->get();
        $result = $query->result_array();
        return $result;   
    }
	
	/***** /acc report for Profit_loss_report/ *****/
	
	/***** acc report for balance sheet *****/
	
	public function gplre_bal($data){
		$this->db->select('(sum(IFNULL(`tbl_general_ledger`.`dr`, 0))-sum(IFNULL(`tbl_general_ledger`.`cr`, 0))) as cost');
		$this->db->from('tbl_general_ledger');
		$this->db->join('tbl_devoucher_bkdn','tbl_devoucher_bkdn.devoucher_bkdn_id=tbl_general_ledger.devoucher_bkdn_id','left');
		$this->db->where($data, NULL, FALSE);
		$this->db->where("(`tbl_general_ledger`.`fcoa_bkdn_id` IN (select fcoa_bkdn_id from tbl_fcoa_bkdn where fcoa_id in(12,13)) or `tbl_general_ledger`.`fcoa_bkdn_sub_id` IN (select fcoa_bkdn_sub_id from tbl_fcoa_bkdn_sub where fcoa_bkdn_id = 46))", NULL, FALSE);
		//$this->db->or_where("`tbl_devoucher_bkdn`.`table_id` IN (select fcoa_bkdn_sub_id from tbl_fcoa_bkdn_sub where fcoa_bkdn_id = 46)", NULL, FALSE);
		
		//$this->db->group_by('`tbl_devoucher_bkdn`.`account_code`');
		$this->db->order_by('`tbl_devoucher_bkdn`.`account_code`','ASC');
		$query = $this->db->get();
        $result = $query->row_array();
        return $result;   
    }
	
	public function gplri_bal($data){
		$this->db->select('(sum(IFNULL(`tbl_general_ledger`.`cr`, 0))-sum(IFNULL(`tbl_general_ledger`.`dr`, 0))) as income');
		$this->db->from('tbl_general_ledger');
		$this->db->join('tbl_devoucher_bkdn','tbl_devoucher_bkdn.devoucher_bkdn_id=tbl_general_ledger.devoucher_bkdn_id','left');
		$this->db->where($data, NULL, FALSE);
		$this->db->where("(`tbl_general_ledger`.`fcoa_bkdn_id` IN (select fcoa_bkdn_id from tbl_fcoa_bkdn where fcoa_id in (11,10,9,8)) or `tbl_general_ledger`.`fcoa_bkdn_sub_id` IN (select fcoa_bkdn_sub_id from tbl_fcoa_bkdn_sub where fcoa_bkdn_id = 34))", NULL, FALSE);
		//$this->db->or_where("`tbl_devoucher_bkdn`.`table_id` IN (select fcoa_bkdn_sub_id from tbl_fcoa_bkdn_sub where fcoa_bkdn_id = 34)", NULL, FALSE);
		
		//$this->db->group_by('`tbl_devoucher_bkdn`.`account_code`');
		$this->db->order_by('tbl_devoucher_bkdn.account_code','ASC');
		$query = $this->db->get();
        $result = $query->row_array();
        return $result;   
    }
	
	
	/***** /acc report for balance sheet *****/
	
}
?>