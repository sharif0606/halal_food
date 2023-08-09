<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cornjob_run extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$data['page']="accounts/report/cornjob/run_r";
		$this->load->view('accounts/template',$data);
	}
}
