<template>
    <div
        class="modal fade"
        :class="{ show: bModal }"
        id="modal-default"
        aria-modal="true"
        role="dialog"
    >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        @click="cierraModal"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.unidad_id,
                                    }"
                                    >Seleccionar Unidad Requerida*</label
                                >
                                <el-select
                                    placeholder="Seleccionar Unidad Requerida"
                                    class="w-100"
                                    :class="{ 'is-invalid': errors.unidad_id }"
                                    v-model="unidad_solicitante.unidad_id"
                                    clearable
                                    filterable
                                >
                                    <el-option
                                        v-for="item in listUnidads"
                                        :key="item.id"
                                        :value="item.id"
                                        :label="item.nombre"
                                    ></el-option>
                                </el-select>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.unidad_id"
                                    v-text="errors.unidad_id[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.descripcion_viaje,
                                    }"
                                    >Descripción del viaje*</label
                                >
                                <el-input
                                    type="textarea"
                                    placeholder="Descripción del viaje"
                                    :class="{
                                        'is-invalid': errors.descripcion_viaje,
                                    }"
                                    v-model="
                                        unidad_solicitante.descripcion_viaje
                                    "
                                    autosize
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.descripcion_viaje"
                                    v-text="errors.descripcion_viaje[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.fecha_solicitud,
                                    }"
                                    >Fecha Solicitud*</label
                                >
                                <input
                                    type="date"
                                    placeholder="Fecha Solicitud"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.fecha_solicitud,
                                    }"
                                    v-model="unidad_solicitante.fecha_solicitud"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.fecha_solicitud"
                                    v-text="errors.fecha_solicitud[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.nro_hoja_ruta,
                                    }"
                                    >Nro. Hoja de Ruta</label
                                >

                                <el-input
                                    type="text"
                                    placeholder="Nro. Hoja de Ruta"
                                    :class="{
                                        'is-invalid': errors.nro_hoja_ruta,
                                    }"
                                    v-model="unidad_solicitante.nro_hoja_ruta"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.nro_hoja_ruta"
                                    v-text="errors.nro_hoja_ruta[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label
                                    :class="{
                                        'text-danger': errors.conductor,
                                    }"
                                    >Requiere Conductor</label
                                >
                                <div class="icheck-primary d-inline">
                                    <input
                                        type="checkbox"
                                        id="conductor_cb"
                                        true-value="1"
                                        false-value="0"
                                        v-model.number="
                                            unidad_solicitante.conductor
                                        "
                                    />
                                    <label for="conductor_cb"></label>
                                </div>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.conductor"
                                    v-text="errors.conductor[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label
                                    :class="{
                                        'text-danger': errors.vehiculo,
                                    }"
                                    >Requiere Vehículo</label
                                >
                                <div class="icheck-primary d-inline">
                                    <input
                                        type="checkbox"
                                        id="vehiculo_cb"
                                        true-value="1"
                                        false-value="0"
                                        v-model.number="
                                            unidad_solicitante.vehiculo
                                        "
                                    />
                                    <label for="vehiculo_cb"></label>
                                </div>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.vehiculo"
                                    v-text="errors.vehiculo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label
                                    :class="{
                                        'text-danger': errors.combustible,
                                    }"
                                    >Requiere Combustible</label
                                >
                                <div class="icheck-primary d-inline">
                                    <input
                                        type="checkbox"
                                        id="combustible_cb"
                                        true-value="1"
                                        false-value="0"
                                        v-model.number="
                                            unidad_solicitante.combustible
                                        "
                                    />
                                    <label for="combustible_cb"></label>
                                </div>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.combustible"
                                    v-text="errors.combustible[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.observacion,
                                    }"
                                    >Observación</label
                                >
                                <el-input
                                    type="textarea"
                                    placeholder="Observación"
                                    :class="{
                                        'is-invalid': errors.observacion,
                                    }"
                                    v-model="unidad_solicitante.observacion"
                                    autosize
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.observacion"
                                    v-text="errors.observacion[0]"
                                ></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button
                        type="button"
                        class="btn btn-default"
                        data-dismiss="modal"
                        @click="cierraModal"
                    >
                        Cerrar
                    </button>
                    <el-button
                        type="success"
                        class="bg-success"
                        :loading="enviando"
                        @click="setRegistroModal()"
                        >{{ textoBoton }}</el-button
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        muestra_modal: {
            type: Boolean,
            default: false,
        },
        accion: {
            type: String,
            default: "nuevo",
        },
        unidad_solicitante: {
            type: Object,
            default: {
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
        },
    },
    watch: {
        muestra_modal: function (newVal, oldVal) {
            this.errors = [];
            if (newVal) {
                this.bModal = true;
            } else {
                this.bModal = false;
            }
        },
    },
    computed: {
        tituloModal() {
            if (this.accion == "nuevo") {
                return "AGREGAR REGISTRO";
            } else {
                return "MODIFICAR REGISTRO";
            }
        },
        textoBoton() {
            if (this.accion == "nuevo") {
                return "Registrar";
            } else {
                return "Actualizar";
            }
        },
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            bModal: this.muestra_modal,
            enviando: false,
            errors: [],
            listUnidads: [],
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
        this.getUnidads();
    },
    methods: {
        getUnidads() {
            axios.get(main_url + "/admin/unidads").then((response) => {
                this.listUnidads = response.data.unidads;
            });
        },
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = main_url + "/admin/unidad_solicitantes";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "nro",
                    this.unidad_solicitante.nro
                        ? this.unidad_solicitante.nro
                        : ""
                );
                formdata.append(
                    "codigo",
                    this.unidad_solicitante.codigo
                        ? this.unidad_solicitante.codigo
                        : ""
                );
                formdata.append(
                    "unidad_id",
                    this.unidad_solicitante.unidad_id
                        ? this.unidad_solicitante.unidad_id
                        : ""
                );
                formdata.append(
                    "descripcion_viaje",
                    this.unidad_solicitante.descripcion_viaje
                        ? this.unidad_solicitante.descripcion_viaje
                        : ""
                );
                formdata.append(
                    "fecha_solicitud",
                    this.unidad_solicitante.fecha_solicitud
                        ? this.unidad_solicitante.fecha_solicitud
                        : ""
                );
                formdata.append(
                    "nro_hoja_ruta",
                    this.unidad_solicitante.nro_hoja_ruta
                        ? this.unidad_solicitante.nro_hoja_ruta
                        : ""
                );
                formdata.append(
                    "conductor",
                    this.unidad_solicitante.conductor
                        ? this.unidad_solicitante.conductor
                        : "0"
                );
                formdata.append(
                    "vehiculo",
                    this.unidad_solicitante.vehiculo
                        ? this.unidad_solicitante.vehiculo
                        : "0"
                );
                formdata.append(
                    "combustible",
                    this.unidad_solicitante.combustible
                        ? this.unidad_solicitante.combustible
                        : "0"
                );
                formdata.append(
                    "observacion",
                    this.unidad_solicitante.observacion
                        ? this.unidad_solicitante.observacion
                        : ""
                );

                if (this.accion == "edit") {
                    url =
                        main_url +
                        "/admin/unidad_solicitantes/" +
                        this.unidad_solicitante.id;
                    formdata.append("_method", "PUT");
                }
                axios
                    .post(url, formdata, config)
                    .then((res) => {
                        this.enviando = false;
                        Swal.fire({
                            icon: "success",
                            title: res.data.msj,
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        this.limpiaUnidadSolicitante();
                        this.$emit("envioModal");
                        this.errors = [];
                        if (this.accion == "edit") {
                            this.textoBtn = "Actualizar";
                        } else {
                            this.textoBtn = "Registrar";
                        }
                    })
                    .catch((error) => {
                        this.enviando = false;
                        if (this.accion == "edit") {
                            this.textoBtn = "Actualizar";
                        } else {
                            this.textoBtn = "Registrar";
                        }
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
            } catch (e) {
                this.enviando = false;
                console.log(e);
            }
        },
        cargaImagen(e) {
            this.unidad_solicitante.foto = e.target.files[0];
        },
        // Dialog/modal
        cierraModal() {
            this.bModal = false;
            this.$emit("close");
        },
        limpiaUnidadSolicitante() {
            this.errors = [];
            this.unidad_solicitante.nro = "";
            this.unidad_solicitante.codigo = "";
            this.unidad_solicitante.unidad_id = "";
            this.unidad_solicitante.descripcion_viaje = "";
            this.unidad_solicitante.fecha_solicitud = "";
            this.unidad_solicitante.nro_hoja_ruta = "";
            this.unidad_solicitante.conductor = "0";
            this.unidad_solicitante.vehiculo = "0";
            this.unidad_solicitante.combustible = "0";
            this.unidad_solicitante.observacion = "";
        },
    },
};
</script>

<style></style>
