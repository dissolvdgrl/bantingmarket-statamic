module.exports = {
  content: [
    './resources/**/*.antlers.html',
    './resources/**/*.blade.php',
    './resources/**/*.vue',
    './content/**/*.md'
  ],
  theme: {
    extend: {
        fontFamily: {
            serif: ['Old Standard TT', 'serif'],
            'din-bold': ['din_bold'],
        },
        colors: {
          'dark-green': '#7ba982',
        },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
}
