<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Administrar Unidad Solicitante</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-3">
                                        <button
                                            v-if="
                                                permisos.includes(
                                                    'unidad_solicitantes.create'
                                                )
                                            "
                                            class="btn btn-success btn-flat btn-block"
                                            @click="
                                                abreModal('nuevo');
                                                limpiaUnidadSolicitante();
                                            "
                                        >
                                            <i class="fa fa-plus"></i>
                                            Nuevo
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <b-col lg="10" class="my-1">
                                        <b-form-group
                                            label="Buscar"
                                            label-for="filter-input"
                                            label-cols-sm="3"
                                            label-align-sm="right"
                                            label-size="sm"
                                            class="mb-0"
                                        >
                                            <b-input-group size="sm">
                                                <b-form-input
                                                    id="filter-input"
                                                    v-model="filter"
                                                    type="search"
                                                    placeholder="Buscar"
                                                ></b-form-input>

                                                <b-input-group-append>
                                                    <b-button
                                                        variant="success"
                                                        :disabled="!filter"
                                                        @click="filter = ''"
                                                        >Borrar</b-button
                                                    >
                                                </b-input-group-append>
                                            </b-input-group>
                                        </b-form-group>
                                    </b-col>
                                    <div class="col-md-12">
                                        <b-overlay
                                            :show="showOverlay"
                                            rounded="sm"
                                        >
                                            <b-table
                                                :fields="fields"
                                                :items="listRegistros"
                                                show-empty
                                                stacked="md"
                                                responsive
                                                :current-page="currentPage"
                                                :per-page="perPage"
                                                @filtered="onFiltered"
                                                empty-text="Sin resultados"
                                                empty-filtered-text="Sin resultados"
                                                :filter="filter"
                                            >
                                                <template #cell(accion)="row">
                                                    <div
                                                        class="row justify-content-between"
                                                    >
                                                        <b-button
                                                            v-if="
                                                                permisos.includes(
                                                                    'unidad_solicitantes.edit'
                                                                )
                                                            "
                                                            size="sm"
                                                            pill
                                                            variant="outline-warning"
                                                            class="btn-flat btn-block"
                                                            title="Editar registro"
                                                            @click="
                                                                editarRegistro(
                                                                    row.item
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-edit"
                                                            ></i>
                                                        </b-button>
                                                        <b-button
                                                            v-if="
                                                                permisos.includes(
                                                                    'unidad_solicitantes.destroy'
                                                                )
                                                            "
                                                            size="sm"
                                                            pill
                                                            variant="outline-danger"
                                                            class="btn-flat btn-block"
                                                            title="Eliminar registro"
                                                            @click="
                                                                eliminaUnidadSolicitante(
                                                                    row.item.id,
                                                                    row.item
                                                                        .full_name
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-trash"
                                                            ></i>
                                                        </b-button>
                                                    </div>
                                                </template>
                                            </b-table>
                                        </b-overlay>
                                        <div class="row">
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="ml-auto my-1"
                                            >
                                                <b-form-select
                                                    align="right"
                                                    id="per-page-select"
                                                    v-model="perPage"
                                                    :options="pageOptions"
                                                    size="sm"
                                                ></b-form-select>
                                            </b-col>
                                            <b-col
                                                sm="6"
                                                md="2"
                                                class="my-1 mr-auto"
                                                v-if="perPage"
                                            >
                                                <b-pagination
                                                    v-model="currentPage"
                                                    :total-rows="totalRows"
                                                    :per-page="perPage"
                                                    align="left"
                                                ></b-pagination>
                                            </b-col>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Nuevo
            :muestra_modal="muestra_modal"
            :accion="modal_accion"
            :unidad_solicitante="oUnidadSolicitante"
            @close="muestra_modal = false"
            @envioModal="getUnidadSolicitantes"
        ></Nuevo>
    </div>
</template>

<script>
import Nuevo from "./Nuevo.vue";
export default {
    components: {
        Nuevo,
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            permisos: localStorage.getItem("permisos"),
            search: "",
            listRegistros: [],
            showOverlay: false,
            fields: [
                {
                    key: "codigo",
                    label: "Código",
                    sortable: true,
                },
                { key: "unidad.nombre", label: "Unidad", sortable: true },
                {
                    key: "descripcion_viaje",
                    label: "Descripción del viaje",
                    sortable: true,
                },
                {
                    key: "fecha_solicitud_t",
                    label: "Fecha de solicitud",
                    sortable: true,
                },
                {
                    key: "nro_hoja_ruta",
                    label: "Nro. Hoja Ruta",
                    sortable: true,
                },
                { key: "conductor_txt", label: "Conductor", sortable: true },
                { key: "vehiculo_txt", label: "Vehículo", sortable: true },
                {
                    key: "combustible_txt",
                    label: "Combustible",
                    sortable: true,
                },
                { key: "observacion", label: "Observación", sortable: true },
                {
                    key: "fecha_registro_t",
                    label: "Fecha de registro",
                    sortable: true,
                },
                { key: "accion", label: "Acción" },
            ],
            loading: true,
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            muestra_modal: false,
            modal_accion: "nuevo",
            oUnidadSolicitante: {
                id: 0,
                nro: "",
                codigo: "",
                unidad_id: "",
                descripcion_viaje: "",
                fecha_solicitud: "",
                nro_hoja_ruta: "",
                conductor: "0",
                vehiculo: "0",
                combustible: "0",
                observacion: "",
            },
            currentPage: 1,
            perPage: 5,
            pageOptions: [
                { value: 5, text: "Mostrar 5 Registros" },
                { value: 10, text: "Mostrar 10 Registros" },
                { value: 25, text: "Mostrar 25 Registros" },
                { value: 50, text: "Mostrar 50 Registros" },
                { value: 100, text: "Mostrar 100 Registros" },
                { value: this.totalRows, text: "Mostrar Todo" },
            ],
            totalRows: 10,
            filter: null,
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getUnidadSolicitantes();
    },
    methods: {
        // Seleccionar Opciones de Tabla
        editarRegistro(item) {
            this.oUnidadSolicitante.id = item.id;
            this.oUnidadSolicitante.nro = item.nro ? item.nro : "";
            this.oUnidadSolicitante.codigo = item.codigo ? item.codigo : "";
            this.oUnidadSolicitante.unidad_id = item.unidad_id
                ? item.unidad_id
                : "";
            this.oUnidadSolicitante.descripcion_viaje = item.descripcion_viaje
                ? item.descripcion_viaje
                : "";
            this.oUnidadSolicitante.fecha_solicitud = item.fecha_solicitud
                ? item.fecha_solicitud
                : "";
            this.oUnidadSolicitante.nro_hoja_ruta = item.nro_hoja_ruta
                ? item.nro_hoja_ruta
                : "";
            this.oUnidadSolicitante.conductor = item.conductor
                ? item.conductor
                : "";
            this.oUnidadSolicitante.vehiculo = item.vehiculo
                ? item.vehiculo
                : "";
            this.oUnidadSolicitante.combustible = item.combustible
                ? item.combustible
                : "";
            this.oUnidadSolicitante.observacion = item.observacion
                ? item.observacion
                : "";

            this.modal_accion = "edit";
            this.muestra_modal = true;
        },

        // Listar UnidadSolicitantes
        getUnidadSolicitantes() {
            this.showOverlay = true;
            this.muestra_modal = false;
            let url = main_url + "/admin/unidad_solicitantes";
            if (this.pagina != 0) {
                url += "?page=" + this.pagina;
            }
            axios
                .get(url, {
                    params: { per_page: this.per_page },
                })
                .then((res) => {
                    this.showOverlay = false;
                    this.listRegistros = res.data.unidad_solicitantes;
                    this.totalRows = res.data.total;
                });
        },
        eliminaUnidadSolicitante(id, descripcion) {
            Swal.fire({
                title: "¿Quierés eliminar este registro?",
                html: `<strong>${descripcion}</strong>`,
                showCancelButton: true,
                confirmButtonColor: "#da1900",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "No, cancelar",
                denyButtonText: `No, cancelar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios
                        .post(main_url + "/admin/unidad_solicitantes/" + id, {
                            _method: "DELETE",
                        })
                        .then((res) => {
                            this.getUnidadSolicitantes();
                            this.filter = "";
                            Swal.fire({
                                icon: "success",
                                title: res.data.msj,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        })
                        .catch((error) => {
                            if (error.response) {
                                if (error.response.status === 422) {
                                    this.errors = error.response.data.errors;
                                }
                                if (
                                    error.response.status === 420 ||
                                    error.response.status === 419 ||
                                    error.response.status === 401
                                ) {
                                    window.location = "/";
                                }
                                if (error.response.status === 500) {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        html: error.response.data.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                }
                            }
                        });
                }
            });
        },
        abreModal(tipo_accion = "nuevo", unidad_solicitante = null) {
            this.muestra_modal = true;
            this.modal_accion = tipo_accion;
            if (unidad_solicitante) {
                this.oUnidadSolicitante = unidad_solicitante;
            }
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        limpiaUnidadSolicitante() {
            this.oUnidadSolicitante.nro = "";
            this.oUnidadSolicitante.codigo = "";
            this.oUnidadSolicitante.unidad_id = "";
            this.oUnidadSolicitante.descripcion_viaje = "";
            this.oUnidadSolicitante.fecha_solicitud = this.getFechaActual();
            this.oUnidadSolicitante.nro_hoja_ruta = "";
            this.oUnidadSolicitante.conductor = "0";
            this.oUnidadSolicitante.vehiculo = "0";
            this.oUnidadSolicitante.combustible = "0";
            this.oUnidadSolicitante.observacion = "";
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
    },
};
</script>

<style></style>
