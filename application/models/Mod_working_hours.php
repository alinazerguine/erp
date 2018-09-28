<?php
class Mod_working_hours extends CI_Model {

	public function get_count_sites(){   

        $this->db->select(array("COUNT(ewh.site_id) as working_sites","o.reference_no","o.description","u.name as manager_name"));
        $this->db->from("employees_working_hours ewh"); 
        $this->db->join("offers o","o.id=ewh.site_id","left");
        $this->db->join("users u","u.id=o.manager_id","left");
        $this->db->group_by("ewh.site_id");

        $query = $this->db->get();
        return $query->num_rows();  
    }
    
    public function get_sites($id=0){
        //print_r($_POST);
        $column_order = array("o.reference_no","o.description","u.name","o.working_hours","ewh.total_accountable_hours","o.working_hours - SEC_TO_TIME(SUM(TIME_TO_SEC(total_accountable_hours)))"); //set column field database for datatable orderable
        $column_search = array("o.reference_no","o.description","u.name","o.working_hours","ewh.total_accountable_hours"); //set column field database for datatable searchable 
        $order = array('o.reference_no' => 'asc'); // default order 
        
        $this->db->select(array("ewh.site_id","o.reference_no","o.description","u.name as manager_name","o.working_hours as schedule_hours","SEC_TO_TIME(SUM(TIME_TO_SEC(total_accountable_hours))) as total_worked_hours"));
        $this->db->from("employees_working_hours ewh"); 
         $this->db->join("offers o","o.id=ewh.site_id","left");
        $this->db->join("users u","u.id=o.manager_id","left");
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

    public function get_count(){	
      if($this->input->post('month_id')){
      $month_id=$this->input->post('month_id');
    }  else{
       $month_id='';
    }
		$this->db->select(array("COUNT(ewh.site_id) as working_sites","emp.id","CONCAT(emp.fname,'',emp.lname) as employee_name"));
        $this->db->from("employees_working_hours ewh"); 
        $this->db->join("erp_employees emp","emp.id=ewh.employee_id","left");
         $this->db->where("ewh.employee_id!=",''); 
        $this->db->group_by("ewh.employee_id");
        if($month_id!='' && $month_id!='select'){
           $this->db->where('MONTH(working_date)',$month_id);
        }

        $query = $this->db->get();
       // echo $this->db->last_query();exit;
        return $query->num_rows();	
    }

    public function get_employees($id=0){
		//print_r($_POST);
    if($this->input->post('month_id')){
      $month_id=$this->input->post('month_id');
    }  else{
       $month_id='';
    }
		$column_order = array("emp.id","CONCAT(emp.fname,' ',emp.lname)","ewh.site_id","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_real_hours)))","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_accountable_hours)))","SUM(distance)"); //set column field database for datatable orderable
		$column_search = array("emp.id","CONCAT(emp.fname,' ',emp.lname)","ewh.site_id","ewh.total_real_hours","ewh.total_accountable_hours"); //set column field database for datatable searchable 
		$order = array('emp.id' => 'asc'); // default order 
		
		$this->db->select(array("COUNT(ewh.site_id) as working_sites","emp.id","CONCAT(emp.fname,' ',emp.lname) as employee_name","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_real_hours))) as total_real_hours","SEC_TO_TIME(SUM(TIME_TO_SEC(ewh.total_accountable_hours))) as total_accountable_hours","SUM(distance) as distance"));
		$this->db->from("employees_working_hours ewh");	
        $this->db->join("erp_employees emp","emp.id=ewh.employee_id","left"); 
        $this->db->where("ewh.employee_id!=",''); 	
        $this->db->group_by("ewh.employee_id");
         if($month_id!='' && $month_id!='select'){
           $this->db->where('MONTH(working_date)',$month_id);
        }

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
       $this->db->where('emp.id',$id);
       $query = $this->db->get();
       return $query->row();
   }

}

public function get_site_working_dates($where){

         $this->db->select(array("working_date"));
           $this->db->from("employees_working_hours");
           $this->db->where($where);

           $query = $this->db->get();
          return $result = $query->result_array();       
    }


    public function get_site_users($site_id,$start_date,$end_date){

          // $this->db->select(array("ewh.site_id","ewh.total_real_hours AS HR","ewh.total_accountable_hours AS HC","o.description AS site_name"));
         $this->db->select(array("ewh.site_id","CONCAT(e.fname,' ',e.lname) AS employee_name","e.id as employee_id"));
           $this->db->from("employees_working_hours ewh");
           $this->db->join("employees e","e.id = ewh.employee_id");
           $this->db->where("ewh.site_id",$site_id);
           $this->db->where("ewh.working_date BETWEEN '".$start_date."' AND '".$end_date."'");
            $this->db->group_by("ewh.employee_id");

           $query = $this->db->get();
          // echo $this->db->last_query();
          return $result = $query->result_array();       
    }

     public function get_site_hours($employee_id,$site_id,$date){

         $this->db->select(array("ewh.total_accountable_hours AS worked_hours"));
           $this->db->from("employees_working_hours ewh");
           $this->db->join("employees e","e.id = ewh.employee_id");
           $this->db->where("ewh.site_id",$site_id);
           $this->db->where("ewh.employee_id",$employee_id);
           $this->db->where("ewh.working_date",$date);
            $this->db->group_by("ewh.employee_id");

           $query = $this->db->get();
         return $result = $query->row();
    }

