// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: ["@kevinmarrec/nuxt-pwa", "@nuxtjs/tailwindcss"],
  devtools: { enabled: true },
  pwa: {
    manifest: {
      theme_color: "#3565f6",
      background_color: "#ffffff",
      display: "standalone",
      scope: "/",
      start_url: "/",
      name: "todo-app",
      short_name: "todo-app",
      description: "This is IF Todo App with Nuxtjs and Laravel.",
      icons: [
        {
          src: "/icon-192x192.png",
          sizes: "192x192",
          type: "image/png",
        },
        {
          src: "/icon-256x256.png",
          sizes: "256x256",
          type: "image/png",
        },
        {
          src: "/icon-384x384.png",
          sizes: "384x384",
          type: "image/png",
        },
        {
          src: "/icon-512x512.png",
          sizes: "512x512",
          type: "image/png",
        },
      ],
    },
  },
});
