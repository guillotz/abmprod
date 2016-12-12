<?php
if (session_status() !== PHP_SESSION_ACTIVE)
{
	session_start();
}
require_once 'AccesoDatos.php';

class Usuario
{
	public $nombre;
	public $mail;
	public $password;
/*
	function __construct($nomb,$email,$password)
	{
		$this->nombre = $nomb;
		$this->mail = $email;
		$this->password = $password;		
	}*/
	public static function Login ($nombreOmail,$pass)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		("SELECT * FROM usuarios WHERE (nombre = :nombre OR mail = :mail) AND password =:pass");
		$consulta->bindValue(':nombre',$nombreOmail,PDO::PARAM_STR);
		$consulta->bindValue(':pass',$pass,PDO::PARAM_STR);
		$consulta->bindValue(':mail',$nombreOmail,PDO::PARAM_STR);
		$consulta->execute();
		$user = $consulta->fetch (PDO::FETCH_ASSOC);
		return $user;
	}
	public static function LoginPorCookie()
	{
		if (isset($_COOKIE["usuario"],$_COOKIE["senha"])) // Si no hay sesion abierta, busco en COOKIES
		{
			$user = usuario::Login($_COOKIE["usuario"],$_COOKIE["senha"]);// Asigno un usuario por sus cookies
			if ($user !== false)//Vuelvo a chequear que exista el usuario
			{
				$_SESSION["user"]=$user;
				return $user;
			}		
		}
		return false;
	} 
}
?>