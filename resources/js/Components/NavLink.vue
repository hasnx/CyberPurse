<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
});

const classes = computed(() => {
    return props.active
        ? "inline-flex items-center px-1 pt-1 border-b-2 border-yellow-500 text-sm font-cyber text-yellow-500"
        : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-cyber text-yellow-500/60 hover:text-yellow-500 hover:border-yellow-500/40 transition-colors duration-150 ease-in-out";
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
