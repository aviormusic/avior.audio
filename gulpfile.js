var fs = require('fs');
var gulp = require('gulp');
var remove = require('del');
var uuid = require('shortid');
var runIf = require('gulp-if');
var minimist = require('minimist');
var compiler = require('gulp-sass');
var bundle = require('gulp-concat');
var rename = require('gulp-rename');
var buildConfig = require('./build.config.json');

var uglify = {
    styles: require('gulp-uglifycss'),
    scripts: require('gulp-uglify')
};

var files = {
    sass: require('./build.files.json').sass,
    js: require('./build.files.json').js,
    img: require('./build.files.json').img
};

var isWatching = {
    sass: false,
    js: false
};

// Default settings for environement
var knownOptions = {
    string: 'env',
    default: {
        env: process.env.NODE_ENV || 'production'
    }
};

// Check for environement
var options = minimist(process.argv.slice(2), knownOptions);
var runningInProd = !!(options.env === 'production');

// Generate time-based unique universal identifier
var actualVersion = uuid.generate();

gulp.task('clean:sass:pub', function() {
    return remove([
        buildConfig.destination + '*.css'
    ]);
});

gulp.task('clean:js:pub', function() {
    return remove([
        buildConfig.destination + '*.js'
    ]);
});

gulp.task('compile:init', function(done) {
    if(fs.writeFileSync('.build', actualVersion)) {
        done();
    }
});

gulp.task('compile:img', function() {
    return gulp.src(files.img)
        .pipe(gulp.dest(buildConfig.destination + 'img/assets/'));
});

gulp.task('compile:sass', ['clean:sass:pub'], function() {
    return gulp.src(files.sass)
        .pipe(compiler({
            outputStyle: 'compressed'
        }))
        .pipe(bundle(buildConfig.name + '-' + actualVersion + '.css'))
        .pipe(runIf(runningInProd, uglify.styles()))
        .pipe(gulp.dest(buildConfig.destination));
});

gulp.task('compile:js', ['clean:js:pub'],function() {
    return gulp.src(files.js)
        .pipe(bundle(buildConfig.name + '-' + actualVersion + '.js'))
        .pipe(runIf(runningInProd, uglify.scripts()))
        .pipe(gulp.dest(buildConfig.destination));
});

gulp.task('watch:locals', function() {
    if(!isWatching.sass) {
        gulp.watch(files.sass, ['compile:sass']);
        isWatching.sass = true;
    }
    if(!isWatching.js) {
        gulp.watch(files.js, ['compile:js']);
        isWatching.js = true;
    }
});

gulp.task('default', [
    'compile:init',
    'compile:sass',
    'compile:js',
    'compile:img',
    'watch:locals'
]);
