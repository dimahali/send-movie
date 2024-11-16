const defaultTheme = require('tailwindcss/defaultTheme')

export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/helpers.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['"Mali"', 'cursive', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
}
