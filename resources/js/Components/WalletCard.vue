<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    wallet: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="bg-black/80 border-2 border-yellow-500/20 relative group">
        <!-- Decorative Corner Elements -->
        <div class="absolute -top-1 -left-1 w-8 h-8">
            <div class="absolute top-0 left-0 w-full h-1 bg-yellow-500"></div>
            <div class="absolute top-0 left-0 h-full w-1 bg-yellow-500"></div>
        </div>
        <div class="absolute -bottom-1 -right-1 w-8 h-8">
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

        <!-- Wallet Content -->
        <div class="p-6">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-cyber text-yellow-500 mb-2">
                        {{ wallet.name }}
                    </h3>
                    <p class="text-yellow-500/60 font-mono text-sm break-all">
                        {{ wallet.address }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <Link
                        :href="route('wallets.edit', wallet.id)"
                        class="p-2 text-yellow-500/80 hover:text-yellow-500 transition-colors"
                    >
                        <span class="sr-only">Edit</span>
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                            />
                        </svg>
                    </Link>
                    <button
                        @click="$emit('delete')"
                        class="p-2 text-red-500/80 hover:text-red-500 transition-colors"
                    >
                        <span class="sr-only">Delete</span>
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                            />
                        </svg>
                    </button>
                    <Link
                        as="button"
                        method="post"
                        :href="route('wallets.refresh', wallet.id)"
                        class="p-2 text-yellow-500/80 hover:text-yellow-500 transition-colors"
                    >
                        <span class="sr-only">Refresh</span>
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                            />
                        </svg>
                    </Link>
                </div>
            </div>

            <!-- Wallet Balance -->
            <div class="mt-4 font-cyber">
                <div class="text-sm text-yellow-500/60 uppercase">Balance</div>
                <div class="text-xl text-yellow-500">
                    {{ wallet.balance }} ETH
                </div>
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
