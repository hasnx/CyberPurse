<script setup>
import { onMounted, ref } from "vue";
import { Chart } from "chart.js/auto";

const props = defineProps({
    tokens: {
        type: Array,
        required: true,
    },
});

const chartCanvas = ref(null);

onMounted(() => {
    const ctx = chartCanvas.value.getContext("2d");

    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: props.tokens.map((token) => token.symbol),
            datasets: [
                {
                    data: props.tokens.map((token) => token.pivot.balance),
                    backgroundColor: [
                        "rgba(234, 179, 8, 0.2)",
                        "rgba(234, 179, 8, 0.4)",
                        "rgba(234, 179, 8, 0.6)",
                        "rgba(234, 179, 8, 0.8)",
                    ],
                    borderColor: "rgba(234, 179, 8, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "right",
                    labels: {
                        color: "rgba(234, 179, 8, 0.8)",
                        font: {
                            family: "cyber",
                        },
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
