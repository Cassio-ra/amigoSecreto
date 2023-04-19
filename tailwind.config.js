/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/app/*.blade.php",
    "./resources/views/*.blade.php",
    "./resources/views/**/*.blade.php",
  ],
  theme: {
    screens: {},
    extend: {},
  },
  plugins: [],
  darkMode: 'class',
}

