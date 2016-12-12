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

$prods = Productos::TraerProductos();
echo "Bienvenido: ".$_SESSION["user"]["nombre"]."<br>";
echo '<a href="nexoadministrador.php?CERRAR">CERRAR SESION</a>';
if ($_SESSION["user"]["tipo"] == "admin")
{	
	echo Productos::AltaProductoForm();
	echo Productos::CargarTablaAdmin($prods);
}
elseif($_SESSION["user"]["tipo"]=="user")
{
	echo Productos::CargarTablaUser($prods);
}
?>