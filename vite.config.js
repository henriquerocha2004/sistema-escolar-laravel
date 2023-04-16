import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
      host: 'localhost'
    },
    plugins: [
        laravel({
            input: [
                'resources/js/customAlpine.js',
                'resources/js/focus-trap.js',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/custom.css',
            ],
            refresh: true,

        }),
    ],
});
