import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/css/libs.min.css',
                'resources/assets/scss/style.scss',
                'resources/assets/js/libs.min.js',
                'resources/assets/js/app.js'
            ],
            refresh: true,
        }),
    ],
});
