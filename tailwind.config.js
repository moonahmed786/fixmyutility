import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#7C5C3E',
                    50:  '#F5EDE4',
                    100: '#EBDAC8',
                    200: '#D7B591',
                    300: '#C49060',
                    400: '#A87041',
                    500: '#7C5C3E',
                    600: '#6B4F35',
                    700: '#5A422C',
                    800: '#493523',
                    900: '#38281A',
                },
                secondary: {
                    DEFAULT: '#C49A72',
                    50:  '#FBF5EE',
                    100: '#F7EBDD',
                    200: '#EFD7BB',
                    300: '#E7C399',
                    400: '#D9AF7F',
                    500: '#C49A72',
                    600: '#B38457',
                    700: '#9A6E3E',
                    800: '#7D592F',
                    900: '#6A4A28',
                },
                accent: {
                    DEFAULT: '#E8A87C',
                    50:  '#FDF6F0',
                    100: '#FBEEE0',
                    200: '#F7DDC1',
                    300: '#F3CCA2',
                    400: '#EFBB83',
                    500: '#E8A87C',
                    600: '#DF9259',
                    700: '#D47A35',
                    800: '#B86320',
                    900: '#9A521A',
                },
                background: {
                    DEFAULT: '#FAF6F0',
                },
                dark: {
                    DEFAULT: '#3D2B1F',
                    50:  '#F2EBE7',
                    100: '#E5D7CF',
                    200: '#CBAF9F',
                    300: '#B1876F',
                    400: '#7D5A47',
                    500: '#3D2B1F',
                    600: '#36261C',
                    700: '#2F2118',
                    800: '#281C14',
                    900: '#211710',
                },
            },
            fontFamily: {
                sans:    ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
