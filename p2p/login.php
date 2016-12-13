		<html>
			<head>
				<script src="ajax.js"></script>
				<link rel="stylesheet" type="text/css" href="css/style.css" />
			</head>
				<body background="Fotos/bg-img.jpg">		
					<center>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<form class ="form-container" onsubmit="return false" action="nexoadministrador.php" method="post">
							Nombre o E-mail<br /><input type ="text" id="nombrejs" name="nombre"><br />
							Password<br /><input type ="password" id="passwordjs" name="password"><br /><br />
							<input type ="submit" class="submit-button" id="loginjs" name="login" onclick="Login()" value="Login">
							<input type ="checkbox" id="checkjs" name ="check" value="checked">Recordarme<br /><br /> 
							<input type ="submit" class="submit-button" id="testAdmin" name="login" onclick="TestAdmin()" value="TestAdmin">
							<input type ="submit" class="submit-button" id="testUser" name="login" onclick="TestUser()" value="TestUser">
						</form>
					</center>
				</body>
		</html>

<!--
<script src="ajax.js"></script>
<form class="form-container" action="nexoadministrador.php" method="post">
<div class="form-title"><h2>Login</h2></div>
<div class="form-title">Nombre o Mail</div>
<input class="form-field" type="text" name="firstname" id="nombrejs"/><br />
<div class="form-title">Password</div>
<input class="form-field" type="password" name="email" id="passwordjs" /><br />
<div class="submit-container">
<input type ="checkbox" id="checkjs" name ="check" value="checked">Recordarme 
<input class="submit-button" type="submit" value="Login" onclick="Login()"/>
</div>
</form>
</html>-->