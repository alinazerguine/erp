<?php
class Mod_admin_dashboard extends CI_Model {

	public function total_turnover(){ 

        $this->db->select(array("turnover"));
        $this->db->from("cron_turnover");
        //$this->db->where("offer_type","end_construction");

        $query = $this->db->get();

        $result =  $query->row();  
        return ($result) ? $result->turnover : 0;
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

	public function get_notifications($notify_to){  

        $this->db->select(array("*"));
        $this->db->from("notifications");
        $this->db->where("notify_to",$notify_to);
        $this->db->order_by('id','DESC');

        $query = $this->db->get();
        return $query->result();  
    }

    public function unread_message($notify_to=0){  

        $this->db->select(array("*"));
        $this->db->from("notifications");
        $this->db->where("is_new",1);
        $this->db->where("notify_to",$notify_to);

        $query = $this->db->get();
        $count = $query->num_rows();    

        $this->db->select(array("*","TIMESTAMPDIFF(MINUTE,created_at,NOW()) as created_time"));
        $this->db->from('notifications'); 
        $this->db->where('is_new',1);
        $this->db->where("notify_to",$notify_to);
        $this->db->order_by('id','DESC');
        $this->db->limit('4');  
        //echo $this->db->get_compiled_select();exit;
        $query1 = $this->db->get();
        $result = $query1->result();

        $list=array();
        if($result){
            foreach($result as $key=>$data){
                $list[$key] = $data;
                $created_time = $data->created_time;
                $hours = round($created_time / 60) ;
                $days = round($hours/24) ;
                
                $time = '';
                if($created_time<=0){
                    $time ="just now";
                }elseif($created_time >0 && $hours <1){
                    $time = $created_time." mins ago";
                }
                elseif($created_time >60 && $hours >0 && $hours<24){
                    $time = $hours." hours ago";
                }elseif($hours >24){
                    $time = $days." days ago";
                }

                $list[$key]->created_time = $time;
            }
        }   

        return array("count"=>$count,"list"=>$result);


    }

    public function read_message($id){
        $this->db->update("notifications",array('is_new'=>0), array('id'=>$id));
        echo "OK";
    }


}
