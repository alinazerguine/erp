<?php


class Mod_import_data extends CI_Model {

	public function save_import_temp($input_data){
        foreach($input_data as $key => $ro){
            if($key != 1){

                $personal_id = $ro['B'];
                $type = $ro['C'];
               // $secury_date = $ro['F'];
                $departure_time = $ro['G'];
                $arrival_time = $ro['I'];
                $depart_place = $ro['J'];
                $arrival_place = $ro['K'];
                $duration = $ro['L'];
                $distance = $ro['M'];
                $where = array(
                    'user_name' => $ro['A'],
                    'created_at' => date("Y-m-d")
                );
                $this->db->select('*');
                $this->db->where($where);
                $this->db->limit(1);
                $get = $this->db->get('erp_securysat');
                $query = $get->row_array();

                if($query == ''){
                    $secury_date = explode('/', $ro['F']);
                    if(count($secury_date)!=3){
                        return 'NO'; exit;
                    }
                    $insert = array(
                        'user_name'=>$ro['A'],
                        'type'=>$ro['C'],
                        'secury_file_date'=>$secury_date[2].'-'.$secury_date[1].'-'.$secury_date[0],
                        'created_at'=>date("Y-m-d")
                    );
                    $this->db->insert('securysat',$insert);
                    $user_id = $this->db->insert_id();

                }else{
                    $user_id = $query['id'];
                }

            //$this->db->where("user_id",$user_id);
            //$this->db->delete("securysat_data");

                $insert_data = array(
                 'user_id'=>$user_id,
                 'personal_id'=>$personal_id,
                 'type'=>$type,
                 'departure_time'=>$departure_time,
                 'arrival_time'=>$arrival_time,
                 'depart_place'=>$depart_place,
                 'arrival_place'=> $arrival_place,
                 'duration'=>$duration,
                 'distance'=>$distance
             );

                $this->db->insert('securysat_data',$insert_data);


            }
        }
        return "OK";
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
        $this->db->where("offer_type!=","offer");
        //$this->db->or_where("offer_type","order_book");
        $query= $this->db->get();
        return $query->result();
    }

    function add_absent(){
        $user_name = $this->input->post('name');
        $employee_id =$this->db->select('id')->where("CONCAT(fname,' ',lname) ='".$user_name."'")->get('employees')->row()->id;

        $is_data_exist =$this->db->select('id')->where(array('employee_id'=>$employee_id,'working_date'=>date("Y-m-d")))->get('employees_working_hours')->num_rows();
               // echo $is_data_exist;exit;
        if($is_data_exist>0){
            $this->db->delete('employees_working_hours', array('employee_id'=>$employee_id,'working_date'=>date("Y-m-d")));
        }

        $insert_arrays = array(
            'site_id'=>0,
            'employee_id'=>$employee_id,
            'total_working_hours'=>0,
            'total_real_hours'=>0,
            'total_accountable_hours'=>0,
            'distance'=>0,
            'comment'=>'',
            'is_absent'=>1,
            'working_date'=>date("Y-m-d")
        );

        $this->db->insert("employees_working_hours",$insert_arrays);
        echo "OK";

    }

