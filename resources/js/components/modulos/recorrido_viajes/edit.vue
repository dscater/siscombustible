<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Administrar Recorrido de Viajes > Editar</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <Formulario
                    :accion="accion"
                    :recorrido_viaje="oRecorridoViaje"
                ></Formulario>
            </div>
        </section>
    </div>
</template>
<script>
import Formulario from "./Formulario.vue";
export default {
    props: ["id"],
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
            accion: "edit",
            oRecorridoViaje: {
                id: 0,
                unidad_solicitante_id: "",
                descripcion_recorrido: "",
                fecha_inicio: "",
                fecha_fin: "",
                inicio_combustible: "",
                fin_combustible: "",
                restante_combustible: "",
                inicio_kilometraje: "",
                fin_kilometraje: "",
                observacion: "",
            },
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getRecorridoViaje();
    },
    methods: {
        getRecorridoViaje() {
            axios
                .get(main_url + "/admin/recorrido_viajes/" + this.id)
                .then((response) => {
                    this.oRecorridoViaje = response.data.recorrido_viaje;
                });
        },
    },
};
</script>

<style></style>
