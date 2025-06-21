import laravel from 'laravel-vite-plugin'
import { defineConfig } from 'vite'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            transformOnServe: (code) => code.replaceAll('/images', 'http://localhost:8000/images'),
            refresh: true,
            detectTls: 'banting-market-statamic.test',
            server: {
                https: true,
                host: 'localhost',
            }
        }),
    ],
});
