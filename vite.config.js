import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/less/site/style.less',
                'resources/assets/less/content-adm/style.less',
                'resources/assets/js/content-adm/index.js',
                'resources/assets/js/site/app.js'
            ],
            //refresh: true,
        }),
    ],
});