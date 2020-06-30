<?php
class Customer_token extends CI_Model {
	public $title;
	public $content;
	public $date;

	public function get_customer_token($id_client){
		$query = $this 	-> db
						-> 	select("id_client, last_four")
						-> 	where("id_client = '" . $id_client . "'") 
						->	get('customer_token');
		return $query -> row_array();
	}

	public function get_customer_token_full($id_client){
		$query = $this -> db
						-> 	where("id_client = '" . $id_client . "'") 
						->	get('customer_token');
		return $query -> row_array();
	}

	public function new_customer_token($data){
		$this -> db -> insert('customer_token', $data);
	}

	public function update_entry(){
		$this->title    = $_POST['title'];
		$this->content  = $_POST['content'];
		$this->date     = time();

		$this->db->update('entries', $this, array('id' => $_POST['id']));
	}

}
?>