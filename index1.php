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
$clientId 		= 'a7397ff5-e1f0-45e0-9f66-f3030d9f62f6';
$clientSecret 	= 'zeQvtdkKGSFq';
$redirectUri 	= "http://87.66.16.17:7080/erp/administrator";
$division		= "249534";

try {
		
	// Initialize ExactAPI
	$exactApi = new ExactApi('be', $clientId, $clientSecret, $division);
	
	$exactApi->getOAuthClient()->setRedirectUri($redirectUri);
	
	if (isset($_GET['code'])) {
		
		// Redirect to Auth-endpoint
		$authUrl = $exactApi->getOAuthClient()->getAuthenticationUrl();
		header('Location: ' . $authUrl, TRUE, 302);
		die('Redirect');
		
	} else {
		
		// Receive data from Token-endpoint
		$asdf = "AgX7!IAAAAL1wgrcZgVbfo0s4EOApRitIlE9hq7ILEMe9QYRJRY228QAAAAHvxGeQG_kdFEn5PD3dDh073-9WHUDmUEF0OyWTq4jF_LKlZEH1F6RMQda5i4F_u3rXikPZDFk_OTWO8r-LjmIewYLpNOw1qgOwmSoYvMfIC7tMsjZ_ZX6QylkswmQUvQdKC-j8XXczepribuKx3qYAJc86clbS5VYal8j8MAH3iVrM8I-nGb4h2TH5spj-F-iwCXIp8La9HA7tyCaLzRSVUDHjw35srqN9Yo2Yl05VkT4oRchvML0PvZBAt0s84035sL3NKn2rmsHo5QFrvLp3OekZwv9B7bef-TNeUY_GZyJFpviJdoB5pr6T3JosPnc";

		$tokenResult = $exactApi->getOAuthClient()->getAccessToken($asdf);
		// $tokenResult = $exactApi->getOAuthClient()->getAccessToken($_GET['code']);
		echo'<pre>';print_r($tokenResult);
		$exactApi->setRefreshToken($tokenResult['refresh_token']);
		echo "here";
		// List accounts
		$response = $exactApi->sendRequest('crm/Accounts', 'get');
		echo "hahaha";
		var_dump($response);
		
		// Create account
		$response = $exactApi->sendRequest('crm/Accounts', 'post', array(
			'Status'			=>	'C',
			'IsSupplier'		=>	True,
			'Name'				=>	'iWebDevelopment B.V.',
			'AddressLine1'		=>	'Ceresstraat 1',
			'Postcode'			=>	'4811CA',
			'City'				=>	'Breda',
			'Country'			=>	'NL',
			'Email'				=>	'info@iwebdevelopment.nl',
			'Phone'				=>	'+31(0)76-7002008',
			'Website'			=>	'www.iwebdevelopment.nl'

		));
		echo "ggg";
		var_dump($response);
		
	}
	
}catch(ErrorException $e){
	echo "error";
	var_dump($e);
	
}