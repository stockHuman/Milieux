/*
	OBX labs (c) 2018
	==
	run the whole shabang with `$ gulp watch` in the project directory
	install them all with
	$ npm i -D gulp gulp-sass gulp-concat gulp-rename gulp-uglify browser-sync
*/

// SCSS, HTML, JS development
const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');
const browserSync = require('browser-sync').create();

// environment variables
const themeURL = 'http://localhost:8888/FPPSE'
const project = 'theme'
const assets = project + '/assets'

const scss = 'scss/**/*.scss'
const js = 'js/**/*.js'



gulp.task('sass', function () {
	return gulp.src(scss)
		.pipe(sass({ outputStyle: 'compressed' }).on('error', function (err) {
			console.error(err.message);
			browserSync.notify(err.message, 3000); // Display error in the browser
			this.emit('end'); // Prevent gulp from catching the error and exiting the watch process
		})) // Using gulp-sass
		.pipe(gulp.dest( assets + '/css/'))
		.pipe(browserSync.reload({
			stream: true
		}));
});

gulp.task('scripts', function() {
	return gulp.src(js)
		.pipe(concat('app.js'))
		.pipe(gulp.dest(assets + '/js/'))
		.pipe(rename('app.min.js'))
		.pipe(uglify().on('error', function (err) {
			console.error(err.message);
			browserSync.notify(err.message, 3000); // Display error in the browser
			this.emit('end'); // Prevent gulp from catching the error and exiting the watch process
		}))
		.pipe(gulp.dest(assets + '/js/'))
		.pipe(browserSync.reload({
			stream: true
		}));
});

// does browser live-reloading
// change to appropriate WordPress install directory / server configuration
gulp.task('browserSync', () =>
	browserSync.init({ proxy: themeURL })
)

// watches files for changes, adjust accordingly
gulp.task('watch', ['browserSync', 'sass', 'scripts'], function () {
	gulp.watch(scss, ['sass']);
	gulp.watch(js, ['scripts']);
})

gulp.task('default', ['watch'])

// stop old version of gulp watch from running when you modify the gulpfile
gulp.watch("gulpfile.js").on( "change", () => process.exit(0) )
