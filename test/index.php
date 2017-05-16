<?php
require ("/backend/include/includes.php");

?>
<html>
	<head>
		<title>Dating</title>
		<style type="text/css">
			#login_header {
			background: lightgrey;
			height: 50px;
			display: inline-block;
			color: red;
			width: 100%;
			}
			#links {
			background: transparent;
			width: 50%;
			height: 56%;
			margin: 0px auto;
			color: white;
			margin-top: 11px;
			margin-bottom: 11px;
			}
			.ul-link {
			display: inline-block;
			list-style-type: none;
			margin-left: 0px;
			margin: 0px;
			background: lightgrey;
			padding: 0px;
			}
			.li-link {
			display: inline-block;
			padding: 5px;
			}
			.li-link:hover{
			background:lightskyblue;
			}
		</style>
	</head>
	<body>
	<?php
		if(isset($user_id)){
	
		}else{
		 include ("frontend/Templent/header.php");
		}
	?>





	</body>
</html>