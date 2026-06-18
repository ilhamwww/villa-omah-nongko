import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                bg: {
                    main: '#F6F4F2',
                    soft: '#FBFAF8',
                    card: '#FFFFFF',
                },
                text: {
                    main: '#161712',
                    muted: '#6F6A56',
                    soft: '#8C8F8D',
                    inverse: '#FFFFFF',
                },
                primary: {
                    DEFAULT: '#171A11',
                    2: '#1D2316',
                    3: '#272213',
                    soft: '#35321D',
                },
                olive: '#544E35',
                brown: '#94806E',
                'border-light': '#E0DEDB',
            },
            fontFamily: {
                sparkle: ['"Sparkle Passion"', 'cursive', 'sans-serif'],
                heading: ['"Cormorant Garamond"', '"Playfair Display"', 'Georgia', 'serif'],
                body: ['Inter', 'Manrope', ...defaultTheme.fontFamily.sans],
                sans: ['Inter', 'Manrope', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                container: '1240px',
                'container-wide': '1440px',
            },
            spacing: {
                'section-sm': '56px',
                'section-md': '88px',
                'section-lg': '120px',
            },
            borderRadius: {
                xs: '2px',
            },
            boxShadow: {
                photo: '0 18px 38px rgba(0,0,0,0.20)',
                card: '0 8px 24px rgba(0,0,0,0.045)',
            },
            letterSpacing: {
                widenav: '0.16em',
                widebtn: '0.14em',
            },
            keyframes: {
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
            },
            animation: {
                'fade-in': 'fade-in 0.3s ease-out',
            },
        },
    },
    plugins: [forms, typography],
};