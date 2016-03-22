var elixir = require('laravel-elixir'),
        livereload = require('gulp-livereload'),
        gulp = require('gulp'),
        clean = require('rimraf');

var config = {
    assets_path: './resources/assets',
    build_path: './public/build'
};

config.bower_path = './resources/bower_components';

config.build_path_js = config.build_path + "/js";
config.build_vendor_path_js = config.build_path_js + "/vendor";

config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap-tpls.min.js',
    config.bower_path + '/angular-strap/dist/modules/navbar.min.js',
    config.bower_path + '/angular-cookies/angular-cookies.min.js',
    config.bower_path + '/query-string/query-string.js',
    config.bower_path + '/angular-oauth2/dist/angular-oauth2.min.js',
    config.bower_path + '/ng-file-upload/ng-file-upload.min.js'
];
config.vendor_path_fonts = [
    config.bower_path + '/bootstrap/dist/fonts/glyphicons-halflings-regular.eot',
    config.bower_path + '/bootstrap/dist/fonts/glyphicons-halflings-regular.svg',
    config.bower_path + '/bootstrap/dist/fonts/glyphicons-halflings-regular.ttf',
    config.bower_path + '/bootstrap/dist/fonts/glyphicons-halflings-regular.woff',
    config.bower_path + '/bootstrap/dist/fonts/glyphicons-halflings-regular.woff2',
    config.bower_path + '/font-awesome/fonts/fontawesome-webfont.eot',
    config.bower_path + '/font-awesome/fonts/fontawesome-webfont.svg',
    config.bower_path + '/font-awesome/fonts/fontawesome-webfont.ttf',
    config.bower_path + '/font-awesome/fonts/fontawesome-webfont.woff',
    config.bower_path + '/font-awesome/fonts/fontawesome-webfont.woff2',
    config.bower_path + '/font-awesome/fonts/FontAwesome.otf'

];

config.build_path_css = config.build_path + "/css";
config.build_vendor_path_css = config.build_path_css + "/vendor";

config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css',
    config.bower_path + '/font-awesome/css/font-awesome.min.css',
];

config.build_path_html = config.build_path + "/views";

config.build_path_fonts = config.build_path + "/fonts";
config.build_path_images = config.build_path + "/images";
// TASKS

gulp.task('copy-styles', function () {
    gulp.src([
        config.assets_path + '/css/**/*.css'
    ])
            .pipe(gulp.dest(config.build_path_css))
            .pipe(livereload());

    gulp.src(config.vendor_path_css)
            .pipe(gulp.dest(config.build_vendor_path_css))
            .pipe(livereload());
});

gulp.task('copy-html', function () {
    gulp.src([
        config.assets_path + '/js/views/**/*.html'
    ])
            .pipe(gulp.dest(config.build_path_html))
            .pipe(livereload());

});

gulp.task('copy-font', function () {
    gulp.src([
        config.assets_path + '/fonts/**/*'
    ])
            .pipe(gulp.dest(config.build_path_fonts))
            .pipe(livereload());

});

gulp.task('copy-image', function () {
    gulp.src([
        config.assets_path + '/images/**/*'
    ])
            .pipe(gulp.dest(config.build_path_images))
            .pipe(livereload());
});

gulp.task('copy-scripts', function () {
    gulp.src([
        config.assets_path + '/js/**/*.js'
    ])
            .pipe(gulp.dest(config.build_path_js))
            .pipe(livereload());

    gulp.src(config.vendor_path_js)
            .pipe(gulp.dest(config.build_vendor_path_js))
            .pipe(livereload());
});


gulp.task('clear-build-folder', function () {
    clean.sync(config.build_path);
});

gulp.task('default', ['clear-build-folder'], function () {
    gulp.start('copy-html', 'copy-font', 'copy-image');
    elixir(function (mix) {
        mix.styles(config.vendor_path_css.concat([config.assets_path + '/css/**/*']),
                'public/css/all.css', config.assets_path);
        mix.styles(config.vendor_path_css.concat([config.assets_path + '/css/**/*']),
                'public/build/css/app.css', config.assets_path);
        mix.scripts(config.vendor_path_js.concat([config.assets_path + '/js/**/*']),
                'public/js/all.js', config.assets_path);
        mix.version(['js/all.js', 'css/all.css','app.css']);
    });
});

gulp.task('watch-dev', ['clear-build-folder'], function () {
    livereload.listen();
    gulp.start('copy-styles', 'copy-scripts', 'copy-html', 'copy-font', 'copy-image');
    gulp.watch(config.assets_path + '/**', ['copy-styles', 'copy-scripts', 'copy-html']); // vê em todos os arquivos
});


