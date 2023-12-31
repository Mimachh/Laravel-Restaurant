/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    colors: {
      dark: "#1b1b1b",
      light: "rgb(255, 255, 255)",
      gold: "rgba(228,185,91,0.85)",
      primary: "#20202f", // 240,86,199
      primaryDark: "#e4b95b", // 80,230,217
      creme: "rgb(244, 242, 237)",
      nav: "#383848",
      error: "#FF0000",
      success: "#22543D",
      successBG: "#B2D8B2"
    },
    fontFamily: {
      'figtree': ['Figtree', 'sans-serif'],
      'poppins': ['Poppins', 'sans-serif'],
      'quicksand': ['Quicksand', 'sans-serif']
    }
  },
  plugins: [],
}

