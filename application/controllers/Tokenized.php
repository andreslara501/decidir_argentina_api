<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tokenized extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($id_client = false){

	}

	public function t($id_client = false){
		if($id_client){
			$this -> load -> model('customer_token');
			$array_customer_token = $this -> customer_token -> get_customer_token($id_client);

			if($array_customer_token){
				$data = $array_customer_token;
				$this -> load -> view('tokenized', $data);
			}else{
				echo "Error con el id";
			}
		}else{
			echo "Error, no hay id";
		}
	}
}
