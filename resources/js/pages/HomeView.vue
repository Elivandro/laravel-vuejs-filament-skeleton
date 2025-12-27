<template>
    <section class="max-w-4xl mx-auto px-6 py-16">
        <div v-if="tenant" class="bg-white rounded-lg shadow p-8">

            <!-- Logo -->
            <div v-if="tenant.logo" class="flex justify-center mb-6">
                <img :src="tenant.logo" :alt="tenant.name" class="h-32 object-contain rounded-full" />
            </div>

            <!-- Nome -->
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">
                {{ tenant.name }}
            </h1>

            <!-- Descrição -->
            <p class="text-gray-600 text-center mb-6">
                {{ tenant.description }}
            </p>

            <!-- Infos -->
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">

                <div>
                    <h3 class="font-semibold mb-1">Domínio</h3>
                    <p>
                        <a :href="'http://' + tenant.domains?.[0] ?? '—'" target="_blank">
                            https://{{ tenant.domains?.[0] ?? '—' }}
                        </a>
                    </p>
                </div>

                <div v-if="tenant.owner">
                    <h3 class="font-semibold mb-1">Usuário principal</h3>
                    <p>{{ tenant.owner.name }}</p>
                    <p class="text-sm text-gray-500">
                        {{ tenant.owner.email }}
                    </p>
                </div>

            </div>
        </div>

        <!-- Loading -->
        <div v-else class="text-center text-gray-500">
            Carregando informações do tenant...
        </div>
    </section>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'HomeView',

    computed: {
        ...mapGetters('tenants', ['tenant']),
    },

    mounted() {
        this.$store.dispatch('tenants/getTenant');
    },
};
</script>
