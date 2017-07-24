// 载入外挂
var path = require('path');
var gulp = require('gulp'),
  spritesmith = require('gulp.spritesmith'),//雪碧图
  sass = require('gulp-sass'),//编译sass
  gulpautoprefixer = require('gulp-autoprefixer'),//浏览器前缀
  //minifycss = require('gulp-minify-css'),//已经弃用，gulp-clean-css代替
  cleancss = require('gulp-clean-css'),// 压缩css文件
  concat = require('gulp-concat'),//合并文件
  clean = require('gulp-clean'),//清空文件
  fileinclude = require('gulp-file-include'),//引入模板html
  order = require("gulp-order"),
  jshint = require('gulp-jshint'),// JS语法检测
  uglify = require('gulp-uglify'),// JS丑化
  imagemin = require('gulp-imagemin'),// 图片压缩
  cache = require('gulp-cache'),
  livereload = require('gulp-livereload'),
  plumber = require('gulp-plumber'),
  notify = require('gulp-notify'),
  gutil = require('gulp-util'),
  filter = require('gulp-filter'),
  postcss = require('gulp-postcss'),
  sourcemaps = require('gulp-sourcemaps'), //sass地图
  flatten = require('gulp-flatten'),
  autoprefixer = require('autoprefixer'),
  cssver = require('gulp-make-css-url-version'),  // css文件引用URL加版本号

  revhtml = require('gulp-rev-append'),           // html添加版本号
  //browserSync = require('browser-sync'),      // 浏览器同步
  //reload = browserSync.reload;                // 自动刷新
///---------
//加版本
  runSequence = require('run-sequence'),
  /**需要在源代码处修改为如下格式：
   var verStr = (options.verConnecter || "") + md5;
   src=src+"?v="+verStr;
   **/
  assetRev = require('gulp-asset-rev'),
  rev = require('gulp-rev'),
  revCollector = require('gulp-rev-collector');
//路劲

/**
 * gulp-autoprefixer的browsers参数详解 （传送门）：
 ● last 2 versions: 主流浏览器的最新两个版本
 ● last 1 Chrome versions: 谷歌浏览器的最新版本
 ● last 2 Explorer versions: IE的最新两个版本
 ● last 3 Safari versions: 苹果浏览器最新三个版本
 ● Firefox >= 20: 火狐浏览器的版本大于或等于20
 ● iOS 7: IOS7版本
 ● Firefox ESR: 最新ESR版本的火狐
 ● > 5%: 全球统计有超过5%的使用率
 * */
const postcss_plugins = [
  autoprefixer({
    browsers: ['last 2 versions', 'Android >= 3.0']
  })
];
const gulpautoprefixer_options = {
  browsers: ['last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 3', 'Firefox > 10', 'Chrome  > 10'],
  cascade: true, //是否美化属性值 默认：true
  remove: false //是否去掉不必要的前缀 默认：true
};
var srcAssetsPath = "src/assets"; //原文件资源目录
var outAssetsPath = "dist/assets"; //编译输出资源目录

// 页面特殊样式
var sassArr = [
  srcAssetsPath + '/sass/pages/*.scss',
  "!" + srcAssetsPath + '/sass/base/*.scss'
];
//scss文件映射
gulp.task('sass', function () {
  return gulp.src(sassArr)
    .pipe(sourcemaps.init())

    .pipe(sass({
      outputStyle: 'expanded'//compressed expanded
    }))
    .pipe(plumber({
      errorHandler: function (error) {
        console.log(error.message);
        this.emit("end");
      }
    }))
    // .pipe(postcss(postcss_plugins))
    .pipe(gulpautoprefixer(gulpautoprefixer_options))
    //css文件引入静态文件加版本
    /*.pipe(cssver({
     useDate:true
     }))*/
    //.pipe(cleancss())//压缩

    .pipe(sourcemaps.write('./maps'))//生成map文件的路径
    .pipe(gulp.dest(outAssetsPath + '/styles/'))
    //css js文件引入静态文件加版本 长度：5
    //.pipe(assetRev({hashLen: 5}))
    .pipe(gulp.dest(outAssetsPath + '/styles/'))
});

gulp.task('pageshtml', function () {
  return gulp.src(['src/pages/**/*.html', '!src/pages/test/*.html'])
    .pipe(fileinclude({
      prefix: '@@',
      basepath: '@file'
    }))
    .on('error', function (err) {
      gutil.log('Less Error!', err);
      //this.end();
    })
    .pipe(notify({
      message: 'html task complete'
    }))
    .pipe(gulp.dest('dist/pages'))
    //.pipe(revhtml())//给html引入的css、js 、img等静态资源后面添加?rev=@@hash，即可生成版本,如果路径不对，不会生成
    .pipe(gulp.dest('dist/pages'));
});
//html
gulp.task('html', ['pageshtml'], function () {
  return true;
});

//图片资源
gulp.task('images', function () {
  return gulp.src(srcAssetsPath + '/images/**/*')
    .pipe(plumber())
    .pipe(cache(imagemin({
      optimizationLevel: 5,
      progressive: true,
      interlaced: true
    })))
    .pipe(gulp.dest(outAssetsPath + '/images'));
});
// 清理
var cleanArr = [
  'dist/pages/',
  'dist/assets/'
];
gulp.task('clean', function () {
  return gulp.src(cleanArr, {
    read: false
  })
  // .pipe(plumber())
    .pipe(clean());
});

