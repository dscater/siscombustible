import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    base: "/" + app_base,
    routes: [
        // INICIO
        {
            path: "/",
            name: "inicio",
            component: require("./components/Inicio.vue").default,
        },

        // LOGIN
        {
            path: "/login",
            name: "login",
            component: require("./Auth.vue").default,
        },

        // Usuarios
        {
            path: "/usuarios/perfil/:id",
            name: "usuarios.perfil",
            component: require("./components/modulos/usuarios/perfil.vue")
                .default,
            props: true,
        },
        {
            path: "/usuarios",
            name: "usuarios.index",
            component: require("./components/modulos/usuarios/index.vue")
                .default,
        },

        // Unidads
        {
            path: "/unidads",
            name: "unidads.index",
            component: require("./components/modulos/unidads/index.vue")
                .default,
        },

        // Conductors
        {
            path: "/conductors",
            name: "conductors.index",
            component: require("./components/modulos/conductors/index.vue")
                .default,
        },

        // Vehiculos
        {
            path: "/vehiculos",
            name: "vehiculos.index",
            component: require("./components/modulos/vehiculos/index.vue")
                .default,
        },

        // Unidad Solicitante
        {
            path: "/unidad_solicitantes",
            name: "unidad_solicitantes.index",
            component:
                require("./components/modulos/unidad_solicitantes/index.vue")
                    .default,
        },

        // Solicitud Combustibles
        {
            path: "/solicitud_combustibles",
            name: "solicitud_combustibles.index",
            component:
                require("./components/modulos/solicitud_combustibles/index.vue")
                    .default,
        },
        {
            path: "/solicitud_combustibles/create",
            name: "solicitud_combustibles.create",
            component:
                require("./components/modulos/solicitud_combustibles/create.vue")
                    .default,
        },
        {
            path: "/solicitud_combustibles/:id",
            name: "solicitud_combustibles.edit",
            component:
                require("./components/modulos/solicitud_combustibles/edit.vue")
                    .default,
            props: true,
        },

        // Recorrido Viajes
        {
            path: "/recorrido_viajes",
            name: "recorrido_viajes.index",
            component:
                require("./components/modulos/recorrido_viajes/index.vue")
                    .default,
        },
        {
            path: "/recorrido_viajes/create",
            name: "recorrido_viajes.create",
            component:
                require("./components/modulos/recorrido_viajes/create.vue")
                    .default,
        },
        {
            path: "/recorrido_viajes/:id",
            name: "recorrido_viajes.edit",
            component: require("./components/modulos/recorrido_viajes/edit.vue")
                .default,
            props: true,
        },

        // Configuración
        {
            path: "/administracion/configuracion",
            name: "configuracion",
            component: require("./components/modulos/configuracion/index.vue")
                .default,
            props: true,
        },

        // Reportes
        {
            path: "/reportes/usuarios",
            name: "reportes.usuarios",
            component: require("./components/modulos/reportes/usuarios.vue")
                .default,
            props: true,
        },
        {
            path: "/reportes/solicitud_unidad",
            name: "reportes.solicitud_unidad",
            component:
                require("./components/modulos/reportes/solicitud_unidad.vue")
                    .default,
            props: true,
        },
        {
            path: "/reportes/cantidad_combustible_unidad",
            name: "reportes.cantidad_combustible_unidad",
            component:
                require("./components/modulos/reportes/cantidad_combustible_unidad.vue")
                    .default,
            props: true,
        },
        {
            path: "/reportes/cantidad_viajes_conductor",
            name: "reportes.cantidad_viajes_conductor",
            component:
                require("./components/modulos/reportes/cantidad_viajes_conductor.vue")
                    .default,
            props: true,
        },
        {
            path: "/reportes/cantidad_combustible_conductor",
            name: "reportes.cantidad_combustible_conductor",
            component:
                require("./components/modulos/reportes/cantidad_combustible_conductor.vue")
                    .default,
            props: true,
        },
        {
            path: "/reportes/cantidad_viajes_unidad",
            name: "reportes.cantidad_viajes_unidad",
            component:
                require("./components/modulos/reportes/cantidad_viajes_unidad.vue")
                    .default,
            props: true,
        },
        {
            path: "/reportes/g_cantidad_combustible_unidad",
            name: "reportes.g_cantidad_combustible_unidad",
            component:
                require("./components/modulos/reportes/g_cantidad_combustible_unidad.vue")
                    .default,
            props: true,
        },

        // PÁGINA NO ENCONTRADA
        {
            path: "*",
            component: require("./components/modulos/errors/404.vue").default,
        },
    ],
    mode: "history",
    linkActiveClass: "active open",
});
