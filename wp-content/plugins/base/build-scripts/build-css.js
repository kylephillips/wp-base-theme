'use strict';

const sass = require('sass');
const postcss = require('postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..');

const entries = [
	{ input: 'assets/scss/style.scss', output: 'style.css' },
	{ input: 'assets/scss/block-editor.scss', output: 'block-editor.css' },
];

async function buildCSS() {
	for (const entry of entries) {
		const inputPath = path.join(ROOT, entry.input);
		const outputPath = path.join(ROOT, entry.output);

		const sassResult = sass.compile(inputPath);

		const postcssResult = await postcss([
			autoprefixer({ overrideBrowserslist: ['last 5 versions'] }),
			cssnano({ preset: 'default' }),
		]).process(sassResult.css, { from: inputPath, to: outputPath });

		fs.writeFileSync(outputPath, postcssResult.css);
		console.log(`Built ${entry.output}`);
	}
}

buildCSS().catch(err => {
	console.error(err.message || err);
	process.exit(1);
});
