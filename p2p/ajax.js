function Login()
{
	var respuesta = $.ajax({
								type: "POST",
								url: "nexoadministrador.php",
								data: 	{
											nombre: $("#nombrejs").val(),
											password: $("#passwordjs").val(),
											check: $("#checkjs").val()
										}
							});
	respuesta.done(function (RespuestaPHP)
	{
		if (RespuestaPHP === "Registrado")
		{
			location.reload(true);
		}
		else
		{
			alert("Pone bien los dedos");
		}
	});
}
function Alta()
{
	var respAlta = $.ajax({
								type:"POST",
								url: "nexoadministrador.php",
								data: 	{
											descripcion: $("#descripcionjs").val(),
											cantidad: $("#cantidadjs").val(),
											precio: $("#preciojs").val()
										}
							});
	respAlta.done(function (Respuesta)
	{
		if (Respuesta === "ok")
		{
			alert("Alta ok");
			//location.reload(true);
		}
		else
		{
			alert("no alta");
		}	
	});
}
function Eliminar(id)
{
	var respEli = $.ajax({
								type: "POST",
								url: "nexoadministrador.php",
								data: 	{
											baja: id
										}
							});
	respEli.done(function (RespuestaEli)
	{
		if(RespuestaEli === "ok")
		{
			alert("Baja ok");
		}
		else
		{
			alert("Baja no ok");
		}
	});
}
function Modificar(cantidad,precio,id)
{
	var respModi = $.ajax({
								type:"POST",
								url: "nexoadministrador.php",
								data: 	{
											cant: cantidad,
											pre: precio,
											id: id
										}
							});
	respModi.done(function (RespuestaModi)
	{
		if(RespuestaModi === "ok")
		{
			alert("Modi ok");
		}
		else
		{
			alert("Modi no ok");
		}
	});
}