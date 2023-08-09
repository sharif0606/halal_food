<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontsettings_model extends CI_Model {

	var $table = 'frontsettings';
	var $column_order = array(null, 'popular_icon','offer_icon','logo_img','description','address','phone','email','facebooklink','twitterlink','linkdinlink','youtubelink'); //set column field database for datatable orderable
	var $column_search = array('popular_icon','offer_icon','logo_img','description','address','phone','email','facebooklink','twitterlink','linkdinlink','youtubelink'); //set column field database for datatable searchable
	var $order = array('id' => 'desc'); // default order

	private function _get_datatables_query()
	{

		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item) // loop column
		{
			if(isset($_POST['search']['value'])) // if datatable send POST for search
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
		//if($_POST['length'] != -1)
		//$this->db->limit($_POST['length'], $_POST['start']);
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


        $file_name=$popular_icon=$offer_icon=$logo_img='';
		if(!empty($_FILES['popular_icon']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/fsettings_image/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024000;
	        $config['max_width']            = 100000;
	        $config['max_height']           = 100000;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('popular_icon')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{
	        	$popular_icon=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/fsettings_image/'.$popular_icon;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width']         = 20;
				$config['height']       = 20;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
	        }
		}
		if(!empty($_FILES['offer_icon']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/fsettings_image/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024000;
	        $config['max_width']            = 100000;
	        $config['max_height']           = 100000;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('offer_icon')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{
	        	$offer_icon=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/fsettings_image/'.$offer_icon;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width']         = 20;
				$config['height']       = 20;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
	        }
		}
        if(!empty($_FILES['logo_img']['name'])){
            $new_name = time();
            $config['file_name'] = $new_name;
            $config['upload_path']          = './uploads/fsettings_image/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 1024000;
            $config['max_width']            = 100000;
            $config['max_height']           = 100000;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('logo_img')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
            }else{
                $logo_img=$this->upload->data('file_name');
                /*Create Thumbnail*/
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/fsettings_image/'.$logo_img;
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 200;
                $config['height']       = 100;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                //end
            }
        }

        $query1="insert into frontsettings(popular_icon,offer_icon,logo_img,description,address,phone,email,facebooklink,twitterlink,linkdinlink,youtubelink)
                            values('$popular_icon','$offer_icon','$logo_img','$description','$address','$phone','$email','$facebooklink','$twitterlink','$linkdinlink','$youtubelink')";
        if ($this->db->simple_query($query1)){
                $this->session->set_flashdata('success', 'Success!! Settiongs Added Successfully!');
                return "success";
        }
        else{
                return "failed";
        }

	}

	//Get category_details
	public function get_details($id,$data){
		//Validate This category already exist or not
		$query=$this->db->query("select * from frontsettings where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['popular_icon']=$query->popular_icon;
			$data['offer_icon']=$query->offer_icon;
			$data['logo_img']=$query->logo_img;
			$data['address']=$query->address;
			$data['description']=$query->description;
			$data['phone']=$query->phone;
			$data['email']=$query->email;
			$data['facebooklink']=$query->facebooklink;
			$data['twitterlink']=$query->twitterlink;
			$data['linkdinlink']=$query->linkdinlink;
			$data['youtubelink']=$query->youtubelink;
			return $data;
		}
	}
	public function update_settings(){
		//Filtering XSS and html escape from user inputs
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

		//Validate This category already exist or not

        $file_name='';
		if(!empty($_FILES['popular_icon']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/fsettings_image/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024000;
	        $config['max_width']            = 100000;
	        $config['max_height']           = 100000;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('popular_icon')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{
	        	$popular_icon=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/fsettings_image/'.$popular_icon;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width']         = 20;
				$config['height']       = 20;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
                $file_name.=" ,popular_icon='".$popular_icon."' ";
	        }
		}
		if(!empty($_FILES['offer_icon']['name'])){
			$new_name = time();
			$config['file_name'] = $new_name;
			$config['upload_path']          = './uploads/fsettings_image/';
	        $config['allowed_types']        = 'jpg|png|jpeg';
	        $config['max_size']             = 1024000;
	        $config['max_width']            = 100000;
	        $config['max_height']           = 100000;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('offer_icon')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
	        }else{
	        	$offer_icon=$this->upload->data('file_name');
	        	/*Create Thumbnail*/
	        	$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/fsettings_image/'.$offer_icon;
				$config['create_thumb'] = false;
				$config['maintain_ratio'] = false;
				$config['width']         = 20;
				$config['height']       = 20;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				//end
                $file_name.=" ,offer_icon='".$offer_icon."' ";
	        }
		}
        if(!empty($_FILES['logo_img']['name'])){
            $new_name = time();
            $config['file_name'] = $new_name;
            $config['upload_path']          = './uploads/fsettings_image/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 1024000;
            $config['max_width']            = 100000;
            $config['max_height']           = 100000;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('logo_img')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
            }else{
                $logo_img=$this->upload->data('file_name');
                /*Create Thumbnail*/
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/fsettings_image/'.$logo_img;
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 200;
                $config['height']       = 100;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                //end
                $file_name.=" ,logo_img='".$logo_img."' ";
            }
        }
			$query1="update frontsettings set description='$description',address='$address',phone='$phone',email='$email',facebooklink='$facebooklink',twitterlink='$twitterlink',linkdinlink='$linkdinlink',youtubelink='$youtubelink' $file_name where id=$q_id";
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! Front Setting Updated Successfully!');
			        return "success";
			}
			else{
			        return "failed";
			}

	}

	public function delete_slider_from_table($ids){

			$query1="delete from frontsettings where id in($ids)";
	        if ($this->db->simple_query($query1)){
	            echo "success";
	        }
	        else{
	            echo "failed";
	        }

	}


}
