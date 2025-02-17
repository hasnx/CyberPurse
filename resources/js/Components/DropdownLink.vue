<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        default: undefined,
    },
    as: {
        type: String,
        default: "button",
    },
});
</script>

<template>
    <div>
        <button
            v-if="as === 'button'"
            type="submit"
            class="block w-full px-4 py-2 text-left text-sm font-cyber hover:bg-yellow-500/10 transition-colors focus:outline-none"
        >
            <slot />
        </button>

        <Link
            v-else-if="as === 'link'"
            :href="href"
            class="block px-4 py-2 text-sm font-cyber hover:bg-yellow-500/10 transition-colors"
        >
            <slot />
        </Link>
    </div>
</template>
