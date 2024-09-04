const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const cleanCSS = require('gulp-clean-css');

// Compile and minify SCSS to CSS
gulp.task('scss', function () {
  return gulp.src('scss/main.scss') // Source path for SCSS file
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS()) // Minify the compiled CSS
    .pipe(rename({ suffix: '-min' })) // Rename to main-min.css
    .pipe(gulp.dest('css')); // Destination path for minified CSS
});

// Consolidated JavaScript Minification
gulp.task('js', function () {
  return gulp.src(['js/main.js', 'js/accessibility.js', 'js/admin.js']) // Correct JavaScript paths
    .pipe(uglify()) // Minify JavaScript
    .pipe(rename({ suffix: '-min' })) // Rename to add -min suffix
    .pipe(gulp.dest('js')); // Destination path for minified JavaScript
});

// Watch for changes
gulp.task('watch', function () {
  gulp.watch('scss/**/*.scss', gulp.series('scss')); // Watch all SCSS files
  gulp.watch('js/**/*.js', gulp.series('js')); // Watch all JavaScript files
});

// Default task
gulp.task('default', gulp.series('scss', 'js', 'watch'));
