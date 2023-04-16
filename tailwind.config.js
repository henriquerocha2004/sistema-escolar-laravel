/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  safelist: [
    'bg-red-500',
    'bg-green-500'
  ],
  plugins: [
      require('flowbite/plugin')
  ],
}

