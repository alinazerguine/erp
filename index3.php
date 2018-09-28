<?php
$clientId 		= '5ba13197-4839-4c8f-90bf-37cb5ccfd7b8';
$clientSecret 	= 'ee2b1GzDZWtv';
$redirectUri 	= "http://dev.nsol.sg/projects/exact_online";
$division		= "327668";

/*
#### Get auth ###########
*/
if (!isset($_GET['code'])) {
		
		// Redirect to Auth-endpoint
		$URL_AUTH = 'https://start.exactonline.be/api/oauth2/auth?client_id='.$clientId.'&redirect_uri='.$redirectUri.'&response_type=code';
		header('Location: ' . $URL_AUTH, TRUE, 302);
		die('Redirect');
		
	}else{
		$URL_TOKEN = 'https://start.exactonline.be/api/oauth2/token';
		$params = array(
		    'code' => $_GET['code'],
		    'client_id' => $clientId,
		    'grant_type' => 'authorization_code',
		    'client_secret' => $clientSecret,
		    'redirect_uri' => $redirectUri,
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $URL_TOKEN);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, '', '&'));
		$result = curl_exec($ch);

		$authResult = json_decode($result, TRUE);
		echo '------------- AUTH RESPONSE--------------<br>';
		echo'<pre>';print_r($authResult);
	
		/*
#### Get new access token from refresh token ###########
*/
		
		#------------ purchase entry---------#
		$purchase_api = 'https://start.exactonline.be/api/v1/327668/purchaseentry/PurchaseEntries?$filter=YourRef eq \'18-501\'&$top=1&$select=EntryID,AmountDC,AmountFC,BatchNumber,Created,Creator,CreatorFullName,Currency,InvoiceNumber,SupplierName,YourRef&access_token='.$authResult['access_token'];
		#---------- get documents-----------#
		/*$document_api = "https://start.exactonline.be/api/v1/327668/bulk/Documents/Documents?access_token=".$authResult['access_token']."&$filter=Creator eq guid'".$clientId."'&$select=Category, Contact, Created, Creator, Division, DocumentDate, DocumentFolder, FinancialTransactionEntryID, HID, Modified, SalesInvoiceNumber, Subject, Type";*/
		$header = array(
			    'Content-Type:application/json', 
			    'Accept: application/json',
			    'Key: authorization',
			    'Value: Bearer '.$authResult['access_token'],
			    'access_token:Bearer ' . $authResult['access_token']
			);
		echo $purchase_api;
		//print_r($header);
		 $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $purchase_api);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$info = curl_error($ch);
		curl_error($ch);
		echo '<br>------------- DOCS RESPONSE--------------<br>';
		echo'<pre>';print_r($info);
		echo'<pre>';print_r($result);
		/*$curlOpt = array();
		$curlOpt[CURLOPT_URL] = $purchase_api;
		$curlOpt[CURLOPT_RETURNTRANSFER] = TRUE;
		$curlOpt[CURLOPT_SSL_VERIFYPEER] = TRUE;
		$curlOpt[CURLOPT_HEADER] = false;
		$curlOpt[CURLOPT_HTTPHEADER] = $header;
		$curlOpt[CURLOPT_POSTFIELDS] = null;
		$curlOpt[CURLOPT_CUSTOMREQUEST] = 'GET';
		$curlHandle = curl_init();
		curl_setopt_array($curlHandle, $curlOpt);
		
		$result= curl_exec($curlHandle);
		$info = curl_getinfo($ch);
		echo '<br>error:' . curl_error($curlHandle);*/
		//echo '------------- PURCHASE RESPONSE--------------<br>';
		//echo'<pre>';print_r($result);
	/*if($authResult['refresh_token']){
		$URL_TOKEN = 'https://start.exactonline.be/api/oauth2/token';
		$refreshToken = $authResult['refresh_token'];
		$GRANT_REFRESH_TOKEN = 'refresh_token';
		$params = array(
		    'refresh_token' => $refreshToken,
		    'grant_type' => $GRANT_REFRESH_TOKEN,
		    'client_id' => $clientId,
		    'client_secret' => $clientSecret
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

		$decodedResult = json_decode($result, TRUE);
		echo '------------- TOKEN RESPONSE--------------<br>';
		echo'<pre>';print_r($decodedResult);
	}*/

	}
?>