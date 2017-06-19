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
	'!assets/scss/login.scss',
	'!assets/scss/admin-color/*'
]
var css = 'assets/css/';
var login_scss = 'assets/scss/login.scss';
var scheme_scss = 'assets/scss/admin-color/*';

// JS Paths
var js_source = [
	'assets/js/src/scripts.js',
];
var js_compiled = 'assets/js/';

/**
* Smush the front end Styles and output
*/
gulp.task('sass', function(callback){
	pump([
		gulp.src(scss),
		sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}),
		autoprefix('last 15 version'),
		minifycss({keepBreaks: false}),
		gulp.dest(css),
		livereload(),
		notify('Admin Theme styles compiled & compressed.')
	], callback);
});


/**
* Login Styles
*/
gulp.task('login_styles', function(callback){
	pump([
		gulp.src(login_scss),
		sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}),
		autoprefix('last 15 version'),
		minifycss({keepBreaks: false}),
		gulp.dest(css),
		notify('Admin Login styles compiled & compressed.')
	], callback);
});


/**
* Admin Scheme Styles
*/
gulp.task('scheme_styles', function(callback){
	pump([
		gulp.src(scheme_scss),
		sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}),
		autoprefix('last 15 version'),
		minifycss({keepBreaks: false}),
		gulp.dest(css),
		notify('Admin Scheme styles compiled & compressed.')
	], callback);
});

/**
* Concatenate and uglify scripts
*/
gulp.task('js', function(callback){
	pump([
		gulp.src(js_source),
		concat('scripts.min.js'),
		gulp.dest(js_compiled),
		uglify(),
		gulp.dest(js_compiled),
		notify('Admin scripts compiles & compressed.')
	], callback);
});

/**
* Watch Task
*/
gulp.task('watch', function(){
	livereload.listen(8000);
	gulp.watch(scss, ['sass']);
	gulp.watch(js_source, ['js']);
	gulp.watch(login_scss, ['login_styles']);
	gulp.watch(scheme_scss, ['scheme_styles']);
});

/**
* Default
*/
gulp.task('default', ['sass', 'js', 'watch', 'login_styles', 'scheme_styles']);