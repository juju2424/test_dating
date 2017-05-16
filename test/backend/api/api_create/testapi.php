<?php
include "/config/_db_connect.php";

$db = new DB();
global $api_id;
$api_id = $db->createapi_id();
$hash_api = $db->_hashapi();
echo $db->returnapi($api_id, $hash_api);

?>