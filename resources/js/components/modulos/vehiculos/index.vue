<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Administrar Vehículos</h1>
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
                                                    'vehiculos.create'
                                                )
                                            "
                                            class="btn btn-success btn-flat btn-block"
                                            @click="
                                                abreModal('nuevo');
                                                limpiaVehiculo();
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
                                                <template #cell(foto)="row">
                                                    <b-avatar
                                                        :src="
                                                            row.item.path_image
                                                        "
                                                        size="3rem"
                                                    ></b-avatar>
                                                </template>
                                                <template #cell(mas)="row">
                                                    <b-button
                                                        variant="success"
                                                        size="sm"
                                                        @click="
                                                            row.toggleDetails
                                                        "
                                                    >
                                                        {{
                                                            row.detailsShowing
                                                                ? "Ocultar"
                                                                : "Mostrar"
                                                        }}
                                                        Detalles
                                                    </b-button>
                                                </template>

                                                <template #row-details="row">
                                                    <b-card>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Procedencia:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .procedencia
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Servicio:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .servicio
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Tracción:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .traccion
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Carrocería:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .carroceria
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Tipo:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item.tipo
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Subtipo:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item.subtipo
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Cilindrada:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .cilindrada
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Nro.
                                                                    Puertas:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .nro_puertas
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Capacidad
                                                                    Carga:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .capacidad_carga
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Capacidad
                                                                    Plaza:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .capacidad_plaza
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Capacidad
                                                                    Arrastre:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .capacidad_arrastre
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-row class="mb-2">
                                                            <b-col
                                                                sm="3"
                                                                class="text-sm-right"
                                                                ><b
                                                                    >Observaciones:</b
                                                                ></b-col
                                                            >
                                                            <b-col>{{
                                                                row.item
                                                                    .observacion
                                                            }}</b-col>
                                                        </b-row>
                                                        <b-button
                                                            size="sm"
                                                            variant="success"
                                                            @click="
                                                                row.toggleDetails
                                                            "
                                                            >Ocultar</b-button
                                                        >
                                                    </b-card>
                                                </template>

                                                <template #cell(accion)="row">
                                                    <div
                                                        class="row justify-content-between"
                                                    >
                                                        <b-button
                                                            v-if="
                                                                permisos.includes(
                                                                    'vehiculos.edit'
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
                                                            size="sm"
                                                            pill
                                                            variant="outline-info"
                                                            class="btn-flat btn-block"
                                                            title="Cambiar contraseña"
                                                            @click="
                                                                cambiarPassword(
                                                                    row.item
                                                                )
                                                            "
                                                        >
                                                            <i
                                                                class="fa fa-key"
                                                            ></i>
                                                        </b-button>
                                                        <b-button
                                                            v-if="
                                                                permisos.includes(
                                                                    'vehiculos.destroy'
                                                                )
                                                            "
                                                            size="sm"
                                                            pill
                                                            variant="outline-danger"
                                                            class="btn-flat btn-block"
                                                            title="Eliminar registro"
                                                            @click="
                                                                eliminaVehiculo(
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
            :vehiculo="oVehiculo"
            @close="muestra_modal = false"
            @envioModal="getVehiculos"
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
                { key: "foto", label: "Foto" },
                {
                    key: "placa",
                    label: "Placa",
                    sortable: true,
                },
                { key: "marca", label: "Marca", sortable: true },
                { key: "clase", label: "Clase", sortable: true },
                { key: "modelo", label: "Modelo", sortable: true },
                {
                    key: "fecha_registro_t",
                    label: "Fecha de registro",
                    sortable: true,
                },
                { key: "mas", label: "Ver mas" },
                { key: "accion", label: "Acción" },
            ],
            loading: true,
            fullscreenLoading: true,
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            muestra_modal: false,
            modal_accion: "nuevo",
            oVehiculo: {
                id: 0,
                placa: "",
                marca: "",
                clase: "",
                modelo: "",
                procedencia: "",
                servicio: "",
                traccion: "",
                turbo: "",
                carroceria: "",
                tipo: "",
                subtipo: "",
                cilindrada: "",
                nro_puertas: "",
                capacidad_carga: "",
                capacidad_plaza: "",
                capacidad_arrastre: "",
                foto: "",
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
        this.getVehiculos();
    },
    methods: {
        // Seleccionar Opciones de Tabla
        editarRegistro(item) {
            this.oVehiculo.id = item.id;
            this.oVehiculo.placa = item.placa ? item.placa : "";
            this.oVehiculo.marca = item.marca ? item.marca : "";
            this.oVehiculo.clase = item.clase ? item.clase : "";
            this.oVehiculo.modelo = item.modelo ? item.modelo : "";
            this.oVehiculo.procedencia = item.procedencia
                ? item.procedencia
                : "";
            this.oVehiculo.servicio = item.servicio ? item.servicio : "";
            this.oVehiculo.traccion = item.traccion ? item.traccion : "";
            this.oVehiculo.turbo = item.turbo ? item.turbo : "";
            this.oVehiculo.carroceria = item.carroceria ? item.carroceria : "";
            this.oVehiculo.tipo = item.tipo ? item.tipo : "";
            this.oVehiculo.subtipo = item.subtipo ? item.subtipo : "";
            this.oVehiculo.cilindrada = item.cilindrada ? item.cilindrada : "";
            this.oVehiculo.nro_puertas = item.nro_puertas
                ? item.nro_puertas
                : "";
            this.oVehiculo.capacidad_carga = item.capacidad_carga
                ? item.capacidad_carga
                : "";
            this.oVehiculo.capacidad_plaza = item.capacidad_plaza
                ? item.capacidad_plaza
                : "";
            this.oVehiculo.capacidad_arrastre = item.capacidad_arrastre
                ? item.capacidad_arrastre
                : "";
            this.oVehiculo.foto = item.foto ? item.foto : "";
            this.oVehiculo.observacion = item.observacion
                ? item.observacion
                : "";
            this.modal_accion = "edit";
            this.muestra_modal = true;
        },

        // Listar Vehiculos
        getVehiculos() {
            this.showOverlay = true;
            this.muestra_modal = false;
            let url = main_url + "/admin/vehiculos";
            if (this.pagina != 0) {
                url += "?page=" + this.pagina;
            }
            axios
                .get(url, {
                    params: { per_page: this.per_page },
                })
                .then((res) => {
                    this.showOverlay = false;
                    this.listRegistros = res.data.vehiculos;
                    this.totalRows = res.data.total;
                });
        },
        cambiarPassword(item) {
            Swal.fire({
                title: "Modificar contraseña",
                html: "Vehiculo: " + item.full_name,
                input: "text",
                inputAttributes: {
                    minlength: 4,
                },
                showCancelButton: true,
                confirmButtonColor: "#17a2b8",
                confirmButtonText: "Actualizar",
                cancelButtonText: "Cancelar",
                preConfirm: (texto) => {
                    if (texto.length >= 4) {
                        return axios
                            .post(
                                "/admin/vehiculos/updatePassword/" + item.id,
                                {
                                    password: texto,
                                }
                            )
                            .then((response) => {
                                Swal.fire({
                                    icon: "success",
                                    title: response.data.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });
                            })
                            .catch((error) => {
                                Swal.fire({
                                    icon: "error",
                                    title: "Ocurrío un error al enviar la contraseña",
                                    confirmButtonColor: "#e0a800",
                                    confirmButtonText: `<span class="text-black">Aceptar</span>`,
                                });
                            });
                    } else {
                        Swal.showValidationMessage(
                            "El texto debe contener al menos 6 caracteres"
                        );
                    }
                },
            });
        },
        eliminaVehiculo(id, descripcion) {
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
                        .post(main_url + "/admin/vehiculos/" + id, {
                            _method: "DELETE",
                        })
                        .then((res) => {
                            this.getVehiculos();
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
        abreModal(tipo_accion = "nuevo", vehiculo = null) {
            this.muestra_modal = true;
            this.modal_accion = tipo_accion;
            if (vehiculo) {
                this.oVehiculo = vehiculo;
            }
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        limpiaVehiculo() {
            this.oVehiculo.placa = "";
            this.oVehiculo.marca = "";
            this.oVehiculo.clase = "";
            this.oVehiculo.modelo = "";
            this.oVehiculo.procedencia = "";
            this.oVehiculo.servicio = "";
            this.oVehiculo.traccion = "";
            this.oVehiculo.turbo = "";
            this.oVehiculo.carroceria = "";
            this.oVehiculo.tipo = "";
            this.oVehiculo.subtipo = "";
            this.oVehiculo.cilindrada = "";
            this.oVehiculo.nro_puertas = "";
            this.oVehiculo.capacidad_carga = "";
            this.oVehiculo.capacidad_plaza = "";
            this.oVehiculo.capacidad_arrastre = "";
            this.oVehiculo.foto = "";
            this.oVehiculo.observacion = "";
        },
        formatoFecha(date) {
            return this.$moment(String(date)).format("DD/MM/YYYY");
        },
    },
};
</script>

<style></style>
