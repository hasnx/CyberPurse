<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Banner from "@/Components/Banner.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import FlashMessage from "@/Components/FlashMessage.vue";

defineProps({
    title: String,
    message: String,
});

const showingNavigationDropdown = ref(false);
const glitchEffect = ref(false);

const logout = () => {
    glitchEffect.value = true;
    setTimeout(() => {
        router.post(route("logout"));
    }, 500);
};
</script>

<template>
    <div
        class="min-h-screen bg-night-city text-yellow-500 relative"
        :class="{ 'glitch-effect': glitchEffect }"
    >
        <!-- Scanlines Effect -->
        <div
            class="fixed inset-0 pointer-events-none scanlines opacity-20"
        ></div>

        <Head :title="title" />

        <!-- Flash Messages -->
        <FlashMessage
            v-if="$page.props.flash?.message"
            :message="$page.props.flash.message"
            class="z-50 relative"
        />
        <FlashMessage
            v-if="$page.props.flash?.success"
            :message="$page.props.flash.success"
        />
        <FlashMessage
            v-if="$page.props.flash?.error"
            :message="$page.props.flash.error"
            type="error"
        />

        <Banner />

        <nav
            class="bg-black/80 border-b border-yellow-500/20 backdrop-blur-sm relative z-20"
        >
            <!-- Nav Glow Effect -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Left Navigation -->
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <Link
                                :href="route('dashboard')"
                                class="font-cyber text-xl"
                            >
                                CyberWallet
                            </Link>
                        </div>

                        <div
                            class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                        >
                            <NavLink
                                :href="route('dashboard')"
                                :active="route().current('dashboard')"
                                class="font-cyber"
                            >
                                DASHBOARD
                            </NavLink>
                            <NavLink
                                :href="route('wallets.index')"
                                :active="route().current('wallets.*')"
                                class="font-cyber"
                            >
                                WALLETS
                            </NavLink>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <div class="ms-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        class="flex items-center text-sm font-cyber transition group"
                                        type="button"
                                    >
                                        <span
                                            class="text-yellow-500/80 group-hover:text-yellow-500 transition-colors"
                                        >
                                            {{ $page.props.auth.user.name }}
                                        </span>
                                        <svg
                                            class="ms-2 -me-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </template>

                                <template #content>
                                    <DropdownLink
                                        :href="route('profile.show')"
                                        as="link"
                                        class="font-cyber"
                                    >
                                        PROFILE
                                    </DropdownLink>

                                    <form @submit.prevent="logout">
                                        <DropdownLink
                                            as="button"
                                            class="font-cyber text-red-500"
                                        >
                                            DISCONNECT
                                        </DropdownLink>
                                    </form>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="inline-flex items-center justify-center p-2 text-yellow-500/60 hover:text-yellow-500 transition"
                        >
                            <svg
                                class="h-6 w-6"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }"
                class="sm:hidden"
            >
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink
                        :href="route('dashboard')"
                        :active="route().current('dashboard')"
                        class="font-cyber"
                    >
                        DASHBOARD
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        :href="route('wallets.index')"
                        :active="route().current('wallets.*')"
                        class="font-cyber"
                    >
                        WALLETS
                    </ResponsiveNavLink>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-yellow-500/20">
                    <div class="flex items-center px-4">
                        <div class="font-cyber">
                            <div class="text-base text-yellow-500">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="text-sm text-yellow-500/60">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('profile.show')"
                            class="font-cyber"
                        >
                            PROFILE
                        </ResponsiveNavLink>

                        <form method="POST" @submit.prevent="logout">
                            <ResponsiveNavLink
                                as="button"
                                class="font-cyber text-red-500"
                            >
                                DISCONNECT
                            </ResponsiveNavLink>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header
            v-if="$slots.header"
            class="bg-black/60 border-b border-yellow-500/20 backdrop-blur-sm relative z-10"
        >
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header" />
            </div>
        </header>

        <!-- Page Content -->
        <main class="relative z-0">
            <slot />
        </main>
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

.glitch-effect {
    animation: glitch 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
}

@keyframes glitch {
    0% {
        transform: translate(0);
    }
    20% {
        transform: translate(-2px, 2px);
    }
    40% {
        transform: translate(-2px, -2px);
    }
    60% {
        transform: translate(2px, 2px);
    }
    80% {
        transform: translate(2px, -2px);
    }
    100% {
        transform: translate(0);
    }
}

/* Hover effects for nav links */
.nav-link {
    position: relative;
    overflow: hidden;
}

.nav-link::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

.nav-link:hover::after {
    transform: translateX(100%);
}
</style>
