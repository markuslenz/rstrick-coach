import '../css/app.css';

import { createInertiaApp, usePage } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h, watch } from 'vue';
import createI18n from './i18n';

import { initializeTheme } from './composables/useAppearance';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob<DefineComponent>('./pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        // i18n Instanz speichern
        const i18n = createI18n(props.initialPage)

        const vueApp = createApp({
            render: () => h(App, props),
        })

        vueApp
            .use(plugin)
            .use(i18n)
            .mount(el)
        
        const page = usePage()

        watch(
            () => page.props.locale,
            (newLocale) => {
                if (newLocale) {
                    i18n.global.locale.value = newLocale
                }
            }
        )
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
