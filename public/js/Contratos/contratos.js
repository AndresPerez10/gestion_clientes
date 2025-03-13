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
                    </tr> 
                `);
            });
        }
    }   catch (error) {
        alert("Hubo un error al cargar los datos de los contratos.");
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