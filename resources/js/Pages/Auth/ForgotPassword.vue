<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <Head title="Reset Password" />

    <div class="min-h-screen bg-night-city relative overflow-hidden">
        <!-- Scanlines Effect -->
        <div class="absolute inset-0 pointer-events-none scanlines"></div>

        <!-- Main Content -->
        <div
            class="relative min-h-screen flex items-center justify-center px-4"
        >
            <div class="w-full max-w-lg relative">
                <!-- Decorative Corner Elements -->
                <div class="absolute -top-2 -left-2 w-16 h-16">
                    <div
                        class="absolute top-0 left-0 w-full h-2 bg-yellow-500"
                    ></div>
                    <div
                        class="absolute top-0 left-0 h-full w-2 bg-yellow-500"
                    ></div>
                </div>
                <div class="absolute -bottom-2 -right-2 w-16 h-16">
                    <div
                        class="absolute bottom-0 right-0 w-full h-2 bg-yellow-500"
                    ></div>
                    <div
                        class="absolute bottom-0 right-0 h-full w-2 bg-yellow-500"
                    ></div>
                </div>

                <!-- Reset Form -->
                <div class="bg-black/80 border-2 border-yellow-500/20 p-8">
                    <div class="mb-8 text-center">
                        <h1
                            class="text-4xl font-cyber text-yellow-500 uppercase glitch-text"
                        >
                            Reset Access
                        </h1>
                        <div
                            class="mt-2 h-1 w-32 mx-auto bg-gradient-to-r from-transparent via-yellow-500 to-transparent"
                        ></div>
                    </div>

                    <div class="mb-6 text-sm text-yellow-500/80">
                        Lost your access codes? Enter your identification and
                        we'll transmit reset instructions to your registered
                        contact frequency.
                    </div>

                    <div
                        v-if="status"
                        class="mb-4 text-sm font-medium text-green-400"
                    >
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-1">
                            <InputLabel
                                for="email"
                                value="EMAIL"
                                class="text-yellow-500 font-cyber tracking-wider"
                            />
                            <div class="relative">
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="block w-full bg-black border-2 border-yellow-500/50 focus:border-yellow-500 focus:ring-0 text-yellow-500"
                                    required
                                    autofocus
                                />
                                <div
                                    class="absolute -bottom-0.5 -left-0.5 w-4 h-4 border-b-2 border-l-2 border-yellow-500"
                                ></div>
                                <div
                                    class="absolute -top-0.5 -right-0.5 w-4 h-4 border-t-2 border-r-2 border-yellow-500"
                                ></div>
                            </div>
                            <InputError
                                class="mt-1"
                                :message="form.errors.email"
                            />
                        </div>

                        <div class="pt-4">
                            <button
                                class="w-full py-3 bg-yellow-500/10 hover:bg-yellow-500/20 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all relative group uppercase z-10"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                <span class="relative z-10"
                                    >TRANSMIT RESET LINK</span
                                >
                            </button>
                        </div>

                        <div class="text-center mt-4 relative z-20">
                            <Link
                                :href="route('login')"
                                class="inline-flex items-center gap-2 text-yellow-500/80 text-sm font-cyber tracking-wider group"
                            >
                                <span
                                    class="text-yellow-500/60 group-hover:text-yellow-500/80 transition-colors"
                                    >[</span
                                >
                                Return to access terminal
                                <span
                                    class="text-yellow-500/60 group-hover:text-yellow-500/80 transition-colors"
                                    >]</span
                                >
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.scanlines {
    background: linear-gradient(
        to bottom,
        transparent 50%,
        rgba(0, 0, 0, 0.5) 50%
    );
    background-size: 100% 4px;
    animation: scanlines 0.2s linear infinite;
}

@keyframes scanlines {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(4px);
    }
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
</style>
