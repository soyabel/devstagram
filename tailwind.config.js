/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php", //agregamos las rutas donde vamos a utilizar todos las clases tailwind
    "./resources/**/*.blade.js",  //es este caso todos los archivos blade.php y js.php
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
