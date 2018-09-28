<?php
class Mod_sites extends CI_Model {

	public function total_turnover(){ 

        $this->db->select(array("turnover"));
        $this->db->from("cron_turnover");
        //$this->db->where("offer_type","end_construction");

        $query = $this->db->get();

        $result =  $query->row();  
        return ($result) ? $result->turnover : 0;
    }

    public function get_exact_purchase($reference_no){ 

        $this->db->select(array("purchase"));
        $this->db->from("cron_purchase");
        $this->db->where("reference_no",$reference_no);

        $query = $this->db->get();
        $result = $query->row();  

        return ($result) ? $result->purchase : 0;
    }

    public function get_invoices($reference_no){ 

        $this->db->select(array("invoices"));
        $this->db->from("cron_invoices");
        $this->db->where("reference_no",$reference_no);

        $query = $this->db->get();
        $result = $query->row();  

        return ($result) ? json_decode($result->invoices) : array();
    } 
    
    public function total_inprogress(){ 

        $this->db->select(array("SUM(total_without_vat) as inprogress"));
        $this->db->from("offers");
        $this->db->where("offer_type","execution");

        $query = $this->db->get();
        return $query->row()->inprogress;  
    }
    public function total_sites(){  

        $this->db->select(array("*"));
        $this->db->from("offers");

        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function count_offer_by_status($status){  

        $this->db->select(array("*"));
        $this->db->from("offers");
         $this->db->where("status",$status);

        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function count_client_type($client){  

        $this->db->select(array("*"));
        $this->db->from("offers");
         $this->db->where("client",$client);

        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function get_notifications(){  

        $this->db->select(array("*"));
        $this->db->from("notifications");
         $this->db->order_by('id','DESC');
        $query = $this->db->get();
        return $query->result();  
    }
    public function get_count(){	

		$this->db->select(array("o.*","ewh.site_id","u.name as manager_name","o.working_hours as schedule_hours","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_accountable_hours))) as total_worked_hours"));
        $this->db->from("employees_working_hours ewh"); 
         $this->db->join("offers o","o.id=ewh.site_id","left");
        $this->db->join("users u","u.id=o.manager_id","left");
        $this->db->where('o.manager_id',$this->session->userdata('user_id'));
         $this->db->group_by("ewh.site_id");
		$query = $this->db->get();
       // echo $this->db->last_query();exit;
		return $query->num_rows();
	}
	public function get_manager_sites($id=0){
		 //print_r($_POST);
        $column_order = array("o.reference_no","o.description","o.working_hours","ewh.total_accountable_hours","o.working_hours - SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_accountable_hours)))"); //set column field database for datatable orderable
        $column_search = array("o.reference_no","o.description","o.working_hours","ewh.total_accountable_hours"); //set column field database for datatable searchable 
        $order = array('o.reference_no' => 'asc'); // default order 
        
        $this->db->select(array("o.*","ewh.site_id","u.name as manager_name","o.working_hours as schedule_hours","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_accountable_hours))) as total_worked_hours"));
        $this->db->from("employees_working_hours ewh"); 
         $this->db->join("offers o","o.id=ewh.site_id","left");
        $this->db->join("users u","u.id=o.manager_id","left");
        $this->db->where('o.manager_id',$this->session->userdata('user_id'));
        $this->db->group_by("ewh.site_id");

        $i = 0;
        if($id==0){
        foreach ($column_search as $item) // loop column 
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
       $this->db->where('ewh.site_id',$id);
       $query = $this->db->get();
       return $query->row();
   }

}

public function get_last_progress($id){
    $this->db->select(array("*","DATE(upload_date) as upload_date"));
    $this->db->from("site_progress");
    $this->db->where("site_id",$id);
    $this->db->order_by("id DESC");

    $query = $this->db->get();
    return $result=$query->row();
}
   function save_invoice(){
        //print_r($this->input->post());exit;

        $progress_state = $this->input->post('progress_state');
        $start_period_post = $this->input->post('start_period');
        $end_period_post = $this->input->post('end_period');
        $period_bill = $this->input->post('period_bill');
        $forcasted = $this->input->post('forcasted');
        $site_id = $this->input->post('site_id');
        $refference = $this->input->post('refference');
        $total_without_vat = $this->input->post('total_without_vat');
        $vat = $this->input->post('vat');
        $total_with_vat = $this->input->post('total_with_vat');
        $last_upload = $this->input->post('last_upload');
        $upload_path = $this->input->post('upload_path');

        $start_array = explode('/', $start_period_post);
        $end_array = explode('/', $end_period_post);
        $start_period = $start_array[2].'-'.$start_array[1].'-'.$start_array[0];
        $end_period = $end_array[2].'-'.$end_array[1].'-'.$end_array[0];

        /*------------- progress data------------*/
        $purchase = $this->input->post('purchase');
        $total_hours = $this->input->post('total_hours');
        $hours = $this->input->post('hours');
        $hourly_rate = $this->input->post('hourly_rate');
        $general_fee = $this->input->post('general_fee');
        $selling_price = $this->input->post('selling_price');

         $is_progress_data =$this->db->select('id')->where(array('site_id'=>$site_id))->get('progress_data')->num_rows();
        if($is_progress_data==0){
        $progress_data = array(
                            'site_id'=>$site_id,
                            'purchase'=>$purchase,
                            'total_hours'=>$total_hours,
                            'hours'=>$hours,
                            'hours'=>$hours,
                            'hourly_rate'=>$hourly_rate,
                            'general_fee'=>$general_fee,
                            'selling_price'=>$selling_price
                            );
        $this->db->insert("progress_data",$progress_data);
    }else{
        $progress_data = array(
                            'site_id'=>$site_id,
                            'purchase'=>$purchase,
                            'hours'=>$hours,
                            'general_fee'=>$general_fee,
                            'selling_price'=>$selling_price
                            );
        $this->db->update("progress_data",$progress_data,array('site_id'=>$site_id));
    }

        #-------------- check if data exist for period---------------#
    $is_period_data =$this->db->select('id')->where(array('site_id'=>$site_id,'start_period'=>$start_period,'end_period'=>$end_period))->get('site_progress')->num_rows();
  if($is_period_data==0){
        $insertData = array(
                'site_id' => $site_id,
                'reference_no' => $refference,
                'progress_state' => $progress_state,
                'start_period' => $start_period,
                'end_period' => $end_period,
                'period_bill' => $period_bill,
                'vat' => $vat,
                'total_with_vat' => $total_with_vat,
                'forcasted' => $forcasted,
                'upload_date' => date("Y-m-d H:i:s"),
                'upload_path' => $upload_path
            );
          // print_r( $insertData);exit;
            $this->db->insert('site_progress',$insertData);
            $last_id = $this->db->insert_id();
        }else{
            $insertData = array(
                'site_id' => $site_id,
                'progress_state' => $progress_state,
                'start_period' => $start_period,
                'end_period' => $end_period,
                'period_bill' => $period_bill,
                'vat' => $vat,
                'total_with_vat' => $total_with_vat,
                'forcasted' => $forcasted,
                'upload_date' => date("Y-m-d H:i:s"),
                'upload_path' => $upload_path
            );
          // print_r( $insertData);exit;
            $this->db->update('site_progress',$insertData,array('site_id'=>$site_id,'start_period'=>$start_period,'end_period'=>$end_period));
            $last_id = $site_id;
        }

            if($last_id){
                    return true;
                }else{
                    return false;
                }

    }

    function get_site_billing($id){
        $this->db->select("*");
        $this->db->from("site_progress sp");
        $this->db->where("site_id",$id);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

     function get_progress_data($id){
        $this->db->select("*");
        $this->db->from("progress_data");
        $this->db->where("site_id",$id);

        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function get_last_upload($id){
        $this->db->select("*");
        $this->db->from("site_progress sp");
        $this->db->where("site_id",$id);
        $this->db->order_by("id DESC");
        $this->db->limit(1);

        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function working_hour_site($id){
        $this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(total_accountable_hours))) as total_worked_hours");
        $this->db->from("employees_working_hours");
        $this->db->where("site_id",$id);

        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function end_site($id){

       $query =  $this->db->update('offers',array('offer_type'=>'end_construction'), array("id"=>$id));
       if($query){
        $compeleted_site =$this->db->select(array('reference_no','description'))->where(array('id'=>$id))->get('offers')->row();
         $site_name = '#'.$compeleted_site->reference_no.'-'.$compeleted_site->description;
             $notification = array(
                          'title'=>$site_name.' site is completed.Please ask for the caution.',
                          'detail'=>$site_name.' site is completed.Please ask for the caution.',
                          'is_new'=>1,
                          'notify_to'=>1,
                          'link'=> SURL.'human_resource/caution/sites',
                          'created_at'=>date("Y-m-d H:i:s")
                      );
    $this->db->insert('notifications',$notification);
            return 'OK';
       }else{
            return 'NO';
       }
    }


}
