/**
 * @file
 * Gulp configuration.
 */

var gulp = require("gulp");
var sass = require("gulp-sass");

var notify = require("gulp-notify");
var bower  = require("gulp-bower");

//var concat = require('gulp-concat');
// Show in browser inspector in which SCSS file and line rule is defined.
var sourcemaps = require('gulp-sourcemaps');
var criticalCss = require('gulp-critical-css');

// Forget about manual browser refresh everytime you change CSS.
//var browserSync = require("browser-sync");
//var reload = browserSync.reload;
var shell = require('gulp-shell');
// Automatically create browser-related prefixes in CSS rules.
var autoprefixer = require('gulp-autoprefixer');

var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

var config = {
  sassPath: './sass',
  bowerDir: './bower_components/'
};

// TASK - Sass.
gulp.task('sass', function() {
  return gulp.src('./scss/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
        outputStyle: 'nested',
        //outputStyle: 'compressed',
        precison: 10,
        errLogToConsole: true,
        sourcemap: true,
        includePaths: [
          config.bowerDir + '/font-awesome/scss',
          config.bowerDir + '/normalize-scss/sass',
          config.bowerDir + '/bootstrap-sass/assets/stylesheets',
          config.bowerDir + '/breakpoint-sass/stylesheets',
          config.sassPath
        ],
        sourceMap: 'sass'
      })
        .on("error", notify.onError(function (error) {
          return "Error: " + error.message;
        }))
    )
    .pipe(autoprefixer(autoprefixerOptions))
    .pipe(criticalCss())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./css'));
});


// TASK - Bower.
gulp.task('bower', function() {
  return bower()
    .pipe(gulp.dest(config.bowerDir))
});

// TASK - fontawesome/
gulp.task('icons', function() {
  return gulp.src(config.bowerDir + '/fontawesome/fonts/**.*')
    .pipe(gulp.dest('./fonts'));
});

// Process JS files and return the stream.
gulp.task('js', function() {
  return gulp.src('js/*js')
    .pipe(gulp.dest('js'));
});

// Rerun the task when a file changes
gulp.task('watch', function() {
  gulp.watch("./scss/**/*.scss", ['sass']);
  gulp.watch("./js/*.js", ['js']);
});

// Default task to be run with `gulp`. //'bower', 'icons' 'bower', 'icons',
gulp.task('default', [ 'bower', 'icons', 'sass', 'js']);

