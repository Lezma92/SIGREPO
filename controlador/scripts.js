function activarAlumno(matricula, id_datos, id_alumno, id_espera) {
	var datos = new FormData();
	datos.append("activarAlumno", "activar");
	datos.append("id_datos", id_datos);
	datos.append("id_alumno", id_alumno);
	datos.append("id_espera", id_espera);
	datos.append("matricula", matricula);
	/*datos.append("id_user", id_user);
	 call activarAlumno(2,2,2,"1630717");
	 datos.append("id_datos",id_datos);*/
	Swal.fire({
		title: "¿Está seguro(a) que desea activar al usuario " + matricula + "?",
		text: "Una vez activando al usuario tendra acceso al sistema",
		type: "info",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../modelo/accionUsuarios.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					console.log(respuesta);
					if (respuesta.length > 0) {
						Swal.fire({
							text: "Usuario activado correctamente",
							type: 'success',
							confirmButtonColor: '#d33',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.value) {
								window.location.href = "../admin/espera.php";
							}
						})
					} else {
						Swal.fire({
							type: 'error',
							title: "No fue posible realizar su petición",
							text: "Para más información comunicate con tu administrador"
						})
					}
				}

			})
		}
	})



}

function addRepo() {

	window.location.href = window.location.href = "../admin/userwait.php";

}


$("#opciones").on("change", "select.categoria", function () {
	var categoria = $(this).val();

	var tipo = window.location.search;
	pagina = "";
	console.log(categoria);
	console.log(tipo);
	grupos = document.getElementById("id_grupos").value;

	if (tipo == "?t=integradora") {
		pagina = "integradora.php";
	} else if (tipo == "?t=estadias") {
		pagina = "estadias.php";
	} else if (tipo == "?t=especiales") {
		pagina = "especiales.php";
	}
	console.log("grupos = " + grupos);

	gru_n = grupos.split("-");
	console.log(gru_n);

	// window.location.href = URLactual+"?cat=" + categoria + "&pag=1";

	if (categoria == "ING") {
		for (let index = 1; index < gru_n.length; index++) {
			//integradora.php?cat=ING&pag=1&c=2
			document.getElementById("href_carrera" + gru_n[index]).href = pagina + "?cat=ING&pag=1&carrera=" + gru_n[index];
		}
	}
	if (categoria == "TSU") {

		for (let index = 1; index < gru_n.length; index++) {
			//integradora.php?cat=ING&pag=1&c=2
			document.getElementById("href_carrera" + gru_n[index]).href = pagina+"?cat=TSU&pag=1&carrera=" + gru_n[index];
		}
	}


});


function capturarDatos() {
	var pass = document.getElementById("pass").value;

	$("#pass").val(respuesta[""]);
	console.log(pass);

}

$(".isSearch").on("click", ".btn_eliminar", function () {
	var datos = new FormData();
	var id_archivo = $(this).attr("id_archivo");
	console.log(id_archivo);
	datos.append("id_archivo", id_archivo);
	Swal.fire({
		title: "¿Estás seguro(a) que deseas elminar el archivo?",
		text: "El archivo se eliminará permanentemente de su repositorio",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../modelo/eliminar.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {

					console.log(respuesta);
					if (respuesta.length > 0) {
						Swal.fire({
							text: "El archivo se eliminó correctamente",
							type: 'success',
							confirmButtonColor: '#d33',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.value) {
								window.location.href = "../admin/verArchivos.php";
							}
						})
					} else {
						Swal.fire({
							type: 'error',
							title: "No fue posible realizar su petición",
							text: "Para más información comunicate con tu administrador"
						})
					}
				}

			})
		}
	})


})

$(".isSearch").on("click", ".modificarUser", function () {

	var idDato = $(this).attr("idDato");
	var idUser = $(this).attr("idUser");
	var datos = new FormData();
	datos.append("idDato", idDato);
	datos.append("idUser", idUser);

	console.log(idDato);
	console.log(idUser);


	$.ajax({

		url: "../modelo/update.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			console.log(respuesta);
			$("#idDato").val(idDato);
			$("#idUser").val(idUser);
			$("#txtMatriculaU").val(respuesta["matricula"]);
			$("#txtNombreU").val(respuesta["nombre"]);
			$("#txtAppU").val(respuesta["apellidos"]);
			$("#username_up").val(respuesta["matricula"]);
			$("#tipoU").html(respuesta["nivel_user"]);
			$("#tipoU").val(respuesta["nivel_user"]);
			$("#paswrdU").val(respuesta["pswrd"]);

		}

	})
})

