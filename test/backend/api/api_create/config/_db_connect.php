<?php
 class DB{
 
	private $dbconn;
	
  
	public function __construct(){
		$config = array("db_server"=>"localhost","db_user"=>"root","db_password"=>"password","db_name"=>"_api");
			global $dbconn;
			global $db;
		$this->dbconn = mysqli_connect($config['db_server'], $config['db_user'], $config['db_password']) 
			or die ("could not connect:" . mysqli_error());
		mysqli_select_db($this->dbconn, $config['db_name']) or die ("could not find database");
	}
 
 
 public function error($error) {
		die($error);
	}
	
	public function query($query) {
		$result = mysqli_query($this->dbconn, $query) or $this->error($query . ' / ' . mysqli_error($this->dbconn));
		return $result;
	}
		public function fetch($result) {
		return mysqli_fetch_assoc($result);
	}
	
	public function num_rows($result) {
		return mysqli_num_rows($result);
	}
	
	public function affected_rows() {
		return mysqli_affected_rows($this->dbconn);
	}
	
	
	
	public function createapi($username, $name, $access_token, $secret_token, $redirect_uri){
		global $dbconn;
		global $db;
		
		$create_api = $db->query("INSERT INTO api_cofig (username, api_name, access_token, secret_token, redirect_uri) VALUES ('$username','$name','$access_token','$secret_token','$redirect_uri')");
		
		if ($create_api == true){
			$api = $db->fetch($db->query("SELECT api_id From api_cofig where access_token='".$access_token."' ") );
			$api_id = $api['api_id'];
			$api_array = array("API_ID"=>$api_id);
			print "<pre>";
			print_r ($api_array);
			print "</pre>";
			
			
		}
	
	}
	
	public function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
	
	public function createapi_id(){
		global $db;
		global $api_id;
		$api_id = $db->gen_uuid();
		return $api_id;
	}
	
	public function _options(){
		$options = [
					'cost' => 11
				];
			return $options;
		}
		
		
	public function _hashapi(){
		global $db;
		global $api_id;
		$hash_api = password_hash($db->createapi_id(), PASSWORD_BCRYPT, $db->_options());
		return $hash_api;
	}
		
	public function returnapi($api_id, $hash_api){
		global $api_id;
		global $hash_api;
		$api_real = password_verify($api_id, $hash_api);
		if($api_real == true){
			return $api_id;
		}
	}
	
	public function secret_token($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
 }




?>