var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('styles', function() {
	gulp.src('./assets/scss/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./'))
});

//Watch task
gulp.task('default',function() {
	// run a build first
	gulp.src('./assets/scss/**/*.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./'));

	// watch for any changes
	gulp.watch('./assets/scss/**/*.scss',['styles']);
});
