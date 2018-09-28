<?php
class Mod_offers extends CI_Model {

	public function get_count($where=''){	

		$this->db->select(array("*"));
		$this->db->from("offers");
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->num_rows();	
    }
    public function get_offers($id=0){
     // print_r($_POST);
		$column_order = array("o.id","o.reference_no","o.description","o.company","o.market","o.client","o.offer","DATE(o.created_at)","o.sale_price","o.status","o.comment"); //set column field database for datatable orderable
		$column_search = array("o.id","o.reference_no","o.description","o.company","o.market","o.client","o.offer","DATE(o.created_at)","o.sale_price","o.status","o.comment"); //set column field database for datatable searchable 
		$order = array('o.id' => 'asc'); // default order 
		
		$this->db->select(array("o.*","DATE(o.created_at) as created_at","IF(o.manager_id>0,u.name,'') as site_manager"));
		$this->db->from("offers o");	
        $this->db->join("users u","u.id=o.manager_id","left");	

        $i = 0;
        if($id==0){
        foreach ($column_search as $key=>$item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

             $search_value = $_POST['search']['value'];               

             $search_text = $search_value;


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

                 $search_text = $search_value;


                 if($search_text!='')
                 {
                    $this->db->where($item, $search_text);
                }

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
    	$this->db->where('o.id',$id);
    	$query = $this->db->get();
        return $query->row();
    }

}

public function get_site_managers(){
    $this->db->select(array("id","name"));
    $this->db->from("users");
    $this->db->where("user_type",2);

    $query = $this->db->get();
    $result = $query->result();
    return $result;
}


public function save_offer()
{
   // print_r($this->input->post());exit;
    $refference = $this->input->post('refference');
    $description = $this->input->post('description');
    $general_fee = $this->input->post('general_fee');
    $hourly_rate = $this->input->post('hourly_rate');
    $working_hours = $this->input->post('working_hours');
    $purchase = $this->input->post('purchase');
    $subcontractors = $this->input->post('subcontractors');
    $margin = $this->input->post('margin');
    $sale_price = $this->input->post('sale_price');
    $tva_rate = $this->input->post('tva_rate');
    $market = $this->input->post('market');
    $client = $this->input->post('client');
    $offer = $this->input->post('offer');
    $cost_price = $this->input->post('cost_price');
    $site_manager = $this->input->post('site_manager');
    $status = $this->input->post('status');
    $company = $this->input->post('company');
    $contact_person = $this->input->post('contact_person');
    $email = $this->input->post('email');
    $gsm = $this->input->post('gsm');
    $phone = $this->input->post('phone');
    $delivery_date = $this->input->post('delivery_date');
    $delivery_place = $this->input->post('delivery_place');
    $technical_meeting = $this->input->post('technical_meeting');
    $visit_date = $this->input->post('visit_date');
    $visit_address = $this->input->post('visit_address');
    $visit_contact_person = $this->input->post('visit_contact_person');
    $visit_gsm = $this->input->post('visit_gsm');
    $visit_phone = $this->input->post('visit_phone');

    $total_without_vat = $sale_price;
    $total_vat = ($total_without_vat * $tva_rate)/100;
    $total_with_vat = $total_without_vat + $total_vat;

   // $full_address = $address.' '.$add_address.','.$place.','.$place2;

    $insert_data = array(
       'reference_no'=>$refference,
       'description'=>$description,
       'general_fee'=>$general_fee,     
       'hourly_rate'=>$hourly_rate,
       'working_hours'=>$working_hours,
       'purchase'=>$purchase,
       'subcontractors'=>$subcontractors,
       'cost_price'=>$cost_price,
       'margin'=>$margin,
       'sale_price'=>$sale_price,
       'tva_rate'=>$tva_rate,
       'total_without_vat'=>$total_without_vat,
       'total_vat'=>$total_vat,
       'total_with_vat'=>$total_with_vat,
       'market'=>$market,
       'client'=>$client,
       'offer'=>$offer,
       'manager_id'=>$site_manager,
       'status'=>$status,
       'company'=>$company,
       'contact_person'=>$contact_person,
       'email'=>$email,
       'gsm'=>$gsm,
       'phone'=>$phone,
       'delivery_date'=>date("Y-m-d H:i",strtotime($delivery_date)),
       'delivery_place   '=>$delivery_place,
       'technical_visit'=>$technical_meeting,
       'visit_date'=>date("Y-m-d H:i",strtotime($visit_date)),
       'visit_address'=>$visit_address,
       'visit_contact_person'=>$visit_contact_person,
       'visit_gsm'=>$visit_gsm,
       'visit_phone'=>$visit_phone,
       'created_at'=> date("Y-m-d H:i:s")
   );

    if($client=='Entreprise générale' && $offer=='submission'){
      $color = "green";
    }elseif($client=='Pouvoir public'){
      $color = "orange";
    }else{
       $color = "red";
    }

    $meeting_request = array(
                          'company'=>$company,
                          'reference_no'=>$refference,
                          'description'=>$description,
                          'delivery_date'=>$delivery_date,
                          'color'=>$color,
                          'email'=>$email,
                      );
  $technical_meeting = array(
                          'visit_date'=>$visit_date,
                          'visit_address'=>$visit_address,
                          'visit_contact_person'=>$visit_contact_person,
                          'visit_gsm'=>$visit_gsm,
                          'visit_phone'=>$visit_phone,
                          'email'=>$email,
                      );

    $record_exist = $this->get_count(array('reference_no'=>$refference));
    if($record_exist==0){
        $this->db->insert('offers',$insert_data);
        if($this->db->insert_id()){
          #----------------- meeting request mail-------------#
          $this->send_meeting_request($meeting_request);
          #----------------- meeting request mail-------------#
          $this->send_technical_meeting($technical_meeting);

            return true;
        }else{
            return false;
        }
    }else{
        $this->session->set_flashdata('err_message', 'Offer id already exist.');
        redirect(SURL.'admin/offers/add');
    }
}

public function send_meeting_request($data){

    $company = $data['company'];
    $reference_no = $data['reference_no'];
    $description = $data['description'];
    $delivery_date = $data['delivery_date'];
    $color = $data['color'];    
    $email = $data['email'];  
    
    $html_body='<table>
      <thead>
        <tr>
        <th colspan="2" style="background-color: '.$color.'; color:#FFF;">Meeting Request</th>
      </tr>
      </thead>
      <tbody>
       <tr>
         <td>Nom client:</td>
         <td>'.$company.'</td>
       </tr>
       <tr>
         <td>Référence:</td>
         <td>'.$reference_no.'</td>
       </tr>
       <tr>
         <td>Description:</td>
         <td>'.$description.'</td>
       </tr>
       <tr>
         <td>Remise offre:</td>
         <td>'.$delivery_date.'</td>
       </tr>
      </tbody>
    </table>';
    // bind header ,footer to the email body
    $message = $html_body;
    //echo $message;
    //echo $html_body;exit;
    /*
     * send email
    */
    /*$config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'localhost',
              'smtp_port' => 25,
              'smtp_user' => 'erp@gmail.com',
              'smtp_pass' => '123456',
              'mailtype' => 'html',
              'charset' => 'iso-8859-1'
              );
    
    $this->email->initialize($config);*/    
    
    $this->email->from($email,$company);
    $this->email->to('offre@wm.electricite.be');    
    $this->email->subject('Meeting request');
    $this->email->message($message);
    $this->email->set_mailtype("html");
    $send = $this->email->send();
   return true;
   //echo $this->email->print_debugger(); exit;
}

public function send_technical_meeting($data){
    $contact_person = $data['visit_contact_person'];
    $address = $data['visit_address'];
    $date = $data['visit_date'];
    $mobile = $data['visit_gsm'];
    $phone = $data['visit_phone'];    
     $email = $data['email'];  
    
    $html_body='<table>
      <thead>
        <tr>
        <th colspan="2">Technical Meeting</th>
      </tr>
      </thead>
      <tbody>
       <tr>
         <td>Personne de contact:</td>
         <td>'.$contact_person.'</td>
       </tr>
       <tr>
         <td>Date:</td>
         <td>'.$date.'</td>
       </tr>
       <tr>
         <td>Adresse:</td>
         <td>'.$address.'</td>
       </tr>
       <tr>
         <td>GSM:</td>
         <td>'.$mobile.'</td>
       </tr>
        <tr>
         <td>Téléphone fixe:</td>
         <td>'.$phone.'</td>
       </tr>
      </tbody>
    </table>';
    // bind header ,footer to the email body
    $message = $html_body;
    //echo $message;
    //echo $html_body;exit;
    /*
     * send email
    */
    /*$config = Array(
              'protocol' => 'smtp',
              'smtp_host' => 'localhost',
              'smtp_port' => 25,
              'smtp_user' => 'erp@gmail.com',
              'smtp_pass' => '123456',
              'mailtype' => 'html',
              'charset' => 'iso-8859-1'
              );    
    
    $this->email->initialize($config);*/    
    
    $this->email->from($email,$company);
    $this->email->to('offre@wm.electricite.be');      
    $this->email->subject('Technical Meeting');
    $this->email->message($message);
    $this->email->set_mailtype("html");
    $send = $this->email->send();
     return true;
}

public function update_offer($id)
{
   // print_r($this->input->post());exit;
    $refference = $this->input->post('refference');
    $description = $this->input->post('description');
    $general_fee = $this->input->post('general_fee');
    $hourly_rate = $this->input->post('hourly_rate');
    $working_hours = $this->input->post('working_hours');
    $purchase = $this->input->post('purchase');
    $subcontractors = $this->input->post('subcontractors');
    $margin = $this->input->post('margin');
    $sale_price = $this->input->post('sale_price');
    $tva_rate = $this->input->post('tva_rate');
    $market = $this->input->post('market');
    $client = $this->input->post('client');
    $offer = $this->input->post('offer');
    $cost_price = $this->input->post('cost_price');
    $site_manager = $this->input->post('site_manager');
    $status = $this->input->post('status');
    $company = $this->input->post('company');
    $contact_person = $this->input->post('contact_person');
    $email = $this->input->post('email');
    $gsm = $this->input->post('gsm');
    $phone = $this->input->post('phone');
    $delivery_date = $this->input->post('delivery_date');
    $delivery_place = $this->input->post('delivery_place');
    $technical_meeting = $this->input->post('technical_meeting');
    $visit_date = $this->input->post('visit_date');
    $visit_address = $this->input->post('visit_address');
    $visit_contact_person = $this->input->post('visit_contact_person');
    $visit_gsm = $this->input->post('visit_gsm');
    $visit_phone = $this->input->post('visit_phone');

    $total_without_vat = $sale_price;
    $total_vat = ($total_without_vat * $tva_rate)/100;
    $total_with_vat = $total_without_vat + $total_vat;

   // $full_address = $address.' '.$add_address.','.$place.','.$place2;

    $insert_data = array(
       'reference_no'=>$refference,
       'description'=>$description,
       'general_fee'=>$general_fee,     
       'hourly_rate'=>$hourly_rate,
       'working_hours'=>$working_hours,
       'purchase'=>$purchase,
       'subcontractors'=>$subcontractors,
       'cost_price'=>$cost_price,
       'margin'=>$margin,
       'sale_price'=>$sale_price,
       'tva_rate'=>$tva_rate,
       'total_without_vat'=>$total_without_vat,
       'total_vat'=>$total_vat,
       'total_with_vat'=>$total_with_vat,
       'market'=>$market,
       'client'=>$client,
       'offer'=>$offer,
       'manager_id'=>$site_manager,
       'status'=>$status,
       'company'=>$company,
       'contact_person'=>$contact_person,
       'email'=>$email,
       'gsm'=>$gsm,
       'phone'=>$phone,
       'delivery_date'=>$delivery_date,
       'delivery_place   '=>$delivery_place,
       'technical_visit'=>$technical_meeting,
       'visit_date'=>$visit_date,
       'visit_address'=>$visit_address,
       'visit_contact_person'=>$visit_contact_person,
       'visit_gsm'=>$visit_gsm,
       'visit_phone'=>$visit_phone,
       'is_new'=>0,
       'created_at'=> date("Y-m-d H:i:s")
   );

    $record_exist = $this->get_count(array('id'=>$id));
    if($record_exist >0){
        $quer = $this->db->update('offers',$insert_data,array('id'=>$id));
        if($quer){
            return true;
        }else{
            return false;
        }
    }else{
        $this->session->set_flashdata('err_message', 'Offer id does not exist.');
        redirect(SURL.'admin/offers/modify/'.$id);
    }
}

function update_comment(){
    $comment = $this->input->post('comment');
    $offer_id = $this->input->post('offer_id');

    $query =  $this->db->update('offers',array('comment'=>$comment), array("id"=>$offer_id));
    if($query){
        return 'OK';
    }else{
        return 'NO';
    }
}

function delete_offer(){

    $offer_ids = $this->input->post('offer_ids');

    $this->db->where('id IN ('.$offer_ids.')');
    $query =  $this->db->delete('offers');
       //echo $this->db->last_query();
    if($query){
        return 'OK';
    }else{
        return 'NO';
    }
}

function update_status(){
    $status = $this->input->post('status');
    $offer_id = $this->input->post('offer_id');
    $is_caution = $this->input->post('is_caution');
    if($status=='Accepté'){
        $offer_type = 'order_book';
    }else{
       $offer_type = 'offer';
   }   
   if($is_caution==1){
    $caution_arr = array('site_id'=>$offer_id,'created_at'=>date("Y-m-d H:i:s"));
    $this->db->insert('caution_sites',$caution_arr);
    $reference_no =$this->db->select('reference_no')->where(array('id'=>$offer_id))->get('offers')->row()->reference_no;
    $notification = array(
                          'title'=>'Une nouvelle caution a été ajoutée pour le chantier  '.$reference_no.'.',
                          'detail'=>'Une nouvelle caution a été ajoutée pour le chantier  '.$reference_no.'.',
                          'is_new'=>1,
                          'notify_to'=>1,
                          'link'=> SURL.'human_resource/caution/detail/'.$offer_id,
                          'created_at'=>date("Y-m-d H:i:s")
                      );
    $this->db->insert('notifications',$notification);
   }
   $query =  $this->db->update('offers',array('status'=>$status,'offer_type'=>$offer_type), array("id"=>$offer_id));
   if($query){
    return 'OK';
}else{
    return 'NO';
}
}


}
