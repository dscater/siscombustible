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
                                v-model="
                                    solicitud_combustible.unidad_solicitante_id
                                "
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
                        <div
                            class="form-group col-md-6"
                            v-if="
                                oUnidadSolicitante &&
                                oUnidadSolicitante.conductor
                            "
                        >
                            <label
                                :class="{
                                    'text-danger': errors.user_id,
                                }"
                                >Seleccionar Conductor*</label
                            >
                            <el-select
                                placeholder="Seleccionar Conductor"
                                class="w-100"
                                :class="{
                                    'is-invalid': errors.user_id,
                                }"
                                v-model="solicitud_combustible.user_id"
                                clearable
                                filterable
                            >
                                <el-option
                                    v-for="item in listUsers"
                                    :key="item.id"
                                    :value="item.id"
                                    :label="item.full_name"
                                ></el-option>
                            </el-select>
                            <span
                                class="error invalid-feedback"
                                v-if="errors.user_id"
                                v-text="errors.user_id[0]"
                            ></span>
                        </div>
                        <div
                            class="form-group col-md-6"
                            v-if="
                                oUnidadSolicitante &&
                                oUnidadSolicitante.vehiculo
                            "
                        >
                            <label
                                :class="{
                                    'text-danger': errors.vehiculo_id,
                                }"
                                >Seleccionar Vehículo*</label
                            >
                            <el-select
                                placeholder="Seleccionar Vehículo"
                                class="w-100"
                                :class="{
                                    'is-invalid': errors.vehiculo_id,
                                }"
                                v-model="solicitud_combustible.vehiculo_id"
                                clearable
                                filterable
                            >
                                <el-option
                                    v-for="item in listVehiculos"
                                    :key="item.id"
                                    :value="item.id"
                                    :label="item.full_name"
                                ></el-option>
                            </el-select>
                            <span
                                class="error invalid-feedback"
                                v-if="errors.vehiculo_id"
                                v-text="errors.vehiculo_id[0]"
                            ></span>
                        </div>
                        <div
                            class="form-group col-md-6"
                            v-if="
                                oUnidadSolicitante &&
                                oUnidadSolicitante.combustible
                            "
                        >
                            <label
                                :class="{
                                    'text-danger': errors.combustible,
                                }"
                                >Cantidad de combustible(Litros)*</label
                            >
                            <input
                                type="number"
                                placeholder="Cantidad de combustible"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.combustible,
                                }"
                                v-model="solicitud_combustible.combustible"
                                clearable
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.combustible"
                                v-text="errors.combustible[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.nro_vale,
                                }"
                                >Nro. Vale</label
                            >

                            <el-input
                                type="text"
                                placeholder="Nro. Vale"
                                :class="{
                                    'is-invalid': errors.nro_vale,
                                }"
                                v-model="solicitud_combustible.nro_vale"
                                clearable
                            >
                            </el-input>
                            <span
                                class="error invalid-feedback"
                                v-if="errors.nro_vale"
                                v-text="errors.nro_vale[0]"
                            ></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label
                                :class="{
                                    'text-danger': errors.fecha_entrega,
                                }"
                                >Fecha de Entrega*</label
                            >
                            <input
                                type="date"
                                placeholder="Fecha de Entrega"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors.fecha_entrega,
                                }"
                                v-model="solicitud_combustible.fecha_entrega"
                            />
                            <span
                                class="error invalid-feedback"
                                v-if="errors.fecha_entrega"
                                v-text="errors.fecha_entrega[0]"
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
                                v-model="solicitud_combustible.observacion"
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
                                :to="{ name: 'solicitud_combustibles.index' }"
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
        solicitud_combustible: {
            type: Object,
            default: {
                unidad_solicitante_id: "",
                user_id: "",
                vehiculo_id: "",
                combustible: "",
                nro_vale: "",
                fecha_entrega: "",
                observacion: "",
            },
        },
    },
    watch: {
        solicitud_combustible(newVal) {
            this.getUnidadSolicitante();
            this.getUnidadSolicitantes();
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
            listUsers: [],
            listVehiculos: [],
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
        this.getUnidadSolicitantes();
        this.getConductores();
        this.getVehiculos();
        this.getUnidadSolicitante();
    },
    methods: {
        getUnidadSolicitantes() {
            axios
                .get(
                    main_url +
                        "/admin/unidad_solicitantes/sinSolicitudCombustible",
                    {
                        params: {
                            id: this.solicitud_combustible
                                .unidad_solicitante_id,
                        },
                    }
                )
                .then((response) => {
                    this.listUnidadSolicitantes =
                        response.data.unidad_solicitantes;
                });
        },
        getConductores() {
            axios.get(main_url + "/admin/conductors").then((response) => {
                this.listUsers = response.data.usuarios;
            });
        },
        getVehiculos() {
            axios.get(main_url + "/admin/vehiculos").then((response) => {
                this.listVehiculos = response.data.vehiculos;
            });
        },
        getUnidadSolicitante() {
            if (this.solicitud_combustible.unidad_solicitante_id != "") {
                axios
                    .get(
                        main_url +
                            "/admin/unidad_solicitantes/" +
                            this.solicitud_combustible.unidad_solicitante_id
                    )
                    .then((response) => {
                        this.oUnidadSolicitante =
                            response.data.unidad_solicitante;
                    });
            } else {
                this.oUnidadSolicitante = null;
            }
        },
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = main_url + "/admin/solicitud_combustibles";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "unidad_solicitante_id",
                    this.solicitud_combustible.unidad_solicitante_id
                        ? this.solicitud_combustible.unidad_solicitante_id
                        : ""
                );
                formdata.append(
                    "user_id",
                    this.solicitud_combustible.user_id
                        ? this.solicitud_combustible.user_id
                        : ""
                );
                formdata.append(
                    "vehiculo_id",
                    this.solicitud_combustible.vehiculo_id
                        ? this.solicitud_combustible.vehiculo_id
                        : ""
                );
                formdata.append(
                    "combustible",
                    this.solicitud_combustible.combustible
                        ? this.solicitud_combustible.combustible
                        : ""
                );
                formdata.append(
                    "nro_vale",
                    this.solicitud_combustible.nro_vale
                        ? this.solicitud_combustible.nro_vale
                        : ""
                );
                formdata.append(
                    "fecha_entrega",
                    this.solicitud_combustible.fecha_entrega
                        ? this.solicitud_combustible.fecha_entrega
                        : ""
                );
                formdata.append(
                    "observacion",
                    this.solicitud_combustible.observacion
                        ? this.solicitud_combustible.observacion
                        : ""
                );

                if (this.accion == "edit") {
                    url =
                        main_url +
                        "/admin/solicitud_combustibles/" +
                        this.solicitud_combustible.id;
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
                        this.limpiaSolicitudCombustible();
                        this.errors = [];
                        this.$router.push({
                            name: "solicitud_combustibles.index",
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
            this.solicitud_combustible.foto = e.target.files[0];
        },
        // Dialog/modal
        cierraModal() {
            this.bModal = false;
            this.$emit("close");
        },
        limpiaSolicitudCombustible() {
            this.errors = [];
            this.solicitud_combustible.unidad_solicitante_id = "";
            this.solicitud_combustible.user_id = "";
            this.solicitud_combustible.vehiculo_id = "";
            this.solicitud_combustible.combustible = "";
            this.solicitud_combustible.nro_vale = "";
            this.solicitud_combustible.fecha_entrega = "";
            this.solicitud_combustible.observacion = "";
        },
    },
};
</script>

<style></style>
