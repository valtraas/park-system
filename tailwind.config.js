/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        poppin: ['Poppins']
      },
      colors: {
        sea: '#0073F0',
        putih: '#FDFDFD',
        active: '#E8BA46',
        button: '#F60909',
        second: '#0A56A8'
      },
      animation: {
        'bounce-slow': 'bounce 2s  infinite',
      }
    },
  },
  plugins: [],
}

