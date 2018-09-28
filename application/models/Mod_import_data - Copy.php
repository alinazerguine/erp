<?php


class Mod_import_data extends CI_Model {

	public function save_import_temp($input_data){
	
    foreach($input_data as $ro){
        $name = $ro['name'];
         $data = $ro['data'];
         $insert = array(
            'user_name'=>utf8_encode($name),
            'type'=>$data[0][3],
            'created_at'=>date("Y-m-d H:i:s")
        );
        $this->db->insert('securysat',$insert);
        $user_id = $this->db->insert_id();
       
       
        //echo count($data);exit;
        for($i=0; $i<count($data); $i++){
                $personal_id = $data[$i][2];
                $type = $data[$i][3];
                $departure_time = $data[$i][7];
                $arrival_time = $data[$i][9];
                $depart_place = $data[$i][10];
                $arrival_place = $data[$i][11];
                $duration = $data[$i][12];
                $distance = $data[$i][13];

                $insert_data = array(
                 'user_id'=>$user_id,
                 'personal_id'=>$personal_id,
                 'type'=>$type,
                 'departure_time'=>$departure_time,
                 'arrival_time'=>$arrival_time,
                 'depart_place'=>utf8_encode($depart_place),
                 'arrival_place'=> utf8_encode($arrival_place),
                 'duration'=>$duration,
                 'distance'=>$distance
                );

                 $this->db->insert('securysat_data',$insert_data);

           }
    }
     
    return true;
}

    function get_import_temp(){
        $this->db->select("*");
        $this->db->from("securysat");
        $this->db->where("DATE(created_at)",date("Y-m-d"));
        $query= $this->db->get();
        return $query->result();
    }


    function get_importdata_temp($id){
        $this->db->select("*");
        $this->db->from("securysat_data");
        $this->db->where("user_id",$id);

        $query= $this->db->get();
        return $query->result();
    }


    function get_all_working_sites(){
        $this->db->select(array("id","reference_no","description"));
        $this->db->from("offers");
        $this->db->where("offer_type","execution");
         $this->db->or_where("offer_type","order_book");
        $query= $this->db->get();
        return $query->result();
    }

    function post_user_data(){

        $working_hours = $this->input->post('working_hours');
        $real_hours = $this->input->post('real_hours');
        $accountable_hours = $this->input->post('accountable_hours');
        $site = $this->input->post('site');
        $user_name = $this->input->post('user_name');
        $employee_id =$this->db->select('id')->where("CONCAT(fname,' ',lname) ='".$user_name."'")->get('employees')->row()->id;
        $count = count($site);
        $insert_arrays = array();
        for($i=0; $i<$count; $i++){ 
        if($site[$i]){               
                $key = array_search($site[$i], array_column($insert_arrays, 'site_id'));
                if ($key>=0 && $i>0) {
                     $key = array_search($site[$i], array_column($insert_arrays, 'site_id'));
                     $old_w_h = $insert_arrays[$key]['total_working_hours']; 
                     $old_r_h = $insert_arrays[$key]['total_real_hours'];
                     $old_a_h = $insert_arrays[$key]['total_accountable_hours'];

                      $tworking_hours = sum_the_time($old_w_h,$working_hours[$i]);
                       $treal_hours = sum_the_time($old_r_h,$real_hours[$i]);
                       $taccountable_hours = sum_the_time($old_a_h,$accountable_hours[$i]);

                    $insert_arrays[$key]['total_working_hours']=$tworking_hours;
                    $insert_arrays[$key]['total_real_hours']=$treal_hours;
                    $insert_arrays[$key]['total_accountable_hours']=$taccountable_hours;
                    //echo '<pre>';print_r($user_array[$key]['data']);exit;
                    //$user_array[$key]['data'][] = $cells[$i];
                }else{
                $insert_arrays[] = array(
                                    'site_id'=>$site[$i],
                                    'employee_id'=>$employee_id,
                                    'total_working_hours'=>$working_hours[$i],
                                    'total_real_hours'=>$real_hours[$i],
                                    'total_accountable_hours'=>$accountable_hours[$i],
                                    'working_date'=>date("Y-m-d")
                                );
                }

                $this->db->update("offers",array('offer_type'=>'execution'),array('id'=>$site[$i]));               
            }
        }

        //print_r($this->input->post());
        if($insert_arrays){
        foreach($insert_arrays as $data){

            $is_data_exist =$this->db->select('id')->where(array('employee_id'=>$employee_id,'working_date'=>date("Y-m-d")))->get('employees_working_hours')->num_rows();
            
            if($is_data_exist>0){
                $this->db->delete('employees_working_hours', array('employee_id'=>$employee_id,'working_date'=>date("Y-m-d")) );
            }

            $this->db->insert('employees_working_hours',$data);
        }
        
        echo 'OK';
    }else{
        echo 'NO';
        
    }
    }

    public function delete_temp_data(){

        $this->db->truncate('securysat');
        $this->db->truncate('securysat_data');

        echo "OK";
    }

    public function remove_employee_row(){
       
        $this->db->where("id IN (".$this->input->post('checked_rows').")"); 
        $this->db->delete("securysat_data");

        echo "OK";
    }

    public function add_new_site(){
        $reference = $this->input->post('reference');
        $description = $this->input->post('description');
        
        $insert = array(
                    'reference_no'=>$reference,
                    'description'=>$description,
                    'offer_type'=>'order_book'
        );

        $this->db->insert("offers",$insert);
        /*------------- notification -----*/
        $notifications = array(
                    'title'=>'New working site is added.',
                    'detail'=>'New working site is added with reference no.'.$reference.' and name '.$description.'. Please import all the info for that site.',
                    'is_new'=>'1',
                    'created_at'=>date("Y-m-d H:i:s")
        );

        $this->db->insert("notifications",$notifications);

        echo "OK";
    }


}
