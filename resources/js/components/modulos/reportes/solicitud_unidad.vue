<template>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reportes - Solicitud de Unidad</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="ml-auto mr-auto col-md-5">
                                    <form>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.filtro,
                                                    }"
                                                    >Seleccione*</label
                                                >
                                                <el-select
                                                    v-model="oReporte.filtro"
                                                    filterable
                                                    placeholder="Seleccione"
                                                    class="d-block"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.filtro,
                                                    }"
                                                >
                                                    <el-option
                                                        v-for="item in listFiltro"
                                                        :key="item"
                                                        :label="item"
                                                        :value="item"
                                                    >
                                                    </el-option>
                                                </el-select>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.filtro"
                                                    v-text="errors.filtro[0]"
                                                ></span>
                                            </div>
                                            <div
                                                class="form-group col-md-12"
                                                v-if="
                                                    oReporte.filtro == 'Unidad'
                                                "
                                            >
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.unidad_id,
                                                    }"
                                                    >Seleccione Unidad*</label
                                                >
                                                <el-select
                                                    v-model="oReporte.unidad_id"
                                                    filterable
                                                    placeholder="Seleccione"
                                                    class="d-block"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.unidad_id,
                                                    }"
                                                >
                                                    <el-option
                                                        v-for="item in listUnidads"
                                                        :key="item.id"
                                                        :value="item.id"
                                                        :label="item.nombre"
                                                    >
                                                    </el-option>
                                                </el-select>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.unidad_id"
                                                    v-text="errors.unidad_id[0]"
                                                ></span>
                                            </div>
                                            <div
                                                class="form-group col-md-12"
                                                v-if="
                                                    oReporte.filtro ==
                                                    'Solicitud'
                                                "
                                            >
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.solicitud,
                                                    }"
                                                    >Seleccionar
                                                    Solicitud*</label
                                                >
                                                <el-select
                                                    v-model="oReporte.solicitud"
                                                    filterable
                                                    placeholder="Seleccione"
                                                    class="d-block"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.solicitud,
                                                    }"
                                                >
                                                    <el-option
                                                        v-for="item in listSolicitud"
                                                        :key="item"
                                                        :value="item"
                                                        :label="item"
                                                    >
                                                    </el-option>
                                                </el-select>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.solicitud"
                                                    v-text="errors.solicitud[0]"
                                                ></span>
                                            </div>
                                            <div
                                                class="form-group col-md-12"
                                                v-if="
                                                    oReporte.solicitud ==
                                                    'Conductor'
                                                "
                                            >
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.user_id,
                                                    }"
                                                    >Seleccionar
                                                    Conductor*</label
                                                >
                                                <el-select
                                                    v-model="oReporte.user_id"
                                                    filterable
                                                    placeholder="Seleccione"
                                                    class="d-block"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.user_id,
                                                    }"
                                                >
                                                    <el-option
                                                        v-for="item in listConductors"
                                                        :key="item.id"
                                                        :value="item.id"
                                                        :label="item.full_name"
                                                    >
                                                    </el-option>
                                                </el-select>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.user_id"
                                                    v-text="errors.user_id[0]"
                                                ></span>
                                            </div>
                                            <div
                                                class="form-group col-md-12"
                                                v-if="
                                                    oReporte.solicitud ==
                                                    'Vehículos'
                                                "
                                            >
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.vehiculo_id,
                                                    }"
                                                    >Seleccionar
                                                    Vehículo*</label
                                                >
                                                <el-select
                                                    v-model="
                                                        oReporte.vehiculo_id
                                                    "
                                                    filterable
                                                    placeholder="Seleccione"
                                                    class="d-block"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.vehiculo_id,
                                                    }"
                                                >
                                                    <el-option
                                                        v-for="item in listVehiculos"
                                                        :key="item.id"
                                                        :value="item.id"
                                                        :label="item.full_name"
                                                    >
                                                    </el-option>
                                                </el-select>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.vehiculo_id"
                                                    v-text="
                                                        errors.vehiculo_id[0]
                                                    "
                                                ></span>
                                            </div>
                                            <div
                                                class="form-group col-md-12"
                                                v-if="
                                                    oReporte.solicitud ==
                                                    'Combustible'
                                                "
                                            >
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.combustible,
                                                    }"
                                                    >Combustible*</label
                                                >
                                                <input
                                                    type="number"
                                                    v-model="
                                                        oReporte.combustible
                                                    "
                                                    filterable
                                                    placeholder="Seleccione"
                                                    class="form-control"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.combustible,
                                                    }"
                                                />
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.combustible"
                                                    v-text="
                                                        errors.combustible[0]
                                                    "
                                                ></span>
                                            </div>

                                            <div
                                                class="form-group col-md-12"
                                                v-if="
                                                    oReporte.filtro ==
                                                    'Rango de fechas'
                                                "
                                            >
                                                <label
                                                    :class="{
                                                        'text-danger':
                                                            errors.fecha_ini,
                                                        'text-danger':
                                                            errors.fecha_fin,
                                                    }"
                                                    >Indice un rango de
                                                    fechas*</label
                                                >
                                                <el-date-picker
                                                    class="w-full d-block"
                                                    :class="{
                                                        'is-invalid':
                                                            errors.fecha_ini,
                                                        'is-invalid':
                                                            errors.fecha_fin,
                                                    }"
                                                    v-model="aFechas"
                                                    type="daterange"
                                                    range-separator="a"
                                                    start-placeholder="Fecha Inicial"
                                                    end-placeholder="Fecha Final"
                                                    format="dd/MM/yyyy"
                                                    value-format="yyyy-MM-dd"
                                                    @change="obtieneFechas()"
                                                >
                                                </el-date-picker>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.fecha_ini"
                                                    v-text="errors.fecha_ini[0]"
                                                ></span>
                                                <span
                                                    class="error invalid-feedback"
                                                    v-if="errors.fecha_fin"
                                                    v-text="errors.fecha_fin[0]"
                                                ></span>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <el-button
                                                type="success"
                                                class="bg-success w-full"
                                                :loading="enviando"
                                                @click="generaReporte()"
                                                >{{ textoBtn }}</el-button
                                            >
                                        </div>
                                        <div class="col-md-12">
                                            <el-button
                                                type="default"
                                                class="w-full mt-1"
                                                @click="limpiarFormulario()"
                                                >Reiniciar</el-button
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loadingWindow: Loading.service({
                fullscreen: this.fullscreenLoading,
            }),
            errors: [],
            oReporte: {
                filtro: "Todos",
                unidad_id: "",
                solicitud: "",
                user_id: "",
                vehiculo_id: "",
                combustible: "",
                fecha_ini: "",
                fecha_fin: "",
            },
            aFechas: [],
            enviando: false,
            textoBtn: "Generar Reporte",
            listFiltro: ["Todos", "Unidad", "Solicitud", "Rango de fechas"],
            listSolicitud: ["Todos", "Conductor", "Vehículos", "Combustible"],
            listUnidads: [],
            listConductors: [],
            listVehiculos: [],
            listSolicitudCombustibles: [],
            errors: [],
        };
    },
    mounted() {
        this.loadingWindow.close();
        this.getUnidads();
        this.getConductors();
        this.getVehiculos();
        this.getSolicitudCombustibles();
    },
    methods: {
        limpiarFormulario() {
            this.oReporte.filtro = "Todos";
        },
        getUnidads() {
            axios.get(main_url + "/admin/unidads").then((response) => {
                this.listUnidads = response.data.unidads;
            });
        },
        getConductors() {
            axios.get(main_url + "/admin/conductors").then((response) => {
                this.listConductors = response.data.usuarios;
            });
        },
        getVehiculos() {
            axios.get(main_url + "/admin/vehiculos").then((response) => {
                this.listVehiculos = response.data.vehiculos;
            });
        },
        getSolicitudCombustibles() {
            axios
                .get(main_url + "/admin/solicitud_combustibles")
                .then((response) => {
                    this.listSolicitudCombustibles =
                        response.data.solicitud_combustibles;
                });
        },
        generaReporte() {
            this.enviando = true;
            let config = {
                responseType: "blob",
            };
            axios
                .post(
                    main_url + "/admin/reportes/solicitud_unidad",
                    this.oReporte,
                    config
                )
                .then((res) => {
                    this.errors = [];
                    this.enviando = false;
                    let pdfBlob = new Blob([res.data], {
                        type: "application/pdf",
                    });
                    let urlReporte = URL.createObjectURL(pdfBlob);
                    window.open(urlReporte);
                })
                .catch(async (error) => {
                    let responseObj = await error.response.data.text();
                    responseObj = JSON.parse(responseObj);
                    console.log(error);
                    this.enviando = false;
                    if (error.response) {
                        if (error.response.status === 422) {
                            this.errors = responseObj.errors;
                        }
                        if (
                            error.response.status === 420 ||
                            error.response.status === 419 ||
                            error.response.status === 401
                        ) {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                html: responseObj.message,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                            window.location = "/";
                        }
                    }
                });
        },
        obtieneFechas() {
            this.oReporte.fecha_ini = this.aFechas[0];
            this.oReporte.fecha_fin = this.aFechas[1];
        },
    },
};
</script>

<style></style>
