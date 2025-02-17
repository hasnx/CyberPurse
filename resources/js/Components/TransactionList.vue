<script setup>
import { ref } from "vue";
import { formatDistance } from "date-fns";

const props = defineProps({
    transactions: {
        type: Array,
        required: true,
    },
});

const shortenAddress = (address) => {
    return `${address.slice(0, 6)}...${address.slice(-4)}`;
};

const formatValue = (value) => {
    return parseFloat(value).toFixed(6);
};

const getMethodName = (tx) => {
    if (!tx.raw_data) return "Transfer";
    const input = tx.raw_data.input || "";
    if (input === "0x") return "Transfer";
    // Add more method signature mappings as needed
    return "Contract Interaction";
};

const getStatusColor = (status) => {
    return (
        {
            success: "bg-green-900/50 text-green-400 border-green-500/20",
            failed: "bg-red-900/50 text-red-400 border-red-500/20",
            pending: "bg-yellow-900/50 text-yellow-400 border-yellow-500/20",
        }[status] || "bg-gray-900/50 text-gray-400 border-gray-500/20"
    );
};
</script>

<template>
    <div class="bg-gray-900 rounded-lg border border-pink-500/20">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-pink-500/20">
            <h3 class="text-xl font-semibold text-pink-500">Transactions</h3>
        </div>

        <!-- Transaction List -->
        <div class="divide-y divide-pink-500/10">
            <div
                v-for="tx in transactions"
                :key="tx.hash"
                class="p-4 hover:bg-gray-800/50 transition-colors"
            >
                <!-- Transaction Header -->
                <div class="flex justify-between items-start mb-2">
                    <div class="flex items-center space-x-2">
                        <span
                            :class="[
                                'px-2 py-1 text-xs font-medium rounded border',
                                getStatusColor(tx.status),
                            ]"
                        >
                            {{ tx.status }}
                        </span>
                        <span class="text-gray-400 text-sm">
                            {{
                                formatDistance(
                                    new Date(tx.transaction_date),
                                    new Date(),
                                    { addSuffix: true }
                                )
                            }}
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="text-cyan-400 font-mono font-medium">
                            {{ formatValue(tx.value) }} ETH
                        </div>
                    </div>
                </div>

                <!-- Transaction Details -->
                <div class="grid grid-cols-2 gap-4 mt-2">
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-400">From:</span>
                            <a
                                :href="`https://etherscan.io/address/${tx.from_address}`"
                                target="_blank"
                                class="text-pink-400 hover:text-pink-300 font-mono"
                            >
                                {{ shortenAddress(tx.from_address) }}
                            </a>
                        </div>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="text-gray-400">To:</span>
                            <a
                                :href="`https://etherscan.io/address/${tx.to_address}`"
                                target="_blank"
                                class="text-pink-400 hover:text-pink-300 font-mono"
                            >
                                {{ shortenAddress(tx.to_address) }}
                            </a>
                        </div>
                    </div>
                    <div class="text-right space-y-1">
                        <div>
                            <span class="text-gray-400 text-sm">Method:</span>
                            <span class="text-gray-300 ml-1">{{
                                getMethodName(tx)
                            }}</span>
                        </div>
                        <div>
                            <a
                                :href="`https://etherscan.io/tx/${tx.hash}`"
                                target="_blank"
                                class="text-xs text-pink-400 hover:text-pink-300"
                            >
                                View on Etherscan →
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Additional Transaction Info -->
                <div class="mt-2 text-xs text-gray-500">
                    <span>Block: {{ tx.block_number }}</span>
                    <span class="mx-2">•</span>
                    <span>Hash: {{ shortenAddress(tx.hash) }}</span>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div
            v-if="transactions.length === 0"
            class="p-8 text-center text-gray-400"
        >
            <p class="text-lg">No transactions found</p>
            <p class="text-sm text-gray-500 mt-1">
                Transactions will appear here once they are processed
            </p>
        </div>
    </div>
</template>
