import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        'node_modules/preline/dist/*.js',
    ],
    darkMode:"class",
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                cairo: ['Cairo', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
                righteous: ['Righteous', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                slate:{
                    10:'#272729',
                    20:'#5C668B',
                },
                purple:{
                    10:'#CAC0FF'
                },
                yellow:{
                    10:'#FDEDB7',
                    20:'#FFAE58'
                },
                green:{
                    10:'#D8EDF0',
                },
                hijau:{
                    10:'#4CD080',
                    20:'#105D38',
                    30:'#0F5533',
                    40:'#00373E'
                },
                oren:{
                    10:'#FFAE58          '
                }
                
            }
        },
    },

    plugins: [forms,
        require('preline/plugin'),
    ],
};
