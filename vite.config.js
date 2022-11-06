import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/less/Site/style.less',
                'resources/assets/less/Admin/style.less',
                'resources/assets/js/Admin/index.js',
                'resources/assets/js/Site/app.js'
               ],
            refresh: true,
        }),
    ],
});
