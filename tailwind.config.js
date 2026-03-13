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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                luno: {
                    primary: '#2563EB',
                    'primary-dark': '#1D4ED8',
                    'primary-light': '#DBEAFE',
                    
                    secondary: '#F59E0B',
                    
                    dark: '#0F172A',    
                    slate: '#64748B',    
                    surface: '#FFFFFF', 
                    bg: '#F8FAFC',      
                }
            },
            boxShadow: {
                'luno': '0 10px 15px -3px rgba(37, 99, 235, 0.1), 0 4px 6px -4px rgba(37, 99, 235, 0.05)',
                'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
            },
            borderRadius: {
                'xl': '1rem',
                '2xl': '1.5rem',
                '3xl': '2rem',
            }
        },
    },

    plugins: [forms],
};