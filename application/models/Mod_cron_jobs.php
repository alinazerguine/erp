<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_cron_jobs extends CI_Model {


	public function turnover_api()
	{
		$total_sales_invoices=0;
		$this->mod_common->exact_turnOver_api('',$total_sales_invoices);
		//echo $total_sales_invoices;exit;
		$data = array('turnover'=>(float)$total_sales_invoices);
		//print_r($data);exit;
		$this->db->truncate('cron_turnover');
		$this->db->insert("cron_turnover",$data);

		return true;

	}


	public function purchase_api()
	{
		$this->db->select(array("reference_no","offer_type","purchase_price","description"));
		$this->db->from("offers");

		$query = $this->db->get();
		$result = $query->result();

		$this->db->truncate('cron_purchase');

		foreach ($result as $key => $value) {
			$real_purchase=0;
			$this->mod_common->exact_purchase_api($value->reference_no,'',$real_purchase);
			#---------- only for completed sites-----------------#
			if($value->offer_type=="end_construction"){

				$purchase_price = $value->purchase_price;

				if($real_purchase > $purchase_price){
					 $site_name = '#'.$value->reference_no.'-'.$value->description;
					$notification = array(
                          'title'=>'Le chantier terminé a reçu de nouveaux achats',
                          'detail'=>'Le chantier terminé '.$site_name.' a reçu de nouveaux achats',
                          'is_new'=>1,
                          'notify_to'=>0,
                          'link'=> SURL.'administrator',
                          'created_at'=>date("Y-m-d H:i:s")
                      );
    				$this->db->insert('notifications',$notification);
				}


			}
			$data = array(
				'reference_no'=>$value->reference_no,
				'purchase'=>$real_purchase,
			);
			$this->db->insert("cron_purchase",$data);
		}

		return true;
			
	}

	public function invoice_api()
	{
		$this->db->select("reference_no");
		$this->db->from("offers");

		$query = $this->db->get();
		$result = $query->result();

		$this->db->truncate('cron_invoices');

		foreach ($result as $key => $value) {

			$invoices = $this->mod_common->exact_invoice_api($value->reference_no);

			$data = array(
				'reference_no'=>$value->reference_no,
				'invoices'=>json_encode($invoices),
			);
			$this->db->insert("cron_invoices",$data);
		}

		return true;
			
	}

	public function documents_api()
	{
		$this->db->select("reference_no");
		$this->db->from("offers");

		$query = $this->db->get();
		$result = $query->result();
		
		$this->db->truncate('cron_documents');

		foreach ($result as $key => $value) {
			$purchase_entryId = array();
			$this->mod_common->exact_purchase_api_entryid($value->reference_no,'',$purchase_entryId); 

			$documents = $this->mod_common->exact_document_api($purchase_entryId);

			if($documents){
                  foreach($documents as $key=>$data){
                    if(count($data['docs'])>0){
                    foreach($data['docs'] as $k=>$docs){
                      foreach($docs as $j=>$doc){ 

                      $data_arr = array(
                      				'reference_no'=>$value->reference_no,
                      				'supplier_name'=>$data['name'],
                      				'document_url' => $doc['url'],
                      				'purchase' => abs($doc['purchase']),
                      				'created' =>$doc['created'],
                      				);           
                	$this->db->insert("cron_documents",$data_arr);
                 }}}   
                 }
              }
		}

			return true;
			
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
}
