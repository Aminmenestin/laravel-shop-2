import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/admin/admin.scss', 'resources/scss/home/home.scss', 'resources/js/admin/app.js', 'resources/js/home/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            $: 'jquery',
            jQuery: 'jquery',
        },
    },
});
