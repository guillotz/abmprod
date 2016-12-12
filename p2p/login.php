		<script src="ajax.js"></script>
		<form onsubmit="return false" action="nexoadministrador.php" method="post">
			<input type="text" id="nombrejs" name="nombre">Nombre
			<input type ="password" id="passwordjs" name="password">Password
			<input type ="submit" id="loginjs" name="login" onclick="Login()">Login
			<input type ="checkbox" id="checkjs" name ="check" value="checked">Recordarme  
		</form>

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