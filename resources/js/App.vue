<template>
    <Header />

    <main class="container mx-auto min-h-screen">
        <div class="px-4 mt-12">
            <router-view />
        </div>
    </main>

    <Footer />
</template>

<script>
import Header from '@/layout/Header.vue';
import Footer from '@/layout/Footer.vue';

export default {
    components: { Header, Footer },

    mounted() {
        this.updateIcons();

        const media = window.matchMedia('(prefers-color-scheme: dark)');
        media.addEventListener('change', this.updateIcons);
    },

    methods: {
        updateIcons() {
            const scheme = window.matchMedia('(prefers-color-scheme: dark)').matches
                ? 'dark'
                : 'light';

            const icons = document.head.querySelectorAll('link[rel="icon"]');

            if (!icons.length) return;

            icons.forEach(el => {
                const url = el.dataset[scheme];
                if (url) el.href = url;
            });
        }
    }
};
</script>
