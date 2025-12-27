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
                green: '#626F47', 
                green_dark: '#2F7A2F',
                green_soft: '#CCF6C2',
                cream: '#F5ECD5', 
                white: '#ffffff',
                kuning: '#F0BB78',
                cream_muda: '#F5ECD5',
                orange_200: '#F0EAD2',
                black: '#000000',
                pearl: '#F8F8F8',
                twetterdark: '#15202B',
                netral: '#192734',
                primary_dark: '#8a9a55',
                primary_medium: '#A4B465',
                primary_light: '#b8c685',
                primary_pale: '#f0f4e0',
                primary_bg: '#f8faf0'
            }
        },
    },

    plugins: [forms],
};
