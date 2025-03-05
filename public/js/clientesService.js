export function obtenerClientes() {    
    return new Promise((resolve, reject) => {
        $.ajax({
            method: "GET",
            url: '/api/clientes/obtener',            
            success: function(response) {
                resolve(response);  // Resolvemos la promesa con la respuesta exitosa
            },
            error: function(error) {
                console.error("Error al obtener clientes:", error);
                reject([]);  // Rechazamos la promesa con un array vacío en caso de error
            }
        });
    });
}

export function insertarClientes() {    
    return new Promise((resolve, reject) => {
        $.ajax({
            method: "POST",
            url: '/api/clientes/crear',            
            success: function(response) {
                resolve(response);  // Resolvemos la promesa con la respuesta exitosa
            },
            error: function(error) {
                console.error("Error al obtener clientes:", error);
                reject([]);  // Rechazamos la promesa con un array vacío en caso de error
            }
        });
    });
}