import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/candidate-dashboard.css',
                'resources/css/candidate-application-space.css',
                'resources/css/candidate-choix.css',
                'resources/css/candidate-profile.css',
                'resources/css/candidate-settings.css',
                'resources/css/candidate-apropos.css',
                'resources/css/candidate-notifications.css',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});