import { ContratosService } from './contratosService.js';
import { formatearFecha } from '../formatearFecha.js';
import { ClientesService } from '../Clientes/clientesService.js';

$(document).ready(function() {
    // Cargar los contratos cuando se muestra la página de contratos
    if(window.location.pathname == '/contratos/mostrar') mostrarContratos();
    
    cargarDNIs(); // Llama a la función para cargar los DNIs

    $('#dni-dropdown').on('change', function () {
        const selectedDNI = $(this).val(); // Obtener el DNI seleccionado
        if (selectedDNI) {
            // Llamar a la función para mostrar los contratos del DNI seleccionado
            mostrarContratos(selectedDNI);
        }
    });

    $(document).on('click', '#btn-eliminarContrato', function(event) {
        deleteContratos($(this)); 
   });
});

async function mostrarContratos(dni) {
    const tableBody = $('#contratos-table');  // Asegúrate de que coincida el id de la tabla
    const tablaContratos = $('#tablaContratos');  // Corregido el id aquí también.

    try {        
        let response = await ContratosService.getContratos(dni);

        if (response.status) { // Usar 'status' en lugar de 'success'
            let contratos = response.mensaje; // Accedemos al array de contratos

            // Limpiar la tabla antes de agregar nuevos datos
            tableBody.html('');

            // Llenar la tabla con los datos de los contratos
            $.each(contratos, function (index, contrato) {
                tableBody.append(`
                    <tr>
                        <td>${contrato.id}</td>
                        <td>${contrato.descripcion}</td>
                        <td>
                            <div class="acciones">
                                 <button id="btn-eliminarContrato" class="btn btn-danger" data-id="${contrato.id}">
                                <i class="bi bi-trash"></i>
                                </button>
                                <button id="btn-editar" class="btn btn-primary" 
                                data-id="${contrato.id}"
                                data-cliente='${JSON.stringify(contrato)}'>
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            </div>
                        </td>
                </tr>
                                `);
            });
        }
    } catch (error) {
        alert("El cliente seleccionado no tiene contratos asociados.");
    } 
}

async function deleteContratos(button) {
    let id = $(button).data("id");
    let dni = $("#dni-dropdown").val(); 

    if (confirm(`¿Seguro que deseas eliminar el contrato con id ${id}?`)) {
        let fila = $(button).closest("tr"); // Encuentra la fila del botón presionado
        
        try {
            const request = {
                'idContrato':id,
                'dni':dni,
            };

            // Llamar al servicio para eliminar de la base de datos
            let result = await ContratosService.deleteContrato(request);

            // Eliminar la fila de la tabla con animación
            fila.fadeOut(300, function() { 
                $(this).remove(); 
            });
            
            alert(`Contrato con id ${id} eliminado correctamente.`);
        } catch (error) {          
            alert("No se pudo eliminar el cliente.");
            console.error(error);
        }
    }
}

async function cargarDNIs() {
    const dropdown = $('#dni-dropdown'); // Selecciona el <select> por id

    try {
        // Llamamos a la API para obtener solo los DNIs
        let clientes = await ClientesService.dniClientes();  
        
            dropdown.html('<option selected disabled>Seleccione un DNI</option>');

            // Recorrer la lista de clientes y agregar los DNIs como opciones
            $.each(clientes.mensaje, function(index, cliente) {
                dropdown.append(`<option value="${cliente.dni}">${cliente.dni}</option>`);
            });
        } catch (error) {
        alert('Error al cargar los DNIs:', error);
    }
}