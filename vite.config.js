import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { VitePWA } from "vite-plugin-pwa";

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.ts',
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VitePWA({
            mode: "development",
            registerType: "autoUpdate",
            includeAssets: ["favicon.svg", "favicon.ico", "robots.txt", "safari-pinned-tab.svg"],
            manifest: {
                name: "OpenSquaire",
                short_name: "OSquaire",
                theme_color: "#8936FF",
                background_color: "#8936FF",
                display: "standalone",
                scope: "/",
                start_url: "/",
                icons: [
                    {
                        src: "/img/logo128.png",
                        sizes: "128x128",
                        type: "image/png",
                    },
                    {
                        src: "/img/logo512.png",
                        sizes: "512x512",
                        type: "image/png",
                    },
                ],
            },
        }),
    ],
});
