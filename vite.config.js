import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
<<<<<<< HEAD
                'resources/css/welcome.css',
                'resources/css/global.css',
                'resources/css/navbar.css',
                'resources/css/auth/login.css',
                'resources/css/auth/register.css',
                'resources/css/candidate-application-space.css',
                'resources/css/candidate-apropos.css',
                'resources/css/candidate-choix.css',
                'resources/css/candidate-dashboard.css',
                'resources/css/candidate-notifications.css',
                'resources/css/candidate-profile.css',
                'resources/css/candidate-settings.css',
                'resources/js/app.js',
=======
                'resources/js/app.js',
                'resources/css/auth/login.css',
                'resources/css/auth/register.css',
                'resources/css/global.css',
                'resources/css/navbar.css',
                'resources/css/candidate-dashboard.css',
                'resources/css/candidate-application-space.css',
                'resources/css/candidate-choix.css',
                'resources/css/candidate-profile.css',
                'resources/css/candidate-settings.css',
                'resources/css/candidate-apropos.css',
                'resources/css/candidate-notifications.css',
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
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
<<<<<<< HEAD
});
=======
});
>>>>>>> c197336818e36134310417f97a6a0f1ef03adec6
