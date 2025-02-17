import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                // Primary Backgrounds
                'deep-space': '#0D0D1F',
                'night-city': '#121212',
                'tech-noir': '#1A1A2E',
                'matrix-black': '#000913',

                // Secondary Backgrounds
                'neon-pink': '#9B0A3A',
                'cyber-purple': '#3E0064',
                'electric-blue': '#0A1A3B',
                'hacker-green': '#002B20',

                // Neon Accents
                'plasma-pink': '#FF0D6A',
                'cyber-cyan': '#00FFFF',
                'matrix-green': '#00FF00',
                'quantum-purple': '#BD00FF',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'cyber': ['Orbitron', 'sans-serif'],
                'cyber-mono': ['JetBrains Mono', 'monospace'],
            },
            animation: {
                'neon-pulse': 'neonPulse 2s infinite',
                'scanline': 'scanline 2s linear infinite',
            },
        },
    },

    plugins: [forms, typography],
};
