var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefix = require('gulp-autoprefixer');
var livereload = require('gulp-livereload');
var notify = require('gulp-notify');
var plumber = require('gulp-plumber');
var minifycss = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

// Style Paths
var scss = [
	'assets/scss/*',
	'!assets/scss/ie.scss'
]
var css = '';
var iescss = [
	'assets/scss/ie.scss'
];
var iecss = 'assets/css/';

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
		.pipe(plumber())
		.pipe(livereload())
		.pipe(notify('Theme styles compiled & compressed.'));
});


/**
* IE Styles
*/
gulp.task('iestyles', function(){
	return gulp.src(iescss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 15 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(iecss))
		.pipe(plumber())
		.pipe(notify('Theme IE styles compiled & compressed.'));
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
	livereload.listen(8000);
	gulp.watch(scss, ['sass']);
	gulp.watch(js_source, ['js']);
	gulp.watch(iescss, ['iestyles']);
});

/**
* Default
*/
gulp.task('default', ['sass', 'js', 'watch', 'iestyles']);