<template>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Formulario</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.unidad_solicitante_id,
                                }"
                                >Seleccionar Unidad Solicitante*</label
                            >
                            <el-select
                                placeholder="Seleccionar Unidad Solicitante"
                                class="w-100"
                                :class="{
                                    'is-invalid': errors.unidad_solicitante_id,
                                }"
                                v-model="recorrido_viaje.unidad_solicitante_id"
                                @change="getUnidadSolicitante"
                                clearable
                                filterable
                            >
                                <el-option
                                    v-for="item in listUnidadSolicitantes"
                                    :key="item.id"
                                    :value="item.id"
                                    :label="item.full_name"
                                ></el-option>
                            </el-select>
                            <span
                                class="error invalid-feedback"
                                v-if="errors.unidad_solicitante_id"
                                v-text="errors.unidad_solicitante_id[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.descripcion_recorrido,
                                }"
                                >Descripción del recorrido*</label
                            >
                            <el-input
                                type="textarea"
                                placeholder="Descripción del recorrido"
                                :class="{
                                    'is-invalid': errors.descripcion_recorrido,
                                }"
                                v-model="recorrido_viaje.descripcion_recorrido"
                                autosize
                            >
                            </el-input>
                            <span
                                class="error invalid-feedback"
                                v-if="errors.descripcion_recorrido"
                                v-text="errors.descripcion_recorrido[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.fecha_inicio,
                                }"
                                >Fecha inicio de viaje*</label
                            >
                            <input
                                type="date"
                                placeholder="Fecha inicio de viaje"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fecha_inicio,
                                }"
                                v-model="recorrido_viaje.fecha_inicio"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.fecha_inicio"
                                v-text="errors.fecha_inicio[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.fecha_fin,
                                }"
                                >Fecha fin de viaje*</label
                            >
                            <input
                                type="date"
                                placeholder="Fecha fin de viaje"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fecha_fin,
                                }"
                                v-model="recorrido_viaje.fecha_fin"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.fecha_fin"
                                v-text="errors.fecha_fin[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.inicio_combustible,
                                }"
                                >Inicio Cantidad Combustible*</label
                            >
                            <input
                                type="number"
                                placeholder="Inicio Cantidad Combustible"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.inicio_combustible,
                                }"
                                v-model="recorrido_viaje.inicio_combustible"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.inicio_combustible"
                                v-text="errors.inicio_combustible[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.fin_combustible,
                                }"
                                >Fin Cantidad Combustible*</label
                            >
                            <input
                                type="number"
                                placeholder="Fin Cantidad Combustible"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fin_combustible,
                                }"
                                v-model="recorrido_viaje.fin_combustible"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.fin_combustible"
                                v-text="errors.fin_combustible[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.restante_combustible,
                                }"
                                >Combustible Restante*</label
                            >
                            <input
                                type="number"
                                placeholder="Combustible Restante"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.restante_combustible,
                                }"
                                v-model="recorrido_viaje.restante_combustible"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.restante_combustible"
                                v-text="errors.restante_combustible[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger':
                                        errors.inicio_cinicio_kilometrajeombustible,
                                }"
                                >Inicio de Kilometraje*</label
                            >
                            <input
                                type="number"
                                placeholder="Inicio de Kilometraje"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.inicio_kilometraje,
                                }"
                                v-model="recorrido_viaje.inicio_kilometraje"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.inicio_kilometraje"
                                v-text="errors.inicio_kilometraje[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.fin_kilometraje,
                                }"
                                >Fin de Kilometraje*</label
                            >
                            <input
                                type="number"
                                placeholder="Fin de Kilometraje"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fin_kilometraje,
                                }"
                                v-model="recorrido_viaje.fin_kilometraje"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.fin_kilometraje"
                                v-text="errors.fin_kilometraje[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.observacion,
                                }"
                                >Observaciones</label
                            >
                            <el-input
                                type="textarea"
                                placeholder="Observaciones"
                                :class="{
                                    'is-invalid': errors.observacion,
                                }"
                                v-model="recorrido_viaje.observacion"
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
                    <div class="row">
                        <div class="col-md-6">
                            <button
                                class="btn btn-success btn-block"
                                :disabled="enviando"
                                @click="setRegistroModal()"
                                v-html="textoBoton"
                            ></button>
                        </div>
                        <div class="col-md-6">
                            <router-link
                                :to="{ name: 'recorrido_viajes.index' }"
                                class="btn btn-default btn-block"
                                >Volver</router-link
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger">
                    <h4>Información Unidad Solicitante</h4>
                </div>
                <div class="card-body">
                    <div class="row" v-if="oUnidadSolicitante">
                        <div class="col-12">
                            <p>
                                <strong>Unidad: </strong
                                >{{ oUnidadSolicitante.unidad.nombre }}
                            </p>
                            <p>
                                <strong>Descripción del viaje: </strong
                                >{{ oUnidadSolicitante.descripcion_viaje }}
                            </p>
                            <p>
                                <strong>Fecha de Solicitud: </strong
                                >{{ oUnidadSolicitante.fecha_solicitud_t }}
                            </p>
                            <p>
                                <strong>Nro. Hoja de Ruta: </strong
                                >{{ oUnidadSolicitante.nro_hoja_ruta }}
                            </p>
                            <p>
                                <strong>Requiere conductor: </strong
                                >{{ oUnidadSolicitante.conductor_txt }}
                            </p>
                            <p>
                                <strong>Requiere vehículo: </strong
                                >{{ oUnidadSolicitante.vehiculo_txt }}
                            </p>
                            <p>
                                <strong>Requiere combustible: </strong
                                >{{ oUnidadSolicitante.combustible_txt }}
                            </p>
                            <p>
                                <strong>Observación: </strong
                                >{{ oUnidadSolicitante.observacion }}
                            </p>
                        </div>
                    </div>
                    <div class="row" v-if="!oUnidadSolicitante">
                        <div class="col-12">
                            <h4 class="w-100 text-md text-gray text-center">
                                Selecciona una unidad solicitante
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-danger">
                    <h4>Información Solicitud de Combustibles</h4>
                </div>
                <div class="card-body">
                    <div class="row" v-if="oUnidadSolicitante">
                        <div
                            class="col-12"
                            v-if="
                                oUnidadSolicitante.solicitud_combustibles
                                    .length > 0
                            "
                        >
                            <div class="row">
                                <div
                                    class="col-12"
                                    v-for="item in oUnidadSolicitante.solicitud_combustibles"
                                >
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p>
                                                        <strong
                                                            >Conductor: </strong
                                                        >{{
                                                            item.user?.full_name
                                                        }}
                                                    </p>
                                                    <p>
                                                        <strong
                                                            >Vehículo: </strong
                                                        >{{
                                                            item.vehiculo
                                                                ?.full_name
                                                        }}
                                                    </p>
                                                    <p>
                                                        <strong
                                                            >Cantidad de
                                                            Combustible: </strong
                                                        >{{ item.combustible }}
                                                    </p>
                                                    <p>
                                                        <strong
                                                            >Nro. Vale: </strong
                                                        >{{ item.nro_vale }}
                                                    </p>
                                                    <p>
                                                        <strong
                                                            >Fecha de Entrega: </strong
                                                        >{{
                                                            item.fecha_entrega_t
                                                        }}
                                                    </p>
                                                    <p>
                                                        <strong
                                                            >Observación: </strong
                                                        >{{ item.observacion }}
                                                    </p>
                                                    <p>
                                                        <strong
                                                            >Fecha de registro: </strong
                                                        >{{
                                                            item.fecha_registro_t
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" v-else>
                            <h4 class="w-100 text-md text-gray text-center">
                                No se encontrarón registros
                            </h4>
                        </div>
                    </div>
                    <div class="row" v-else>
                        <div class="col-12">
                            <h4 class="w-100 text-md text-gray text-center">
                                Selecciona una unidad solicitante
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        accion: {
            type: String,
            default: "nuevo",
        },
        recorrido_viaje: {
            type: Object,
            default: {
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
        },
    },
    watch: {
        recorrido_viaje(newVal) {
            this.getUnidadSolicitante();
        },
    },
    computed: {
        textoBoton() {
            if (this.enviando) {
                return `<i class="fa fa-spinner fa-spin"></i> Enviando`;
            }
            if (this.accion == "nuevo") {
                return `<i class="fa fa-save"></i> Registrar`;
            } else {
                return `<i class="fa fa-edit"></i> Actualizar`;
            }
        },
    },
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            bModal: this.muestra_modal,
            enviando: false,
            errors: [],
            listUnidadSolicitantes: [],
            oUnidadSolicitante: null,
            oSolicitudCombustible: null,
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
        this.getUnidadSolicitantes();
    },
    methods: {
        getUnidadSolicitantes() {
            axios
                .get(main_url + "/admin/unidad_solicitantes")
                .then((response) => {
                    this.listUnidadSolicitantes =
                        response.data.unidad_solicitantes;
                });
        },
        getUnidadSolicitante() {
            if (this.recorrido_viaje.unidad_solicitante_id != "") {
                axios
                    .get(
                        main_url +
                            "/admin/unidad_solicitantes/" +
                            this.recorrido_viaje.unidad_solicitante_id
                    )
                    .then((response) => {
                        this.oUnidadSolicitante =
                            response.data.unidad_solicitante;
                    });
            } else {
                this.oUnidadSolicitante = null;
            }
        },
        calculaCombustibleRestante() {
            if (
                this.recorrido_viaje.inicio_combustible != "" &&
                this.recorrido_viaje.fin_combustible != ""
            ) {
                this.recorrido_viaje.restante_combustible =
                    parseFloat(this.recorrido_viaje.inicio_combustible) -
                    parseFloat(this.recorrido_viaje.fin_combustible);
            } else {
                this.recorrido_viaje.restante_combustible = "";
            }
        },
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = main_url + "/admin/recorrido_viajes";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "unidad_solicitante_id",
                    this.recorrido_viaje.unidad_solicitante_id
                        ? this.recorrido_viaje.unidad_solicitante_id
                        : ""
                );
                formdata.append(
                    "descripcion_recorrido",
                    this.recorrido_viaje.descripcion_recorrido
                        ? this.recorrido_viaje.descripcion_recorrido
                        : ""
                );
                formdata.append(
                    "fecha_inicio",
                    this.recorrido_viaje.fecha_inicio
                        ? this.recorrido_viaje.fecha_inicio
                        : ""
                );
                formdata.append(
                    "fecha_fin",
                    this.recorrido_viaje.fecha_fin
                        ? this.recorrido_viaje.fecha_fin
                        : ""
                );
                formdata.append(
                    "inicio_combustible",
                    this.recorrido_viaje.inicio_combustible
                        ? this.recorrido_viaje.inicio_combustible
                        : ""
                );
                formdata.append(
                    "fin_combustible",
                    this.recorrido_viaje.fin_combustible
                        ? this.recorrido_viaje.fin_combustible
                        : ""
                );
                formdata.append(
                    "restante_combustible",
                    this.recorrido_viaje.restante_combustible
                        ? this.recorrido_viaje.restante_combustible
                        : ""
                );
                formdata.append(
                    "inicio_kilometraje",
                    this.recorrido_viaje.inicio_kilometraje
                        ? this.recorrido_viaje.inicio_kilometraje
                        : ""
                );
                formdata.append(
                    "fin_kilometraje",
                    this.recorrido_viaje.fin_kilometraje
                        ? this.recorrido_viaje.fin_kilometraje
                        : ""
                );
                formdata.append(
                    "observacion",
                    this.recorrido_viaje.observacion
                        ? this.recorrido_viaje.observacion
                        : ""
                );

                if (this.accion == "edit") {
                    url =
                        main_url +
                        "/admin/recorrido_viajes/" +
                        this.recorrido_viaje.id;
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
                        this.limpiaRecorridoViaje();
                        this.errors = [];
                        this.$router.push({
                            name: "recorrido_viajes.index",
                        });
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
            this.recorrido_viaje.foto = e.target.files[0];
        },
        // Dialog/modal
        cierraModal() {
            this.bModal = false;
            this.$emit("close");
        },
        limpiaRecorridoViaje() {
            this.errors = [];
            this.recorrido_viaje.unidad_solicitante_id = "";
            this.recorrido_viaje.descripcion_recorrido = "";
            this.recorrido_viaje.fecha_inicio = "";
            this.recorrido_viaje.fecha_fin = "";
            this.recorrido_viaje.inicio_combustible = "";
            this.recorrido_viaje.fin_combustible = "";
            this.recorrido_viaje.restante_combustible = "";
            this.recorrido_viaje.inicio_kilometraje = "";
            this.recorrido_viaje.fin_kilometraje = "";
            this.recorrido_viaje.observacion = "";
        },
    },
};
</script>

<style></style>
