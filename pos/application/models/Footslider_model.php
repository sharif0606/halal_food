<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footslider_model extends CI_Model {

	var $table = 'footer_sliders';
	var $column_order = array(null, 'title','link','short_description','fslider_image'); //set column field database for datatable orderable
	var $column_search = array('title','link','short_description','fslider_image'); //set column field database for datatable searchable
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


        $file_name='';
        if(!empty($_FILES['fslider_image']['name'])){
            $new_name = time();
            $config['file_name'] = $new_name;
            $config['upload_path']          = './uploads/fslider_image/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 1024000;
            $config['max_width']            = 100000;
            $config['max_height']           = 100000;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('fslider_image')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
            }else{
                $file_name=$this->upload->data('file_name');
                /*Create Thumbnail*/
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/fslider_image/'.$file_name;
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 1290;
                $config['height']       = 400;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                //end
            }
        }


        $query1="insert into footer_sliders(fslider_image,title,short_description,link)
                            values('$file_name','$title','$short_description','$link')";
        if ($this->db->simple_query($query1)){
                $this->session->set_flashdata('success', 'Success!! New Footer Sliders Added Successfully!');
                return "success";
        }
        else{
                return "failed";
        }

	}

	//Get category_details
	public function get_details($id,$data){
		//Validate This category already exist or not
		$query=$this->db->query("select * from footer_sliders where upper(id)=upper('$id')");
		if($query->num_rows()==0){
			show_404();exit;
		}
		else{
			$query=$query->row();
			$data['q_id']=$query->id;
			$data['fslider_image']=$query->fslider_image;
			$data['title']=$query->title;
			$data['short_description']=$query->short_description;
			$data['link']=$query->link;
			return $data;
		}
	}
	public function update_fslider(){
		//Filtering XSS and html escape from user inputs
		extract($this->security->xss_clean(html_escape(array_merge($this->data,$_POST))));

		//Validate This category already exist or not

        $file_name='';
        if(!empty($_FILES['fslider_image']['name'])){
            $new_name = time();
            $config['file_name'] = $new_name;
            $config['upload_path']          = './uploads/fslider_image/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['max_size']             = 1024000;
            $config['max_width']            = 100000;
            $config['max_height']           = 100000;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('fslider_image')){
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
            }else{
                $file_name="fslider_image='".$this->upload->data('file_name')."', ";
                /*Create Thumbnail*/
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'uploads/fslider_image/'.$file_name;
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 1290;
                $config['height']       = 400;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                //end
            }
        }

			$query1="update footer_sliders set $file_name short_description='$short_description',title='$title',link='$link' where id=$q_id";
			if ($this->db->simple_query($query1)){
					$this->session->set_flashdata('success', 'Success!! Slider Updated Successfully!');
			        return "success";
			}
			else{
			        return "failed";
			}

	}

	public function delete_fslider_from_table($ids){

			$query1="delete from footer_sliders where id in($ids)";
	        if ($this->db->simple_query($query1)){
	            echo "success";
	        }
	        else{
	            echo "failed";
	        }

	}


}
