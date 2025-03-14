export class ContratosService {
    
    static async getContratos(dni) {  
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: `/api/contratos/obtener/${dni}`,  // Utilizamos el dni en la URL
                success: function(response) {

                    console.log(response);
                    

                    resolve(response);  // Resolvemos la promesa con la respuesta exitosa
                },
                error: function(error) {

                    console.log('error: ',error);

                    reject([]);  // Rechazamos la promesa con un array vacío en caso de error
                }
            });
        });
    }
    static async deleteContrato(data) {
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "DELETE",
                url: "/api/contratos/eliminar",            
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") // Laravel CSRF Token
                },
                data: JSON.stringify(data), // Convertir objeto JS a JSON
                contentType: "application/json", // Asegurar que se envía JSON
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