<script setup>
import { onMounted, ref } from "vue";
import { Chart } from "chart.js/auto";

const props = defineProps({
    transactions: {
        type: Array,
        required: true,
    },
});

const chartCanvas = ref(null);

onMounted(() => {
    const ctx = chartCanvas.value.getContext("2d");

    // Process data for the chart
    const last30Days = [...Array(30)].map((_, i) => {
        const date = new Date();
        date.setDate(date.getDate() - (29 - i));
        return date.toISOString().split("T")[0];
    });

    const transactionsByDate = last30Days.map((date) => {
        return {
            date,
            count: props.transactions.filter((tx) =>
                tx.transaction_date.startsWith(date)
            ).length,
        };
    });

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: transactionsByDate.map((d) => d.date),
            datasets: [
                {
                    label: "Transactions",
                    data: transactionsByDate.map((d) => d.count),
                    backgroundColor: "rgba(234, 179, 8, 0.2)",
                    borderColor: "rgba(234, 179, 8, 0.8)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "rgba(234, 179, 8, 0.6)",
                        font: {
                            family: "cyber",
                        },
                    },
                    grid: {
                        color: "rgba(234, 179, 8, 0.1)",
                    },
                },
                x: {
                    ticks: {
                        color: "rgba(234, 179, 8, 0.6)",
                        font: {
                            family: "cyber",
                        },
                        maxRotation: 45,
                        minRotation: 45,
                    },
                    grid: {
                        color: "rgba(234, 179, 8, 0.1)",
                    },
                },
            },
        },
    });
});
</script>

<template>
    <canvas ref="chartCanvas"></canvas>
</template>
