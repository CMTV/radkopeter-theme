const { src, dest, watch, series } = require('gulp');

const del =     require('delete');
const sass =    require('gulp-sass');
const css =     require('gulp-clean-css');
const concat =  require('gulp-concat');

// // //

function moveToTest()
{
    let pathToTest = 'D:\\Sites\\radkopeter.loc\\wp-content\\themes\\radkopeter/';

    del([pathToTest + '**'], { force: true });

    return src('out/**')
        .pipe(dest(pathToTest));
}

function styles()
{
    del(['out/**']);

    src('src/styles/editor/**/*.scss', { ignore: 'src/styles/**/_*/scss' })
        .pipe(sass())
        .pipe(css())
        .pipe(concat('style-editor.css'))
        .pipe(dest('out/'));

    return src('src/styles/frontend/**/*.scss', { ignore: 'src/styles/**/_*.scss' })
        .pipe(sass())
        .pipe(css())
        .pipe(concat('style-frontend.css'))
        .pipe(dest('out/'));
}

function build()
{
    let ignore = [
        'src/styles/**' // Styles
    ];

    return src('src/**', { ignore: ignore })
            .pipe(dest('out/'));
}

function buildMove()
{

}

// // //

exports.build = series(styles, build);
exports.default = build;

exports.watch = () =>
{
    watch('src/**', exports.buildMove);
};

exports.buildMove = series(styles, build, moveToTest);