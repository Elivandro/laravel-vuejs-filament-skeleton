<script setup>
import { computed } from 'vue'
import { useRoute, RouterLink } from 'vue-router'

const props = defineProps({
    to: {
        type: [String, Object],
        required: true,
    }
})

const route = useRoute()

const isActive = computed(() => {
    if (typeof props.to === 'string') {
        return route.path === props.to
    }
    if (props.to.name) {
        return route.name === props.to.name
    }
    return false
})

const activeClasses =
    'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'

const inactiveClasses =
    'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'

const classes = computed(() => isActive.value ? activeClasses : inactiveClasses);
</script>

<template>
    <RouterLink :to="to" :class="classes">
        <slot />
    </RouterLink>
</template>
