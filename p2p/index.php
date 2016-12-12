<html>
<head>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<title>Practica</title>
</head>
	<body>
		<?php
		session_start();
		require_once 'Clases/usuario.php';	
		if (!isset ($_SESSION["user"]) && Usuario::LoginPorCookie() === false)
		{
			include 'login.php';		
		}
		else
		{
			include 'menu.php';
		}
		?>
	</body>
</html>