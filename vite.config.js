import { defineConfig } from 'vite';
import vue from "@vitejs/plugin-vue";
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path'

const projectRootDir = resolve(__dirname);

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            'ziggy-js': resolve(projectRootDir, 'vendor/tightenco/ziggy'),
        },
    },
});
