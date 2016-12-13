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
	public static function MostrarUsuario($nombre,$tipo)
	{
		echo '<center><h3>Bienvenido: '.$nombre.'<br />Tipo User: '.$tipo.'</h3><a href="nexoadministrador.php?CERRAR">CERRAR SESION</a></center>';
	}
	public static function TraerUsuarios()
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		("SELECT * FROM usuarios");
		$consulta->execute();
		$usuarios = $consulta->fetchAll();
		return $usuarios;
	}
	public static function EliminarUser($idUser)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		("DELETE FROM usuarios WHERE id = :id");
		$consulta->bindValue(':id',$idUser,PDO::PARAM_INT);
		return $consulta->execute();
	}
	public static function CargarTablaUsuarios($usuarios)
	{
		$titulos = '<script src="ajax.js"></script>
					<link rel="stylesheet" type="text/css" href="css/grillastyle.css" />
					<h1><center>Usuarios</center></h1>
					<div class="datagrid">
						<table>
		                <thead>
		                    <tr>
		                        <th>  Nombre </th>
		                        <th>  Mail   </th>              
		                        <th>  Tipo     </th>
		                        <!--<th>  Foto   </th>-->
		                        <th>  Accion   </th>
		                    </tr> 
		                </thead><tbody>';
		$cuerpo = "";
		foreach ($usuarios as $u)
		{
			$cuerpo.='<tr>
		        		<td>'.$u["nombre"].'</td>
		        		<td>'.$u["mail"].'</td>
		        		<td>'.$u["tipo"].'</td>
		        		<td>
		        		<button id="btn_elijs"class="submit-button" onclick="EliminarUser('.$u["id"].')">Eliminar</button></td>
		        	</tr>';
		}
		$fin = '</tbody></table></div>';
		return $titulos.$cuerpo.$fin;
	} 
}
?>