<?php

/**
* Exact API
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

require_once 'ExactOAuth.php';

class ExactApi
{
	
	const METHOD_POST = 'post';
	
	const URL_API = 'https://start.exactonline.%s/api/v1/';
	
	/** @var string */
	protected $countryCode;

	/** @var string */
	protected $clientId;

	/** @var string */
	protected $clientSecret;

	/** @var string */
	protected $refreshToken;
	
	/** @var string */
	protected $accessToken;
	
	/** @var int */
	protected $expiresIn;
	
	/** @var string */
	protected $division;

	/** @var ExactOAuth */
	protected $oAuthClient;
	

	/**
	 * @param string $countryCode
	 * @param string $clientId
	 * @param string $clientSecret
	 * @param string $division
	 * @param string|NULL $refreshToken
	 */
	public function __construct($countryCode, $clientId, $clientSecret, $division, $refreshToken = NULL)
	{
		$this->countryCode = $countryCode;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;
		$this->refreshToken = $refreshToken;
		$this->division = $division;
	}
	
	/**
	 * @return ExactOAuth
	 */
	public function getOAuthClient()
	{
		if (!$this->oAuthClient) {
			$this->oAuthClient = new ExactOAuth(
				$this->countryCode, $this->clientId, $this->clientSecret
			);
		}
		
		return $this->oAuthClient;
	}
	
	/**
	 * @param string $token
	 */
	public function setRefreshToken($token)
	{
		$this->refreshToken = $token;
	}

	/**
	 * @return string|FALSE
	 * @throws \ErrorException
	 */
	protected function initAccessToken()
	{
		if (empty($this->accessToken) || $this->isExpired()) {
			
			if (empty($this->refreshToken)) {
				throw new \ErrorException('Refresh token is not specified.');
			}
			
			$refreshed =  $this->getOAuthClient()->refreshAccessToken($this->refreshToken);
			if (!$refreshed) {
				return FALSE;
			}
			$this->setExpiresIn($refreshed['expires_in']);
			$this->refreshToken = $refreshed['refresh_token'];
			$this->accessToken = $refreshed['access_token'];
		}
		
		return $this->accessToken;
	}

	/**
	 * @param int $expiresInTime
	 */
	protected function setExpiresIn($expiresInTime)
	{
		$this->expiresIn = time() + $expiresInTime;
	}
	
	/**
	 * @return int
	 */
	protected function isExpired()
	{
		return $this->expiresIn > time();
	}
	
	/**
	 * @param string $resourceUrl
	 * @param array|NULL $params
	 * @return string
	 */
	protected function getRequestUrl($resourceUrl, $params = NULL)
	{
		$resourceUrlParts = parse_url($resourceUrl);
		$baseUrl = sprintf(self::URL_API, $this->countryCode);
		$apiUrl = $baseUrl . $this->division.'/'.$resourceUrlParts['path'];
		
		if (isset($resourceUrlParts['query'])) {
			$apiUrl .= '?' . $resourceUrlParts['query'];
		} else
		if ($params && is_array($params)) {
			$apiUrl .= '?' . http_build_query($params, '', '&');
		}
		
		return $apiUrl;
	}
	
	/**
	 * @param string $url
	 * @param string $method
	 * @param array|NULL $payload
	 * @return string
	 */
	public function sendRequest($url, $method, $payload = NULL, $refference = NULL,$skiptoken = '')
	{
		if ($payload && !is_array($payload)) {
			throw new \ErrorException('Payload is not valid.');
		}
		
		if (!$accessToken = $this->initAccessToken()) {
			throw new \ErrorException('Access token was not initialized');
		}
		
	if($url=='purchaseentry/PurchaseEntryLines'){ //purchaseentry/PurchaseEntries
		if($skiptoken!=''){
			$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		    '$filter'=>  'CostCenter eq \''.$refference.'\'',	//18-501	    
		   '$select'=>'EntryID, AmountDC',
		   '$skiptoken'=>$skiptoken
		));
		}else{
		$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		    '$filter'=>  'CostCenter eq \''.$refference.'\'',	//18-501
		     //'$top'=>1,	    
		   '$select'=>'EntryID, AmountDC',
		));
	}
		//echo $requestUrl;exit;
	}elseif($url=='purchaseentry/PurchaseEntries'){
		$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		    '$filter'=>  'EntryID eq guid\''.$refference.'\'',	//18-501
		     //'$top'=>1,	    
		   '$select'=>'Document,Supplier,SupplierName,EntryDate,AmountDC',
		));	
		//echo $requestUrl;exit;	
	}elseif($url=='bulk/Documents/DocumentAttachments'){
		$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		    '$filter'=>  "Document eq guid'".$refference."'",	   
		   '$select'=>'FileName,Document,ID,Url',
		   'Download'=>1,
		));
		//echo $requestUrl;exit;
	}elseif($url=='turnover'){
		$url='salesentry/SalesEntries';
		if($skiptoken!=''){			
			$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		   '$select'=>'AmountDC,EntryID,Created',
		   '$skiptoken'=>$skiptoken
		));		
		}else{
		$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		   '$select'=>'AmountDC,EntryID,Created'		   
		));
	}
	}elseif($url=='salesentry/SalesEntryLines'){//salesinvoice/SalesInvoices
		$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		    '$filter'=>  'CostCenter eq \''.$refference.'\'',	//18-501
		   '$select'=>'AmountDC,EntryID'
		));
	}elseif($url=='bulk/Documents/Documents'){
		$requestUrl = $this->getRequestUrl($url, array(
		    'access_token' => $accessToken,		   
		   //'$filter'=>  "ID eq guid'32927356-c66e-4596-af15-4d7f8bcbe0df'",	      
		   '$select'=>'ID,Subject, Type,DocumentViewUrl',
		   'Download'=>1,
		));
	}

		//print_r($requestUrl);exit;
		// Base cURL option
		$curlOpt = array();
		$curlOpt[CURLOPT_URL] = $requestUrl;
		$curlOpt[CURLOPT_RETURNTRANSFER] = TRUE;
		$curlOpt[CURLOPT_SSL_VERIFYPEER] = TRUE;
		$curlOpt[CURLOPT_HEADER] = false;
			
		if ($method == self::METHOD_POST) {
			
			$curlOpt[CURLOPT_HTTPHEADER] = array(
			    'Content-Type:application/json', 
			    'Accept: application/json',
			    'Key: authorization',
			    'Value: Bearer '.$accessToken,
			    'access_token:Bearer ' . $accessToken, 
			    'Content-length: ' . strlen(json_encode($payload))
			);
			$curlOpt[CURLOPT_POSTFIELDS] = json_encode($payload);
			$curlOpt[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
		}
		
		$curlHandle = curl_init();
		curl_setopt_array($curlHandle, $curlOpt);
		
		$result= curl_exec($curlHandle);
		$info = curl_getinfo($curlHandle);

		if(curl_error($curlHandle))
			{
			    echo 'error:' . curl_error($curlHandle);
			}else{
				/*$xml = simplexml_load_string($result);
				$json = json_encode($xml);
				$array = json_decode($json);*/
				return $result;
			}
	}

	public function get_next($requestUrl){
		if (!$accessToken = $this->initAccessToken()) {
			throw new \ErrorException('Access token was not initialized');
		}
		echo $accessToken;
		//echo $requestUrl;exit;
		// Base cURL option
		$curlOpt = array();
		$curlOpt[CURLOPT_URL] = $requestUrl;
		$curlOpt[CURLOPT_RETURNTRANSFER] = TRUE;
		$curlOpt[CURLOPT_SSL_VERIFYPEER] = TRUE;
		$curlOpt[CURLOPT_HEADER] = false;
			
		
		$curlHandle = curl_init();
		curl_setopt_array($curlHandle, $curlOpt);
		
		$result= curl_exec($curlHandle);
		$info = curl_getinfo($curlHandle);

		if(curl_error($curlHandle))
			{
			    echo 'error:' . curl_error($curlHandle);
			}else{
				/*$xml = simplexml_load_string($result);
				$json = json_encode($xml);
				$array = json_decode($json);*/
				return $result;
			}
	}

}
