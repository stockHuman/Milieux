/*
	Arthem (c) 2018
	==
	run the whole shabang with `$ gulp` in the project directory
	install them all with
	$ npm i -D
		gulp gulp-sass
		gulp-babel
		gulp-concat
		gulp-uglify
		gulp-rename
		gulp-sourcemaps
		gulp-autoprefixer
		browserify
		babelify
		browser-sync
		vinyl-buffer
		vinyl-source-stream


	Note that this gulpfile uses Gulp 4 syntax
*/

const gulp = require('gulp')
const sass = require('gulp-sass')
const babel = require('gulp-babel')
const source = require('vinyl-source-stream')
const buffer = require('vinyl-buffer')
const concat = require('gulp-concat')
const uglify = require('gulp-uglify')
const rename = require('gulp-rename')
const browserify = require('browserify')
const sourcemaps = require('gulp-sourcemaps')
const autoprefixer = require('gulp-autoprefixer')
const browserSync = require('browser-sync').create()

const paths = {
	domain: '',
	theme: 'theme/',
	jsBase: 'scripts/',
	jsBuild: 'theme/assets/js/', // this is where the minified and concat'd project js build file will go
	styles: './scss/**/*.scss', // watch these directories
	stylesBuild: 'assets/css/', // this is where the minified, compiled css will go
	scripts: [{
		name: 'app',
		main: 'app/app.js',
		glob: ['app/*.js']
	}]
}

const config = {
	autoprefixer: {
		browsers: ['last 2 versions', '> 10%', 'Firefox ESR']
	},
	sass: {
		errLogToConsole: true,
		outputStyle: 'compressed' // compressed, compact, expanded
	},
	browserSync: {
		proxy: paths.domain
	}
}


paths.scripts.forEach(script => {
	// Compile each script
	gulp.task(script.name + '-js', function (callback) {

		let b = browserify({
			entries: paths.jsBase + script.main , // 'stories/main.js'
			presets: ['env'],
			transform: ['babelify'],
			extensions: ['.js'],
			debug: true
		})

		return b.bundle()
		.pipe(source(script.name + '.js'))
		.pipe(buffer())
		.pipe(sourcemaps.init({loadMaps: true}))
			.pipe(gulp.dest(paths.jsBuild))
			.pipe(rename(script.name + '.min.js'))
			.pipe(buffer())
			.pipe(uglify())
			.on('error', logError)
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(paths.jsBuild))
		.pipe(browserSync.reload({stream: true}))
		.on('end', callback)
	})
})



// SCSS compile
gulp.task('css', function (callback) {
	return gulp.src(paths.styles)
	.pipe(sourcemaps.init())
	.pipe(sass(config.sass))
	.pipe(sourcemaps.write())
	.on('error', logError)
	.pipe(autoprefixer(config.autoprefixer))
	.pipe(gulp.dest(paths.stylesBuild))
	.pipe(browserSync.reload({stream: true}))
	.on('end', callback)
})


// Live Reload
gulp.task('browserSync', () => browserSync.init( config.browserSync ))


// Watch Files For Changes (Scripts and Styles)
gulp.task('watch', () => {
	// create a watcher for each top-level script
	paths.scripts.forEach( script => {
		gulp.watch(paths.jsBase + script.glob)
		.on('change', gulp.series(script.name + '-js'))
	})
	gulp.watch(paths.styles).on('change', gulp.series('css'))
})


gulp.task( 'default' , gulp.parallel( 'browserSync', 'watch' ))


gulp.watch( 'gulpfile.js' ).on('change', () => process.exit(0) )


var logError =  function ( err ) {
	console.error( err.message )
	browserSync.notify(err.message, 3000) // Display error in the browser
	this.emit('end') // Prevent gulp from catching the error and exiting the watch process
}
