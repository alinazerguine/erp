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

      if (!isset($_GET['code']) && (count($result)==0 || $result['refresh_token']=='') ) {

        // Redirect to Auth-endpoint
        $authUrl = $exactApi->getOAuthClient()->getAuthenticationUrl();
        header('Location: ' . $authUrl, TRUE, 302);
        die('Redirect');

      } else {

        if(count($result)==0 || $result['refresh_token']==''){
          // Receive data from Token-endpoint
          $tokenResult = $exactApi->getOAuthClient()->getAccessToken($_GET['code']);
          // var_dump($tokenResult);

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

          // echo '------------- TOKEN RESPONSE--------------<br>';
          // echo'<pre>';print_r($tokenResult);
          // die();

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
      echo "error in Mode_common";
      var_dump($e);
      echo "error end in Mode_common";
    }


  }

  public function exact_turnOver_api($skipToken='',&$total_sales_invoices){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    $grand_total = 0;

    //echo 'sale before='.$total_sales_invoices.'<br>';
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  
    $SalesInvoices = $exactApi->sendRequest('turnover', 'get','','',$skipToken);
 //echo '<pre>';print_r($SalesInvoices);exit;
    if($SalesInvoices!=''){
    $search2 = array('m:properties','d:AmountDC','d:Created');
    $repalce2 = array('mproperties','AmountDC','Created');
    $SalesInvoices = str_replace($search2, $repalce2, $SalesInvoices);
  // print_r($SalesInvoices);exit;
    $xml2 = simplexml_load_string($SalesInvoices);    

    foreach($xml2->entry as $item){   
      $created_year =  date("Y",strtotime($item->content->mproperties->Created));   
      if($created_year==date("Y")){  
      $total_sales_invoices +=(float)$item->content->mproperties->AmountDC;
    }
      //echo $total_sales_invoices.'<br>';
    } 
    $grand_total = $total_sales_invoices;
    /*$requestUrl = $xml2->link[1]['href'];
    echo $requestUrl[0];*/

    if(count($xml2->link)>1){
      $next_url = $xml2->link[1]['href'];
      // echo $next_url.'<br>';
      $parts = parse_url($next_url);
      parse_str($parts['query'], $query);
      $this->exact_turnOver_api($query['$skiptoken'],$total_sales_invoices);
    
    }
    //echo $total_sales_invoices.'-';
//echo $grand_total;    
  }
    //print_r($total_sales_invoices);
    //return $grand_total;

  }
  
  public function exact_purchase_api($refference,$skipToken='',&$real_purchase){

    require_once 'ExactApi.php';
    // Configuration, change these:
    $clientId     = CLIENT_ID;
    $clientSecret   = CLIENT_SECRET;
    $redirectUri  = REDIRECT_URL;
    $division   = DIVISION;
    
    $exactApi = new ExactApi('be', $clientId, $clientSecret, $division);

    $this->db->select("*");
    $this->db->from("tokens");

    $query = $this->db->get();
    $result = $query->row_array();
    $exactApi->setRefreshToken($result['refresh_token']);  

    $response = $exactApi->sendRequest('purchaseentry/PurchaseEntryLines', 'get','',$refference,$skipToken);//purchaseentry/PurchaseEntries
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

    if(count($xml->link)>1){
      $next_url = $xml->link[1]['href'];
      //echo $next_url.'<br>';
      $parts = parse_url($next_url);
      parse_str($parts['query'], $query);
      $this->exact_purchase_api($refference,$query['$skiptoken'],$real_purchase);
    
    }
  }
   
  }

  public function exact_purchase_api_entryid($refference,$skipToken='',&$purchase_entryId){

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

    $response = $exactApi->sendRequest('purchaseentry/PurchaseEntryLines', 'get','',$refference,$skipToken);//purchaseentry/PurchaseEntries
    if($response){
    $search = array('m:properties','d:AmountDC','d:EntryID');
    $repalce = array('mproperties','dAmountDC','dEntryID');
    $response = str_replace($search, $repalce, $response);
    $xml = simplexml_load_string($response); 
    foreach($xml->entry as $item){
      $purchase_entryId[] = $item->content->mproperties->dEntryID;
        //echo  'AmountFC='.$item->content->mproperties->dAmountFC.'<br>';
    } 

    if(count($xml->link)>1){
      $next_url = $xml->link[1]['href'];
      //echo $next_url.'<br>';
      $parts = parse_url($next_url);
      parse_str($parts['query'], $query);
      $this->exact_purchase_api_entryid($refference,$query['$skiptoken'],$purchase_entryId);
    
    }

  }

   // return $purchase_entryId;

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
     $data = array();
    foreach ($entry_id as $key => $entry) {

    $response = $exactApi->sendRequest('purchaseentry/PurchaseEntries', 'get','',$entry);
    if($response){
    $search = array('m:properties','d:Document','d:Supplier','d:SupplierName','d:EntryDate','d:AmountDC');
    $repalce = array('mproperties','dDocument','dSupplier','dSupplierName','dCreated','AmountDC');
    $response = str_replace($search, $repalce, $response);
    $xml = simplexml_load_string($response); 

    $document_id = '';
    foreach($xml->entry as $item){
      $document_id = $item->content->mproperties->dDocument;
      $Supplier =  str_replace('-', '', $item->content->mproperties->dSupplier);
       $SupplierName =  $item->content->mproperties->dSupplierName;
      $Created =  date("Y-m-d",strtotime($item->content->mproperties->dCreated));
      $purchase = (float)$item->content->mproperties->AmountDC;
    }

    $data[$Supplier]['name'] = $SupplierName;
   // $data[$Supplier]['purchase'] = $purchase;
    #----------- document link for download -------------------------#
    $response1 = $exactApi->sendRequest('bulk/Documents/DocumentAttachments', 'get','',$document_id);
    $search1 = array('m:properties','d:FileName','d:Url');
    $repalce1 = array('mproperties','FileName','dUrl');
    $response1 = str_replace($search1, $repalce1, $response1);
    $xml1 = simplexml_load_string($response1); 
    /*echo '<br>*****************************************************************************<br>';*/
   // echo $response1;
    $documents = array();
    foreach($xml1->entry as $item){
      
      //array_push($documents,$item->content->mproperties->dUrl);
      $filename = $item->content->mproperties->FileName;
      $type = explode('.', $filename);
     if($type[1]!='xml'){
      $documents[] = array('created'=>$Created,'url'=>$item->content->mproperties->dUrl,'purchase'=>$purchase);
    }
     //print_r($documents);
    }
   $data[$Supplier]['docs'][] = $documents;
  }
}

/*echo "<pre>";
print_r ($data);
echo "</pre>";exit;*/
   return $data;


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
