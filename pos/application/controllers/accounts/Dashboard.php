<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model', 'Common_model', true);
		
	}
	
	public function index()
	{
		$data['page']="accounts/dashboard";
		$this->load->view('accounts/template',$data);
	}
}
