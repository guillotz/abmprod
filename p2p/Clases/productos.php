<?php
require_once 'AccesoDatos.php';

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
	public static function AgregarProducto($descripcion,$precio,$foto,$cantidad)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"INSERT INTO productos (descripcion,precio,foto,cantidad) VALUES (:descrip,:precio,:foto,:cantidad)"
		);
		$consulta->bindValue(':descrip',$descripcion,PDO::PARAM_STR);
		$consulta->bindValue(':precio',$precio,PDO::PARAM_INT);
		$consulta->bindValue(':foto',$foto,PDO::PARAM_STR);
		$consulta->bindValue(':cantidad',$cantidad,PDO::PARAM_INT);
		return $consulta->execute();
	}
	public static function ModificarProducto($idProd,$desripcion,$precio,$foto,$cantidad)
	{
		$acceso = AccesoDatos::dameUnObjetoAcceso();
		$consulta = $acceso->RetornarConsulta
		(
			"UPDATE productos SET descripcion = :descrip , precio = :precio, foto =:foto, cantidad =:cantidad
			WHERE id = :id"
		);
		$consulta->bindValue(':descrip',$descripcion,PDO::PARAM_STR);
		$consulta->bindValue(':precio',$precio,PDO::PARAM_INT);
		$consulta->bindValue(':foto',$foto,PDO::PARAM_STR);
		$consulta->bindValue(':cantidad',$cantidad,PDO::PARAM_INT);
		$consulta->bindValue(':id',$idProd,PDO::PARAM_INT);
		return $consulta->execute();
	}
	public static function CargarTablaAdmin($productos)
	{
		$titulos = '<script src="ajax.js"></script>
			<table>
                <thead>
                    <tr>
                        <th>  Descripcion </th>
                        <th>  Precio   </th>              
                        <th>  Cantidad     </th>
                        <th>  Foto   </th>
                        <th>  Accion   </th>
                    </tr> 
                </thead><tbody>';
        $cuerpo="";
        $fin="</tbody></table>";
        foreach ($productos as $p) 
        {
        	$cuerpo.=
		        	'<tr>
		        		<td>'.$p["descripcion"].'</td>
		        		<td>'.$p["precio"].'</td>
		        		<td>'.$p["cantidad"].'</td>
		        		<td><img style= width:75px;height:75px; src="'.$p["foto"].'"></td>
		        		<td>
		        		<button id="btn_modjs" onclick="Modificar('.$p["cantidad"].','.$p["precio"].','.$p["id"].')">Modificar</button>
		        		<button id="btn_elijs" onclick="Eliminar('.$p["id"].')">Eliminar</button></td>
		        	</tr>';
        }
        return $titulos.$cuerpo.$fin;
	}
	public static function CargarTablaUser($productos)
	{
		$titulos = "<table>
                <thead>
                    <tr>
                        <th>  Descripcion </th>
                        <th>  Precio   </th>              
                        <th>  Cantidad     </th>
                        <th>  Foto   </th>
                    </tr> 
                </thead><tbody>";
        $cuerpo="";
        $fin="</tbody></table>";
        foreach ($productos as $p) 
        {
        	$cuerpo.=
		        	'<tr>
		        		<td>'.$p["descripcion"].'</td>
		        		<td>'.$p["precio"].'</td>
		        		<td>'.$p["cantidad"].'</td>
		        		<td><img style= width:75px;height:75px; src="'.$p["foto"].'"></td>		   
		        	</tr>';
        }
        return $titulos.$cuerpo.$fin;
	}
	public static function AltaProductoForm()
	{
		$formulario = 	'
						<script src="ajax.js"></script>
						<div>
							<form action="nexoadministrador.php" method="post">
								<input type="text" id="descripcionjs" name="descripcion" placeholder="DESCRIPCION"><br>
								<input type="text" id="cantidadjs" name="cantidad" placeholder="CANTIDAD"><br>
								<input type="text" id="preciojs" name="precio" placeholder="PRECIO"><br>
								<input type="submit" id="altajs" name="alta" onclick="Alta()">ALTA
							</form>
						</div>
						';
		return $formulario;				
	}	
}
?>