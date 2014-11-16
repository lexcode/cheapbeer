<?php
class Paypal{

	private $user      = "guizmauh-facilitator_api1.gmail.com";
	private $pwd       = "PJL2V7YYH3N3NHQX";
	private $signature = "AxaiB0b0dtd0YYMJwTAXvyrkiqATAyHLvdeKPijPewNLZK7gctKEnIF2";
	private $endpoint = "https://api-3t.sandbox.paypal.com/nvp";
	public $errors    = array();

	public function __construct($user = false, $pwd = false, $signature = false, $prod = false){
		if($user){
			$this->user = $user;
		}
		if($pwd){
			$this->pwd = $pwd;
		}
		if($signature){
			$this->signature = $signature;
		}
		if($prod){
			$this->endpoint = str_replace('sandbox.','', $this->endpoint);
		}
	}

	public function request($method, $params){
		$params = array_merge($params, array(
				'METHOD' => $method,
				'VERSION' => '98.0',
				'USER'	 => $this->user,
				'SIGNATURE' => $this->signature,
				'PWD'	 => $this->pwd
		));
		$params = http_build_query($params);
                
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $this->endpoint,
			CURLOPT_POST=> 1,
			CURLOPT_POSTFIELDS => $params,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_SSL_VERIFYPEER => true,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_VERBOSE => 1
		));
		$response = curl_exec($curl);
		$responseArray = array();
		parse_str($response, $responseArray);
		if(curl_errno($curl)){
			$this->errors = curl_error($curl);
			curl_close($curl);
			return false;
		}else{
			if($responseArray['ACK'] == 'Success'){
				curl_close($curl);
				return $responseArray;
			}else{
				$this->errors = $responseArray;
				curl_close($curl);
				return false;
			}
		}
	}


}