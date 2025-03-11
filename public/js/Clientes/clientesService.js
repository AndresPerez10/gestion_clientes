export class ClientesService {
    static async getClientes() {    
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: '/api/clientes/obtener',            
                success: function(response) {
                    resolve(response);  // Resolvemos la promesa con la respuesta exitosa
                },
                error: function(error) {
                    reject([]);  // Rechazamos la promesa con un array vacío en caso de error
                }
            });
        });
    }

    static async addCliente(data) {          
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "POST",
                url: "/api/clientes/crear",
                contentType: "application/json", // Asegurar que se envía JSON
                data: JSON.stringify(data), // Convertir objeto JS a JSON
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // Laravel CSRF Token
                },
                success: function(response) {                    
                    resolve(response);  
                },
                error: function(xhr, status, error) {
                    reject(xhr.responseJSON || { message: "Error desconocido" });  
                }
            });
        });
    }

static async deleteCliente(data) {          
    return new Promise((resolve, reject) => {
        $.ajax({
            method: "DELETE",
            url: "/api/clientes/eliminar/"+data,            
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // Laravel CSRF Token
            },
            success: function(response) {                    
                resolve(response);  
            },
            error: function(xhr, status, error) {
                reject(xhr.responseJSON || { message: "Error desconocido" });  
            }
        });
    });
  }
}


