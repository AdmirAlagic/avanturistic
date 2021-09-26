const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.sass('resources/sass/timelapse.scss', 'public/dist/css/timelapse.css');
mix.sass('resources/sass/share.scss', 'public/dist/css/share.css');
mix.sass('resources/sass/chat.scss', 'public/dist/css/chat.css');
mix.sass('resources/sass/swal2.scss', 'public/dist/css/swal2.css');

mix.styles([
    'resources/sass/preload.scss',
],'public/dist/css/preload.css').minify('public/dist/css/preload.css').version();


mix.js('resources/js/app.js', 'public/dist/js')
    .js('resources/js/edit-profile.js', 'public/dist/js')
    .js('resources/js/general.js', 'public/dist/js')
    .js('resources/js/search.js', 'public/dist/js')
    .js('resources/js/vue.js', 'public/dist/js')
    .js('resources/js/posts.js', 'public/dist/js')
    .js('resources/js/edit-post.js', 'public/dist/js').version()
    .js('resources/js/create-post.js', 'public/dist/js').version()
    .js('resources/js/my_adventures.js', 'public/dist/js').version()
    .js('resources/js/timelapse.js', 'public/dist/js').version()
    .js('resources/js/timelapses.js', 'public/dist/js').version()
    .js('resources/js/avatar.js', 'public/dist/js')
    .js('resources/js/map/user-map.js', 'public/dist/js/map')
    .js('resources/js/map/home-map.js', 'public/dist/js/map').version()
    .js('resources/js/map/map.js', 'public/dist/js/map').version()
    .js('resources/js/map/adventures.js', 'public/dist/js/map').version()
    .js('resources/js/home.js', 'public/dist/js').version()
    .js('resources/js/map/country-map.js', 'public/dist/js/map').version()
    .js('resources/js/show-blog.js', 'public/dist/js')
    .js('resources/js/profile.js', 'public/dist/js')
    .js('resources/js/visiteds-map.js', 'public/dist/js')
    .js('resources/js/popular.js', 'public/dist/js')
    .js('resources/js/message.js', 'public/js/')
    .js('resources/js/activity.js', 'public/js/').version()
    .js('resources/js/map/post.js', 'public/dist/js').version()
    .js('resources/js/favorites.js', 'public/dist/js')
    .js('resources/js/create-blog.js', 'public/dist/js').version()
    .js('resources/js/auth/login.js', 'public/dist/js/auth')
    .js('resources/js/auth/register.js', 'public/dist/js/auth')
    .sass('resources/sass/responsive.scss', 'public/dist/css').minify('public/dist/css/responsive.css')
    .sass('resources/sass/app.scss', 'public/dist/css').minify('public/dist/css/app.css')
    .sass('resources/sass/auth.scss', 'public/dist/css').minify('public/dist/css/auth.css');
mix.styles([
    'public/dist/metronic/assets/css/style.bundle.css',
    'public/dist/css/app.min.css',
    'public/dist/css/responsive.min.css'
],'public/dist/css/style.css').minify('public/dist/css/style.css').version();

mix.combine([
    'public/dist/js/app.js',
    // 'public/dist/js/map/home-map.js',
], 'public/dist/js/app.js').minify('public/dist/js/app.js').version();

mix.combine([
    'public/js/libs/jquery.js',
    'public/js/libs/sweetalert2.min.js',
    'public/dist/metronic/assets/js/scripts.bundle.js',
    'public/leaflet/leaflet.js',
    'public/leaflet/fullscreen/Control.FullScreen.js',
    'public/js/libs/sticky.js',
    'public/js/libs/katex.min.js',
    'publicjs/libs/highlight.min.js',
    'public/js/libs/popper.min.js',
    'public/js/libs/bootstrap.min.js',
    'public/js/libs/perfect-scrollbar.min.js',
    'public/dist/js/app.min.js',
    'public/dist/js/general.js'
], 'public/dist/js/libs.js').minify('public/dist/js/libs.js').version();
if(process.env.MIX_BROWSERSYNC){
    mix.browserSync({
        proxy: process.env.MIX_PROXY
    });
}

mix.version();
mix.browserSync({
    proxy: 'https://avanturistic.com/'
});