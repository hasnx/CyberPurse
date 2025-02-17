<script setup>
import { ref } from "vue";
import { Link, Head } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import TransactionList from "@/Components/TransactionList.vue";
import TransactionChart from "@/Components/TransactionChart.vue";
import TokenDistributionChart from "@/Components/TokenDistributionChart.vue";

const props = defineProps({
    wallet: Object,
});

const formatBalance = (balance) => {
    return parseFloat(balance).toFixed(4);
};

const activeTab = ref("overview");

const copyToClipboard = async (text) => {
    await navigator.clipboard.writeText(text);
    // Could add flash message here
};

const getTransactionValue = (tx) => {
    return parseFloat(tx.value).toLocaleString(undefined, {
        minimumFractionDigits: 4,
        maximumFractionDigits: 8,
    });
};

const getTimeSince = (dateString) => {
    const date = new Date(dateString);
    const seconds = Math.floor((new Date() - date) / 1000);

    let interval = seconds / 31536000;
    if (interval > 1) return Math.floor(interval) + " years ago";
    interval = seconds / 2592000;
    if (interval > 1) return Math.floor(interval) + " months ago";
    interval = seconds / 86400;
    if (interval > 1) return Math.floor(interval) + " days ago";
    interval = seconds / 3600;
    if (interval > 1) return Math.floor(interval) + " hours ago";
    interval = seconds / 60;
    if (interval > 1) return Math.floor(interval) + " minutes ago";
    return Math.floor(seconds) + " seconds ago";
};

const calculateSentVolume = () => {
    return props.wallet.transactions
        .filter((tx) => tx.from_address === props.wallet.address)
        .reduce((sum, tx) => sum + parseFloat(tx.value), 0)
        .toFixed(4);
};

const calculateReceivedVolume = () => {
    return props.wallet.transactions
        .filter((tx) => tx.to_address === props.wallet.address)
        .reduce((sum, tx) => sum + parseFloat(tx.value), 0)
        .toFixed(4);
};

const calculateSuccessRate = () => {
    if (!props.wallet.transactions.length) return "0.0";
    const successfulTx = props.wallet.transactions.filter(
        (tx) => tx.status === "success"
    ).length;
    return ((successfulTx / props.wallet.transactions.length) * 100).toFixed(1);
};

const getTopInteractions = () => {
    const interactions = {};
    props.wallet.transactions.forEach((tx) => {
        const interactionAddress =
            tx.from_address === props.wallet.address
                ? tx.to_address
                : tx.from_address;
        if (!interactions[interactionAddress]) {
            interactions[interactionAddress] = {
                address: interactionAddress,
                count: 0,
                volume: 0,
            };
        }
        interactions[interactionAddress].count++;
        interactions[interactionAddress].volume += parseFloat(tx.value);
    });
    return Object.values(interactions)
        .sort((a, b) => b.count - a.count)
        .slice(0, 5);
};
</script>

