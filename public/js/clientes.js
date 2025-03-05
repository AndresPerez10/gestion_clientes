import { obtenerClientes } from './clientesService.js';
import { formatearFecha } from './formatearFecha.js';
import { insertarClientes } from './clientesService.js';

$(document).ready(function() {
    $("#boton-obtener-clientes").on('click', function() {
        const tableBody = $('#clientes-table'); // Declarar antes de usar
        tableBody.html("<tr><td colspan='2'>Cargando...</td></tr>");

        obtenerClientes()
        .then(clientes => {
            // Limpiar la tabla antes de agregar nuevos datos
            tableBody.html('');

            // Llenar la tabla con los datos de los clientes
            $.each(clientes.mensaje, function (index, cliente) {
                let fechaFormateada = formatearFecha(cliente.fechaNacimiento);
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
                    </tr> 
                `);
            });

            $('#data-table').css('display', 'block');
        })
        .catch(error => {
            console.error("Error al obtener los clientes:", error);
        });
    });

    $("#ver-clientes-dropdown").on('click', function() {
        const tableBody = $('#clientes-table'); // Declarar antes de usar
        tableBody.html("<tr><td colspan='2'>Cargando...</td></tr>");

        obtenerClientes()
        .then(clientes => {
            // Limpiar la tabla antes de agregar nuevos datos
            tableBody.html('');

            // Llenar la tabla con los datos de los clientes
            $.each(clientes.mensaje, function (index, cliente) {
                let fechaFormateada = formatearFecha(cliente.fechaNacimiento);
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
                    </tr> 
                `);
            });

            $('#data-table').css('display', 'block');
        })
        .catch(error => {
            console.error("Error al obtener los clientes:", error);
        });
    });
});

