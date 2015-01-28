var concat       = require('gulp-concat');
var del          = require('del');
var gulp         = require('gulp');
var jshint       = require('gulp-jshint');
var less         = require('gulp-less');
var plumber      = require('gulp-plumber');
var sourcemaps   = require('gulp-sourcemaps');
var spawn        = require('child_process').spawn;
var uglify       = require('gulp-uglify');

gulp.task('default', [
  'scripts',
  'styles'
]);

gulp.task('scripts', ['scripts:compile']);

gulp.task('scripts:compile', ['scripts:lint', 'scripts:clean'], function () {

  gulp.src([
    'vendor/bootstrap/js/transition.js',
    'vendor/bootstrap/js/alert.js',
    // 'vendor/bootstrap/js/button.js',
    'vendor/bootstrap/js/carousel.js',
    // 'vendor/rygine/looper/src/looper.js',
    'vendor/bootstrap/js/collapse.js',
    'vendor/bootstrap/js/dropdown.js',
    // 'vendor/bootstrap/js/modal.js',
    // 'vendor/bootstrap/js/tooltip.js',
    // 'vendor/bootstrap/js/popover.js',
    // 'vendor/bootstrap/js/scrollspy.js',
    // 'vendor/bootstrap/js/tab.js',
    // 'vendor/bootstrap/js/affix.js',
    // 'vendor/jquery.scrollTo/jquery.scrollTo.js',
    'vendor/cover/src/cover.js',
    // 'scripts/src/single-page.js',
    // 'scripts/src/bootstrap-gravity-forms.js',
    'scripts/src/js.js'
  ])
    .pipe(plumber())
    .pipe(sourcemaps.init({loadMaps: true}))
      .pipe(uglify({ compress: true }))
      .pipe(concat('main.min.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('scripts/dist'))
  ;

});

gulp.task('scripts:lint', function () {
  return gulp
    .src('scripts/src/**/*.js')
    .pipe(plumber())
    .pipe(jshint({ esnext: true }))
    .pipe(jshint.reporter('jshint-stylish'))
  ;
});

gulp.task('scripts:clean', function (done) {
  del([
    'scripts/dist/**/*'
  ], done);
});

gulp.task('styles', ['styles:compile']);

gulp.task('styles:compile', ['styles:clean'], function () {
  return gulp
    .src('styles/src/main.less')
    .pipe(plumber())
    .pipe(sourcemaps.init({ loadMaps: true }))
      .pipe(less({
        compress: true
      }))
      .pipe(concat('main.min.css'))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('styles/dist'))
  ;
});

gulp.task('styles:clean', function (done) {
  del([
    'styles/dist/*'
  ], done);
});

gulp.task('watch', ['watch:reload']);

gulp.task('watch:reload', function () {
  var p;

  function reload () {
    if (p) {
      p.kill();
    }

    p = spawn('gulp', ['watch:watching'], { stdio: 'inherit' });
  }

  reload();

  return gulp.watch(__filename, ['config:lint', reload]);
});

gulp.task('watch:watching', function (done) {
  gulp.watch('scripts/src/**/*', ['scripts']);
  gulp.watch('styles/src/**/*', ['styles']);
});