<template>
    <Head :title="`Wallet ${props.wallet.name}`" />

    <AppLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-2xl font-cyber text-yellow-500 uppercase glitch-text"
                >
                    Wallet Details
                </h2>
                <div class="flex gap-4">
                    <Link
                        :href="route('wallets.index')"
                        class="py-2 px-4 bg-yellow-500/10 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all uppercase hover:bg-yellow-500/20"
                    >
                        Return to Grid
                    </Link>
                    <button
                        @click="
                            $inertia.post(
                                route('wallets.refresh', props.wallet.id)
                            )
                        "
                        class="py-2 px-4 bg-yellow-500/10 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all uppercase hover:bg-yellow-500/20"
                    >
                        Sync Data
                    </button>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 p-6 relative overflow-hidden"
                    >
                        <div class="relative">
                            <h3
                                class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                            >
                                Total Value
                            </h3>
                            <p class="text-2xl text-yellow-500 font-cyber">
                                {{
                                    formatBalance(props.wallet.eth_balance)
                                }}
                                ETH
                            </p>
                            <p class="text-sm text-yellow-500/60 mt-1">
                                Last updated:
                                {{ getTimeSince(props.wallet.last_checked_at) }}
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 p-6 relative overflow-hidden"
                    >
                        <div class="relative">
                            <h3
                                class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                            >
                                Token Types
                            </h3>
                            <p class="text-2xl text-yellow-500 font-cyber">
                                {{ props.wallet.tokens.length }}
                            </p>
                            <p class="text-sm text-yellow-500/60 mt-1">
                                Unique tokens tracked
                            </p>
                        </div>
                    </div>

                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 p-6 relative overflow-hidden"
                    >
                        <div class="relative">
                            <h3
                                class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                            >
                                Transaction Count
                            </h3>
                            <p class="text-2xl text-yellow-500 font-cyber">
                                {{ props.wallet.transactions.length }}
                            </p>
                            <p class="text-sm text-yellow-500/60 mt-1">
                                Total transactions
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Wallet Details Card -->
                <div
                    class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                >
                    <div class="p-6 relative">
                        <div class="flex items-start justify-between mb-6">
                            <div>
                                <h3
                                    class="text-xl font-cyber text-yellow-500 uppercase mb-2"
                                >
                                    Wallet Information
                                </h3>
                                <p class="text-yellow-500/60">
                                    Detailed information about this wallet
                                </p>
                            </div>
                            <button
                                @click="copyToClipboard(props.wallet.address)"
                                class="p-2 text-yellow-500/80 hover:text-yellow-500 transition-colors"
                                title="Copy address"
                            >
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
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"
                                    />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3
                                    class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                                >
                                    Identifier
                                </h3>
                                <p class="text-xl text-yellow-500 font-cyber">
                                    {{ props.wallet.name }}
                                </p>
                            </div>
                            <div>
                                <h3
                                    class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                                >
                                    ETH Balance
                                </h3>
                                <p class="text-xl text-yellow-500 font-mono">
                                    {{ props.wallet.eth_balance }} ETH
                                </p>
                            </div>
                            <div class="md:col-span-2">
                                <h3
                                    class="text-lg font-cyber text-yellow-500/80 uppercase mb-2"
                                >
                                    Address
                                </h3>
                                <p
                                    class="text-yellow-500/90 font-mono break-all"
                                >
                                    {{ props.wallet.address }}
                                </p>
                            </div>

                            <!-- Additional Details -->
                            <div
                                class="md:col-span-2 grid grid-cols-1 md:grid-cols-3 gap-4 mt-4"
                            >
                                <div
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                                >
                                    <div
                                        class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                    >
                                        First Transaction
                                    </div>
                                    <div class="text-yellow-500">
                                        {{
                                            props.wallet.transactions.length
                                                ? getTimeSince(
                                                      props.wallet.transactions[
                                                          props.wallet
                                                              .transactions
                                                              .length - 1
                                                      ].transaction_date
                                                  )
                                                : "N/A"
                                        }}
                                    </div>
                                </div>
                                <div
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                                >
                                    <div
                                        class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                    >
                                        Last Activity
                                    </div>
                                    <div class="text-yellow-500">
                                        {{
                                            props.wallet.transactions.length
                                                ? getTimeSince(
                                                      props.wallet
                                                          .transactions[0]
                                                          .transaction_date
                                                  )
                                                : "N/A"
                                        }}
                                    </div>
                                </div>
                                <div
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                                >
                                    <div
                                        class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                    >
                                        Network
                                    </div>
                                    <div class="text-yellow-500">
                                        Ethereum Mainnet
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add after the wallet details card -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Transaction Activity Chart -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="p-6 relative">
                            <h3
                                class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                            >
                                Activity Chart
                            </h3>
                            <div class="h-64">
                                <TransactionChart
                                    :transactions="props.wallet.transactions"
                                    class="h-full w-full"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Token Distribution -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="p-6 relative">
                            <h3
                                class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                            >
                                Token Distribution
                            </h3>
                            <div class="h-64">
                                <TokenDistributionChart
                                    :tokens="props.wallet.tokens"
                                    class="h-full w-full"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Analytics Section -->
                <div
                    class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                >
                    <div class="p-6 relative">
                        <h3
                            class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                        >
                            Analytics
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Sent Volume -->
                            <div
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                            >
                                <div
                                    class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                >
                                    Sent Volume
                                </div>
                                <div class="text-yellow-500 font-mono">
                                    {{ calculateSentVolume() }} ETH
                                </div>
                            </div>

                            <!-- Received Volume -->
                            <div
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                            >
                                <div
                                    class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                >
                                    Received Volume
                                </div>
                                <div class="text-yellow-500 font-mono">
                                    {{ calculateReceivedVolume() }} ETH
                                </div>
                            </div>

                            <!-- Success Rate -->
                            <div
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                            >
                                <div
                                    class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                >
                                    Success Rate
                                </div>
                                <div class="text-yellow-500 font-mono">
                                    {{ calculateSuccessRate() }}%
                                </div>
                            </div>

                            <!-- Transaction Count -->
                            <div
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                            >
                                <div
                                    class="text-yellow-500/80 text-sm uppercase font-cyber mb-1"
                                >
                                    Total Transactions
                                </div>
                                <div class="text-yellow-500 font-mono">
                                    {{ props.wallet.transactions.length }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Interactions -->
                <div
                    class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                >
                    <div class="p-6 relative">
                        <h3
                            class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                        >
                            Top Interactions
                        </h3>
                        <div class="space-y-4">
                            <div
                                v-for="address in getTopInteractions()"
                                :key="address.address"
                                class="p-4 bg-yellow-500/5 border border-yellow-500/20"
                            >
                                <div class="flex justify-between items-center">
                                    <div>
                                        <div
                                            class="text-yellow-500/80 font-mono text-sm truncate"
                                        >
                                            {{ address.address }}
                                        </div>
                                        <div class="text-yellow-500/60 text-sm">
                                            {{ address.count }} transactions
                                        </div>
                                    </div>
                                    <div class="text-yellow-500 font-cyber">
                                        {{ address.volume.toFixed(4) }} ETH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="border-b border-yellow-500/20">
                    <nav class="-mb-px flex space-x-8">
                        <button
                            v-for="tab in [
                                'overview',
                                'tokens',
                                'transactions',
                            ]"
                            :key="tab"
                            @click="activeTab = tab"
                            class="py-4 px-1 font-cyber uppercase transition-colors"
                            :class="[
                                activeTab === tab
                                    ? 'border-b-2 border-yellow-500 text-yellow-500'
                                    : 'text-yellow-500/60 hover:text-yellow-500/80',
                            ]"
                        >
                            {{ tab }}
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div v-if="activeTab === 'overview'">
                    <!-- Token Holdings -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <!-- Decorative Elements (same as above) -->
                        <div class="p-6 relative">
                            <h3
                                class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                            >
                                Token Holdings
                            </h3>
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <div
                                    v-for="token in props.wallet.tokens"
                                    :key="token.id"
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20 relative group"
                                >
                                    <div class="font-cyber">
                                        <div
                                            class="text-yellow-500/80 text-sm uppercase"
                                        >
                                            {{ token.symbol }}
                                        </div>
                                        <div class="text-yellow-500 text-lg">
                                            {{ token.pivot.balance }}
                                        </div>
                                        <div
                                            class="text-yellow-500/60 text-xs mt-1 font-mono truncate"
                                        >
                                            {{ token.contract_address }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <!-- Decorative Elements (same as above) -->
                        <div class="p-6 relative">
                            <h3
                                class="text-xl font-cyber text-yellow-500 uppercase mb-6"
                            >
                                Recent Transactions
                            </h3>
                            <div class="space-y-4">
                                <div
                                    v-for="tx in props.wallet.transactions"
                                    :key="tx.hash"
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20 relative group"
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
                                            <div
                                                class="text-yellow-500 font-mono"
                                            >
                                                {{ tx.value }} ETH
                                            </div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <div
                                                class="text-yellow-500/80 text-sm uppercase font-cyber"
                                            >
                                                {{
                                                    tx.from_address ===
                                                    props.wallet.address
                                                        ? "To"
                                                        : "From"
                                                }}
                                            </div>
                                            <div
                                                class="text-yellow-500/90 font-mono text-sm truncate"
                                            >
                                                {{
                                                    tx.from_address ===
                                                    props.wallet.address
                                                        ? tx.to_address
                                                        : tx.from_address
                                                }}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div
                                                class="text-yellow-500/80 text-sm uppercase font-cyber"
                                            >
                                                Status
                                            </div>
                                            <div
                                                :class="{
                                                    'text-green-500':
                                                        tx.status === 'success',
                                                    'text-red-500':
                                                        tx.status === 'failed',
                                                }"
                                                class="font-cyber"
                                            >
                                                {{ tx.status.toUpperCase() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else-if="activeTab === 'tokens'">
                    <!-- Enhanced Token List -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="p-6 relative">
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4"
                            >
                                <div
                                    v-for="token in props.wallet.tokens"
                                    :key="token.id"
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20 relative group hover:bg-yellow-500/10 transition-colors"
                                >
                                    <div class="font-cyber">
                                        <div
                                            class="text-yellow-500/80 text-sm uppercase"
                                        >
                                            {{ token.symbol }}
                                        </div>
                                        <div class="text-yellow-500 text-lg">
                                            {{ token.pivot.balance }}
                                        </div>
                                        <div
                                            class="text-yellow-500/60 text-xs mt-1 font-mono truncate"
                                        >
                                            {{ token.contract_address }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else-if="activeTab === 'transactions'">
                    <!-- Enhanced Transaction List -->
                    <div
                        class="bg-black/80 border-2 border-yellow-500/20 relative overflow-hidden"
                    >
                        <div class="p-6 relative">
                            <div class="space-y-4">
                                <div
                                    v-for="tx in props.wallet.transactions"
                                    :key="tx.hash"
                                    class="p-4 bg-yellow-500/5 border border-yellow-500/20 relative group"
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
                                            <div
                                                class="text-yellow-500 font-mono"
                                            >
                                                {{ tx.value }} ETH
                                            </div>
                                        </div>
                                        <div class="md:col-span-2">
                                            <div
                                                class="text-yellow-500/80 text-sm uppercase font-cyber"
                                            >
                                                {{
                                                    tx.from_address ===
                                                    props.wallet.address
                                                        ? "To"
                                                        : "From"
                                                }}
                                            </div>
                                            <div
                                                class="text-yellow-500/90 font-mono text-sm truncate"
                                            >
                                                {{
                                                    tx.from_address ===
                                                    props.wallet.address
                                                        ? tx.to_address
                                                        : tx.from_address
                                                }}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div
                                                class="text-yellow-500/80 text-sm uppercase font-cyber"
                                            >
                                                Status
                                            </div>
                                            <div
                                                :class="{
                                                    'text-green-500':
                                                        tx.status === 'success',
                                                    'text-red-500':
                                                        tx.status === 'failed',
                                                }"
                                                class="font-cyber"
                                            >
                                                {{ tx.status.toUpperCase() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

.hover-trigger .hover-target {
    opacity: 0;
    transition: opacity 0.2s ease;
}

.hover-trigger:hover .hover-target {
    opacity: 1;
}
</style>
