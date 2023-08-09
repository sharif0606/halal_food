<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cornjob extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		$this->load->model('accounts_model', 'Accounts_model', true);
	}
	
	public function index(){
	    $data['page']='accounts/pos_acc_hit';
		$this->load->view('accounts/template',$data);
	}
	
	public function submit_all(){
	    if($_GET['current_date'])
	        $date=date('Y-m-d',strtotime($_GET['current_date']));
	    else
	        $date=date('Y-m-d');
	  
	  
		$this->pos_acc_sales($date);
		$this->pos_acc_sales_return($date);
		$this->pos_acc_purchase($date);
		$this->pos_acc_purchase_return($date);
		$this->pos_acc_expense($date);
		
		$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a> Successfully Transfered</div>');
		redirect('accounts/cornjob');
	}
	
	public function pos_acc_sales($date=false){
	    if(!$date)
	        $date=date('Y-m-d');
		// get sum of 
		$sales_payment=$this->db->query("SELECT GROUP_CONCAT(id) as ids,sum(`payment`) as amount,payment_type,payment_date FROM `db_salespayments` WHERE (accstatus=0 or accstatus is null) and payment_date <= '$date' group by payment_type,payment_date")->result_array();
		
		
		// get ready for voucher
		if($sales_payment){
    		foreach($sales_payment as $sum){
    			$my_id=1;
    			$rec_date		= date('Y-m-d H:i:s',strtotime($sum['payment_date']));
    			$current_date	= $sum['payment_date'];
    			$pay_name		= 'Auto Process';
    			$purpose		= 'Sales payment';
    			$amount       	= $sum['amount'];
    			$cheque_no  	= '';
    			$cheque_dt		= '';
    			$bank			= '';
    			$voucher_no		= $this->Accounts_model->create_voucher_no($my_id);
    			
    			if(!empty($voucher_no)){
    				$data1 = array(
    					'my_id'    		=> $my_id,
    					'voucher_no'    => $voucher_no,
    					'current_date'	=> $current_date,
    					'pay_name'		=> $pay_name,
    					'purpose'		=> $purpose,
    					'amount'    	=> $amount,
    					'cheque_no'     => $cheque_no,
    					'cheque_dt'   	=> $cheque_dt,
    					'bank'    		=> $bank,
    					'rec_date'    	=> $rec_date,
    					'createdBy' 	=> 1
    					);
    				
    				$insert_id = $this->Common_model->common_insert($data1,'tbl_credit_voucher');
    				
    				if(!empty($insert_id) and $insert_id>0){
						$dr_side_id=0;
    				    if($sum['payment_type']=="1110-Cash")
    				        $dr_side_id=3;
    				    else if($sum['payment_type']=="1120-UCB")
    				        $dr_side_id=1;
    				    else if($sum['payment_type']=="1121-UCB POS")
    				        $dr_side_id=2;
    				        
    					$particularsArr		= array('Auto','Auto');
    					$account_codeArr	= array($sum['payment_type'],'4011-Sales');
    					$table_nameArr    	= array('tbl_fcoa_bkdn_sub','tbl_fcoa_bkdn');
    					$table_idArr 		= array($dr_side_id,22);
    					$debitArr 			= array($amount,'');
    					$creditArr 			= array('',$amount);
    					$bkdn_idArr 		= array('','');
    					
    					$inc=0;	
    					foreach($bkdn_idArr as $bkdn_id){
    						$insertid       ='';
    						$particulars	= '';
    						$account_code	= '';
    						$table_name    	= '';
    						$table_id 		= '';
    						$debit 			= '';
    						$credit 		= '';
    						
    						if(!empty($particularsArr[$inc])){$particulars = trim($particularsArr[$inc]);}
    						if(!empty($account_codeArr[$inc])){$account_code = $account_codeArr[$inc];}
    						if(!empty($table_nameArr[$inc])){$table_name = $table_nameArr[$inc];}
    						if(!empty($table_idArr[$inc])){$table_id = $table_idArr[$inc];}
    						if(!empty($debitArr[$inc])){$debit = $debitArr[$inc];}
    						if(!empty($creditArr[$inc])){$credit = $creditArr[$inc];}
    						
    						$data2 = array(
    							'credit_voucher_id' => $insert_id,
    							'particulars'    	=> $particulars,
    							'account_code'		=> $account_code,
    							'table_name'		=> $table_name,
    							'table_id'    		=> $table_id,
    							'debit'    			=> $debit,
    							'credit'    		=> $credit
    						);
    						
    						$insertid = $this->Common_model->common_insert($data2,'tbl_crvoucher_bkdn');
    						
    						if(!empty($insertid) and $insertid>0){
    							// Ledger part
    							if($table_name=="tbl_fcoa_master")
    								$field_name="fcoa_master_id";
    							elseif($table_name=="tbl_fcoa")
    								$field_name="fcoa_id";
    							elseif($table_name=="tbl_fcoa_bkdn")
    								$field_name="fcoa_bkdn_id";
    							elseif($table_name=="tbl_fcoa_bkdn_sub")
    								$field_name="fcoa_bkdn_sub_id";
    							
    							if($debit>0 && empty($credit)){
    								$journal_title=$particulars;
    								 $data3 = array(
    										'journal_title'=> $journal_title,
    										'dr'=> $debit,
    										'rec_date'=> $rec_date,
    										'my_id'=> $my_id,
    										'jv_id'=> $voucher_no,
    										'credit_voucher_id'=> $insert_id,
    										'crvoucher_bkdn_id' => $insertid,
    										''.$field_name.''=> $table_id
    										);
    										
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    							if(empty($debit) && $credit>0){
    								$journal_title=$particulars;
    								$data3 = array(
    										'journal_title' 	=> $journal_title,
    										'cr'    			=> $credit,
    										'rec_date'			=> $rec_date,
    										'my_id'    		    => $my_id,
    										'jv_id'    			=> $voucher_no,
    										'credit_voucher_id' => $insert_id,
    										'crvoucher_bkdn_id' => $insertid,
    										''.$field_name.''	=> $table_id
    									);
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    						}// Ledger part
    						$inc++;
    					}
    				}
    				$up=$this->db->query("UPDATE `db_salespayments` SET `accstatus`=1 where id in (".$sum['ids'].")");
    			}// voucher_no
        		
    		}
		}
	}
	
	public function pos_acc_sales_return($date=false){
	    if(!$date)
	        $date=date('Y-m-d');
		// get sum of 
		$sales_payment=$this->db->query("SELECT GROUP_CONCAT(id) as ids,sum(`payment`) as amount,payment_type,payment_date FROM `db_salespaymentsreturn` WHERE (accstatus=0 or accstatus is null) and payment_date <= '$date' group by payment_type,payment_date")->result_array();
		
		
		// get ready for voucher
		if($sales_payment){
    		foreach($sales_payment as $sum){
    			$my_id=1;
    			$rec_date		= date('Y-m-d H:i:s',strtotime($sum['payment_date']));
    			$current_date	= $sum['payment_date'];
    			$pay_name		= 'Auto Process';
    			$purpose		= 'Sales Return';
    			$amount       	= $sum['amount'];
    			$cheque_no  	= '';
    			$cheque_dt		= '';
    			$bank			= '';
    			$voucher_no		= $this->Accounts_model->create_voucher_no($my_id);
    			
    			if(!empty($voucher_no)){
    				$data1 = array(
    					'my_id'    		=> $my_id,
    					'voucher_no'    => $voucher_no,
    					'current_date'	=> $current_date,
    					'pay_name'		=> $pay_name,
    					'purpose'		=> $purpose,
    					'amount'    	=> $amount,
    					'cheque_no'     => $cheque_no,
    					'cheque_dt'   	=> $cheque_dt,
    					'bank'    		=> $bank,
    					'rec_date'    	=> $rec_date,
    					'createdBy' 	=> 1
    					);
    				
    				$insert_id = $this->Common_model->common_insert($data1,'tbl_debit_voucher');
    				
    				if(!empty($insert_id) and $insert_id>0){
    				    if($sum['payment_type']=="1110-Cash")
    				        $dr_side_id=3;
    				    else if($sum['payment_type']=="1120-UCB")
    				        $dr_side_id=1;
    				    else if($sum['payment_type']=="1121-UCB POS")
    				        $dr_side_id=2;
    				        
    					$particularsArr		= array('Auto','Auto');
    					$account_codeArr	= array('4011-Sales',$sum['payment_type']);
    					$table_nameArr    	= array('tbl_fcoa_bkdn','tbl_fcoa_bkdn_sub');
    					$table_idArr 		= array(22,$dr_side_id);
    					$debitArr 			= array($amount,'');
    					$creditArr 			= array('',$amount);
    					$bkdn_idArr 		= array('','');
    					
    					$inc=0;	
    					foreach($bkdn_idArr as $bkdn_id){
    						$insertid       ='';
    						$particulars	= '';
    						$account_code	= '';
    						$table_name    	= '';
    						$table_id 		= '';
    						$debit 			= '';
    						$credit 		= '';
    						
    						if(!empty($particularsArr[$inc])){$particulars = trim($particularsArr[$inc]);}
    						if(!empty($account_codeArr[$inc])){$account_code = $account_codeArr[$inc];}
    						if(!empty($table_nameArr[$inc])){$table_name = $table_nameArr[$inc];}
    						if(!empty($table_idArr[$inc])){$table_id = $table_idArr[$inc];}
    						if(!empty($debitArr[$inc])){$debit = $debitArr[$inc];}
    						if(!empty($creditArr[$inc])){$credit = $creditArr[$inc];}
    						
    						$data2 = array(
    							'debit_voucher_id' => $insert_id,
    							'particulars'    	=> $particulars,
    							'account_code'		=> $account_code,
    							'table_name'		=> $table_name,
    							'table_id'    		=> $table_id,
    							'debit'    			=> $debit,
    							'credit'    		=> $credit
    						);
    						
    						$insertid = $this->Common_model->common_insert($data2,'tbl_devoucher_bkdn');
    						
    						if(!empty($insertid) and $insertid>0){
    							// Ledger part
    							if($table_name=="tbl_fcoa_master")
    								$field_name="fcoa_master_id";
    							elseif($table_name=="tbl_fcoa")
    								$field_name="fcoa_id";
    							elseif($table_name=="tbl_fcoa_bkdn")
    								$field_name="fcoa_bkdn_id";
    							elseif($table_name=="tbl_fcoa_bkdn_sub")
    								$field_name="fcoa_bkdn_sub_id";
    							
    							if($debit>0 && empty($credit)){
    								$journal_title=$particulars;
    								 $data3 = array(
    										'journal_title'=> $journal_title,
    										'dr'=> $debit,
    										'rec_date'=> $rec_date,
    										'my_id'=> $my_id,
    										'jv_id'=> $voucher_no,
    										'debit_voucher_id'=> $insert_id,
    										'devoucher_bkdn_id' => $insertid,
    										''.$field_name.''=> $table_id
    										);
    										
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    							if(empty($debit) && $credit>0){
    								$journal_title=$particulars;
    								$data3 = array(
    										'journal_title' 	=> $journal_title,
    										'cr'    			=> $credit,
    										'rec_date'			=> $rec_date,
    										'my_id'    		    => $my_id,
    										'jv_id'    			=> $voucher_no,
    										'debit_voucher_id' => $insert_id,
    										'devoucher_bkdn_id' => $insertid,
    										''.$field_name.''	=> $table_id
    									);
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    						}// Ledger part
    						$inc++;
    					}
    				}
    				$up=$this->db->query("UPDATE `db_salespaymentsreturn` SET `accstatus`=1 where id in (".$sum['ids'].")");
    			}// voucher_no
        		
    		}
		}
	}
	
	public function pos_acc_purchase($date=false){
	    if(!$date)
	        $date=date('Y-m-d');
		// get sum of 
		$pur_payment=$this->db->query("SELECT GROUP_CONCAT(id) as ids,sum(`payment`) as amount,payment_type,payment_date FROM `db_purchasepayments` WHERE (accstatus=0 or accstatus is null) and payment_date <= '$date' group by payment_type,payment_date")->result_array();
		
		// get ready for voucher
		if($pur_payment){
    		foreach($pur_payment as $sum){
    			$my_id=1;
    			$rec_date		= date('Y-m-d H:i:s',strtotime($sum['payment_date']));
    			$current_date	= $sum['payment_date'];
    			$pay_name		= 'Auto Process';
    			$purpose		= 'Purchase Payment';
    			$amount       	= $sum['amount'];
    			$cheque_no  	= '';
    			$cheque_dt		= '';
    			$bank			= '';
    			$voucher_no		= $this->Accounts_model->create_voucher_no($my_id);
    			
    			if(!empty($voucher_no)){
    				$data1 = array(
    					'my_id'    		=> $my_id,
    					'voucher_no'    => $voucher_no,
    					'current_date'	=> $current_date,
    					'pay_name'		=> $pay_name,
    					'purpose'		=> $purpose,
    					'amount'    	=> $amount,
    					'cheque_no'     => $cheque_no,
    					'cheque_dt'   	=> $cheque_dt,
    					'bank'    		=> $bank,
    					'rec_date'    	=> $rec_date,
    					'createdBy' 	=> 1
    					);
    				
    				$insert_id = $this->Common_model->common_insert($data1,'tbl_debit_voucher');
    				
    				if(!empty($insert_id) and $insert_id>0){
    				    if($sum['payment_type']=="1110-Cash")
    				        $dr_side_id=3;
    				    else if($sum['payment_type']=="1120-UCB")
    				        $dr_side_id=1;
    				    else if($sum['payment_type']=="1121-UCB POS")
    				        $dr_side_id=2;
    				        
    					$particularsArr		= array('Auto','Auto');
    					$account_codeArr	= array('5016-Purchase',$sum['payment_type']);
    					$table_nameArr    	= array('tbl_fcoa_bkdn','tbl_fcoa_bkdn_sub');
    					$table_idArr 		= array(23,$dr_side_id);
    					$debitArr 			= array($amount,'');
    					$creditArr 			= array('',$amount);
    					$bkdn_idArr 		= array('','');
    					
    					$inc=0;	
    					foreach($bkdn_idArr as $bkdn_id){
    						$insertid       ='';
    						$particulars	= '';
    						$account_code	= '';
    						$table_name    	= '';
    						$table_id 		= '';
    						$debit 			= '';
    						$credit 		= '';
    						
    						if(!empty($particularsArr[$inc])){$particulars = trim($particularsArr[$inc]);}
    						if(!empty($account_codeArr[$inc])){$account_code = $account_codeArr[$inc];}
    						if(!empty($table_nameArr[$inc])){$table_name = $table_nameArr[$inc];}
    						if(!empty($table_idArr[$inc])){$table_id = $table_idArr[$inc];}
    						if(!empty($debitArr[$inc])){$debit = $debitArr[$inc];}
    						if(!empty($creditArr[$inc])){$credit = $creditArr[$inc];}
    						
    						$data2 = array(
    							'debit_voucher_id' => $insert_id,
    							'particulars'    	=> $particulars,
    							'account_code'		=> $account_code,
    							'table_name'		=> $table_name,
    							'table_id'    		=> $table_id,
    							'debit'    			=> $debit,
    							'credit'    		=> $credit
    						);
    						
    						$insertid = $this->Common_model->common_insert($data2,'tbl_devoucher_bkdn');
    						
    						if(!empty($insertid) and $insertid>0){
    							// Ledger part
    							if($table_name=="tbl_fcoa_master")
    								$field_name="fcoa_master_id";
    							elseif($table_name=="tbl_fcoa")
    								$field_name="fcoa_id";
    							elseif($table_name=="tbl_fcoa_bkdn")
    								$field_name="fcoa_bkdn_id";
    							elseif($table_name=="tbl_fcoa_bkdn_sub")
    								$field_name="fcoa_bkdn_sub_id";
    							
    							if($debit>0 && empty($credit)){
    								$journal_title=$particulars;
    								 $data3 = array(
    										'journal_title'=> $journal_title,
    										'dr'=> $debit,
    										'rec_date'=> $rec_date,
    										'my_id'=> $my_id,
    										'jv_id'=> $voucher_no,
    										'debit_voucher_id'=> $insert_id,
    										'devoucher_bkdn_id' => $insertid,
    										''.$field_name.''=> $table_id
    										);
    										
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    							if(empty($debit) && $credit>0){
    								$journal_title=$particulars;
    								$data3 = array(
    										'journal_title' 	=> $journal_title,
    										'cr'    			=> $credit,
    										'rec_date'			=> $rec_date,
    										'my_id'    		    => $my_id,
    										'jv_id'    			=> $voucher_no,
    										'debit_voucher_id' => $insert_id,
    										'devoucher_bkdn_id' => $insertid,
    										''.$field_name.''	=> $table_id
    									);
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    						}// Ledger part
    						$inc++;
    					}
    				}
    				$up=$this->db->query("UPDATE `db_purchasepayments` SET `accstatus`=1 where id in (".$sum['ids'].")");
    			}// voucher_no
        		
    		}
		}
	}

	public function pos_acc_purchase_return($date=false){
	    if(!$date)
	        $date=date('Y-m-d');
		// get sum of 
		$sales_payment=$this->db->query("SELECT GROUP_CONCAT(id) as ids,sum(`payment`) as amount,payment_type,payment_date FROM `db_purchasepaymentsreturn` WHERE (accstatus=0 or accstatus is null) and payment_date <= '$date' group by payment_type,payment_date")->result_array();
		
		
		// get ready for voucher
		if($sales_payment){
    		foreach($sales_payment as $sum){
    			$my_id=1;
    			$rec_date		= date('Y-m-d H:i:s',strtotime($sum['payment_date']));
    			$current_date	= $sum['payment_date'];
    			$pay_name		= 'Auto Process';
    			$purpose		= 'Purchase Return';
    			$amount       	= $sum['amount'];
    			$cheque_no  	= '';
    			$cheque_dt		= '';
    			$bank			= '';
    			$voucher_no		= $this->Accounts_model->create_voucher_no($my_id);
    			
    			if(!empty($voucher_no)){
    				$data1 = array(
    					'my_id'    		=> $my_id,
    					'voucher_no'    => $voucher_no,
    					'current_date'	=> $current_date,
    					'pay_name'		=> $pay_name,
    					'purpose'		=> $purpose,
    					'amount'    	=> $amount,
    					'cheque_no'     => $cheque_no,
    					'cheque_dt'   	=> $cheque_dt,
    					'bank'    		=> $bank,
    					'rec_date'    	=> $rec_date,
    					'createdBy' 	=> 1
    					);
    				
    				$insert_id = $this->Common_model->common_insert($data1,'tbl_credit_voucher');
    				
    				if(!empty($insert_id) and $insert_id>0){
    				    if($sum['payment_type']=="1110-Cash")
    				        $dr_side_id=3;
    				    else if($sum['payment_type']=="1120-UCB")
    				        $dr_side_id=1;
    				    else if($sum['payment_type']=="1121-UCB POS")
    				        $dr_side_id=2;
    				        
    					$particularsArr		= array('Auto','Auto');
    					$account_codeArr	= array($sum['payment_type'],'5016-Purchase');
    					$table_nameArr    	= array('tbl_fcoa_bkdn_sub','tbl_fcoa_bkdn');
    					$table_idArr 		= array($dr_side_id,23);
    					$debitArr 			= array($amount,'');
    					$creditArr 			= array('',$amount);
    					$bkdn_idArr 		= array('','');
    					
    					$inc=0;	
    					foreach($bkdn_idArr as $bkdn_id){
    						$insertid       ='';
    						$particulars	= '';
    						$account_code	= '';
    						$table_name    	= '';
    						$table_id 		= '';
    						$debit 			= '';
    						$credit 		= '';
    						
    						if(!empty($particularsArr[$inc])){$particulars = trim($particularsArr[$inc]);}
    						if(!empty($account_codeArr[$inc])){$account_code = $account_codeArr[$inc];}
    						if(!empty($table_nameArr[$inc])){$table_name = $table_nameArr[$inc];}
    						if(!empty($table_idArr[$inc])){$table_id = $table_idArr[$inc];}
    						if(!empty($debitArr[$inc])){$debit = $debitArr[$inc];}
    						if(!empty($creditArr[$inc])){$credit = $creditArr[$inc];}
    						
    						$data2 = array(
    							'credit_voucher_id' => $insert_id,
    							'particulars'    	=> $particulars,
    							'account_code'		=> $account_code,
    							'table_name'		=> $table_name,
    							'table_id'    		=> $table_id,
    							'debit'    			=> $debit,
    							'credit'    		=> $credit
    						);
    						
    						$insertid = $this->Common_model->common_insert($data2,'tbl_crvoucher_bkdn');
    						
    						if(!empty($insertid) and $insertid>0){
    							// Ledger part
    							if($table_name=="tbl_fcoa_master")
    								$field_name="fcoa_master_id";
    							elseif($table_name=="tbl_fcoa")
    								$field_name="fcoa_id";
    							elseif($table_name=="tbl_fcoa_bkdn")
    								$field_name="fcoa_bkdn_id";
    							elseif($table_name=="tbl_fcoa_bkdn_sub")
    								$field_name="fcoa_bkdn_sub_id";
    							
    							if($debit>0 && empty($credit)){
    								$journal_title=$particulars;
    								 $data3 = array(
    										'journal_title'=> $journal_title,
    										'dr'=> $debit,
    										'rec_date'=> $rec_date,
    										'my_id'=> $my_id,
    										'jv_id'=> $voucher_no,
    										'credit_voucher_id'=> $insert_id,
    										'crvoucher_bkdn_id' => $insertid,
    										''.$field_name.''=> $table_id
    										);
    										
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    							if(empty($debit) && $credit>0){
    								$journal_title=$particulars;
    								$data3 = array(
    										'journal_title' 	=> $journal_title,
    										'cr'    			=> $credit,
    										'rec_date'			=> $rec_date,
    										'my_id'    		    => $my_id,
    										'jv_id'    			=> $voucher_no,
    										'credit_voucher_id' => $insert_id,
    										'crvoucher_bkdn_id' => $insertid,
    										''.$field_name.''	=> $table_id
    									);
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    						}// Ledger part
    						$inc++;
    					}
    				}
    				$up=$this->db->query("UPDATE `db_purchasepaymentsreturn` SET `accstatus`=1 where id in (".$sum['ids'].")");
    			}// voucher_no
        		
    		}
		}
	}
	
	public function pos_acc_expense($date=false){
	    if(!$date)
	        $date=date('Y-m-d');
		// get sum of 
		$exppayment=$this->db->query("SELECT GROUP_CONCAT(id) as ids,sum(`expense_amt`) as amount,GROUP_CONCAT(expense_for) as expense_for,expense_date,category_id FROM `db_expense` WHERE (accstatus=0 or accstatus is null) and expense_date <= '$date' group by category_id,expense_date")->result_array();
		
		// get ready for voucher
		if($exppayment){
    		foreach($exppayment as $sum){
    			$my_id=1;
    			$rec_date		= date('Y-m-d H:i:s',strtotime($sum['expense_date']));
    			$current_date	= $sum['expense_date'];
    			$pay_name		= "Auto Process";
    			$purpose		= $sum['expense_for'];
    			$amount       	= $sum['amount'];
    			$cheque_no  	= '';
    			$cheque_dt		= '';
    			$bank			= '';
    			$voucher_no		= $this->Accounts_model->create_voucher_no($my_id);
    			
    			if(!empty($voucher_no)){
    				$data1 = array(
    					'my_id'    		=> $my_id,
    					'voucher_no'    => $voucher_no,
    					'current_date'	=> $current_date,
    					'pay_name'		=> $pay_name,
    					'purpose'		=> $purpose,
    					'amount'    	=> $amount,
    					'cheque_no'     => $cheque_no,
    					'cheque_dt'   	=> $cheque_dt,
    					'bank'    		=> $bank,
    					'rec_date'    	=> $rec_date,
    					'createdBy' 	=> 1
    					);
    				
    				$insert_id = $this->Common_model->common_insert($data1,'tbl_debit_voucher');
    				
    				if(!empty($insert_id) and $insert_id>0){
    				    if($sum['category_id']=="24")
    				        $dr_side="5017-Showroom";
    				        
    					$particularsArr		= array('Auto','Auto');
    					$account_codeArr	= array($dr_side,"1110-Cash");
    					$table_nameArr    	= array('tbl_fcoa_bkdn','tbl_fcoa_bkdn_sub');
    					$table_idArr 		= array($sum['category_id'],3);
    					$debitArr 			= array($amount,'');
    					$creditArr 			= array('',$amount);
    					$bkdn_idArr 		= array('','');
    					
    					$inc=0;	
    					foreach($bkdn_idArr as $bkdn_id){
    						$insertid       ='';
    						$particulars	= '';
    						$account_code	= '';
    						$table_name    	= '';
    						$table_id 		= '';
    						$debit 			= '';
    						$credit 		= '';
    						
    						if(!empty($particularsArr[$inc])){$particulars = trim($particularsArr[$inc]);}
    						if(!empty($account_codeArr[$inc])){$account_code = $account_codeArr[$inc];}
    						if(!empty($table_nameArr[$inc])){$table_name = $table_nameArr[$inc];}
    						if(!empty($table_idArr[$inc])){$table_id = $table_idArr[$inc];}
    						if(!empty($debitArr[$inc])){$debit = $debitArr[$inc];}
    						if(!empty($creditArr[$inc])){$credit = $creditArr[$inc];}
    						
    						$data2 = array(
    							'debit_voucher_id' => $insert_id,
    							'particulars'    	=> $particulars,
    							'account_code'		=> $account_code,
    							'table_name'		=> $table_name,
    							'table_id'    		=> $table_id,
    							'debit'    			=> $debit,
    							'credit'    		=> $credit
    						);
    						
    						$insertid = $this->Common_model->common_insert($data2,'tbl_devoucher_bkdn');
    						
    						if(!empty($insertid) and $insertid>0){
    							// Ledger part
    							if($table_name=="tbl_fcoa_master")
    								$field_name="fcoa_master_id";
    							elseif($table_name=="tbl_fcoa")
    								$field_name="fcoa_id";
    							elseif($table_name=="tbl_fcoa_bkdn")
    								$field_name="fcoa_bkdn_id";
    							elseif($table_name=="tbl_fcoa_bkdn_sub")
    								$field_name="fcoa_bkdn_sub_id";
    							
    							if($debit>0 && empty($credit)){
    								$journal_title=$particulars;
    								 $data3 = array(
    										'journal_title'=> $journal_title,
    										'dr'=> $debit,
    										'rec_date'=> $rec_date,
    										'my_id'=> $my_id,
    										'jv_id'=> $voucher_no,
    										'debit_voucher_id'=> $insert_id,
    										'devoucher_bkdn_id' => $insertid,
    										''.$field_name.''=> $table_id
    										);
    										
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    							if(empty($debit) && $credit>0){
    								$journal_title=$particulars;
    								$data3 = array(
    										'journal_title' 	=> $journal_title,
    										'cr'    			=> $credit,
    										'rec_date'			=> $rec_date,
    										'my_id'    		    => $my_id,
    										'jv_id'    			=> $voucher_no,
    										'debit_voucher_id' => $insert_id,
    										'devoucher_bkdn_id' => $insertid,
    										''.$field_name.''	=> $table_id
    									);
    								$this->Common_model->common_insert($data3,'tbl_general_ledger');
    							}
    						}// Ledger part
    						$inc++;
    					}
    				}
    				$up=$this->db->query("UPDATE `db_expense` SET `accstatus`=1 where id in (".$sum['ids'].")");
    			}// voucher_no
        		
    		}
		}
	}

}