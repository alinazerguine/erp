<?php

/**
* Exact API / oAauth
* Copyright (c) iWebDevelopment B.V. (https://www.iwebdevelopment.nl)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) iWebDevelopment B.V. (https://www.iwebdevelopment.nl)
* @link          https://www.iwebdevelopment.nl
* @since         01-06-2015
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/

require_once 'ExactApi.php';

// Configuration, change these:
$clientId 		= '5ba13197-4839-4c8f-90bf-37cb5ccfd7b8';
$clientSecret 	= 'ee2b1GzDZWtv';
$redirectUri 	= "http://dev.nsol.sg/projects/exact_online";
$division		= "327668";

try {
		
	// Initialize ExactAPI
	$exactApi = new ExactApi('be', $clientId, $clientSecret, $division);
	
	$exactApi->getOAuthClient()->setRedirectUri($redirectUri);
	
	if (!isset($_GET['code'])) {
		
		// Redirect to Auth-endpoint
		$authUrl = $exactApi->getOAuthClient()->getAuthenticationUrl();
		header('Location: ' . $authUrl, TRUE, 302);
		die('Redirect');
		
	} else {
		
		// Receive data from Token-endpoint
		$tokenResult = $exactApi->getOAuthClient()->getAccessToken($_GET['code']);
		/*echo '------------- AUTH RESPONSE--------------<br>';
		echo'<pre>';print_r($tokenResult);*/
		//$exactApi->initAccessToken($tokenResult['refresh_token']);
		$exactApi->setRefreshToken($tokenResult['refresh_token']);


		
		#------------ get purchase entries--------------#
		echo '------------- Purchase entries--------------<br>';
		$response = $exactApi->sendRequest('purchaseentry/PurchaseEntries', 'get');
		$search = array('m:properties','d:AmountDC','d:AmountFC');
		$repalce = array('mproperties','dAmountDC','dAmountFC');
		$response = str_replace($search, $repalce, $response);
		$xml = simplexml_load_string($response); 
		foreach($xml->entry as $item){
			echo  'AmountDC='.$item->content->mproperties->dAmountDC.'<br>';
			echo  'AmountFC='.$item->content->mproperties->dAmountFC.'<br>';
		}	
		echo '<br>------------- Docs--------------<br>';
		#--------------- get documents----------------#
		$response1 = $exactApi->sendRequest('bulk/Documents/DocumentAttachments', 'get');
		//print_r($response1);
		$search1 = array('m:properties','d:Url');
		$repalce1 = array('mproperties','dUrl');
		$response1 = str_replace($search1, $repalce1, $response1);
		$xml1 = simplexml_load_string($response1); 
		foreach($xml1->entry as $item){
			echo  'URL='.$item->content->mproperties->dUrl.'<br>';
		}
		exit;

		
		
		// Create account
		/*$response = $exactApi->sendRequest('purchaseentry/PurchaseEntries', 'post', array(
			'EntryID'				=>	'guid12345678-asdf-qwer-zxcv-qwert123456u',
			'BatchNumber'			=>	'5',
			'Currency'				=>	'',//Currency code
			'Description'			=>	'',
			'Document'				=>	'',
			'DueDate'				=>	'HGello world',//Date when payment should be done
			'EntryDate'				=>	'5',
			'EntryNumber'			=>	'2018',
			'ExternalLinkReference'	=>	'2017-12-27',
			'GAccountAmountFC'		=>	'5',
			'InvoiceNumber'			=>	'5',
			'Journal'				=>	'5',
			'OrderNumber'			=>	'5',
			'PaymentCondition'		=>	'5',
			'PaymentReference'		=>	'5',
			'ProcessNumber'			=>	'5',
			'Rate'					=>	'5.0',
			'ReportingPeriod'		=>	'5',
			'ReportingYear'			=>	'1',
			'Reversal'				=>	false,
			'Supplier'				=>	'1',
			'VATAmountFC'			=>	'4',
			'YourRef'				=>	'sdfsd'

		));
		echo '<br>------------- API RESPONSE--------------<br>';
		var_dump($response);*/
		
	}
	
}catch(ErrorException $e){
	
	var_dump($e);
	
}