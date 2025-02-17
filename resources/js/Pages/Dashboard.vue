<script setup>
import { Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { computed, onMounted } from "vue";

const props = defineProps({
    wallets: {
        type: Array,
        default: () => [],
    },
    totalBalance: {
        type: Number,
        default: 0,
    },
    recentTransactions: {
        type: Array,
        default: () => [],
    },
});

onMounted(() => {
    console.log("Wallets:", props.wallets);
    console.log("Total Balance:", props.totalBalance);
    console.log("Recent Transactions:", props.recentTransactions);
});

const totalWallets = computed(() => props.wallets?.length || 0);

const totalTransactions = computed(() => {
    if (!props.wallets) return 0;
    return props.wallets.reduce(
        (sum, wallet) => sum + (wallet.transactions?.length || 0),
        0
    );
});

const formatBalance = (balance) => {
    if (!balance) return "0.0000";
    return parseFloat(balance).toFixed(4);
};

const getTransactionStatus = (tx) => {
    return (
        {
            success: "text-green-500",
            failed: "text-red-500",
            pending: "text-yellow-500",
        }[tx?.status || "pending"] || "text-yellow-500/60"
    );
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <template #header>
            <h2
                class="text-2xl font-cyber text-yellow-500 uppercase glitch-text"
            >
                System Overview
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Total Balance -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="absolute -top-1 -left-1 w-8 h-8">
                            <div
                                class="absolute top-0 left-0 w-full h-1 bg-yellow-500"
                            ></div>
                            <div
                                class="absolute top-0 left-0 h-full w-1 bg-yellow-500"
                            ></div>
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                            >
                                Total Assets
                            </h3>
                            <p class="text-3xl text-yellow-500 font-cyber">
                                {{ formatBalance(totalBalance) }} ETH
                            </p>
                            <div class="mt-2 text-sm text-yellow-500/60">
                                Across all wallets
                            </div>
                        </div>
                    </div>

                    <!-- Wallet Count -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="absolute -top-1 -left-1 w-8 h-8">
                            <div
                                class="absolute top-0 left-0 w-full h-1 bg-yellow-500"
                            ></div>
                            <div
                                class="absolute top-0 left-0 h-full w-1 bg-yellow-500"
                            ></div>
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                            >
                                Active Wallets
                            </h3>
                            <p class="text-3xl text-yellow-500 font-cyber">
                                {{ totalWallets }}
                            </p>
                            <div class="mt-2 text-sm text-yellow-500/60">
                                Monitored addresses
                            </div>
                        </div>
                    </div>

                    <!-- Transaction Count -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="absolute -top-1 -left-1 w-8 h-8">
                            <div
                                class="absolute top-0 left-0 w-full h-1 bg-yellow-500"
                            ></div>
                            <div
                                class="absolute top-0 left-0 h-full w-1 bg-yellow-500"
                            ></div>
                        </div>
                        <div class="p-6">
                            <h3
                                class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                            >
                                Total Transactions
                            </h3>
                            <p class="text-3xl text-yellow-500 font-cyber">
                                {{ totalTransactions }}
                            </p>
                            <div class="mt-2 text-sm text-yellow-500/60">
                                Recorded operations
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wallet Quick View -->
                <div
                    class="bg-black/80 border-2 border-yellow-500/20 p-6 relative overflow-hidden"
                >
                    <h3
                        class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                    >
                        Active Wallets
                    </h3>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
                    >
                        <template v-if="wallets && wallets.length > 0">
                            <div
                                v-for="wallet in wallets"
                                :key="wallet.id"
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20 hover:bg-yellow-500/10 transition-colors"
                            >
                                <Link
                                    :href="route('wallets.show', wallet.id)"
                                    class="block"
                                >
                                    <div class="space-y-2">
                                        <!-- Wallet Name and Balance -->
                                        <div
                                            class="flex justify-between items-center"
                                        >
                                            <div>
                                                <div
                                                    class="font-cyber text-yellow-500"
                                                >
                                                    {{ wallet.name }}
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div
                                                    class="text-yellow-500 font-cyber"
                                                >
                                                    {{
                                                        formatBalance(
                                                            wallet.eth_balance
                                                        )
                                                    }}
                                                    ETH
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Wallet Address -->
                                        <div
                                            class="text-sm text-yellow-500/60 font-mono truncate border-t border-yellow-500/10 pt-2"
                                        >
                                            {{ wallet.address }}
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </template>
                        <div
                            v-else
                            class="col-span-3 text-center text-yellow-500/60 py-8"
                        >
                            No wallets found. Add one to get started.
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div
                    class="bg-black/80 border-2 border-yellow-500/20 p-6 relative overflow-hidden"
                >
                    <h3
                        class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                    >
                        Recent Activity
                    </h3>
                    <div class="space-y-4">
                        <template
                            v-if="
                                recentTransactions &&
                                recentTransactions.length > 0
                            "
                        >
                            <div
                                v-for="tx in recentTransactions"
                                :key="tx.hash"
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                            >
                                <div
                                    class="grid grid-cols-1 md:grid-cols-4 gap-4"
                                >
                                    <div>
                                        <div
                                            class="text-yellow-500/80 text-sm uppercase font-cyber"
                                        >
                                            Value
                                        </div>
                                        <div class="text-yellow-500 font-mono">
                                            {{ formatBalance(tx.value) }} ETH
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div
                                            class="text-yellow-500/80 text-sm uppercase font-cyber"
                                        >
                                            To
                                        </div>
                                        <div
                                            class="text-yellow-500/90 font-mono text-sm truncate"
                                        >
                                            {{ tx.to_address }}
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div
                                            class="text-yellow-500/80 text-sm uppercase font-cyber"
                                        >
                                            Status
                                        </div>
                                        <div
                                            :class="getTransactionStatus(tx)"
                                            class="font-cyber"
                                        >
                                            {{ tx.status.toUpperCase() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div v-else class="text-center text-yellow-500/60 py-8">
                            No recent transactions found.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.bg-night-city {
    background-image: linear-gradient(to bottom, #000000, #1a1a2e);
}

/* Add any additional custom styles here */
</style>
