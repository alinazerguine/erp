<?php


class Mod_employees extends CI_Model {

	public function get_count(){	

		$this->db->select(array("*"));
		$this->db->from("employees");

		$query = $this->db->get();
		return $query->num_rows();	
	}
	public function get_employees($id=0){
		//print_r($_POST);
		$column_order = array("id","fname","lname","status"); //set column field database for datatable orderable
		$column_search = array("id","fname","lname","status"); //set column field database for datatable searchable 
		$order = array('id' => 'asc'); // default order 
		
		$this->db->select(array("*","CASE 
            WHEN status =0 THEN 'Inactif'
            WHEN status =1 THEN 'Actif'
            END AS user_status"));
		$this->db->from("employees");		
		
		$i = 0;
     if($id==0){
        foreach ($column_search as $key=>$item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

             $search_value = $_POST['search']['value'];
             if(strpos($search_value, 'Actif') !== false){
                $search_text = 1;
            }elseif(strpos($search_value, 'Inactif') !== false){
                $search_text = 0;
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
                }elseif($_POST['columns']) // if datatable send POST for coulumn search
                {
                   $search_value = $_POST['columns'][$key]['search']['value'];               

                   if($search_value=='Actif'){
                    $search_text = 1;
                }elseif($search_value=='Inactif'){
                    $search_text = 0;
                }else{

                    $search_text = '';
                }   
                //echo $search_value.$search_text;

                if($search_value=='Inactif' || $search_value=='Actif')
                {
                    $this->db->where($item, $search_text);
                }

               // echo $this->db->get_compiled_select();

               /* if(count($column_search) - 1 == $i) //last loop
               $this->db->group_end(); //close bracket*/
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
public function add_employee()
{
   // print_r($this->input->post());exit;
    $fname = $this->input->post('fname');
    $lname = $this->input->post('lname');
    $address = $this->input->post('address');
    $add_address = $this->input->post('add_address');
    $place = $this->input->post('place');
    $place2 = $this->input->post('place2');
    $national_number = $this->input->post('national_number');
    $dob = $this->input->post('dob');
    $birth_place = $this->input->post('birth_place');
    $nationality = $this->input->post('nationality');
    $mobile = $this->input->post('mobile');
    $show_size = $this->input->post('show_size');
    $high_waist = $this->input->post('high_waist');
    $low_waist = $this->input->post('low_waist');
    $position = $this->input->post('position');
    $civil_status = $this->input->post('civil_status');
    $spouse_name = $this->input->post('spouse_name');
    $dependent_child = $this->input->post('dependent_child');
    $bank_name = $this->input->post('bank_name');
    $account_number = $this->input->post('account_number');
    $bic_code = $this->input->post('bic_code');
    $mutual_name = $this->input->post('mutual_name');
    $affiliation = $this->input->post('affiliation');
    $workplace = $this->input->post('workplace');
    $study_level = $this->input->post('study_level');
    $status = $this->input->post('status');

   // $full_address = $address.' '.$add_address.','.$place.','.$place2;

    $insert_data = array(
       'fname'=>$fname,
       'lname'=>$lname,
       'address'=>$address,     
       'add_address'=>$add_address,
       'place'=>$place,
       'place2'=>$place2,
       'national_reg_no'=>$national_number,
       'dob'=>$dob,
       'birth_place'=>$birth_place,
       'nationality'=>$nationality,
       'mobile'=>$mobile,
       'show_size'=>$show_size,
       'high_waist'=>$high_waist,
       'low_waist'=>$low_waist,
       'position'=>$position,
       'civil_status'=>$civil_status,
       'spouse_name'=>$spouse_name,
       'dependent_child'=>$dependent_child,
       'bank_name'=>$bank_name,
       'account_number'=>$account_number,
       'bic_code'=>$bic_code,
       'mutual_name'=>$mutual_name,
       'affiliation'=>$affiliation,
       'workplace'=>$workplace,
       'study_level'=>$study_level,
       'status'=>$status,
       'created_at'=> date("Y-m-d H:i:s")
   );

    $this->db->insert('employees',$insert_data);
    if($this->db->insert_id()){
        return true;
    }else{
        return false;
    }
}

public function update_employee($id)
{
   // print_r($this->input->post());exit;
    $fname = $this->input->post('fname');
    $lname = $this->input->post('lname');
    $address = $this->input->post('address');
    $add_address = $this->input->post('add_address');
    $place = $this->input->post('place');
    $place2 = $this->input->post('place2');
    $national_number = $this->input->post('national_number');
    $dob = $this->input->post('dob');
    $birth_place = $this->input->post('birth_place');
    $nationality = $this->input->post('nationality');
    $mobile = $this->input->post('mobile');
    $show_size = $this->input->post('show_size');
    $high_waist = $this->input->post('high_waist');
    $low_waist = $this->input->post('low_waist');
    $position = $this->input->post('position');
    $civil_status = $this->input->post('civil_status');
    $spouse_name = $this->input->post('spouse_name');
    $dependent_child = $this->input->post('dependent_child');
    $bank_name = $this->input->post('bank_name');
    $account_number = $this->input->post('account_number');
    $bic_code = $this->input->post('bic_code');
    $mutual_name = $this->input->post('mutual_name');
    $affiliation = $this->input->post('affiliation');
    $workplace = $this->input->post('workplace');
    $study_level = $this->input->post('study_level');
    $status = $this->input->post('status');

   // $full_address = $address.' '.$add_address.','.$place.','.$place2;

    $insert_data = array(
       'fname'=>$fname,
       'lname'=>$lname,
       'address'=>$address,     
       'add_address'=>$add_address,
       'place'=>$place,
       'place2'=>$place2,
       'national_reg_no'=>$national_number,
       'dob'=>$dob,
       'birth_place'=>$birth_place,
       'nationality'=>$nationality,
       'mobile'=>$mobile,
       'show_size'=>$show_size,
       'high_waist'=>$high_waist,
       'low_waist'=>$low_waist,
       'position'=>$position,
       'civil_status'=>$civil_status,
       'spouse_name'=>$spouse_name,
       'dependent_child'=>$dependent_child,
       'bank_name'=>$bank_name,
       'account_number'=>$account_number,
       'bic_code'=>$bic_code,
       'mutual_name'=>$mutual_name,
       'affiliation'=>$affiliation,
       'workplace'=>$workplace,
       'study_level'=>$study_level,
       'status'=>$status
   );

    $query = $this->db->update('employees',$insert_data,array("id"=>$id));
    if($query){
        return true;
    }else{
        return false;
    }
}

function delete_employee($id){
    $this->db->delete('employees', array('id' => $id));
    return true;
}


}
