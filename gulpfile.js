const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');


gulp.task('styles', () => {
  // pasta de origem materialize
    return gulp.src('public/site/**/*.scss')
        .pipe(sass().on('error', sass.logError))
  // pasta de destino materialize
        .pipe(gulp.dest('public/site/'));
});


//apaga o arquivo
gulp.task('clean', () => {
    return del([
        'public/site/materialize.css',
    ]);
});

// verifica se houve mudanças
gulp.task('watch', () => {
    gulp.watch('public/site/**/*.scss', (done) => {
        gulp.series(['clean', 'styles'])(done);
    });
});

gulp.task('default', gulp.series(['clean', 'styles' , 'watch']));