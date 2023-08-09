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
	    $data['month']=$this->input->get('rMonth');
		$data['year']=$this->input->get('rYear');
		
		$m=$this->input->get('rMonth');
		$y=$this->input->get('rYear');
		
		if($m>6) {
    		$qy=" date(mainv.current_date) BETWEEN '".$y."-07-01' and '".$y."-".$m."-31"."' ";
    		$qm=" date(mainv.current_date) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31"."' ";
    	}else{
    		$qy=" date(mainv.current_date) BETWEEN '".($y-1)."-07-01' and '".$y."-".$m."-31"."' ";
    		$qm=" date(mainv.current_date) BETWEEN '".$y."-".$m."-01' and '".$y."-".$m."-31' ";
    	}
    	
    	
    	/* get all expense head */
    	$exphead['tbl_fcoa']=array();
	    $exphead['tbl_fcoa_bkdn']=array();
	    $exphead['tbl_fcoa_bkdn_sub']=array();
	    $exp=$this->db->query("select fcoa_id from tbl_fcoa where fcoa_master_id=5")->result();
	    if($exp){
	        foreach($exp as $ch){
	            $headsub=$this->db->query("select * from tbl_fcoa_bkdn where fcoa_id='".$ch->fcoa_id."'")->result();
	            if($headsub){
	                foreach($headsub as $hs){
	                    $headsubsub=$this->db->query("select * from tbl_fcoa_bkdn_sub where fcoa_bkdn_id='".$hs->fcoa_bkdn_id."'")->result();
	                    if($headsubsub){
	                        foreach($headsubsub as $hss){
	                            array_push($exphead['tbl_fcoa_bkdn_sub'],$hss->fcoa_bkdn_sub_id);
	                            //$data['ahead'][]=array('id'=>$hss->fcoa_bkdn_sub_id,'head_name'=>$hss->fcoa_bkdn_sub,'head_code'=>$hss->sub_code,'table_name'=>'tbl_fcoa_bkdn_sub');
	                        }
	                    }else{
	                        array_push($exphead['tbl_fcoa_bkdn'],$hs->fcoa_bkdn_id);
	                    }
	                }
	            }else{
	                array_push($exphead['tbl_fcoa'],$ch->fcoa_id);
	            }
	        }
	    }
	    /* get all income head */
	    $inchead['tbl_fcoa']=array();
	    $inchead['tbl_fcoa_bkdn']=array();
	    $inchead['tbl_fcoa_bkdn_sub']=array();
	    $inc=$this->db->query("select fcoa_id from tbl_fcoa where fcoa_master_id=4")->result();
	    if($inc){
	        foreach($inc as $ch){
	            $headsub=$this->db->query("select * from tbl_fcoa_bkdn where fcoa_id='".$ch->fcoa_id."'")->result();
	            if($headsub){
	                foreach($headsub as $hs){
	                    $headsubsub=$this->db->query("select * from tbl_fcoa_bkdn_sub where fcoa_bkdn_id='".$hs->fcoa_bkdn_id."'")->result();
	                    if($headsubsub){
	                        foreach($headsubsub as $hss){
	                            array_push($inchead['tbl_fcoa_bkdn_sub'],$hss->fcoa_bkdn_sub_id);
	                            //$data['ahead'][]=array('id'=>$hss->fcoa_bkdn_sub_id,'head_name'=>$hss->fcoa_bkdn_sub,'head_code'=>$hss->sub_code,'table_name'=>'tbl_fcoa_bkdn_sub');
	                        }
	                    }else{
	                        array_push($inchead['tbl_fcoa_bkdn'],$hs->fcoa_bkdn_id);
	                    }
	                }
	            }else{
	                array_push($inchead['tbl_fcoa'],$ch->fcoa_id);
	            }
	        }
	    }
    	
		
		//$c_data['year(tbl_debit_voucher.current_date)'] = $year;
		$data['expDataYear']=$this->Acc_rep_model->gplre($qy,$exphead);// yearly Expenses
		
		$data['incDataYear']=$this->Acc_rep_model->gplri($qy,$inchead);// yearly Income
		
		//$c_data['month(tbl_debit_voucher.current_date)'] = $month;
		$expDataMonth=$this->Acc_rep_model->gplre($qm,$exphead);// Monthly Expenses
		
		$incDataMonth=$this->Acc_rep_model->gplri($qm,$inchead);// Monthly Income
		
		// Expenses
		foreach($expDataMonth as $edm){
			$data['expDataMonth'][explode('-',$edm['account_code'])[0]]=$edm['cost'];
		}
		// Income
		foreach($incDataMonth as $idm){
			$data['incDataMonth'][explode('-',$idm['account_code'])[0]]=$idm['income'];
		}

		$mainContent=$this->load->view('accounts/report/profit_loss_report/gplr', $data, true);
			
        $result = 'success';
        $return = array('result' => $result, 'mainContent'=> $mainContent);
        print json_encode($return);
        exit;
    }
}