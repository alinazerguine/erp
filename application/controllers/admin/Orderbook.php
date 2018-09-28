<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orderbook extends AdminController {

  function __construct() {
        // Call the Model constructor
    parent::__construct();
    $this->user = 'Administrator';
    $this->load->model('mod_orderbook');
    $this->load->model('mod_common');
     ini_set('max_execution_time', 0); 
  }

  public function index()
  {
		#--------------- load view--------------#	
    $data['title'] = 'Order Book';
    $data["subview"] = "admin/orderbook/orders";
    $this->load->view('admin_layout', $data);
  }

  public function get_offers()
  {
    $list = $this->mod_orderbook->get_offers();
    $data = array();
    $no = $_POST['start'];
    foreach ($list as $value) {

     $action = '<ul class="for_editing_deleting">
     <li><a href="'.SURL.'/admin/orderbook/detail/'.$value->id.'"><i class="fa fa-eye" aria-hidden="true" title="detail"></i></a></li>                        
     </ul>';

     $no++;
     $row = array();
     
     $row[] = $value->reference_no.'<input type="hidden" id="row_id" value="'.$value->id.'" />';
     $row[] = $value->description;            
     $row[] = $value->company;
     $row[] = $value->market;
     $row[] = $value->client;
     $row[] = convertTime($value->working_hours);
     $row[] = numberFormat($value->sale_price).CURRENCY;
     $row[] = $value->working_hours;
     $row[] = $value->sale_price;
           
     
     
     $data[] = $row;
   }
   
   $output = array(
    "draw" => $_POST['draw'],
    "recordsTotal" => $this->mod_orderbook->get_count(),
    "recordsFiltered" => $this->mod_orderbook->get_count(),
    "data" => $data,
  );
        //output to json format
   echo json_encode($output);

 }

 
 public function detail($id)
 {
  $data['order_detail'] = $this->mod_orderbook->get_offers($id);
		#--------------- load view--------------#	
  $data['title'] = 'Offer Detail';
  $data["subview"] = "admin/orderbook/order_detail";
  $this->load->view('admin_layout', $data);
}

public function documents($id)
  {
    $data['offer'] = $this->mod_orderbook->get_offers($id);
    /*$purchase_entryId = array();
    $this->mod_common->exact_purchase_api_entryid($data['offer']->reference_no,'',$purchase_entryId); 
    $data['documents'] = $this->mod_common->exact_document_api($purchase_entryId); */
    $data['documents'] = get_exact_document($data['offer']->reference_no);  
    #--------------- load view--------------# 
    $data['offer_id'] = $id;
    $data['reference_no'] = $data['offer']->reference_no;
    $data['title'] = DOCUMENTS;
    $data["subview"] = "admin/orderbook/documents";
    $this->load->view('admin_layout', $data);
  }



}
