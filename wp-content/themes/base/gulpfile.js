var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefix = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var minifycss = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var pump = require('pump');

// Style Paths
var scss = [
	'assets/scss/*',
]
var css = __dirname;

// JS Paths
var js_source = [
	'assets/js/src/lib/jquery.fitvids.js',
	'assets/js/src/theme.factory.js',
];
var js_compiled = 'assets/js/';

/**
* Smush the front end Styles and output
*/
var styles = function(){
	return gulp.src(scss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 5 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css))
		.pipe(livereload())
		.pipe(notify('Theme styles compiled & compressed.'));
}

/**
* Concatenate and uglify scripts
*/
var scripts = function(){
	return gulp.src(js_source)
		.pipe(concat('scripts.min.js'))
		.pipe(uglify())
		.pipe(gulp.dest(js_compiled));
};

/**
* Watch Task
*/
gulp.task('watch', function(){
	livereload.listen();
	gulp.watch(scss, gulp.series(styles));
	gulp.watch(js_source, gulp.series(scripts));
});

/**
* Default
*/
gulp.task('default', gulp.series(styles, scripts, 'watch'));