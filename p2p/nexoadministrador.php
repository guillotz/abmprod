<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
	session_start();
}
require_once 'Clases/AccesoDatos.php';
require_once 'Clases/usuario.php';
require_once 'Clases/productos.php';
	if (! isset($_SESSION["user"])) //Chequeo si hay sesion abierta
	{		
		if (isset ($_POST["nombre"],$_POST["password"])) //recibo del botón login
		{
			$user = usuario::Login($_POST["nombre"],$_POST["password"]); //USER = Retorno de consulta de base
			if ($user === false)
			{
				echo "No registrado";
			}
			else
			{
				if (isset($_POST["check"])) //Si esta el usuario y quiere recordar, genero la cookie x 1 día.
				{
					setcookie("usuario",$_POST["nombre"], time() + (86400), "/");
					setcookie("senha",$_POST["password"], time() + (86400), "/"); 
				}
				$_SESSION["user"] = $user;
				echo "Registrado";
			}
		}
	}
	else
	{
		if (isset($_GET["CERRAR"]))
		{
			session_start();
			unset($_SESSION["user"]);
			session_unset();
			session_destroy();
			setcookie("usuario","XXX", -1);
			setcookie("senha","XXX", -1);
			header ("location:index.php");
		}
	}
	if (isset($_POST["descripcion"],$_POST["precio"],$_POST["cantidad"]))
	{
		if(Productos::AgregarProducto($_POST["descripcion"],$_POST["precio"],"",$_POST["cantidad"]))
		{
			echo "ok";
		}
		else
		{
			echo "no alta";
		}
	}
	if(isset($_POST["baja"]))
	{
		if(Productos::EliminarProducto($_POST["baja"]))
		{
			echo "ok";
		}
		else
		{
			echo "no ok";
		}
	}
	if(isset($_POST["cant"],$_POST["pre"],$_POST["id"]))
	{
		echo "ok";
	}
?>