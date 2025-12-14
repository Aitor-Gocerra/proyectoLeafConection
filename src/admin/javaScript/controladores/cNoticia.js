class CNoticia {
    constructor(modelo, vista) {
        this.modelo = modelo;
        this.vista = vista;
    }

    async cargarNoticia(idNoticia) {
        try {
            let datos = await this.modelo.cargarDatosModificar(idNoticia);
            if (datos.noticia) {
                this.vista.cargarDatosNoticia(datos.noticia, datos.preguntas, datos.opciones_implode, datos.resultadouestas);
            } else {
                alert(datos.mensaje ?? 'No se pudo cargar la noticia!');
            }
        } catch (e) {
            console.error(e);
            alert('Error al cargar la noticia!');
        }
    }

    async obtenerFechasOcupadas() {
        return await this.modelo.obtenerFechasOcupadas();
    }

    async obtenerFechasOcupadasModificar(idNoticia) {
        return await this.modelo.obtenerFechasOcupadasModificar(idNoticia);
    }

    async eliminarNoticia(idNoticia) {
        try {
            let resultado = await this.modelo.eliminarNoticia(idNoticia);
            if (resultado.success) {
                alert('Noticia eliminada correctamente');
                this.vista.eliminarFila(idNoticia);
            } else {
                alert('Error: ' + resultado.error);
            }
        } catch (e) {
            console.error(e);
            alert('Error al eliminar noticia!');
        }
    }

}
