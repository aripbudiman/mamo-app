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
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                figtree: ['Figtree', ...defaultTheme.fontFamily.sans],
                cairo: ['Cairo', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
                righteous: ['Righteous', ...defaultTheme.fontFamily.sans],
            },
            height: {
                '15': '60px',
            },
            width:{
                '15':'60px'
            },
            padding: {
                '15': '60px',
              },
            colors:{
                slate:{
                    1:'#272729',
                    2:'#5C668B',
                    3:'#1D1D1D'
                },
                green:{
                    1:'#00B14F',
                    2:'#008E3F',
                    3:'#00B14F'
                },
                blue:{
                    1:'#4834d4',
                    2:'#37809E',
                },
                sky:{
                    1:'#0AAFD9'
                },
                red:{
                    1:'#eb4d4b'
                }
                // purple:{
                //     10:'#CAC0FF'
                // },
                // yellow:{
                //     10:'#FDEDB7',
                //     20:'#FFAE58'
                // },
                // green:{
                //     10:'#D8EDF0',
                // },
                // hijau:{
                //     10:'#4CD080',
                //     20:'#105D38',
                //     30:'#0F5533',
                //     40:'#00373E'
                // },
                // oren:{
                //     10:'#FFAE58          '
                // }
                
            }
        },
    },

    plugins: [forms,
        require('preline/plugin'),
    ],
};
