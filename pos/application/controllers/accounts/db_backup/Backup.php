<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
	}
	public function index()
	{
		//load helpers

        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        
        //load database
        $this->load->dbutil();
        
        //create format
        $db_format=array('format'=>'zip','filename'=>'backup.sql');
        
        $backup= $this->dbutil->backup($db_format);
        
        // file name
        
        $dbname='backup-on-'.date('d-m-y H:i').'.zip';
        $save='assets/db_backup/'.$dbname;
        
        // write file
        
        write_file($save,$backup);
        
        // and force download
        //force_download($dbname,$backup);
        			
		//$this->session->set_flashdata('message', '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a>Databae Backup Successfully</div>');
		//redirect('Dashboard');

	}

}
