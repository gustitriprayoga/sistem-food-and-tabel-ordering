import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    server: {
        host: '0.0.0.0', // Memungkinkan akses dari alamat IP eksternal/jaringan lokal
        hmr: {
            host: 'localhost', // Seringkali diperlukan untuk HMR agar berfungsi dengan baik
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
})
