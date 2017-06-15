var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefix = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var minifycss = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

// Style Paths
var scss = [
	'assets/scss/*',
]
var css = '';

// JS Paths
var js_source = [
	'assets/js/src/jquery.fitvids.js',
	'assets/js/src/scripts.js',
];
var js_compiled = 'assets/js/';

/**
* Smush the front end Styles and output
*/
gulp.task('sass', function(){
	return gulp.src(scss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 15 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css))
		.pipe(livereload())
		.pipe(notify('Theme styles compiled & compressed.'));
});

/**
* Concatenate and uglify scripts
*/
gulp.task('js', function(){
	return gulp.src(js_source)
		.pipe(concat('scripts.min.js'))
		.pipe(gulp.dest(js_compiled))
		.pipe(uglify())
		.pipe(gulp.dest(js_compiled))
		.pipe(notify('Theme scripts compiles & compressed.'));
});

/**
* Watch Task
*/
gulp.task('watch', function(){
	livereload.listen();
	gulp.watch(scss, ['sass']);
	gulp.watch(js_source, ['js']);
});

/**
* Default
*/
gulp.task('default', ['sass', 'js', 'watch']);