    public function get_user_site($userid,$start_date,$end_date){

          // $this->db->select(array("ewh.site_id","ewh.total_real_hours AS HR","ewh.total_accountable_hours AS HC","o.description AS site_name"));
         $this->db->select(array("ewh.site_id","o.description AS site_name"));
           $this->db->from("employees_working_hours ewh");
           $this->db->join("offers o","o.id = ewh.site_id");
           $this->db->where("ewh.employee_id",$userid);
           $this->db->where("ewh.working_date BETWEEN '".$start_date."' AND '".$end_date."'");
           $this->db->order_by("ewh.id ASC");
            $this->db->group_by("ewh.site_id");

           $query = $this->db->get();
          return $result = $query->result_array();
         

    }

    public function get_user_hours($userid,$date,$site_id){

          // $this->db->select(array("ewh.site_id","ewh.total_real_hours AS HR","ewh.total_accountable_hours AS HC","o.description AS site_name"));
         $this->db->select(array("ewh.total_real_hours AS HR","ewh.total_accountable_hours AS HC"));
           $this->db->from("employees_working_hours ewh");
           $this->db->join("offers o","o.id = ewh.site_id");
           $this->db->where("ewh.employee_id",$userid);
            $this->db->where("ewh.working_date",$date);
            $this->db->where("ewh.site_id",$site_id);

           $query = $this->db->get();
         return $result = $query->row();
         // print_r($result);exit;
    }

    public function get_user_absents($userid,$date){

          // $this->db->select(array("ewh.site_id","ewh.total_real_hours AS HR","ewh.total_accountable_hours AS HC","o.description AS site_name"));
         $this->db->select(array("ewh.is_absent"));
           $this->db->from("employees_working_hours ewh");
           $this->db->where("ewh.employee_id",$userid);
            $this->db->where("ewh.working_date",$date);
            $this->db->where("ewh.is_absent",1);

           $query = $this->db->get();
          $result = $query->row();
          return $result;
         // print_r($result);exit;
    }

    public function get_user_comments($userid,$date){

          // $this->db->select(array("ewh.site_id","ewh.total_real_hours AS HR","ewh.total_accountable_hours AS HC","o.description AS site_name"));
         $this->db->select(array("ewh.comment"));
           $this->db->from("employees_working_hours ewh");
           $this->db->where("ewh.employee_id",$userid);
            $this->db->where("ewh.working_date",$date);
            $this->db->where("ewh.comment !=",'');
            $this->db->order_by("ewh.id DESC");
            $this->db->limit(1);

           $query = $this->db->get();
          $result = $query->row();
          return $result;
         // print_r($result);exit;
    }

    public function get_all_employees(){
          $this->db->select(array("id","CONCAT(fname,' ',lname) as employee_name"));
           $this->db->from("employees");
           $query = $this->db->get();
         return $result = $query->result_array();
    }

    public function get_all_working_sites(){
          $this->db->select(array("id","description","reference_no"));
           $this->db->from("offers");
        $this->db->where("offer_type","execution");
         $this->db->or_where("offer_type","order_book");
        $query= $this->db->get();
        return $query->result();
    }

    public function check_employee_schedule($employee_id,$date){
        $this->db->select(array("*"));
        $this->db->from("schedule"); 
        $this->db->where("employee_id",$employee_id);
        $this->db->where("schedule_date",$date);

        $query = $this->db->get();
        return $query->num_rows();  
    }

    public function save_schedule(){
      $current_week = $this->input->post('week_number');
      $current_year = $this->input->post('current_year');
      $morning_schedule = $this->input->post('morning_schedule');
      $afternoon_schedule = $this->input->post('afternoon_schedule');
      $employee_id = $this->input->post('employee_id');

      $current_week_dates =  get_week_dates($current_week,$current_year);
      $dates_arr = explode('_', $current_week_dates);
      $start_date = $dates_arr[0];
      $end_date = $dates_arr[1];
      $dates = array();
      for($i=0; $i<=6;$i++){
      $next_date = date("Y-m-d",strtotime("+".$i." days ",strtotime($start_date)));     
      array_push($dates, $next_date);
    }
    // print_r($dates);
    $inser_arr = array();
    foreach ($employee_id as $key => $emp) {
        for($i=0; $i<7; $i++){
          if($morning_schedule[$emp][$i] || $afternoon_schedule[$emp][$i]){
        #------------- check if schedule exist-----------#
         $check_schedule = $this->check_employee_schedule($emp,$dates[$i]); 
        if($check_schedule==0){
          $insert = array(
                        'employee_id'=>$emp,
                        'morning_schedule'=>$morning_schedule[$emp][$i],
                        'afternoon_schedule'=>$afternoon_schedule[$emp][$i],
                        'schedule_date'=>$dates[$i]
                      );
          //array_push($inser_arr,$insert);
          $this->db->insert("schedule",$insert);
        }else{
            $update = array(
                        'employee_id'=>$emp,
                        'morning_schedule'=>$morning_schedule[$emp][$i],
                        'afternoon_schedule'=>$afternoon_schedule[$emp][$i],
                        'schedule_date'=>$dates[$i]
                      );
         // print_r($update);exit;
          $this->db->update("schedule",$update,array('employee_id'=>$emp,'schedule_date'=>$dates[$i]));
        }
      }
      }
    }
    return true;
    }

    
    public function get_current_week_schedule($employee_id,$date){
        $this->db->select(array("morning_schedule","afternoon_schedule"));
        $this->db->from("schedule");
        $this->db->where("schedule_date",$date);
        $this->db->where("employee_id",$employee_id);
       // echo $this->db->get_compiled_select();
        $query = $this->db->get();
       return $result = $query->row();
    }

}
