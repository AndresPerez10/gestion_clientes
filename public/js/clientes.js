import { ClientesService } from './clientesService.js';
import { formatearFecha } from './formatearFecha.js';

$(document).ready(function() {
    if(window.location.pathname == '/clientes/mostrar') obtenerClientes();
    
    $("#ver-clientes-dropdown").on('click', function() {
        obtenerClientes(); // Llama a la función para obtener los clientes
    });
    
    $("#formulario").on("submit", function(event) {
        insertarClientes();
    });

    $(document).on('click', '#btn-eliminar', function(event) {
         deleteCliente($(this)); 
    });

    $(document).on('click', '#btn-editar', function(event) {
        // event.preventDefault(); // Previene cualquier acción predeterminada
        var cliente = $(this).data('cliente');
        var clienteBase64 = btoa(JSON.stringify(cliente));
        console.log(clienteBase64);
        var cliente = JSON.parse(decodeURIComponent(atob(clienteBase64)));
        console.log(cliente);
        

        window.location.href = "/clientes/actualizar?data="+clienteBase64;  // Redirige a la URL obtenida
    });
    
});

async function insertarClientes() {    
    // Obtener los datos del formulario
     let clienteData = {
        dni: $("#dni").val().trim(),
        nombre: $("#nombre").val().trim(),
        apellido1: $("#apellido1").val().trim(),
        apellido2: $("#apellido2").val().trim(),
        direccion: $("#direccion").val().trim(),
        contrasenna: $("#contrasenna").val().trim(),
        fechaNacimiento: $("#fechaNacimiento").val(),
        email: $("#email").val().trim()
    };

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'
        
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
        
            form.classList.add('was-validated')
          }, false)
        })
    })()

    try {
        let cliente = await ClientesService.addCliente(clienteData);
        $("#formulario")[0].reset(); // Limpiar formulario tras insertar        
    } catch (error) {        
        console.log(error);        
    }
}

async function obtenerClientes() {
    const tableBody = $('#clientes-table');
    const spinner = $('#spinner');
    const tablaClientes = $('#tablaClientes');
    
    spinner.show();
    tablaClientes.hide();
    
    try {        
        let clientes = await ClientesService.getClientes(); // Obtener los datos de los clientes
        
        // Limpiar la tabla antes de agregar nuevos datos
        tableBody.html('');

        // Llenar la tabla con los datos de los clientes
        $.each(clientes.mensaje, function (index, cliente) {
            let fechaFormateada = formatearFecha(cliente.fechaNacimiento); // Asegúrate de que esta función esté definida
            tableBody.append(`
                <tr>
                    <td>${cliente.id}</td>
                    <td>${cliente.dni}</td>
                    <td>${cliente.nombre}</td>
                    <td>${cliente.apellido1}</td>
                    <td>${cliente.apellido2}</td>
                    <td>${cliente.direccion}</td>
                    <td>${cliente.email}</td>
                    <td>${fechaFormateada}</td>
                    <td>
                        <div class="editar_eliminar">
                            <button id="btn-eliminar" class="btn btn-danger" data-id="${cliente.dni}">
                                <i class="bi bi-trash"></i>
                            </button>                                        
                            <button id="btn-editar" class="btn btn-primary" 
                                data-id="${cliente.id}"
                                data-cliente='${JSON.stringify(cliente)}'>
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </div>
                    </td>
                </tr> 
            `);
        });
    } catch (error) {        
        alert("Hubo un error al cargar los datos de los clientes.");
    } finally {
        setTimeout(() => {
            spinner.hide();  // Ocultar el spinner
            tablaClientes.fadeIn();  // Mostrar la tabla con animación
        }, 2000); // Espera 2 segundos (ajusta según lo que necesites)
    } // Retraso de 1 segundo para ocultar el spinner
}

async function deleteCliente(button) {
    let dni = $(button).data("id"); // Obtener el DNI del botón presionado

    if (confirm(`¿Seguro que deseas eliminar al cliente con DNI ${dni}?`)) {
        let fila = $(button).closest("tr"); // Encuentra la fila del botón presionado
        
        try {
            // Llamar al servicio para eliminar de la base de datos
            await ClientesService.deleteCliente(dni);

            // Eliminar la fila de la tabla con animación
            fila.fadeOut(300, function() { 
                $(this).remove(); 
            });

            alert(`Cliente con DNI ${dni} eliminado correctamente.`);
        } catch (error) {          
            alert("No se pudo eliminar el cliente.");
        }
    }
}

