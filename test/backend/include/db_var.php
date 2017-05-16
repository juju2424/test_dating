<?php
session_start();
// display all the var here
require ("backend/_global/global.php");

$user_error = $db->_error("no_user");
$email_error = $db->_error("no_email");

?>