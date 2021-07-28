const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito Sans', 'Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        fontSize: {
                    'xs': '.65rem',
                    'sm': '.775rem',
                    'tiny': '.775rem',
                    'base': '.9rem',
                    'lg': '1.025rem',
                    'xl': '1.15rem',
                    '2xl': '1.1rem',
                    '3xl': '1.775rem',
                    '4xl': '2.15rem',
                    '5xl': '.9rem',
                    '6xl': '3.9rem',
                    '7xl': '4.9rem',
                }
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
    },

    plugins: [require('@tailwindcss/ui')],
};
