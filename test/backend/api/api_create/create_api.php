<?php
// Include our db-connect //
include "/config/_db_connect.php";

// call for a new DB(); //
$db = new DB();

// Set the Global $api_id //
global $api_id;

// Create the api_id //
$api_id = $db->createapi_id();

// Hash the API //
$hash_api = $db->_hashapi();

// Create the secret_token //
$secret_api = $db->secret_token(24);

$username = ""; /// This will be the login username //

$name = ""; // This will be the name of the api the user creates //

// This creates the API //
$create = $db->createapi($username, $name, $api_id, $secret_api, "http://127.0.0.1/");
if($create == true){
return $api_array = array("API_ID"=>$api_id);
}

?>