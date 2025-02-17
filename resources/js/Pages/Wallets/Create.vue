<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

const form = useForm({
    address: "",
    name: "",
});

const submit = () => {
    form.post(route("wallets.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Add Wallet" />

    <AppLayout>
        <template #header>
            <h2
                class="text-2xl font-cyber text-yellow-500 uppercase glitch-text"
            >
                Initialize New Wallet
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-black/80 border-2 border-yellow-500/20 relative">
                    <!-- Decorative Corner Elements -->
                    <div class="absolute -top-1 -left-1 w-8 h-8">
                        <div
                            class="absolute top-0 left-0 w-full h-1 bg-yellow-500"
                        ></div>
                        <div
                            class="absolute top-0 left-0 h-full w-1 bg-yellow-500"
                        ></div>
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
                    <div
                        class="absolute inset-0 overflow-hidden pointer-events-none"
                    >
                        <div
                            class="w-full h-px bg-gradient-to-r from-transparent via-yellow-500/50 to-transparent animate-scanline"
                        ></div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-8 relative">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label
                                    for="address"
                                    class="block text-sm font-cyber text-yellow-500/80 uppercase tracking-wider mb-2"
                                >
                                    Ethereum Address
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="address"
                                        v-model="form.address"
                                        class="block w-full bg-black border-2 border-yellow-500/50 focus:border-yellow-500 focus:ring-0 text-yellow-500 font-mono placeholder-yellow-500/30"
                                        placeholder="0x..."
                                        required
                                    />
                                    <div
                                        class="absolute -bottom-0.5 -left-0.5 w-4 h-4 border-b-2 border-l-2 border-yellow-500"
                                    ></div>
                                    <div
                                        class="absolute -top-0.5 -right-0.5 w-4 h-4 border-t-2 border-r-2 border-yellow-500"
                                    ></div>
                                </div>
                                <p
                                    v-if="form.errors.address"
                                    class="mt-1 text-sm text-red-400"
                                >
                                    {{ form.errors.address }}
                                </p>
                            </div>

                            <div>
                                <label
                                    for="name"
                                    class="block text-sm font-cyber text-yellow-500/80 uppercase tracking-wider mb-2"
                                >
                                    Wallet Identifier
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        id="name"
                                        v-model="form.name"
                                        class="block w-full bg-black border-2 border-yellow-500/50 focus:border-yellow-500 focus:ring-0 text-yellow-500 placeholder-yellow-500/30"
                                        placeholder="Enter identifier..."
                                    />
                                    <div
                                        class="absolute -bottom-0.5 -left-0.5 w-4 h-4 border-b-2 border-l-2 border-yellow-500"
                                    ></div>
                                    <div
                                        class="absolute -top-0.5 -right-0.5 w-4 h-4 border-t-2 border-r-2 border-yellow-500"
                                    ></div>
                                </div>
                                <p
                                    v-if="form.errors.name"
                                    class="mt-1 text-sm text-red-400"
                                >
                                    {{ form.errors.name }}
                                </p>
                            </div>

                            <div
                                class="flex items-center justify-end gap-4 pt-4"
                            >
                                <Link
                                    :href="route('wallets.index')"
                                    class="inline-flex items-center gap-2 text-yellow-500/80 text-sm font-cyber tracking-wider group"
                                >
                                    <span
                                        class="text-yellow-500/60 group-hover:text-yellow-500/80 transition-colors"
                                        >[</span
                                    >
                                    Return to wallets
                                    <span
                                        class="text-yellow-500/60 group-hover:text-yellow-500/80 transition-colors"
                                        >]</span
                                    >
                                </Link>

                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="py-3 px-6 bg-yellow-500/10 hover:bg-yellow-500/20 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all uppercase"
                                >
                                    Initialize
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
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

.glitch-text {
    text-shadow: 2px 2px #ff0000, -2px -2px #00ff00;
    animation: glitch 0.5s infinite;
}

@keyframes glitch {
    0% {
        text-shadow: 2px 2px #ff0000, -2px -2px #00ff00;
    }
    25% {
        text-shadow: -2px 2px #ff0000, 2px -2px #00ff00;
    }
    50% {
        text-shadow: 2px -2px #ff0000, -2px 2px #00ff00;
    }
    75% {
        text-shadow: -2px -2px #ff0000, 2px 2px #00ff00;
    }
    100% {
        text-shadow: 2px 2px #ff0000, -2px -2px #00ff00;
    }
}

input {
    @apply py-3 px-4;
}

input::placeholder {
    @apply font-cyber;
}
</style>
