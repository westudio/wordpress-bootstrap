var concat     = require('gulp-concat');
var gulp       = require('gulp');
var jshint     = require('gulp-jshint');
var less       = require('gulp-less');
var sourcemaps = require('gulp-sourcemaps');
var spawn      = require('child_process').spawn;
var uglify     = require('gulp-uglify');
var util       = require('gulp-util');

var p;

function report (e) {
  console.log(e.message);
}

gulp.task('default', [
  'scripts',
  'styles'
]);

gulp.task('scripts', ['scripts:lint'], function () {

  gulp.src([
    'assets/vendor/bootstrap/js/transition.js',
    'assets/vendor/bootstrap/js/alert.js',
    // 'assets/vendor/bootstrap/js/button.js',
    'assets/vendor/bootstrap/js/carousel.js',
    'assets/vendor/bootstrap/js/collapse.js',
    'assets/vendor/bootstrap/js/dropdown.js',
    // 'assets/vendor/bootstrap/js/modal.js',
    // 'assets/vendor/bootstrap/js/tooltip.js',
    // 'assets/vendor/bootstrap/js/popover.js',
    // 'assets/vendor/bootstrap/js/scrollspy.js',
    // 'assets/vendor/bootstrap/js/tab.js',
    // 'assets/vendor/bootstrap/js/affix.js',
    // 'assets/vendor/jquery.scrollTo/jquery.scrollTo.js',
    // 'assets/vendor/cover/src/cover.js',
    // 'assets/scripts/src/viewport.js',
    // 'assets/scripts/src/inviewport.js',
    'assets/scripts/src/offcanvas.js',
    // 'assets/scripts/src/sections.js',
    // 'assets/scripts/src/sticky.js',
    // 'assets/scripts/src/header.js',
    // 'assets/scripts/src/nav.js',
    // 'assets/scripts/src/bootstrap-gravity-forms.js',
    'assets/scripts/src/js.js'
  ])
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(uglify({ compress: true })).on('error', report)
    .pipe(concat('main.min.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('assets/scripts/dist'))
  ;

});

gulp.task('scripts:lint', function () {
  return gulp
    .src('assets/scripts/src/**/*.js')
    .pipe(jshint({ esnext: true })).on('error', report)
    .pipe(jshint.reporter('default'))
  ;
});

gulp.task('styles', function () {
  return gulp
    .src('assets/styles/src/main.less')
    .pipe(sourcemaps.init({ loadMaps: true }))
    .pipe(less({ compress: true })).on('error', report)
    .pipe(concat('main.min.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('assets/styles/dist'))
  ;
});

gulp.task('watch', function () {
  function reload () {
    util.log('Reloading gulpfile...');

    if (p) {
      p.kill();
    }

    p = spawn('gulp', ['watching'], { stdio: 'inherit' });
  }

  reload();

  return gulp.watch(__filename, reload);
});

gulp.task('watching', function (done) {
  gulp.watch('assets/scripts/src/**/*', ['scripts']);
  gulp.watch('assets/styles/src/**/*', ['styles']);
});

