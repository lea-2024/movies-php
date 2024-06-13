$(document).ready( function () {
    $('#myTable').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrado de _MAX_ entradas en total)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    // obtener los datos desde administracon.php para mostrar el modal de creacion o actualizacion correctos
    let active = document.getElementById('message').getAttribute('data-active');
    let message = document.getElementById('message').getAttribute('data-message');

    if(active === 'true'){
        Swal.fire({
            title: message,
            confirmButtonColor: "#9f3647",
            showClass: {
                popup: `
          animate__animated
          animate__fadeInUp
          animate__faster
        `
            },
            hideClass: {
                popup: `
          animate__animated
          animate__fadeOutDown
          animate__faster
        `
            }
        });
    }
});
//Mostrar modal de confirmación para eliminar registros
const confirmDelete = (id)=>{
    let form = document.querySelector(`#formDelete${id}`);
    Swal.fire({
        title: "Estás seguro?",
        text: "No podrás revertir está acción!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#9f3647",
        cancelButtonColor: "#545252",
        confirmButtonText: "Si, Eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
};

// Detectar cambios en el input file para mostrar una vista previa de la imágen
document.querySelector('#image').addEventListener('change',(event)=>{
    let containerImage = document.querySelector('#imagePreview');
    let archivo = event.target.files[0];

    let reader = new FileReader();
    reader.onload=(event)=>{
        containerImage.innerHTML='';
        let image = document.createElement('img');
        image.src = event.target.result;
        image.alt = 'Vista previa imágen';
        image.classList.add('image-preview');
        containerImage.appendChild(image);
    }
    reader.readAsDataURL(archivo);
});





