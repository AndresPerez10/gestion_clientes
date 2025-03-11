export class ContratosService {
    static async getContratos() {    
        return new Promise((resolve, reject) => {
            $.ajax({
                method: "GET",
                url: '/api/contratos/obtenerContratosPorCliente',            
                success: function(response) {
                    resolve(response);  // Resolvemos la promesa con la respuesta exitosa
                },
                error: function(error) {
                    reject([]);  // Rechazamos la promesa con un array vacío en caso de error
                }
            });
        });
    }
}