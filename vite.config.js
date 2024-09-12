import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/сss/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
