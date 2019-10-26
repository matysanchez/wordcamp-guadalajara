const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');
const cleanCSS = require('gulp-clean-css');
 
gulp.task('styles', () => {
    return gulp.src('sources/scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./'));
});

gulp.task('minifycss', () => {
    return gulp.src('./*.css')
      .pipe(cleanCSS({compatibility: 'ie8'}))
      .pipe(gulp.dest('./'));
  });


gulp.task('watch',() => {
    return gulp.watch('sources/scss/*.scss', gulp.series(['styles', 'minifycss']));
});

gulp.task('default', gulp.series(['styles', 'watch', 'minifycss']));