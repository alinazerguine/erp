<?php
class Mod_orderbook extends CI_Model {

	public function get_count(){	

		$this->db->select(array("*"));
		$this->db->from("offers");
        $this->db->where('status','Accepté');
        $this->db->where('offer_type','order_book');
		$query = $this->db->get();
		return $query->num_rows();	
	}
	public function get_offers($id=0){
		//print_r($_POST);
		$column_order = array("o.reference_no","o.description","o.company","o.market","o.client","o.sale_price","o.working_hours"); //set column field database for datatable orderable
		$column_search = array("o.reference_no","o.description","o.company","o.market","o.client","o.sale_price","o.working_hours"); //set column field database for datatable searchable 
		$order = array('o.id' => 'asc'); // default order 
		
		$this->db->select(array("o.*","DATE(o.created_at) as created_at","IF(o.manager_id>0,u.name,'') as site_manager"));
		$this->db->from("offers o");	
        $this->db->join("users u","u.id=o.manager_id","left");	
		$this->db->where('o.status','Accepté');
        $this->db->where('o.offer_type','order_book');
		$i = 0;
       if($id==0){
        foreach ($column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

               $search_value = $_POST['search']['value'];
               /*if(strpos($search_value, 'active') !== false){
                $search_text = 1;
            }elseif(strpos($search_value, 'inactive') !== false){
                $search_text = 0;
            }else{

                $search_text = $search_value;
            }*/

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
    $total_vat = ($total_without_vat * VAT_RATE)/100;
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
     'created_at'=> date("Y-m-d H:i:s")
 );

    $record_exist = $this->get_count(array('reference_no'=>$refference));
    if($record_exist==0){
        $this->db->insert('offers',$insert_data);
        if($this->db->insert_id()){
            return true;
        }else{
            return false;
        }
    }else{
        $this->session->set_flashdata('err_message', 'Offer id already exist.');
        redirect(SURL.'admin/offers/add');
    }
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
    $total_vat = ($total_without_vat * VAT_RATE)/100;
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


}