$(".isSearch").on("click", ".eliminarUser", function () {
	var idDato = $(this).attr("idDato");
	var idUser = $(this).attr("idUser");
	var datos = new FormData();
	datos.append("idDato", idDato);
	datos.append("idUser", idUser);

	console.log(idDato);
	console.log(idUser);


	Swal.fire({
		title: "¿Estas seguro(a) que deseas elminar el usuario?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../modelo/eliminar.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					console.log(respuesta);
					if (respuesta == "Ok") {
						Swal.fire({
							text: "Usuario eiminado correctamente",
							type: 'success',
							confirmButtonColor: '#0D80E4',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.value) {
								window.location.href = "../admin/usuarios.php";
							}
						})
					}
				}
			})

		}
	})

	//mensaje = "Maaskadjhadhjadaj "+cantidad;


})
$(".isSearch").on("click", ".modificarUser", function () {

	var idDato = $(this).attr("idDato");
	var idUser = $(this).attr("idUser");
	var datos = new FormData();
	datos.append("idDato", idDato);
	datos.append("idUser", idUser);

	console.log(idDato);
	console.log(idUser);


	$.ajax({

		url: "../modelo/update.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			console.log(respuesta);
			$("#idDato").val(idDato);
			$("#idUser").val(idUser);
			$("#txtMatriculaU").val(respuesta["matricula"]);
			$("#txtNombreU").val(respuesta["nombre"]);
			$("#txtAppU").val(respuesta["apellidos"]);
			$("#username_up").val(respuesta["matricula"]);
			$("#tipoU").html(respuesta["nivel_user"]);
			$("#tipoU").val(respuesta["nivel_user"]);
			$("#paswrdU").val(respuesta["pswrd"]);

		}

	})
})
$(".Tabla_alumnos").on("click", ".modificarAlumno", function () {
	var matricula = $(this).attr("matricula");
	var datos = new FormData();
	datos.append("id_matricuala", matricula);
	console.log(matricula);
	$.ajax({
		url: "../modelo/update.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			console.log(respuesta["idDatos"]);
			console.log(respuesta["idUsuario"]);
			console.log(respuesta["idAlumno"]);
			console.log(respuesta["idDatos"]);
			console.log(respuesta["idDatos"]);
			console.log(respuesta["idDatos"]);
			$("#idDato").val(respuesta["idDatos"]);
			$("#idUser").val(respuesta["idUsuario"]);
			$("#idAlumno").val(respuesta["idAlumno"]);
			$("#text-matricula").val(respuesta["matricula"]);
			$("#text-nombre").val(respuesta["nombre"]);
			$("#text-apellidos").val(respuesta["apellidos"]);
			$("#grupo").val(respuesta["grupo"]);
			$("#text-pswrd").val(respuesta["pswrd"]);
			if (respuesta["nivel_estudio"] == "ING") {
				$("#grado").html("Ingeniería");
			} else {
				$("#grado").html("Técnico");
			}
			$("#tipoU").val(respuesta["nivel_estudio"]);



		}

	})
})

$(".Tabla_alumnos").on("click", ".eliminarUser", function () {
	var idDato = $(this).attr("idDato");
	var idUser = $(this).attr("idUser");
	var datos = new FormData();
	datos.append("idDato", idDato);
	datos.append("idUser", idUser);

	console.log(idDato);
	console.log(idUser);


	Swal.fire({
		title: "¿Estas seguro(a) que deseas elminar el usuario?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../modelo/eliminar.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					console.log(respuesta);
					if (respuesta == "Ok") {

					}
				}
			})

		}
	})

	//mensaje = "Maaskadjhadhjadaj "+cantidad;


})

$(".Tabla_alumnos").on("click", ".eliminarAlumno", function () {
	var idDato = $(this).attr("idDato");
	var idUser = $(this).attr("idUser");
	var idAlumno = $(this).attr("idAlumno");
	var datos = new FormData();

	datos.append("id_datos_alumno", idDato);
	datos.append("id_user_alumno", idUser);
	datos.append("id_alumno", idAlumno);

	console.log(idDato);
	console.log(idUser);
	console.log(idAlumno);
	Swal.fire({
		title: "¿Está seguro(a) que deseas elminar el alumno seleccionado?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../modelo/eliminar.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					console.log(respuesta);
					if (respuesta == "Ok") {
						Swal.fire({
							text: "Usuario eiminado correctamente",
							type: 'success',
							confirmButtonColor: '#0D80E4',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.value) {
								window.location.href = "../admin/alumnos.php";
							}
						})
					}
				}
			})

		}
	})

	//mensaje = "Maaskadjhadhjadaj "+cantidad;


})
function eliminarRepositorios(id_proyecto, matricula, nombreProyecto, ventana, cat, pag,carrera) {
	var datos = new FormData();
	datos.append("id_proyecto", id_proyecto);
	datos.append("matricula", matricula);
	datos.append("nombreProyecto", nombreProyecto);
	console.log(id_proyecto);
	console.log(matricula);
	console.log(nombreProyecto);
	Swal.fire({
		title: "¿Estas seguro(a) que deseas elminar el repositorio seleccionado?",
		text: "Todos los archivos que existen dentro del mismo serán eliminados",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: '¡Aceptar!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: "../modelo/eliminar.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {
					console.log(respuesta);
					if (respuesta.length > 0) {
						Swal.fire({
							text: "El archivo se eliminó correctamente",
							type: 'success',
							confirmButtonColor: '#d33',
							confirmButtonText: 'Ok'
						}).then((result) => {
							if (result.value) {
								if (ventana == 1) { window.location.href = "../admin/integradora.php?cat=" + cat + "&pag=" + pag+"&carrera="+carrera; }
								if (ventana == 2) { window.location.href = "../admin/estadias.php?cat=" + cat + "&pag=" + pag+"&carrera="+carrera; }
								if (ventana == 3) { window.location.href = "../admin/especiales.php?cat=" + cat + "&pag=" + pag+"&carrera="+carrera; }
							}
						})
					} else {
						Swal.fire({
							type: 'error',
							title: "No fue posible realizar su petición",
							text: "Para más información comunicate con tu administrador"
						})
					}
				}

			})
		}
	});
}