gulp.task('watch', function () {
  // 看守所有.scss档
  var scss = srcAssetsPath + '/sass/**/*.scss';
  gulp.watch(scss, ['sass']);
  // 看守所有.js档
  gulp.watch(srcAssetsPath + '/scripts/**/*.js', ['scripts']);
  // 看守所有图片档
  gulp.watch(srcAssetsPath + '/images/**/*', ['images']);
  //看守html
  gulp.watch(['src/**/*.html', 'src/**/*.inc'], ['html']);

  //themes
  gulp.watch(srcAssetsPath + '/themes/**/*.js', ['themes']);
  livereload.listen();
  gulp.watch(['dist/**']).on('change', livereload.changed);
});

//自己编写js文件
gulp.task('scripts', function () {
  return gulp.src(srcAssetsPath + '/scripts/**/*.*')
    .pipe(jshint('.jshintrc'))
    .pipe(plumber())
    //.pipe(uglify())
    .pipe(gulp.dest(outAssetsPath + '/scripts'))
   // .pipe(assetRev({hashLen: 5}))
    .pipe(gulp.dest(outAssetsPath + '/scripts'))
});

//第三库文件
gulp.task('vendor', function () {
  return gulp.src(srcAssetsPath + '/vendor/**/*.*')
    .pipe(gulp.dest(outAssetsPath + '/vendor'));
});

//拷贝php文件

gulp.task('themes', function () {
  return gulp.src('src/themes/**/*.php')
    .pipe(gulp.dest('dist/themes'));
});
// 默认执行
gulp.task('default2', function () {
  gulp.start('sass', 'scripts', 'images', 'html', ['gt-copy']);
});

gulp.task('default', function (done) {
  //condition = false;
  runSequence(       //需要说明的是，用gulp.run也可以实现以上所有任务的执行，只是gulp.run是最大限度的并行执行这些任务，而在添加版本号时需要串行执行（顺序执行）这些任务，故使用了runSequence.
    ['sass'],
    ['scripts'],
    ['images'],
    ['html'],
    ['gt-copy'],
    ['themes'],
    done);
});

//瓜藤资源目录拷贝begin
gulp.task('gt-scripts', function () {
  return gulp.src('src/gt/scripts/**/*.js')
    .pipe(plumber())
    .pipe(gulp.dest('dist/scripts'));
});
gulp.task('gt-images', function () {
  return gulp.src('src/gt/images/**/*.*')
    .pipe(plumber())
    .pipe(gulp.dest('dist/images'));
});
gulp.task('gt-styles', function () {
  return gulp.src('src/gt/styles/**/*.*')
    .pipe(plumber())
    .pipe(gulp.dest('dist/styles'));
});

gulp.task('gt-copy', function () {
  gulp.start('gt-scripts', 'gt-images', 'gt-styles');
});
//瓜藤资源目录拷贝end

//加版本begin
//sprite
// 测试自动雪碧图
// autoSprite, with media query
gulp.task('autoSprite', function () {
  var spriteData = gulp.src('src/pages/test/spriteImages/*.png')
    .pipe(spritesmith({
      imgName: 'sprite.png',
      cssName: 'sprite.css',
      padding: 20
    }));
  return spriteData.pipe(gulp.dest('src/pages/test/spriteImages/'));
});

/*runSequence = require('run-sequence'),
 assetRev = require('gulp-asset-rev'),
 rev = require('gulp-rev'),
 revCollector = require('gulp-rev-collector');*/
//为css中引入的图片/字体等添加hash编码
gulp.task('assetRev', function () {
  return gulp.src(outAssetsPath + '/styles/*.css')   //该任务针对的文件
    //.pipe(assetRev({hashLen: 10}))  //该任务调用的模块
    .pipe(gulp.dest(outAssetsPath + '/rev/')); //编译后的路径
});
//CSS生成文件hash编码并生成 rev-manifest.json文件名对照映射
gulp.task('revCss', function () {
  return gulp.src(outAssetsPath + '/styles/*.css')
    //.pipe(rev())
    .pipe(gulp.dest(outAssetsPath + '/styles/'))
    .pipe(rev.manifest())
    .pipe(gulp.dest(outAssetsPath + '/rev/'));
});
//js生成文件hash编码并生成 rev-manifest.json文件名对照映射
gulp.task('revJs', function () {
  return gulp.src(outAssetsPath + '/scripts/*.js')
    //.pipe(rev())
    .pipe(gulp.dest(outAssetsPath + '/scripts/'))
    //.pipe(rev.manifest())
    .pipe(gulp.dest(outAssetsPath + '/rev/'));
});
gulp.task('revHtml', function () {
  return gulp.src('dist/pages/**/*.html')
    .pipe(revCollector())
    .pipe(gulp.dest('dist/pages2/.'));
});
//开发构建
gulp.task('defaultrev', function (done) {
  //condition = false;
  runSequence(       //需要说明的是，用gulp.run也可以实现以上所有任务的执行，只是gulp.run是最大限度的并行执行这些任务，而在添加版本号时需要串行执行（顺序执行）这些任务，故使用了runSequence.
    ['assetRev'],
    ['revCss'],
    ['revJs'],
    //['revHtml'],
    done);
});
//加版本end
