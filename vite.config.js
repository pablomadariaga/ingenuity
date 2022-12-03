import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import purge from '@erbelion/vite-plugin-laravel-purgecss'

export default defineConfig({
    plugins: [
        /* purge({
            templates: ['blade'],
            safelist: ['nav-link', 'show', 'dropdown-toggle']
        }), */
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/css/styles.css",
                "resources/js/app.js"
            ],
            refresh: true,
        }),
    ],
});
