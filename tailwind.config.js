/** @type {import('tailwindcss').Config} */
export default {
	darkMode: 'class',
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	theme: {
		extend: {
			colors: {
					'madeiraMadeiraPrimary': '#F58220',
					'madeiraMadeiraRusset': '#7B4110',
					'madeiraBackground': '#F9F9F9'
				}
		}
	},
	plugins: [],
}

