<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	var $table = 'db_category';
	var $column_order = array(null, 'category_code','category_name','description','status'); //set column field database for datatable orderable
	var $column_search = array('category_code','category_name','description','status'); //set column field database for datatable searchable 
	var $order = array('id' => 'desc'); // default order 

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


	public function verify_and_save(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

		//Validate This category already exist or not
		$query=$this->db->query("select * from db_category where upper(category_name)=upper('$category')");
		if($query->num_rows()>0){
			return "This Category Name already Exist.";
		}
		else{
			$qs5="select category_init from db_company";
			$q5=$this->db->query($qs5);
			$category_init=$q5->row()->category_init;
			
			//Create category unique Number
			$qs4="select coalesce(max(id),0)+1 as maxid from db_category";
			$q1=$this->db->query($qs4);
			$maxid=$q1->row()->maxid;
			$cat_code='CT'.str_pad($maxid, 4, '0', STR_PAD_LEFT);
			//end
			
			$file_name=$banner_image=$advertise_image='';
		if(!empty($_FILES['image']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/category/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024;
	        $config['max_width']            = 1000;
	        $config['max_height']           = 1000;
	       
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('image')){	
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{		
	        	$file_name=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/category/'.$file_name;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 75;
				$config['height']       = 50;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
	        }
		}
		if(!empty($_FILES['banner_image']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/category/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024;
	        $config['max_width']            = 1000;
	        $config['max_height']           = 1000;
	       
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('banner_image')){	
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{		
	        	$banner_image=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/category/'.$banner_image;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 1200;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
	        }
		}
		if(!empty($_FILES['advertise_image']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/category/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024;
	        $config['max_width']            = 337;
	        $config['max_height']           = 600;
	       
	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('advertise_image')){	
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{		
	        	$advertise_image=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/category/'.$advertise_image;
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 337;
				$config['height']       = 600;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
	        }
		}

			$query1="insert into db_category(category_code,category_name,image,banner_image,advertise_image,is_slied,is_advertise,description,status) 
								values('$cat_code','$category','$file_name','$banner_image','$advertise_image','$is_advertise','$is_slied','$description',1)";
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! New Category Added Successfully!');
			        return "success";
			}
			else{
			        return "failed";
			}
		}
	}

	//Get category_details
	public function get_details($id,$data){
		//Validate This category already exist or not
		$query=$this->db->query("select * from db_category where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['category_code']=$query->category_code;
			$data['category_name']=$query->category_name;
			$data['is_slied']=$query->is_slied;
			$data['is_advertise']=$query->is_advertise;
			$data['image']=$query->image;
			$data['banner_image']=$query->banner_image;
			$data['advertise_image']=$query->advertise_image;
			$data['description']=$query->description;
			return $data;
		}
	}
	public function update_category(){
		//Filtering XSS and html escape from user inputs 
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

		//Validate This category already exist or not
		$query=$this->db->query("select * from db_category where upper(category_name)=upper('$category') and id<>$q_id");
		if($query->num_rows()>0){
			return "This Category Name already Exist.";
			
		}
		else{
			
			$file_name=$image='';
			if(!empty($_FILES['image']['name'])){
				$new_name = time();
				$config['file_name'] = $new_name;
				$config['upload_path']          = './uploads/category/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 1024;
				$config['max_width']            = 1000;
				$config['max_height']           = 1000;
			   
				$this->load->library('upload', $config);
	
				if ( ! $this->upload->do_upload('image')){	
					$error = array('error' => $this->upload->display_errors());
					print($error['error']);
					exit();
				}else{		
					$file_name=$this->upload->data('file_name');
					/*Create Thumbnail*/
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'uploads/category/'.$file_name;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']         = 75;
					$config['height']       = 50;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					//end

					$image.=" ,image='".$config['source_image']."' ";
				}
			}
			if(!empty($_FILES['banner_image']['name'])){
				$new_name = time();
				$config['file_name'] = $new_name;
				$config['upload_path']          = './uploads/category/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 1024;
				$config['max_width']            = 1000;
				$config['max_height']           = 1000;
			   
				$this->load->library('upload', $config);
	
				if ( ! $this->upload->do_upload('banner_image')){	
					$error = array('error' => $this->upload->display_errors());
					print($error['error']);
					exit();
				}else{		
					$banner_image=$this->upload->data('file_name');
					/*Create Thumbnail*/
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'uploads/category/'.$banner_image;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']         = 1200;
					$config['height']       = 250;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					//end

					$image.=" ,banner_image='".$config['source_image']."' ";
				}
			}
			if(!empty($_FILES['advertise_image']['name'])){
				$new_name = time();
				$config['file_name'] = $new_name;
				$config['upload_path']          = './uploads/category/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 1024;
				$config['max_width']            = 1000;
				$config['max_height']           = 1000;
			   
				$this->load->library('upload', $config);
	
				if ( ! $this->upload->do_upload('advertise_image')){	
					$error = array('error' => $this->upload->display_errors());
					print($error['error']);
					exit();
				}else{		
					$advertise_image=$this->upload->data('file_name');
					/*Create Thumbnail*/
					$config['image_library'] = 'gd2';
					$config['source_image'] = 'uploads/category/'.$advertise_image;
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width']         = 1200;
					$config['height']       = 250;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					//end

					$image.=" ,advertise_image='".$config['source_image']."' ";
				}
			}


			$query1="update db_category set category_name='$category',description='$description',is_slied='$is_slied',is_advertise='$is_advertise' $image where id=$q_id";
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! Category Updated Successfully!');
			        return "success";    
			}
			else{
			        return "failed";
			}
		}
	}
	public function update_status($id,$status){
		
        $query1="update db_category set status='$status' where id=$id";
        if ($this->db->simple_query($query1)){
            echo "success";
        }
        else{
            echo "failed";
        }
	}
	public function delete_categories_from_table($ids){
		$tot=$this->db->query('SELECT COUNT(*) AS tot,b.category_name FROM db_items a,`db_category` b WHERE b.id=a.`category_id` AND a.category_id IN ('.$ids.') GROUP BY a.category_id');
		if($tot->num_rows() > 0){
			foreach($tot->result() as $res){
				$category_name[] =$res->category_name;
			}
			$list=implode (",",$category_name);
			echo "Sorry! Can't Delete,<br>Category Name {".$list."} already in use in Items!";
			exit();
		}
		else{
			$query1="delete from db_category where id in($ids)";
	        if ($this->db->simple_query($query1)){
	            echo "success";
	        }
	        else{
	            echo "failed";
	        }	
		}
	}


}
