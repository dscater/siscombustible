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
                                        'text-danger': errors.placa,
                                    }"
                                    >Placa*</label
                                >
                                <el-input
                                    placeholder="Placa"
                                    :class="{ 'is-invalid': errors.placa }"
                                    v-model="vehiculo.placa"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.placa"
                                    v-text="errors.placa[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.marca,
                                    }"
                                    >Marca*</label
                                >

                                <el-input
                                    placeholder="Marca"
                                    :class="{ 'is-invalid': errors.marca }"
                                    v-model="vehiculo.marca"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.marca"
                                    v-text="errors.marca[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.clase,
                                    }"
                                    >Clase</label
                                >

                                <el-input
                                    placeholder="Clase"
                                    :class="{ 'is-invalid': errors.clase }"
                                    v-model="vehiculo.clase"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.clase"
                                    v-text="errors.clase[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.modelo,
                                    }"
                                    >Modelo*</label
                                >

                                <el-input
                                    placeholder="Modelo"
                                    :class="{ 'is-invalid': errors.modelo }"
                                    v-model="vehiculo.modelo"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.modelo"
                                    v-text="errors.modelo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.procedencia,
                                    }"
                                    >Procedencia</label
                                >

                                <el-input
                                    placeholder="Procedencia"
                                    :class="{
                                        'is-invalid': errors.procedencia,
                                    }"
                                    v-model="vehiculo.procedencia"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.procedencia"
                                    v-text="errors.procedencia[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.servicio,
                                    }"
                                    >Servicio</label
                                >
                                <el-input
                                    placeholder="Servicio"
                                    :class="{ 'is-invalid': errors.servicio }"
                                    v-model="vehiculo.servicio"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.servicio"
                                    v-text="errors.servicio[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.traccion,
                                    }"
                                    >Tracción</label
                                >
                                <el-input
                                    placeholder="Tracción"
                                    :class="{ 'is-invalid': errors.traccion }"
                                    v-model="vehiculo.traccion"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.traccion"
                                    v-text="errors.traccion[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.turbo,
                                    }"
                                    >Turbo</label
                                >
                                <el-input
                                    placeholder="Turbo"
                                    :class="{ 'is-invalid': errors.turbo }"
                                    v-model="vehiculo.turbo"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.turbo"
                                    v-text="errors.turbo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.carroceria,
                                    }"
                                    >Carrocería</label
                                >
                                <el-input
                                    placeholder="Carrocería"
                                    :class="{ 'is-invalid': errors.carroceria }"
                                    v-model="vehiculo.carroceria"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.carroceria"
                                    v-text="errors.carroceria[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.tipo,
                                    }"
                                    >Tipo</label
                                >
                                <el-input
                                    placeholder="Tipo"
                                    :class="{ 'is-invalid': errors.tipo }"
                                    v-model="vehiculo.tipo"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.tipo"
                                    v-text="errors.tipo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.subtipo,
                                    }"
                                    >Subtipo</label
                                >
                                <el-input
                                    placeholder="Subtipo"
                                    :class="{ 'is-invalid': errors.subtipo }"
                                    v-model="vehiculo.subtipo"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.subtipo"
                                    v-text="errors.subtipo[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.cilindrada,
                                    }"
                                    >Cilindrada</label
                                >
                                <el-input
                                    placeholder="Cilindrada"
                                    :class="{ 'is-invalid': errors.cilindrada }"
                                    v-model="vehiculo.cilindrada"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.cilindrada"
                                    v-text="errors.cilindrada[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.nro_puertas,
                                    }"
                                    >Nro. Puertas</label
                                >
                                <el-input
                                    placeholder="Nro. Puertas"
                                    :class="{
                                        'is-invalid': errors.nro_puertas,
                                    }"
                                    v-model="vehiculo.nro_puertas"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.nro_puertas"
                                    v-text="errors.nro_puertas[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.capacidad_carga,
                                    }"
                                    >Capacidad Carga</label
                                >
                                <el-input
                                    placeholder="Capacidad Carga"
                                    :class="{
                                        'is-invalid': errors.capacidad_carga,
                                    }"
                                    v-model="vehiculo.capacidad_carga"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.capacidad_carga"
                                    v-text="errors.capacidad_carga[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.capacidad_plaza,
                                    }"
                                    >Capacidad Plaza</label
                                >
                                <el-input
                                    placeholder="Capacidad Plaza"
                                    :class="{
                                        'is-invalid': errors.capacidad_plaza,
                                    }"
                                    v-model="vehiculo.capacidad_plaza"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.capacidad_plaza"
                                    v-text="errors.capacidad_plaza[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger':
                                            errors.capacidad_arrastre,
                                    }"
                                    >Capacidad Arrastre</label
                                >
                                <el-input
                                    placeholder="Capacidad Arrastre"
                                    :class="{
                                        'is-invalid': errors.capacidad_arrastre,
                                    }"
                                    v-model="vehiculo.capacidad_arrastre"
                                    clearable
                                >
                                </el-input>
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.capacidad_arrastre"
                                    v-text="errors.capacidad_arrastre[0]"
                                ></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label
                                    :class="{
                                        'text-danger': errors.foto,
                                    }"
                                    >Foto</label
                                >
                                <input
                                    type="file"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': errors.foto,
                                    }"
                                    ref="input_file"
                                    @change="cargaImagen"
                                />
                                <span
                                    class="error invalid-feedback"
                                    v-if="errors.foto"
                                    v-text="errors.foto[0]"
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
                                    v-model="vehiculo.observacion"
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
        vehiculo: {
            type: Object,
            default: {
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
        },
    },
    watch: {
        muestra_modal: function (newVal, oldVal) {
            this.errors = [];
            if (newVal) {
                this.$refs.input_file.value = null;
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
        };
    },
    mounted() {
        this.bModal = this.muestra_modal;
    },
    methods: {
        setRegistroModal() {
            this.enviando = true;
            try {
                this.textoBtn = "Enviando...";
                let url = main_url + "/admin/vehiculos";
                let config = {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                };
                let formdata = new FormData();
                formdata.append(
                    "placa",
                    this.vehiculo.placa ? this.vehiculo.placa : ""
                );
                formdata.append(
                    "marca",
                    this.vehiculo.marca ? this.vehiculo.marca : ""
                );
                formdata.append(
                    "clase",
                    this.vehiculo.clase ? this.vehiculo.clase : ""
                );
                formdata.append(
                    "modelo",
                    this.vehiculo.modelo ? this.vehiculo.modelo : ""
                );
                formdata.append(
                    "procedencia",
                    this.vehiculo.procedencia ? this.vehiculo.procedencia : ""
                );
                formdata.append(
                    "servicio",
                    this.vehiculo.servicio ? this.vehiculo.servicio : ""
                );
                formdata.append(
                    "traccion",
                    this.vehiculo.traccion ? this.vehiculo.traccion : ""
                );
                formdata.append(
                    "turbo",
                    this.vehiculo.turbo ? this.vehiculo.turbo : ""
                );
                formdata.append(
                    "carroceria",
                    this.vehiculo.carroceria ? this.vehiculo.carroceria : ""
                );
                formdata.append(
                    "tipo",
                    this.vehiculo.tipo ? this.vehiculo.tipo : ""
                );
                formdata.append(
                    "subtipo",
                    this.vehiculo.subtipo ? this.vehiculo.subtipo : ""
                );
                formdata.append(
                    "cilindrada",
                    this.vehiculo.cilindrada ? this.vehiculo.cilindrada : ""
                );
                formdata.append(
                    "nro_puertas",
                    this.vehiculo.nro_puertas ? this.vehiculo.nro_puertas : ""
                );
                formdata.append(
                    "capacidad_carga",
                    this.vehiculo.capacidad_carga
                        ? this.vehiculo.capacidad_carga
                        : ""
                );
                formdata.append(
                    "capacidad_plaza",
                    this.vehiculo.capacidad_plaza
                        ? this.vehiculo.capacidad_plaza
                        : ""
                );
                formdata.append(
                    "capacidad_arrastre",
                    this.vehiculo.capacidad_arrastre
                        ? this.vehiculo.capacidad_arrastre
                        : ""
                );
                formdata.append(
                    "foto",
                    this.vehiculo.foto ? this.vehiculo.foto : ""
                );
                formdata.append(
                    "observacion",
                    this.vehiculo.observacion ? this.vehiculo.observacion : ""
                );

                if (this.accion == "edit") {
                    url = main_url + "/admin/vehiculos/" + this.vehiculo.id;
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
                        this.limpiaVehiculo();
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
            this.vehiculo.foto = e.target.files[0];
        },
        // Dialog/modal
        cierraModal() {
            this.bModal = false;
            this.$emit("close");
        },
        limpiaVehiculo() {
            this.errors = [];
            this.vehiculo.placa = "";
            this.vehiculo.marca = "";
            this.vehiculo.clase = "";
            this.vehiculo.modelo = "";
            this.vehiculo.procedencia = "";
            this.vehiculo.servicio = "";
            this.vehiculo.traccion = "";
            this.vehiculo.turbo = "";
            this.vehiculo.carroceria = "";
            this.vehiculo.tipo = "";
            this.vehiculo.subtipo = "";
            this.vehiculo.cilindrada = "";
            this.vehiculo.nro_puertas = "";
            this.vehiculo.capacidad_carga = "";
            this.vehiculo.capacidad_plaza = "";
            this.vehiculo.capacidad_arrastre = "";
            this.vehiculo.foto = "";
            this.vehiculo.observacion = "";
            this.$refs.input_file.value = null;
        },
    },
};
</script>

<style></style>
