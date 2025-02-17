<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const sections = ref([
    {
        id: 1,
        title: "Information We Collect",
        content:
            "We collect information that you provide directly to us, including but not limited to your name, email address, and wallet addresses.",
    },
    {
        id: 2,
        title: "How We Use Your Information",
        content:
            "We use the information we collect to provide, maintain, and improve our services, to communicate with you, and to protect our users.",
    },
    {
        id: 3,
        title: "Information Sharing",
        content:
            "We do not share your personal information with third parties except as described in this privacy policy or with your explicit consent.",
    },
]);

const activeSection = ref(1);
</script>

<template>
    <Head title="Privacy Policy" />

    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-deep-space via-tech-noir to-matrix-black"
    >
        <div class="w-full max-w-5xl px-6 py-8">
            <h1
                class="text-4xl font-cyber text-plasma-pink mb-8 cyber-text-glow text-center"
            >
                Privacy Policy
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Navigation Sidebar -->
                <div class="lg:col-span-1">
                    <div class="cyber-card p-4 sticky top-8">
                        <nav class="space-y-2">
                            <button
                                v-for="section in sections"
                                :key="section.id"
                                @click="activeSection = section.id"
                                class="w-full text-left px-4 py-2 rounded transition-all"
                                :class="{
                                    'bg-plasma-pink/20 text-plasma-pink border-l-2 border-plasma-pink':
                                        activeSection === section.id,
                                    'text-gray-400 hover:text-plasma-pink hover:bg-plasma-pink/10':
                                        activeSection !== section.id,
                                }"
                            >
                                {{ section.title }}
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="lg:col-span-3">
                    <div class="cyber-card p-6 relative overflow-hidden">
                        <!-- Decorative Elements -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-10"
                        >
                            <div
                                class="w-full h-full border-t-2 border-r-2 border-plasma-pink rounded-tr-full"
                            ></div>
                        </div>
                        <div
                            class="absolute bottom-0 left-0 w-24 h-24 opacity-10"
                        >
                            <div
                                class="w-full h-full border-b-2 border-l-2 border-cyber-cyan rounded-bl-full"
                            ></div>
                        </div>

                        <!-- Scanner Line Effect -->
                        <div class="absolute inset-0 pointer-events-none">
                            <div
                                class="w-full h-px bg-gradient-to-r from-transparent via-plasma-pink to-transparent animate-scanline"
                            ></div>
                        </div>

                        <!-- Content -->
                        <div class="relative">
                            <TransitionGroup name="fade" mode="out-in">
                                <div
                                    v-for="section in sections"
                                    :key="section.id"
                                    v-show="activeSection === section.id"
                                    class="space-y-6"
                                >
                                    <h2
                                        class="text-2xl font-cyber text-cyber-cyan mb-4 cyber-text-glow"
                                    >
                                        {{ section.id }}. {{ section.title }}
                                    </h2>
                                    <p class="text-gray-300 leading-relaxed">
                                        {{ section.content }}
                                    </p>
                                </div>
                            </TransitionGroup>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
