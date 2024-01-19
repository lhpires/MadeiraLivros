import {createApp, h } from 'vue';
import { createInertiaApp,Link } from '@inertiajs/vue3';
import NProgress from 'nprogress';
import { router,Head } from '@inertiajs/vue3';
import route from 'ziggy-js';
import '../css/app.css';

router.on('start', () => NProgress.start());
router.on('finish', () => NProgress.done());

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {

        const VueApp = createApp({ render: () => h(App, props) });
        VueApp.config.globalProperties.$route = route;
        VueApp.component('Link',Link);
        VueApp.component('Head',Head).use(plugin).mount(el);
    },
});
