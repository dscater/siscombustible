<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Administrar Solicitud de Combustible > Nuevo</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <Formulario
                    :accion="accion"
                    :solicitud_combustible="oSolicitudCombustible"
                ></Formulario>
            </div>
        </section>
    </div>
</template>
<script>
import Formulario from "./Formulario.vue";
export default {
    components: {
        Formulario,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            permisos: localStorage.getItem("permisos"),
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            accion: "nuevo",
            oSolicitudCombustible: {
                id: 0,
                unidad_solicitante_id: "",
                user_id: "",
                vehiculo_id: "",
                combustible: "",
                nro_vale: "",
                fecha_entrega: this.getFechaActual(),
                observacion: "",
            },
        };
    },
    mounted() {
        this.loadingWindow.close();
    },
    methods: {},
};
</script>

<style></style>
