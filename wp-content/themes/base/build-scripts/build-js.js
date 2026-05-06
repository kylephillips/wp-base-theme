'use strict';

const esbuild = require('esbuild');
const fs = require('fs');
const path = require('path');

const ROOT = path.join(__dirname, '..');

// Files concatenated in order — matches original gulp build
const sources = [
	'assets/js/src/lib/jquery.fitvids.js',
	'assets/js/src/theme.scroll-to.js',
	'assets/js/src/theme.modals.js',
	'assets/js/src/theme.in-field-labels.js',
	'assets/js/src/theme.factory.js',
];

async function buildJS() {
	const combined = sources
		.map(f => fs.readFileSync(path.join(ROOT, f), 'utf8'))
		.join('\n');

	const result = await esbuild.transform(combined, {
		minify: true,
	});

	fs.writeFileSync(path.join(ROOT, 'assets/js/scripts.min.js'), result.code);
	console.log('Built scripts.min.js');
}

buildJS().catch(err => {
	console.error(err.message || err);
	process.exit(1);
});
