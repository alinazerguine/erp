<?php


class Mod_users extends CI_Model {

	public function get_count(){	

		$this->db->select(array("*"));
		$this->db->from("users");

		$query = $this->db->get();
		return $query->num_rows();	
	}
	public function get_users($id=0){
		//print_r($_POST);
		$column_order = array("id","name","email","user_type"); //set column field database for datatable orderable
		$column_search = array("id","name","email","user_type"); //set column field database for datatable searchable 
		$order = array('id' => 'asc'); // default order 
		
		$this->db->select(array("*","CASE 
            WHEN user_type =1 THEN 'Administrator'
            WHEN user_type =2 THEN 'Site Manager'
            WHEN user_type =3 THEN 'HR Manager'
            END AS designation"));
		$this->db->from("users");		
		
		$i = 0;
       if($id==0){
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

               $search_value = $_POST['search']['value'];
               if(strpos($search_value, 'Administrator') !== false){
                $search_text = 1;
            }elseif(strpos($search_value, 'Site Manager') !== false){
                $search_text = 2;
            }elseif(strpos($search_value, 'HR Manager') !== false){
                $search_text = 3;
            }else{

                $search_text = $search_value;
            }



                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $search_text);
                }
                else
                {
                    $this->db->or_like($item, $search_text);
                }

                if(count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                }


                $i++;
            }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
		//echo $this->db->get_compiled_select();exit;
        $query = $this->db->get();
        return $query->result();
    }else{
    	$this->db->where('id',$id);
    	$query = $this->db->get();
        return $query->row();
    }

}
public function add_user()
{
  $name = $this->input->post('name');
  $email = $this->input->post('email');
  $password = $this->input->post('password');
  $user_type = $this->input->post('user_type');

  $filename = "";

  if ($_FILES['user_image']['name'] != "") {

    $projects_folder_path = './assets/images/users/';

    $thumb =  './assets/images/users/thumbnail';


    $orignal_file_name = $_FILES['user_image']['name'];

    $file_ext = ltrim(strtolower(strrchr($_FILES['user_image']['name'], '.')), '.');

    $rand_num = rand(1, 1000);

    $config['upload_path'] = $projects_folder_path;
    $config['allowed_types'] = 'jpg|jpeg|gif|tiff|tif|png';
    $config['overwrite'] = false;
    $config['encrypt_name'] = TRUE;
                    //$config['file_name'] = $file_name;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('user_image')) {

        $error_file_arr = array('error' => $this->upload->display_errors());
        print_r($error_file_arr);

    } else {

        $data_image_upload = array('upload_image_data' => $this->upload->data());
        $filename = $data_image_upload['upload_image_data']['file_name'];
        $full_path =   $data_image_upload['upload_image_data']['full_path'];
        create_thumbnail($filename, $full_path, $thumb);
    }
}

$insert_data = array(
 'name'=>$name,
 'email'=>$email,
 'password'=>sha1($password),
 'image'=>$filename,
 'user_type'=>$user_type,
 'created_at'=> date("Y-m-d H:i:s")
);

$this->db->insert('users',$insert_data);
if($this->db->insert_id()){
    return true;
}else{
    return false;
}
}

public function update_user($id)
{
  $name = $this->input->post('name');
  $user_type = $this->input->post('user_type');
  $old_image = $this->input->post('old_image');

  $filename = "";

  if ($_FILES['user_image']['name'] != "") {

    $projects_folder_path = './assets/images/users/';

    $thumb =  './assets/images/users/thumbnail';


    $orignal_file_name = $_FILES['user_image']['name'];

    $file_ext = ltrim(strtolower(strrchr($_FILES['user_image']['name'], '.')), '.');

    $rand_num = rand(1, 1000);

    $config['upload_path'] = $projects_folder_path;
    $config['allowed_types'] = 'jpg|jpeg|gif|tiff|tif|png';
    $config['overwrite'] = false;
    $config['encrypt_name'] = TRUE;
                    //$config['file_name'] = $file_name;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('user_image')) {

        $error_file_arr = array('error' => $this->upload->display_errors());
        print_r($error_file_arr);

    } else {

        $data_image_upload = array('upload_image_data' => $this->upload->data());
        $filename = $data_image_upload['upload_image_data']['file_name'];
        $full_path =   $data_image_upload['upload_image_data']['full_path'];
        create_thumbnail($filename, $full_path, $thumb);
    }
}else{
    $filename = $old_image;
}

$insert_data = array(
 'name'=>$name,
 'image'=>$filename,
 'user_type'=>$user_type
);

$quer = $this->db->update('users',$insert_data,array('id'=>$id));
if($quer){

                $newdata = array(
                    'user_name' => $name,
                    'user_image' => $filename
                    );
                 
                $this->session->set_userdata($newdata);
    return true;
}else{
    return false;
}
}




}
