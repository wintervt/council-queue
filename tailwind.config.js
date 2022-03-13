const { fontFamily } = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            'xs': '360px',
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1200px',
            'xxl': '1440px'
        },
        fontFamily: {
            'sans': [
                'hind-vadodara',
                ...fontFamily.sans
            ],
        },
        extend: {},
    },
}
