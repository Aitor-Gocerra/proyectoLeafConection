class CEstadisticas {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    async obtenerEstadisticas() {
        return await this.modelo.obtenerEstadisticas(ID_USUARIO); // Pedir datos al modelo
    }
}
