<script setup>
import { ref, onMounted } from "vue";

const props = defineProps({
    message: String,
    type: {
        type: String,
        default: "success",
    },
});

const show = ref(true);

onMounted(() => {
    setTimeout(() => {
        show.value = false;
    }, 3000);
});
</script>

<template>
    <div
        v-if="show"
        class="fixed top-4 right-4 z-50 max-w-sm"
        @click="show = false"
    >
        <div
            class="bg-black/80 border-2 border-yellow-500/20 p-4 relative cursor-pointer"
        >
            <!-- Decorative Corner Elements -->
            <div class="absolute -top-1 -left-1 w-4 h-4">
                <div
                    class="absolute top-0 left-0 w-full h-1 bg-yellow-500"
                ></div>
                <div
                    class="absolute top-0 left-0 h-full w-1 bg-yellow-500"
                ></div>
            </div>
            <div class="absolute -bottom-1 -right-1 w-4 h-4">
                <div
                    class="absolute bottom-0 right-0 w-full h-1 bg-yellow-500"
                ></div>
                <div
                    class="absolute bottom-0 right-0 h-full w-1 bg-yellow-500"
                ></div>
            </div>

            <!-- Scanner Line -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div
                    class="w-full h-px bg-gradient-to-r from-transparent via-yellow-500/50 to-transparent animate-scanline"
                ></div>
            </div>

            <div class="relative text-yellow-500 font-cyber">
                {{ message }}
            </div>
        </div>
    </div>
</template>

<style scoped>
@keyframes scanline {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(100%);
    }
}

.animate-scanline {
    animation: scanline 2s linear infinite;
}
</style>
