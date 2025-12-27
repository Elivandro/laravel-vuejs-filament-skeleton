<template>

    <header>
        <nav class="bg-white sm:border-b border-gray-100 shadow-sm">
            <!-- Desktop Navigation -->
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between sm:h-16">
                    <div v-if="tenant" class="flex items-center justify-center">
                        <!-- Logo -->
                        <div v-if="tenant.logo" class="flex items-center shrink-0">
                            <NavLink :to="{ name: 'home' }" class="border-none">
                                <img :src="tenant.logo" :alt="tenant.name" class="h-16 object-contain block w-auto" />
                            </NavLink>
                        </div>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <NavLink :to="{ name: 'home' }">
                            Ínicio
                        </NavLink>

                        <NavLink :to="{ name: 'about' }">
                            Sobre
                        </NavLink>

                        <NavLink :to="{ name: 'contact' }">
                            Contato
                        </NavLink>
                    </div>
                </div>
            </div>
        </nav>
    </header>

</template>

<script>
import { mapGetters } from 'vuex';
import NavLink from '@/components/NavLink.vue';

export default {
    components: { NavLink },

    computed: {
        ...mapGetters('tenants', ['tenant']),
    },

    mounted() {
        this.$store.dispatch('tenants/getTenant');
    },
}
</script>