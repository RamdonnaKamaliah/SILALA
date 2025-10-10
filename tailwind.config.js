import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inknut: ['"Inknut Antiqua"', 'serif'],
                Irish: ['Irish Grover'],
                mochiy: ['"Mochiy Pop One"', 'sans-serif'],
            },
            colors: {
                primary: '#A4B465',
            }
        },
    },

    plugins: [forms],
};
