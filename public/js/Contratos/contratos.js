import { ContratosService } from './contratosService.js';
import { formatearFecha } from '../formatearFecha.js';

$(document).ready(function() {
    if(window.location.pathname == '/contratos/mostrar') mostrarContratos();
$("#ver-contratos-dropdown").on('click', function() {
    obtenerContratos(); // Llama a la función para obtener los clientes
    });
    ver-contratos-dropdown").on('click', function() {
        obtenerContratos(); // Llama a la función para obtener los clientes
        });
});


async function mostrarContratos() {
    const tableBody = $('#contratos-table');  // Asegúrate de que coincida el id de la tabla
    const tablaContratos = $('#tablaContratos');  // Corregido el id aquí también.
    
    try {        
        let response = await ContratosService.getContratos();

        if (response.status) { // Usar 'status' en lugar de 'success'
            let contratos = response.mensaje; // Accedemos al array de contratos

            // Llenar la tabla con los datos de los contratos
            $.each(contratos, function (index, contrato) {
                tableBody.append(`
                    <tr>
                        <td>${contrato.id}</td>
                        <td>${contrato.idCliente}</td>
                        <td>${contrato.descripcion}</td>
                    </tr> 
                `);
            });
        } else {
            alert(response.mensaje); // Si no hay contratos, mostramos el mensaje de error
        }
    } catch (error) {
        alert("Hubo un error al cargar los datos de los contratos.");
    } 

    async function cargarDNIs() {
        const dropdown = $('.form-select'); // Selecciona el <select>
    
        try {
            let clientes = await ClientesService.getClientes(); // Llamamos a la API

            // Limpiar el dropdown y agregar la opción por defecto
            dropdown.html('<option selected disabled>Seleccione un DNI</option>');
    
            // Recorrer la lista de clientes y agregar los DNIs como opciones
            $.each(clientes.mensaje, function (index, cliente) {
                dropdown.append(`<option value="${cliente.dni}">${cliente.dni}</option>`);
            });
    
        } catch (error) {
            alert("Hubo un error al cargar los DNIs.");
        }
    }
    
}