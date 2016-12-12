<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
	session_start();
}
if (! isset($_SESSION["user"]))
{
	header("location:index.php");
	exit;
}
require_once 'Clases/productos.php';
require_once 'Clases/usuario.php';
require_once 'Clases/AccesoDatos.php';
echo '<html>
<script src="ajax.js"></script>
<head>Modificacion</head>
						<div>
							<form action="nexoadministrador.php" method="post">
								<input type="text" id="descripcionjs" name="descripcion" placeholder="DESCRIPCION"><br>
								<input type="text" id="cantidadjs" name="cantidad" placeholder="CANTIDAD"><br>
								<input type="text" id="preciojs" name="precio" placeholder="PRECIO"><br>
								<input type="submit" id="altajs" name="alta" onclick="Alta()">ALTA
							</form>
						</div>
						</html>'
?>