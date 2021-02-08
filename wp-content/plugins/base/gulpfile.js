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
* Process the admin styles
*/
var styles = function(){
	return gulp.src(scss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 5 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css))
		.pipe(livereload())
		.pipe(notify('Theme plugin admin styles compiled & compressed.'));
}

/**
* Process the login styles
*/
var login_styles = function(){
	return gulp.src(login_scss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 5 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css))
		.pipe(livereload())
		.pipe(notify('Theme plugin login styles compiled & compressed.'));
}


var scheme_styles = function(){
	return gulp.src(scheme_scss)
		.pipe(sass({sourceComments: 'map', sourceMap: 'sass', style: 'compact'}))
		.pipe(autoprefix('last 5 version'))
		.pipe(minifycss({keepBreaks: false}))
		.pipe(gulp.dest(css))
		.pipe(livereload())
		.pipe(notify('Theme plugin color scheme styles compiled & compressed.'));
}

/**
* Concatenate and minify scripts
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
	gulp.watch(scss, gulp.series(login_styles));
	gulp.watch(scss, gulp.series(scheme_styles));
	gulp.watch(js_source, gulp.series(scripts));
});

/**
* Default
*/
gulp.task('default', gulp.series(styles, login_styles, scheme_styles, scripts, 'watch'));