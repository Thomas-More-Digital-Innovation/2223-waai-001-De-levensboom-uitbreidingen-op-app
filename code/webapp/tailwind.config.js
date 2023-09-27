/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'wb-blue': "#3855a2",
        'wb-cyan': "#46ae93",
        'wb-yellow': "#f9cc3e",
        'wb-lightblue': "#b1b4dc",
        'wb-black': "#2e2e2e",
        'wb-orange': "#fade99",
      },
    },
  },
  plugins: [],
}