function cerrarSesion(mensaje,tipo,ruta){
    Swal.fire({
        title: mensaje,
        type: tipo,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Aceptar!'
    }).then((result) => {
        if (result.value) {
            window.location.href = ruta;
        }
    })
}