import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import ToastService from "primevue/toastservice";
import { createInertiaApp } from "@inertiajs/vue3";

import DefaultLayout from "./Layouts/DefaultLayout.vue"; // Import the DefaultLayout component
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page: any = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || DefaultLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(ToastService)
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                },
            })
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
