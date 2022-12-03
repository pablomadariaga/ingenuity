import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import purge from "@erbelion/vite-plugin-laravel-purgecss";

export default defineConfig({
    plugins: [
        purge({
            templates: ["blade"],
            safelist: {
                standard: [
                    "show",
                    "ss-main",
                    "disabled",
                    "nav-link",
                    "d-sm-flex",
                    "flex-fill",
                    "page-link",
                    "d-sm-none",
                    "page-item",
                    "pagination",
                    "flex-sm-fill",
                    "dropdown-toggle",
                    "justify-items-center",
                    "align-items-sm-center",
                    "justify-content-between",
                    "justify-content-sm-between",
                ],
                deep: [/^ss/],
            },
        }),
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/css/styles.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
