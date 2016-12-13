<?php
require_once 'AccesoDatos.php';
require_once 'usuario.php';
class Productos
{
	public $descripcion;
	public $precio;
	public $foto;
	public $cantidad;

	function __construct ($d,$p,$f,$c)
	{
		$this->descripcion = $d;
		$this->precio =$p;
		$this->foto = $f;
		$this->cantidad = $c;
	}
	public static function TraerUnProducto($idProd)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"SELECT * FROM productos WHERE id = :id"
		);
		$consulta->bindValue(':id',$idProd,PDO::PARAM_INT);
		$consulta->execute();
		$producto = $consulta->fetch (PDO::FETCH_ASSOC);
		return $producto;
	}
	public static function TraerProductos()
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"SELECT * FROM productos"
		);
		$consulta->execute();
		$productos = $consulta->fetchAll();
		return $productos;
	}
	public static function EliminarProducto($idProd)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"DELETE FROM productos WHERE id = :id"
		);
		$consulta->bindValue(':id',$idProd,PDO::PARAM_INT);
		return $consulta->execute();		
	}
	public static function AgregarProducto($descripcion,$precio,$cantidad)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"INSERT INTO productos (descripcion,precio,cantidad) VALUES (:descrip,:precio,:cantidad)"
		);
		$consulta->bindValue(':descrip',$descripcion,PDO::PARAM_STR);
		$consulta->bindValue(':precio',$precio,PDO::PARAM_INT);
		//$consulta->bindValue(':foto',$foto,PDO::PARAM_STR);
		$consulta->bindValue(':cantidad',$cantidad,PDO::PARAM_INT);
		return $consulta->execute();
		exit;
	}
	public static function ModificarProducto($idProd,$descripcion,$precio,$cantidad)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"UPDATE productos SET descripcion = :descrip , precio = :precio, cantidad =:cantidad
			WHERE id = :id"
		);
		$consulta->bindValue(':descrip',$descripcion,PDO::PARAM_STR);
		$consulta->bindValue(':precio',$precio,PDO::PARAM_INT);
		//$consulta->bindValue(':foto',$foto,PDO::PARAM_STR);
		$consulta->bindValue(':cantidad',$cantidad,PDO::PARAM_INT);
		$consulta->bindValue(':id',$idProd,PDO::PARAM_INT);
		return $consulta->execute();
	}
	public static function CargarTablaAdmin($productos)
	{
		$titulos = '<script src="ajax.js"></script>
					<link rel="stylesheet" type="text/css" href="css/grillastyle.css" />
					<h1><center>Productos</center></h1>
					<div class="datagrid">
						<table>
		                <thead>
		                    <tr>
		                        <th>  Descripcion </th>
		                        <th>  Precio   </th>              
		                        <th>  Cantidad     </th>
		                        <!--<th>  Foto   </th>-->
		                        <th>  Accion   </th>
		                    </tr> 
		                </thead><tbody>';
        $cuerpo="";
        $fin="</tbody></table></div>";
        foreach ($productos as $p) 
        {
        	$cuerpo.=
		        	'<tr>
		        		<td>'.$p["descripcion"].'</td>
		        		<td>'.$p["precio"].'</td>
		        		<td>'.$p["cantidad"].'</td>
		        		<!--<td><img style= width:75px;height:75px; src="'.$p["foto"].'"></td>-->
		        		<td>
		        		<!--<button id="btn_modjs" class="submit-button" onclick="Modificar('.$p["cantidad"].','.$p["precio"].','.$p["id"].')">Modificar</button>-->
		        		<button id="btn_modjs" class="submit-button" onclick="CargarDatosModificables(this,'.$p["id"].')">Modificar</button>
		        		<button id="btn_elijs"class="submit-button" onclick="Eliminar('.$p["id"].')">Eliminar</button></td>
		        	</tr>';
        }
        return $titulos.$cuerpo.$fin;
	}
	public static function CargarTablaUser($productos)
	{
		$titulos = '<script src="ajax.js"></script>
					<link rel="stylesheet" type="text/css" href="css/grillastyle.css" />
					<h1><center>Productos</center></h1>
					<body background="Fotos/bg-img.jpg">
					<div class="datagrid">
						<table>
		                <thead>
		                    <tr>
		                        <th>  Descripcion </th>
		                        <th>  Precio   </th>              
		                        <th>  Cantidad     </th>
		                        <!--<th>  Foto   </th>-->
		                        <!--<th>  Accion   </th>-->
		                    </tr> 
		                </thead><tbody>';
        $cuerpo="";
        $fin="</tbody></table></div></body>";
        foreach ($productos as $p) 
        {
        	$cuerpo.=
		        	'<tr>
		        		<td>'.$p["descripcion"].'</td>
		        		<td>'.$p["precio"].'</td>
		        		<td>'.$p["cantidad"].'</td>
		        	</tr>';
        }
        return $titulos.$cuerpo.$fin;
	}
	public static function AltaProductoForm()
	{
		$formulario = 	'
		<html>
			<head>
				<script src="ajax.js"></script>
				<link rel="stylesheet" type="text/css" href="css/style.css" />
			</head>
				<body background="Fotos/bg-img.jpg">		
					<center>
						<div>
							<form class="form-container" onsubmit="return false">
								<input type="hidden" id="idjs" name="id" value="0">
								Descripcion<br>
								<input type="text" id="descripcionjs" name="descripcion" placeholder="DESCRIPCION"><br>
								Cantidad<br>
								<input type="text" id="cantidadjs" name="cantidad" placeholder="CANTIDAD"><br>
								Precio<br>
								<input type="text" id="preciojs" name="precio" placeholder="PRECIO"><br>							
								<input type="submit" class="submit-button" id="altajs" name="alta" value="Alta" onclick="Alta()">
							</form>
						</div>
					</center>
				</body>
		</html>				
						';
		return $formulario;				
	}
	public static function FormatoMenuAdmin($productos,$users)
	{
		$formato ='
				<form onsubmit="return false">
					<table>
	                    <tbody>
			                    <tr>
			     	                <td width="70%">
			        	                 <div id="divFrm" style="height:550px;overflow:auto;border-style:solid;">
			                                '.Productos::CargarTablaAdmin($productos).'
			                            </div>
		                       		</td>
		                         	<td rowspan="2" style="vertical-align:top">
			                                <div id="divGrilla" style="height:550px;overflow:auto;border-style:solid;">
			                                    '.Usuario::CargarTablaUsuarios($users).'
			                                </div>
			                     	</td>
			                    </tr>
	                    </tbody>
	                </table>
	            </form>';
         return $formato;
	}	
}
?>