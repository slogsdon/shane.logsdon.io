/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./pages/**/*.php",
    "./resources/partials/**/*.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['"IBM Plex Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        display: ['Fraunces', 'ui-serif', 'Georgia', 'serif'],
        mono: ['"JetBrains Mono"', 'ui-monospace', 'SFMono-Regular', 'Menlo', 'monospace'],
      },
      colors: {
        background: "hsl(var(--background))",
        foreground: "hsl(var(--foreground))",
        rule: "hsl(var(--rule))",
        "rule-strong": "hsl(var(--rule-strong))",
        "ink-soft": "hsl(var(--ink-soft))",
        "surface-muted": "var(--color-surface-muted)",
        muted: {
          DEFAULT: "hsl(var(--muted))",
          foreground: "hsl(var(--muted-foreground))",
        },
        accent: {
          DEFAULT: "hsl(var(--accent))",
          foreground: "hsl(var(--accent-foreground))",
        },
      },
      fontSize: {
        // v2 publication-cover scale — used sparingly on hero treatments
        "display-xxl": ["9rem",     { lineHeight: "0.96", letterSpacing: "-0.022em" }],
        "display-xl":  ["6rem",     { lineHeight: "1.0",  letterSpacing: "-0.02em" }],
        "display":     ["4.5rem",   { lineHeight: "1.05", letterSpacing: "-0.02em" }],
      },
      maxWidth: {
        prose: "64ch",        // tightened from v1's 68ch — denser column
        editorial: "1180px",
      },
      borderRadius: {
        DEFAULT: "var(--radius)",
      },
    },
  },
  plugins: [],
};
