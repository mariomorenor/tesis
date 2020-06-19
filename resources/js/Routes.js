import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [{
            path: '/',
            name: 'app',
            components: require('./components/App'),
            children: [{
                    path: '/login',
                    name: 'login',
                    components: require('./components/views/auth/login')
                },
                ////**************Rutas Usuario*****************
                {
                    path: 'user',
                    name: 'user_index',
                    components: require('./components/views/user/index')
                },
                {
                    path: 'user/new',
                    name: 'user_create',
                    components: require('./components/views/user/create')
                },
                {
                    path: 'user/:id/edit',
                    name: 'user_edit',
                    components: require('./components/views/user/edit')
                },
                ////**************Rutas Control*****************
                {
                    path: 'control/lote',
                    name: 'control_lote_index',
                    components: require('./components/views/lote/control/index')
                },
                {
                    path: 'control/config',
                    name: 'control_lote_config',
                    components: require('./components/views/lote/control/config')
                },
                {
                    path: 'control/inicio',
                    name: 'control_lote_init',
                    components: require('./components/views/lote/control/init')
                },
                ////**************Rutas Reporte*****************
                {
                    path: 'reportes/lote',
                    name: 'reporte_lote_index',
                    components: require('./components/views/lote/reporte/index')
                },
                {
                    path: 'reportes/lote/:id',
                    name: 'reporte_lote_show',
                    components: require('./components/views/lote/reporte/show')
                },
                ////**************Rutas Soporte*****************
                {
                    path: '/soporte',
                    name: 'support',
                    components: require('./components/views/support/index')
                }
            ]
        },

    ]
});
