<?php
class Mod_common extends CI_Model {

  public function exact_connect(){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $total_sales_invoices = 0;
    try {

      // Initialize ExactAPI
      $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);  
      $exactApi->getOAuthClient()->setRedirectUri($redirectUri);

      $this->db->select("*");
      $this->db->from("tokens");

      $query = $this->db->get();
      $result = $query->row_array();

     //print_r($result);exit;

      if (!isset($_GET['code']) && (count($result)==0 || $result['refresh_token']=='') ) {

      // Redirect to Auth-endpoint
        $authUrl = $exactApi->getOAuthClient()->getAuthenticationUrl();
        header('Location: ' . $authUrl, TRUE, 302);
        die('Redirect');

      } else {

        if(count($result)==0 || $result['refresh_token']==''){
      // Receive data from Token-endpoint
          $tokenResult = $exactApi->getOAuthClient()->getAccessToken($_GET['code']);

        #----------- insert in database-----------#
          $this->db->truncate('tokens');
          $insert = array(
            'access_token' =>$tokenResult['access_token'],
            'refresh_token' => $tokenResult['refresh_token']
          );
          $this->db->insert('tokens',$insert);

        }else{
          $URL_TOKEN = 'https://start.exactonline.be/api/oauth2/token';
          $refreshToken = $result['refresh_token'];
          $GRANT_REFRESH_TOKEN = 'refresh_token';
          $params = array(
            'refresh_token' => $refreshToken,
            'grant_type' => $GRANT_REFRESH_TOKEN,
            'client_id' => CLIENT_ID,
            'client_secret' => CLIENT_SECRET
          );

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_URL, $URL_TOKEN);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, '', '&'));
          $result = curl_exec($ch);

          $tokenResult = json_decode($result, TRUE);
          /*echo '------------- TOKEN RESPONSE--------------<br>';
          echo'<pre>';print_r($tokenResult);*/

          $update = array(
            'access_token' =>$tokenResult['access_token'],
            'refresh_token' => $tokenResult['refresh_token']
          );
          $this->db->update('tokens',$update,array('id'=>1));
        }
    #-------------- set refresh token -----------#
        $exactApi->setRefreshToken($tokenResult['refresh_token']);
      }

    }catch(ErrorException $e){
      var_dump($e);

    }


  }

  public function exact_turnOver_api(){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $total_sales_invoices = 0;
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  
    $SalesInvoices = $exactApi->sendRequest('turnover', 'get');
  //print_r($SalesInvoices);
    if($SalesInvoices!=''){
    $search2 = array('m:properties','d:AmountDC');
    $repalce2 = array('mproperties','AmountDC');
    $SalesInvoices = str_replace($search2, $repalce2, $SalesInvoices);
  //echo $SalesInvoices;
    $xml2 = simplexml_load_string($SalesInvoices);    
    foreach($xml2->entry as $item){         
      $total_sales_invoices +=(float)$item->content->mproperties->AmountDC;
    }
  }else{
    $total_sales_invoices = 0;
  }

    return $total_sales_invoices;

  }
  
  public function exact_purchase_api($refference){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $real_purchase = 0;
    
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  

    $response = $exactApi->sendRequest('purchaseentry/PurchaseEntryLines', 'get','',$refference);//purchaseentry/PurchaseEntries
    if($response){
    $search = array('m:properties','d:AmountDC','d:EntryID');
    $repalce = array('mproperties','dAmountDC','dEntryID');
    $response = str_replace($search, $repalce, $response);
    $xml = simplexml_load_string($response); 
   // print_r($xml->entry);
    foreach($xml->entry as $item){
      $real_purchase += (float)$item->content->mproperties->dAmountDC;
        //echo  'AmountFC='.$item->content->mproperties->dAmountFC.'<br>';
    } 
  }else{
    $real_purchase =0;
  }

    return $real_purchase;

  }

  public function exact_purchase_api_entryid($refference){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $real_purchase = 0;
    
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  

    $response = $exactApi->sendRequest('purchaseentry/PurchaseEntryLines', 'get','',$refference);//purchaseentry/PurchaseEntries
    if($response){
    $search = array('m:properties','d:AmountDC','d:EntryID');
    $repalce = array('mproperties','dAmountDC','dEntryID');
    $response = str_replace($search, $repalce, $response);
    $xml = simplexml_load_string($response); 
    foreach($xml->entry as $item){
      $purchase_entryId = $item->content->mproperties->dEntryID;
        //echo  'AmountFC='.$item->content->mproperties->dAmountFC.'<br>';
    } 
  }else{
    $purchase_entryId =0;
  }

    return $purchase_entryId;

  }

  public function exact_document_api($entry_id){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $real_purchase = 0;
    
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  

    #---------------- get document from purhcase--------------------#
    $response = $exactApi->sendRequest('purchaseentry/PurchaseEntries', 'get','',$entry_id);
    if($response){
    $search = array('m:properties','d:AmountDC','d:AmountFC','d:BatchNumber','d:Document');
    $repalce = array('mproperties','dAmountDC','dAmountFC','dBatchNumber','dDocument');
    $response = str_replace($search, $repalce, $response);
    $xml = simplexml_load_string($response); 
    $document_id = '';
    foreach($xml->entry as $item){
      $document_id = $item->content->mproperties->dDocument;
    }

    #----------- document link for download -------------------------#
    $response1 = $exactApi->sendRequest('bulk/Documents/DocumentAttachments', 'get','',$document_id);
    $documents = array();
    $search1 = array('m:properties','d:Url');
    $repalce1 = array('mproperties','dUrl');
    $response1 = str_replace($search1, $repalce1, $response1);
    $xml1 = simplexml_load_string($response1); 
   // echo $response1;
    foreach($xml1->entry as $item){
      
      //array_push($documents,$item->content->mproperties->dUrl);
      $documents[] = $item->content->mproperties->dUrl;
    }
  }else{
     $documents = array();
  }
   return $documents;


  }

  public function exact_invoice_api($refference){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $total_sales_invoices = 0;
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  
    $SalesInvoices = $exactApi->sendRequest('salesentry/SalesEntryLines', 'get','',$refference);
  //print_r($SalesInvoices); 
    $invoices = array();
    if($SalesInvoices){
    $search2 = array('m:properties','d:AmountDC');
    $repalce2 = array('mproperties','AmountDC');
    $SalesInvoices = str_replace($search2, $repalce2, $SalesInvoices);
   
    $xml2 = simplexml_load_string($SalesInvoices);    
    foreach($xml2->entry as $item){         
      $invoices[]=(float)$item->content->mproperties->AmountDC;
    }
  }
//print_r($invoices);
    return $invoices;

  }


}
