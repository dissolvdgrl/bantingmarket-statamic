import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
            detectTls: 'banting-market-statamic.test',
            server: {
                https: true,
                host: 'localhost',
            }
        }),
    ],
});