    function post_user_data(){

        $distance = $this->input->post('distance');
        $working_hours = $this->input->post('working_hours');
        $real_hours = $this->input->post('real_hours');
        $accountable_hours = $this->input->post('accountable_hours');
        $site = $this->input->post('site');
        $user_name = $this->input->post('user_name');
        $comment = $this->input->post('comment');
        $work_date = $this->input->post('work_date');

        $employee_id =$this->db->select('id')->where("CONCAT(fname,' ',lname) ='".$user_name."' OR fname = '".$user_name."'")->get('employees')->row()->id;
        //echo $this->db->last_query();        
        $count = count($working_hours);
        $insert_arrays = array();
        for($i=0; $i<$count; $i++){

            if($site[$i]!=''){               
               $key = array_search($site[$i], array_column($insert_arrays, 'site_id'));
               if ($key!='' && $key>=0 && $i>0) {

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
                if($site[$i]>0){ 
                    $total_distance =  $distance[0] + $distance[$count]; // first and last entry of the distance
                    $insert_arrays[] = array(
                        'site_id'=>$site[$i],
                        'employee_id'=>$employee_id,
                        'total_working_hours'=>$working_hours[$i],
                        'total_real_hours'=>$real_hours[$i],
                        'total_accountable_hours'=>$accountable_hours[$i],
                        'distance'=>$total_distance,
                        'comment'=>$comment,
                        'working_date'=>$work_date
                    );

                    $is_data_exist =$this->db->select('id')->where(array('employee_id'=>$employee_id,'working_date'=>$work_date))->get('employees_working_hours')->num_rows();
               // echo $is_data_exist;exit;
                    if($is_data_exist>0){
                        $this->db->delete('employees_working_hours', array('employee_id'=>$employee_id,'working_date'=>$work_date));
                    }                    

                }

            }

            #----------- for completed sites-------------#
            $compeleted_site =$this->db->select(array('reference_no','description','offer_type'))->where(array('id'=>$site[$i]))->get('offers')->row();
            if($compeleted_site->offer_type=='end_construction'){
            $site_name = '#'.$compeleted_site->reference_no.'-'.$compeleted_site->description;
            $notification = array(
                  'title'=>'Des heures ont été prestées sur un chantier terminé',
                  'detail'=>'Des heures ont été prestées sur un chantier terminé '.$site_name,
                  'is_new'=>1,
                  'notify_to'=>0,
                  'link'=> SURL.'admin/endconstruction/detail/'.$site[$i],
                  'created_at'=>date("Y-m-d H:i:s")
              );
            $this->db->insert('notifications',$notification);
        }else{
            #------------ change status if site is not in execution or completed----------#
            $this->db->update("offers",array('offer_type'=>'execution'),array('id'=>$site[$i],'offer_type!='=>'execution'));  

                    #---------- send notification-------------#
            $reference_no =$this->db->select('reference_no')->where(array('id'=>$site[$i]))->get('offers')->row()->reference_no;
            $is_noty_exist =$this->db->select('id')->where(array('title'=>'L’exécution du chantier '.$reference_no.' a démarré. Merci d’attribuer un gestionnaire.'))->get('notifications')->num_rows();
            if($is_noty_exist==0){
                $notifications = array(
                    'title'=>'L’exécution du chantier '.$reference_no.' a démarré. Merci d’attribuer un gestionnaire.',
                    'detail'=>'L’exécution du chantier '.$reference_no.' a démarré. Merci d’attribuer un gestionnaire.',
                    'is_new'=>'1',
                    'link'=> SURL.'admin/offers/detail/'.$site[$i],
                    'created_at'=>date("Y-m-d H:i:s")
                );

                $this->db->insert("notifications",$notifications);
            }
        }

        }
    }

    if($insert_arrays){
        foreach($insert_arrays as $data){           
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

public function get_next_site_refernce(){

    $this->db->select("reference_no"); 
    $this->db->from("offers");
    $this->db->order_by("id DESC");
    $this->db->limit(1);

    $query = $this->db->get();
    $result = $query->row();
    $pos = strpos($result->reference_no,'-');
    if($pos){
        $reference_no = str_replace('-', '', $result->reference_no);
        $reference_no++;
        echo substr_replace($reference_no, '-', $pos, 0);
            //echo $result->reference_no;
    }else{
        echo $result->reference_no++;
    }
        //echo strpos($result->reference_no,'-');

}

public function add_new_site(){
    $reference = $this->input->post('reference');
    $description = $this->input->post('description');

    $insert = array(
        'reference_no'=>$reference,
        'description'=>$description,
        'offer_type'=>'order_book',
        'is_new'=>1,
        'created_at'=>date("Y-m-d H:i:s")
    );

    $this->db->insert("offers",$insert);
    $offer_id = $this->db->insert_id();
    /*------------- notification -----*/
    $notifications = array(
        'title'=>'Le chantier '.$reference.' a été créé. Merci d’importer le fichier Excel correspondant.',
        'detail'=>'Le chantier '.$reference.' a été créé. Merci d’importer le fichier Excel correspondant.',
        'is_new'=>'1',
        'link'=> SURL.'admin/offers/detail/'.$offer_id,
        'created_at'=>date("Y-m-d H:i:s")
    );

    $this->db->insert("notifications",$notifications);

    echo "OK";
}


}
