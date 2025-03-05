export function formatearFecha(fechaISO) { // El parámetro debe ser una sola variable
    let fecha = new Date(fechaISO);
    return fecha.toLocaleDateString("es-ES"); // Salida: "16/04/2022"
}
