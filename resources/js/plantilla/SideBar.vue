<template>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-danger">
        <!-- Brand Logo -->
        <router-link
            exact
            :to="{ name: 'inicio' }"
            class="brand-link bg-success"
        >
            <img
                :src="configuracion.path_image"
                alt="Logo"
                class="brand-image"
                style="opacity: 0.8"
            />
            <span
                class="brand-text font-weight-light"
                v-text="configuracion.alias"
            ></span>
        </router-link>

        <!-- Sidebar -->
        <div class="sidebar p-0">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img
                        :src="user_sidebar.path_image"
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info">
                    <router-link
                        exact
                        :to="{
                            name: 'usuarios.perfil',
                            params: { id: user.id },
                        }"
                        class="d-block"
                        v-text="user_sidebar.full_name"
                    ></router-link>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline pl-1 pr-1">
                <div class="input-group" data-widget="sidebar-search">
                    <input
                        class="form-control form-control-sidebar bg-white"
                        type="search"
                        placeholder="Buscar Modulo"
                        aria-label="Search"
                    />
                    <div class="input-group-append">
                        <button class="btn btn-sidebar bg-white">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2 pr-1 pl-1">
                <ul
                    class="nav nav-pills nav-sidebar flex-column nav-compact nav-child-indent text-xs"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false"
                >
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <router-link
                            exact
                            :to="{ name: 'inicio' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-home"></i>
                            <p>Pandel de Administración</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-header bg-navy"
                        v-if="
                            permisos.includes('usuarios.index') ||
                            permisos.includes('unidads.index') ||
                            permisos.includes('conductors.index') ||
                            permisos.includes('vehiculos.index') ||
                            permisos.includes('unidad_solicitantes.index') ||
                            permisos.includes('solicitud_combustibles.index') ||
                            permisos.includes('recorrido_viajes.index')
                        "
                    >
                        ADMINISTRACIÓN
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('recorrido_viajes.index')"
                    >
                        <router-link
                            :to="{ name: 'recorrido_viajes.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Recorrido de Viajes</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('solicitud_combustibles.index')"
                    >
                        <router-link
                            :to="{ name: 'solicitud_combustibles.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Solicitud de Combustible</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('unidad_solicitantes.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'unidad_solicitantes.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list-alt"></i>
                            <p>Unidad Solicitante</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('vehiculos.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'vehiculos.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-truck"></i>
                            <p>Administrar Vehículos</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('unidads.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'unidads.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-list"></i>
                            <p>Administrar Unidad</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('conductors.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'conductors.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Administrar Conductores</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('usuarios.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'usuarios.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Gestión de Usuarios</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('profesors.index')"
                    >
                        <router-link
                            exact
                            :to="{ name: 'profesors.index' }"
                            class="nav-link"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="nav-icon fas fa-users"></i>
                            <p>Profesores</p>
                        </router-link>
                    </li>

                    <li
                        class="nav-header bg-navy"
                        v-if="
                            permisos.includes('reportes.usuarios') ||
                            permisos.includes('reportes.solicitud_unidad') ||
                            permisos.includes(
                                'reportes.cantidad_combustible_unidad'
                            ) ||
                            permisos.includes(
                                'reportes.cantidad_viajes_conductor'
                            ) ||
                            permisos.includes(
                                'reportes.cantidad_combustible_conductor'
                            ) ||
                            permisos.includes(
                                'reportes.cantidad_viajes_unidad'
                            ) ||
                            permisos.includes(
                                'reportes.g_cantidad_combustible_unidad'
                            )
                        "
                    >
                        REPORTES
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('reportes.usuarios')"
                    >
                        <router-link
                            :to="{ name: 'reportes.usuarios' }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Lista de Usuarios</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('reportes.solicitud_unidad')"
                    >
                        <router-link
                            :to="{ name: 'reportes.solicitud_unidad' }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Solicitud de Unidad</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes(
                                'reportes.cantidad_combustible_unidad'
                            )
                        "
                    >
                        <router-link
                            :to="{
                                name: 'reportes.cantidad_combustible_unidad',
                            }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Cantidad de combustible por Unidad</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes(
                                'reportes.cantidad_viajes_conductor'
                            )
                        "
                    >
                        <router-link
                            :to="{
                                name: 'reportes.cantidad_viajes_conductor',
                            }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Cantidad de Viajes por Conductor</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes(
                                'reportes.cantidad_combustible_conductor'
                            )
                        "
                    >
                        <router-link
                            :to="{
                                name: 'reportes.cantidad_combustible_conductor',
                            }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Cantidad de Combustible entregado al Conductor</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes(
                                'reportes.cantidad_viajes_unidad'
                            )
                        "
                    >
                        <router-link
                            :to="{
                                name: 'reportes.cantidad_viajes_unidad',
                            }"
                            class="nav-link"
                        >
                            <i class="fas fa-file-pdf nav-icon"></i>
                            <p>Cantidad de Viajes por Unidad</p>
                        </router-link>
                    </li>
                    <li
                        class="nav-item"
                        v-if="
                            permisos.includes(
                                'reportes.g_cantidad_combustible_unidad'
                            )
                        "
                    >
                        <router-link
                            :to="{
                                name: 'reportes.g_cantidad_combustible_unidad',
                            }"
                            class="nav-link"
                        >
                            <i class="fas fa-chart-bar nav-icon"></i>
                            <p>Cantidad de Combustible Entregado por Unidad</p>
                        </router-link>
                    </li>
                    <li class="nav-header bg-navy">OTRAS OPCIONES</li>
                    <li
                        class="nav-item"
                        v-if="permisos.includes('configuracion.index')"
                    >
                        <router-link
                            :to="{ name: 'configuracion' }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Configurar Sistema</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link
                            exact
                            :to="{
                                name: 'usuarios.perfil',
                                params: { id: user.id },
                            }"
                            class="nav-link"
                        >
                            <i class="nav-icon fas fa-user"></i>
                            <p>Perfil</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav-link"
                            @click.prevent="logout()"
                            v-loading.fullscreen.lock="fullscreenLoading"
                        >
                            <i class="fas fa-power-off nav-icon"></i>
                            <p>Cerrar Sesión</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    props: ["user_sidebar", "configuracion"],
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            fullscreenLoading: false,
            permisos:
                typeof localStorage.getItem("permisos") == "string"
                    ? JSON.parse(localStorage.getItem("permisos"))
                    : localStorage.getItem("permisos"),
            timeoutId: null,
        };
    },
    mounted() {
        // Configurar el temporizador para llamar a logout después de 10 minutos de inactividad
        this.resetLogoutTimer();
        window.addEventListener("mousemove", this.resetLogoutTimer);
    },
    methods: {
        logout() {
            this.fullscreenLoading = true;
            axios.post(main_url + "/logout").then((res) => {
                let self = this;
                setTimeout(function () {
                    self.$router.push({ name: "login" });
                    localStorage.clear();
                    location.reload();
                }, 500);
            });
        },
        resetLogoutTimer() {
            // Reiniciar el temporizador cuando se detecta actividad
            clearTimeout(this.timeoutId);
            this.timeoutId = setTimeout(() => {
                this.logout();
            }, 10 * 60 * 1000); // 10 minutos en milisegundos
        },
    },
    beforeDestroy() {
        // Limpiar el temporizador y quitar el evento cuando se destruye el componente
        clearTimeout(this.timeoutId);
        window.removeEventListener("mousemove", this.resetLogoutTimer);
    },
};
</script>

<style>
.user-panel .info {
    display: flex;
    height: 100%;
    align-items: center;
}
.user-panel .info a {
    font-size: 0.8em;
}

.main-sidebar .image img {
    min-height: 30px;
}
</style>
