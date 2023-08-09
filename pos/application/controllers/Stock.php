<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load_global();
		$this->load->model('stock_model','sales');
		$this->load->helper('sms_template_helper');
	}

	public function is_sms_enabled(){
		return is_sms_enabled();
	}

	public function index()
	{
		$this->permission_check('sales_view');
		$data=$this->data;
		$data['page_title']=$this->lang->line('stock_list');
		$this->load->view('stock_list',$data);
	}
	public function add()
	{	
		$this->permission_check('sales_add');
		$data=$this->data;
		$data['page_title']=$this->lang->line('stock_exchange');
		$this->load->view('stock_adjustment',$data);
	}
	

	public function stock_save_and_update(){
		$this->form_validation->set_rules('entry_date', 'Exchange Date', 'trim|required');
		$this->form_validation->set_rules('warehouse_from', 'From Warehouse', 'trim|required');
		$this->form_validation->set_rules('warehouse_to', 'To Warehouse', 'trim|required');
		
		if ($this->form_validation->run() == TRUE) {
	    	$result = $this->sales->verify_save_and_update();
	    	echo $result;
		} else {
			echo "Please Fill Compulsory(* marked) Fields.";
		}
	}
	

	public function ajax_list(){
		$list = $this->sales->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $sales) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = show_date($sales->exc_date);
			$row[] = $sales->warf;
			$row[] = $sales->wart;
			$row[] = $this->get_item_d($sales->id);
			$row[] = $sales->exc_note;
			$row[] = ucfirst($sales->created_by);

			$str2 = '<a class="btn btn-primary btn-o" href="'.base_url('stock/delete_stock/'.$sales->id).'"> Delete </a>';			

			$row[] = $str2;

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->sales->count_all(),
						"recordsFiltered" => $this->sales->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function get_item_d($s){
		$q3=$this->db->query("SELECT concat(db_items.item_name,' - ',db_stockentry.qty) as itm FROM `db_stockentry` join db_items on db_items.id=db_stockentry.item_id WHERE `qty`>0 and `exc_id`=".$s)->result();
        $d="";
        if($q3){
            foreach($q3 as $q){
                $d.=$q->itm."<br>";
            }
		    return $d;
		}else{
		    return false;
		}
	
	}
	
	public function delete_stock($id){
		$this->permission_check_with_msg('sales_delete');
		$this->sales->delete_stock($id);
		redirect('stock');
	}


	//Table ajax code
	public function search_item(){
		$q=$this->input->get('q');
		$result=$this->sales->search_item($q);
		echo $result;
	}
	public function find_item_details(){
		$id=$this->input->post('id');
		
		$result=$this->sales->find_item_details($id);
		echo $result;
	}


	public function pdf($sales_id){
		if(!$this->permissions('sales_add') && !$this->permissions('sales_edit')){
			$this->show_access_denied_page();
		}
		
		$data=$this->data;
		$data['page_title']=$this->lang->line('sales_invoice');
        $data=array_merge($data,array('sales_id'=>$sales_id));
        if(get_invoice_format_id()==3){
			$this->load->view('print-sales-invoice-3',$data);
		}
		else if(get_invoice_format_id()==2){
			$this->load->view('print-sales-invoice-2',$data);
		}
		else{
			$this->load->view('print-sales-invoice',$data);
		}
       

        // Get output html
        $html = $this->output->get_output();
        // Load pdf library
        $this->load->library('pdf');
        
        // Load HTML content
        $this->dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation
        $this->dompdf->setPaper('A4', 'portrait');/*landscape or portrait*/
        
        // Render the HTML as PDF
        $this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview)
        $this->dompdf->stream("Sales_invoice_$sales_id", array("Attachment"=>0));
	}

	/*v1.1*/
	public function return_row_with_data($rowcount,$item_id,$stock){
		echo $this->sales->get_items_info($rowcount,$item_id,$stock);
	}
	public function return_sales_list($sales_id){
		echo $this->sales->return_sales_list($sales_id);
	}
}
