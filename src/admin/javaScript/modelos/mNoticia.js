class MNoticia {
    constructor() {
        this.URL_API = 'index.php?c=GestionarNoticias&m=';
    }

    async cargarDatosModificar(idNoticia) {
        let resultado = await fetch(`${this.URL_API}modificarJSON&idNoticia=${idNoticia}`);
        return resultado.json();
    }

    async obtenerFechasOcupadas() {
        let resultado = await fetch(`${this.URL_API}fechasOcupadasJSON`);
        let datos = await resultado.json();
        return datos.fechas.map(f => f.fechaProgramada);
    }

    async obtenerFechasOcupadasModificar(idNoticia) {
        let resultado = await fetch(`${this.URL_API}fechasOcupadasModificarJSON&idNoticia=${idNoticia}`);
        let datos = await resultado.json();
        if (datos.error) throw new Error(datos.error);
        return datos.fechas.map(f => f.fechaProgramada);
    }

    async eliminarNoticia(idNoticia) {
        let resultado = await fetch(`${this.URL_API}eliminar&idNoticia=${idNoticia}`, {
            method: 'GET'
        });
        return resultado.json();
    }
}
