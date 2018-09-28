<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends AdminController {

	function __construct() {
        // Call the Model constructor
		parent::__construct();
		$this->user = 'Administrator';
		$this->load->model('mod_admin_dashboard');
		$this->load->model('mod_common');
	}

	public function index()
	{
		//$this->mod_common->exact_connect();
		/*$total_sales_invoices=0;
		$this->mod_common->exact_turnOver_api('',$total_sales_invoices);*/
		#------------------- other functions------------------------------#
		$data['total_turnover'] = $this->mod_admin_dashboard->total_turnover();
		$data['total_inprogress'] = $this->mod_admin_dashboard->total_inprogress();
		$data['total_sites'] = $this->mod_admin_dashboard->total_sites();
		$data['offer_pending'] = $this->mod_admin_dashboard->count_offer_by_status("En attente");
		$data['offer_accepted'] = $this->mod_admin_dashboard->count_offer_by_status("Accepté");
		$data['offer_canceled'] = $this->mod_admin_dashboard->count_offer_by_status("Annulé");
		$data['offer_rejected'] = $this->mod_admin_dashboard->count_offer_by_status("Rejeté");
		#-------------- market -----------------#
		$data['general_companies'] = $this->mod_admin_dashboard->count_client_type("Entreprise générale");
		$data['public_entities'] = $this->mod_admin_dashboard->count_client_type("Pouvoir public");
		$data['private_companies'] = $this->mod_admin_dashboard->count_client_type("Privé - Entreprise");
		$data['private_person'] = $this->mod_admin_dashboard->count_client_type("Privé - Particulier");
		#-------------- get all Notification -----------------#
		$data['notifications'] = $this->mod_admin_dashboard->get_notifications(0);
		#--------------- load view--------------#	
		$data['title'] = 'Dashboard';
		$data["subview"] = "admin/dashbaord";
		$this->load->view('admin_layout', $data);
	}

	public function unread_message(){
		$unread_message = $this->mod_admin_dashboard->unread_message();
		echo json_encode($unread_message);
	}

	public function read_message($id){

		$unread_message = $this->mod_admin_dashboard->read_message($id);
	}

	public function update_token(){

		$this->db->select("*");
		$this->db->from("tokens");

		$query = $this->db->get();
		$result = $query->row_array();

		$URL_TOKEN = 'https://start.exactonline.be/api/oauth2/token';
		$refreshToken = $result['refresh_token'];
		$GRANT_REFRESH_TOKEN = 'refresh_token';
		$params = array(
			'refresh_token' => $refreshToken,
			'grant_type' => $GRANT_REFRESH_TOKEN,
			'client_id' => CLIENT_ID,
			'client_secret' => CLIENT_SECRET
		);

		//echo $URL_TOKEN; 
		//print_r($params);exit;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $URL_TOKEN);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, '', '&'));
		$result = curl_exec($ch);

		$tokenResult = json_decode($result, TRUE);


		$update = array(
			'access_token' =>$tokenResult['access_token'],
			'refresh_token' => $tokenResult['refresh_token']
		);
		$this->db->update('tokens',$update,array('id'=>1));

		echo 'success';

	}

	public function exact_invoice_api($refer){
		$this->mod_common->exact_invoice_api($refer);
	}


}
