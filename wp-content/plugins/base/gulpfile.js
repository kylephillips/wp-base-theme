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
	'!assets/scss/login.scss'
]
var css = 'assets/css/';
var login_scss = 'assets/scss/login.scss';

// JS Paths
var js_source = [
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
		.pipe(notify('Admin Theme styles compiled & compressed.'));
});


/**
* Login Styles
*/
gulp.task('login_styles', function(){
	return gulp.src(login_scss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 15 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css))
		.pipe(plumber())
		.pipe(notify('Admin Login styles compiled & compressed.'));
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
		.pipe(notify('Admin scripts compiles & compressed.'));
});

/**
* Watch Task
*/
gulp.task('watch', function(){
	livereload.listen(8000);
	gulp.watch(scss, ['sass']);
	gulp.watch(js_source, ['js']);
	gulp.watch(login_scss, ['login_styles']);
});

/**
* Default
*/
gulp.task('default', ['sass', 'js', 'watch', 'login_styles']);