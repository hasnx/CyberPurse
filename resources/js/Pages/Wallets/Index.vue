<script setup>
import { ref } from "vue";
import { useForm, Head, Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import WalletCard from "@/Components/WalletCard.vue";

const props = defineProps({
    wallets: Array,
});

const form = useForm({
    address: "",
    name: "",
});

const addWallet = () => {
    form.post(route("wallets.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Wallets" />

    <AppLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-2xl font-cyber text-yellow-500 uppercase glitch-text"
                >
                    Digital Wallets
                </h2>
                <Link
                    :href="route('wallets.create')"
                    class="py-2 px-4 bg-yellow-500/10 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all uppercase hover:bg-yellow-500/20"
                >
                    <span>Initialize New Wallet</span>
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Add Wallet Form -->
                <div
                    class="bg-black/80 border-2 border-yellow-500/20 p-8 mb-8 relative"
                >
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

                    <div class="relative">
                        <h3
                            class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                        >
                            Register New Wallet
                        </h3>
                        <form @submit.prevent="addWallet" class="space-y-6">
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
                            </div>

                            <div>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full py-3 bg-yellow-500/10 hover:bg-yellow-500/20 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all uppercase"
                                >
                                    Initialize Wallet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Grid of Wallets -->
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
                >
                    <WalletCard
                        v-for="wallet in wallets"
                        :key="wallet.id"
                        :wallet="wallet"
                        @delete="$refs[`delete-${wallet.id}`].submit()"
                    />
                </div>

                <!-- Hidden Delete Forms -->
                <form
                    v-for="wallet in wallets"
                    :key="`delete-${wallet.id}`"
                    :ref="`delete-${wallet.id}`"
                    :action="route('wallets.destroy', wallet.id)"
                    method="post"
                    class="hidden"
                >
                    <input type="hidden" name="_method" value="delete" />
                </form>

                <!-- Empty State -->
                <div
                    v-if="!wallets.length"
                    class="bg-black/80 border-2 border-yellow-500/20 p-8 text-center relative"
                >
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

                    <p class="text-yellow-500/60 font-cyber">
                        NO WALLETS DETECTED_
                        <br />
                        <span class="text-sm"
                            >Initialize a new wallet to begin monitoring</span
                        >
                    </p>
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
