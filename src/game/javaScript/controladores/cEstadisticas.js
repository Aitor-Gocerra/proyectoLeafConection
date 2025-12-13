class CEstadisticas {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    async obtenerEstadisticas() {
        return await this.modelo.obtenerEstadisticas(); // Pedir datos al modelo
    }
}
