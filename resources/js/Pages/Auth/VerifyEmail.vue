<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route("verification.send"));
};
</script>

<template>
    <Head title="Email Verification" />

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

                <!-- Verification Content -->
                <div class="bg-black/80 border-2 border-yellow-500/20 p-8">
                    <div class="mb-8 text-center">
                        <h1
                            class="text-4xl font-cyber text-yellow-500 uppercase glitch-text"
                        >
                            Verify Contact Frequency
                        </h1>
                        <div
                            class="mt-2 h-1 w-32 mx-auto bg-gradient-to-r from-transparent via-yellow-500 to-transparent"
                        ></div>
                    </div>

                    <div class="mb-8 text-sm text-yellow-500/80">
                        Thanks for signing up! Before getting started, could you
                        verify your email address by clicking on the link we
                        just emailed to you? If you didn't receive the email, we
                        will gladly send you another.
                    </div>

                    <div
                        v-if="status === 'verification-link-sent'"
                        class="mb-8 text-sm font-medium text-green-400"
                    >
                        A new verification link has been sent to the email
                        address you provided during registration.
                    </div>

                    <form @submit.prevent="submit">
                        <div class="flex items-center justify-between gap-4">
                            <button
                                class="flex-1 py-3 bg-yellow-500/10 hover:bg-yellow-500/20 border-2 border-yellow-500 text-yellow-500 font-cyber tracking-widest transition-all relative group uppercase z-10"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                <span class="relative z-10"
                                    >RESEND VERIFICATION</span
                                >
                            </button>

                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="py-3 px-6 bg-red-500/10 hover:bg-red-500/20 border-2 border-red-500 text-red-500 font-cyber tracking-widest transition-all uppercase"
                            >
                                LOGOUT
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
