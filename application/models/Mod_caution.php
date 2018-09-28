<?php
class Mod_caution extends CI_Model {

	public function get_count_sites(){   

    $this->db->select(array("COUNT(cs.site_id)"));
    $this->db->from("caution_sites cs"); 
    $this->db->join("offers o","o.id=cs.site_id","left");
    $this->db->group_by("cs.site_id");

    $query = $this->db->get();
    return $query->num_rows();  
  }

  public function get_sites($id=0){
        //print_r($_POST);
        $column_order = array("o.reference_no","o.description","cs.caution_reference","cs.admin_provional_accpt_date","cs.financial_provional_accpt_date","cs.duration_for_final_acceptance","cs.admin_final_accpt_date","cs.financial_final_accpt_date"); //set column field database for datatable orderable
        $column_search = array("o.reference_no","o.description","cs.admin_provional_accpt_date","cs.financial_provional_accpt_date","cs.duration_for_final_acceptance","cs.admin_final_accpt_date","cs.financial_final_accpt_date"); //set column field database for datatable searchable 
        $order = array('o.reference_no' => 'asc'); // default order 
        
        $this->db->select(array("cs.*","o.reference_no","o.description"));
        $this->db->from("caution_sites cs"); 
        $this->db->join("offers o","o.id=cs.site_id","left");
        $this->db->group_by("cs.site_id");

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
       $this->db->where('cs.site_id',$id);
       $query = $this->db->get();
       return $query->row();
     }

   }

   function update(){
    $site_id = $this->input->post('site_id');
    $caution_reference = $this->input->post('caution_reference');
    $admin_provional_accpt_date = $this->input->post('admin_provional_accpt_date');
    $financial_provional_accpt_date = $this->input->post('financial_provional_accpt_date');
    $duration_for_final_acceptance = $this->input->post('duration_for_final_acceptance');
    $admin_final_accpt_date = $this->input->post('admin_final_accpt_date');
    $financial_final_accpt_date = $this->input->post('financial_final_accpt_date');
//print_r($this->input->post());
//$date = str_replace('/', '-', $admin_provional_accpt_date);
//echo date("Y-m-d",strtotime(str_replace('/', '-', $admin_provional_accpt_date)));
//exit;
    $update_arr = array(
                        'caution_reference'=>$caution_reference,
                        'admin_provional_accpt_date'=>($admin_provional_accpt_date) ? date("Y-m-d",strtotime(str_replace('/', '-', $admin_provional_accpt_date))) : '',
                        'financial_provional_accpt_date'=>($financial_provional_accpt_date) ? date("Y-m-d",strtotime(str_replace('/', '-', $financial_provional_accpt_date))) : '',
                        'duration_for_final_acceptance'=>($duration_for_final_acceptance) ? $duration_for_final_acceptance : '',
                        'admin_final_accpt_date'=>($admin_final_accpt_date) ? date("Y-m-d",strtotime(str_replace('/', '-', $admin_final_accpt_date))) : '',
                        'financial_final_accpt_date'=>($financial_final_accpt_date) ? date("Y-m-d",strtotime(str_replace('/', '-', $financial_final_accpt_date))) : '',
                      );
    $this->db->update('caution_sites',$update_arr,array('site_id'=>$site_id));

    return true;

   }
 }
