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
}