const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');

// Compile and minify SCSS to CSS
gulp.task('scss', function() {
  return gulp.src('scss/main.scss') // Source path for SCSS file
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS()) // Minify the compiled CSS
    .pipe(rename({ suffix: '-min' })) // Rename to main-min.css
    .pipe(gulp.dest('css')); // Destination path for minified CSS
});

// Minify JavaScript
gulp.task('js', function() {
  return gulp.src('js/main.js') // Source path for JavaScript file
    .pipe(uglify())
    .pipe(rename({ suffix: '-min' })) // Rename to main-min.js
    .pipe(gulp.dest('js')); // Destination path for minified JavaScript
});

// Watch for changes
gulp.task('watch', function() {
  gulp.watch('scss//*.scss', gulp.series('scss'));
  gulp.watch('js//*.js', gulp.series('js'));
});

// Default task
gulp.task('default', gulp.series('scss', 'js', 'watch'));