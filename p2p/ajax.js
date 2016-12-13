function TestAdmin()
{
	$('#nombrejs').val("Admin");
	$('#passwordjs').val("administrador");
};
function TestUser()
{
	$('#nombrejs').val("User");
	$('#passwordjs').val("usuario");
};
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
											precio: $("#preciojs").val(),
											id: $("#idjs").val()
										}
							});
	respAlta.done(function (Respuesta)
	{
		if (Respuesta !== "no" )
		{
			//alert("Accion ok");
			$("#divFrm").html(Respuesta);
			$('#descripcionjs').val("");
			$('#preciojs').val("");
			$('#cantidadjs').val("");
			$('#altajs').val('Alta');
			$('#idjs').val("0");
			//window.location.href="index.php";
			//location.reload(true);
		}
		else
		{
			if(Respuesta === "modiOK")
			{
				alert("Modificacion OK");
				window.location.href="index.php";
			}
			else
			{
				alert("Error");
			}		
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
		if(RespuestaEli !== "no")
		{
			//alert("Baja ok");
			$("#divFrm").html(RespuestaEli);
			//window.location.href="index.php";
		}
		else
		{
			alert("Baja no ok");
		}
	});
}
function EliminarUser(id)
{
	var respEli = $.ajax({
								type: "POST",
								url: "nexoadministrador.php",
								data: 	{
											bajaUser: id
										}
							});
	respEli.done(function (RespuestaEli)
	{
		if(RespuestaEli === "bajaOk")
		{
			alert("Baja usuario ok");
			window.location.href="index.php";
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

function CargarDatosModificables (controlHtml,id) {
	var trTable = $(controlHtml).parent().parent();
	var tdDescripcion = $($(trTable).find('td')[0]).text();
	var tdPrecio = $($(trTable).find('td')[1]).text();
	var tdCantidad = $($(trTable).find('td')[2]).text();

	$('#descripcionjs').val(tdDescripcion);
	$('#preciojs').val(tdPrecio);
	$('#cantidadjs').val(tdCantidad);
	$('#altajs').val('Modificar');
	$('#idjs').val(id);
	//alert(id);
	//alert(tdDescripcion);
/*
	$.each($(trTable).find('td'), function(indice, elemento) {

		if (indice == 0) {
			$('#descripcionjs').val($(elemento).text());
		}

		if (indice == 1) {
			$('#preciojs').val($(elemento).text());
		}	

		if (indice == 2) {
			$('#cantidadjs').val($(elemento).text());
		}			
	});
*/
	// body...
}