<?php
 class DB{

	protected $error;
	protected $db_name = 'dating';
	protected $db_user = 'root';
	protected $db_pass = 'password';
	protected $db_host = 'localhost';
	protected $myconn;
	
	// Open a connect to the database.
	// Make sure this is called on every page that needs to use the database.
	
	public function connect() {
		
		$con = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
		
		if(!$con){
			die('Could Not Connect To Database!!');
		}else{
			$this->myconn = $con;
			return $this->myconn;
		}
		
	}
	public function close(){
		global $db;	
		global $myconn;
		mysqli_close($myconn);
		return $this->_error("close");
	}
	
	public function _error($errors){
			global $db;
			global $error;
		$error = array("no_user"=>"Enter a username!!",
						"no_email"=>"Enter a email!!",
						"close"=>"Connect to database closed!!");
		if ($errors == "no_user"){
			return  $error['no_user'];
		}elseif ($errors == "no_email"){
			return  $error['no_email'];
		}elseif ($errors == "close"){
			return  $error['close'];
		}
	}
 
	public function error($error) {
		die($error);
	}
	
	public function query($query) {
		$result = mysqli_query($this->myconn, $query) or $this->error($query . ' / ' . mysqli_error($this->myconn));
		return $result;
	}
	
	public function fetch($result) {
		return mysqli_fetch_assoc($result);
	}
	
	public function fetch_array($result) {
		return mysqli_fetch_array($result, MYSQLI_ASSOC);
	}
	
	public function fetch_row($result) {
		return mysqli_fetch_row($result);
	}
	
	public function fetch_object($result) {
		return mysqli_fetch_object($result);
	}
	
	public function num_rows($result) {
		return mysqli_num_rows($result);
	}
	
	public function affected_rows() {
		return mysqli_affected_rows($this->myconn);
	}
	
	public function free_results($result) {
		return mysqli_free_result($result);
	}
	
	
 }




?>