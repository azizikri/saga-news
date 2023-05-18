import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import vueJSX from '@vitejs/plugin-vue-jsx'

export default defineConfig({
    server: {
        host: 'saga-news.test',
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
        }),

        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),

        vueJSX(),
    ],
})
