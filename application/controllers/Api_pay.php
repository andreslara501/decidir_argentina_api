<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('URL_DECIDIR', 'https://developers.decidir.com/api/v2/');
define('API_KEY_PUBLIC', 'e9cdb99fff374b5f91da4480c8dca741');
define('API_KEY_PRIVATE', '92b71cf711ca41f78362a7134f87ff65');



class Api_pay extends CI_Controller {
	/* DATA POST NECESARY 
		card_type 							(31 for debit card)
		card_holder_name 					(Titular name)
		card_number 						(Debit card number)
		card_expiration_month 				(Expiration month)
		card_expiration_year 				(Expiration year)
		security_code 						(Code security)
		card_holder_identification_type 	(ID type)
		card_holder_identification_number	(ID number 'cédula')
	*/

	/* Constants */
	private $id_client			= '';
	private $save_data 			= false;
	private $customer_token_id 	= '';
	private $last_four			= 0;

	/* Use when the user pay for first time */
	public function first_pay(){
		$this -> load -> model('customer_token');
		$post = $this -> input -> post();

		/* Save data id_client */
		$this -> id_client = $post["card_holder_id"];

		/* Get token */
		$token = $this -> get_token($post);

		/* With token pay */
		$result_pay = $this -> pay($token);

		if($result_pay["status"] == 'approved'){
			if($post["save_data"] == "true"){
				$this -> customer_token_id = $result_pay["customer_token"];
				$this -> last_four = substr($post["card_number"], -4);

				$this -> save_customer_token();
			}
		}

		echo json_encode($result_pay, true);
	}

	/* 
		Use when the system saved token-info in BD, previously generated
		Use it to not ask for user data again, they are already saved in Decidir platform
	*/

	public function tokenized_pay(){
		$post = $this -> input -> post();

		/* Get token */
		$token = $this -> tokenized_get_token($post);

		/* With token pay */
		$result_pay = $this -> pay($token);

		echo $result_pay["status"];
	}

	/* ---------------------------------------------------------- */

	private function get_token($post){
		//header('Content-type: application/json');

		$headers = [
			'Content-Type: application/json',
			'apikey: ' . API_KEY_PUBLIC,
			'Cache-Control: no-cache'
		];

		$data = array(
			'card_number' 					=> $post["card_number"],
			'card_expiration_month' 		=> $post["card_expiration_month"],
			'card_expiration_year' 			=> $post["card_expiration_year"],
			'security_code' 				=> $post["security_code"],
			'card_holder_name'				=> $post["card_holder_name"],
			'card_holder_identification' 	=> 
				array(
					'type' 		=> $post["card_holder_identification_type"],
					'number' 	=> $post["card_holder_identification_number"]
				)
		);

		/* Convert to json array response*/
		$payload = json_encode($data);

		/* Start CURL */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URL_DECIDIR . "tokens");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}

	private function pay($token){
		$headers = [
			'Content-Type: application/json',
			'apikey: ' . API_KEY_PRIVATE,
			'Cache-Control: no-cache'
		];

		$data = array(
			'customer' 	=> 
				array(
					'id' 		=> $this -> id_client
				),
			'site_transaction_id' 			=> strval(time()),
			'token'					 		=> $token["id"],
			'payment_method_id' 			=> 31,
			'bin'			 				=> $token["bin"],
			'amount'						=> 20000,
			'currency'						=> 'ARS',
			'installments' 					=> 1,
			'description' 					=> 'Pago de servicio',
			'payment_type' 					=> 'single',
			'establishment_name' 			=> 'BigBluePeople',
			'sub_payments' 					=> []
		);


		/* Convert to json array response*/
		$payload = json_encode($data);

		/* Start CURL */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URL_DECIDIR . "payments");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}

	private function save_customer_token(){	
		$data["id_client"] 		= $this -> id_client;
		$data["customer_token"] = $this -> customer_token_id;
		$data["last_four"] 		= $this -> last_four;

		$this -> customer_token -> new_customer_token($data);
	}

	public function tokenized_get_token($post){
		$this -> id_client = $post["id_client"];

		/* Get info customer_token */

		$this -> load -> model('customer_token');
		$array_customer_token = $this -> customer_token -> get_customer_token_full($this -> id_client);

		$headers = [
			'Content-Type: application/json',
			'apikey: ' . API_KEY_PUBLIC,
			'Cache-Control: no-cache'
		];

		$data = array(
			'token'				=> $array_customer_token["customer_token"],
			'security_code'		=> $post["security_code"],
		);

		/* Convert to json array response*/
		$payload = json_encode($data);

		/* Start CURL */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URL_DECIDIR . "tokens");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}




	/* ------------- Cancel -------------- */
	public function cancel(){
		$post = $this -> input -> post();

		$headers = [
			'Content-Type: application/json',
			'apikey: ' . API_KEY_PRIVATE,
			'Cache-Control: no-cache'
		];

		$data = array(
			'id_transaction' => $post["id_transaction"],
		);

		/* Convert to json array response*/
		$payload = json_encode($data);

		/* Start CURL */
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URL_DECIDIR . "payments/" . $post["id_transaction"] . "/refunds");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

		$response = curl_exec($ch);
		curl_close($ch);

		echo $response;
	}
}