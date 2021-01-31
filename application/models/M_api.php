<?php
class m_api extends CI_Model {
	private $signature_valid;
	function __construct() {
		parent::__construct ();
		$this->load->database ();
		$this->checking_signature ( $_POST ['signature'] ); // checking signature,
	} 
	
	function login() {
		$post = $this->input->post();
		$this->db->where ( "username", $post['username'] );
		$this->db->where ( "password", md5 ( $post['password'] ) );
		$query = $this->db->get ("tbl_user");
		if ($query->num_rows () > 0) {
			$data = $query->result_array ();
			$this->db->flush_cache ();
			$exe = array (
					'userid' => $data [0] ['user_id'],
					'nama' => $data [0] ['nama']
			);
			return $exe;
		}else{
			return false;
		} 
		
	}
	
	
	function sendOutput($dataArray, $status, $miss_param = array()) {
		$descriptionStatus = array ( 
				"200" => "OK",
				"400" => "Validation Error", // harusnya int dia kirim str
				"401" => "Auth Denied", // signature salah
				"402" => "Invalid Parameter", // kurang paramater post
				"403" => "User Access Token Expired",
				"501" => "Internal Server Error" 
		); 
		
		$defaultArray = array (
				'greeting' => 'Welcome',
				//'pic' => '', 
				'server_time' => date ( 'd-m-Y H:i:s' ),
				'status' => $status,
				'status_desc' => $descriptionStatus [$status],
				'results' => array () 
		);
		
		$defaultArray = array_merge ( $defaultArray, $dataArray );
		
		$json = json_encode ( $defaultArray );

		$this->save_access_log ( $json, $status, $miss_param ); // saving access log
		header ( 'Access-Control-Allow-Origin: *' );
		header ( 'Access-Control-Expose-Headers: Access-Control-Allow-Origin' );
		header ( "HTTP/1.1 200 OK" );
		header ( 'Content-Type: application/json' );
		echo $json;
		die ();
	}
	
	
	function requireValidation($param) {
		// function utk check requirement wajib
		$invalid = 0;
		$invalid_param = array ();
		foreach ( $param as $key => $value ) {
			if ($value == "" || ! ($key) || $value == " ") {
				$invalid ++;
				$invalid_param [] = $key;
			}
		}
		
		$hasil = array (
				'invalid' => $invalid,
				'invalid_index' => $invalid_param,
				'status' => ($invalid > 0) ? false : true 
		);
		if (! $hasil ['status']) {
			$this->sendOutput ( array (
					'pic' => "Yulia. F <yulia@kpptechnology.co.id>" 
			), 402, $invalid_param );
		} else {
			return $hasil;
		}
	}

	function checking_signature($key) {
		$this->db->select ( "*" );
		$this->db->from ( "api_signature TSA" );
		$this->db->where ( 'SignatureKey', $key ); 
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$this->signature_valid = $key; 
			return true;
		} else {
			$this->sendOutput ( array (
					'pic' => "" 
			), 401 );
		}
	}
	function get_client_ip() {
		return $this->input->ip_address();
	}
	function save_access_log($output, $status, $miss_param = array()) {
		$method_request = $this->uri->segment ( 3 ); // not use 
		$request_param = $this->input->post (); // will return the array ?  
		 
		$data_insert = array (
				"SignatureKey" => $this->input->post ( 'signature' ),
				"IpClient" => $this->get_client_ip (),
				"IpClientForward" => '',
				"UserAccessToken" => $this->input->post ( 'user_access_token' ),
				"MethodRequest" => $this->uri->segment ( 3 ),
				"RequestParam" => json_encode ( $request_param ),
				"ResponseApi" => $output,
				"ResponseStatus" => $status,
				"CreatedDate" => date ( 'Y-m-d H:i:s' ),
				"MissedParam" => json_encode ( $miss_param ) 
		);
		$this->db->insert ( 'api_log', $data_insert );
		return true;
	}
	
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen ( $characters );
		$randomString = '';
		for($i = 0; $i < $length; $i ++) {
			$randomString .= $characters [rand ( 0, $charactersLength - 1 )];
		}
		return $randomString;
	}
	
}

?>