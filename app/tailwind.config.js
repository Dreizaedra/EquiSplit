/** @type {import('tailwindcss').Config} */
export default {
  /** ici il va falloir mettre les chemins des vues, on peut dire tous les fichiers qui se finisse par .php par exemple */
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
