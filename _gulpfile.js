const gulp     = require( 'gulp' ),
	sass         = require( 'gulp-sass' ),
	browserSync  = require( 'browser-sync' ),
	concat       = require( 'gulp-concat' ),
	uglify       = require( 'gulp-uglify-es' ).default,
	cleancss     = require( 'gulp-clean-css' ),
	autoprefixer = require( 'gulp-autoprefixer' ),
	rsync        = require( 'gulp-rsync' ),
	newer        = require( 'gulp-newer' ),
	rename       = require( 'gulp-rename' ),
	responsive   = require( 'gulp-responsive' ),
	del          = require( 'del' );
//  babel        = require( 'gulp-babel' );
//	babelify     = require( 'babelify' );


// Project related variables
const projectURL   = 'magnet.loc';

const styleSRC     = './src/sass/style.sass';
const styleURL     = './css/';
const mapURL       = './';


const jsSRC        = './src/js/';
const jsBackEnd    = 'script';
const jsForm       = 'form';
const jsURL        = './js/';
const jsAll				 = [jsBackEnd, jsForm];

const styleWatch   = './src/**/*.sass';
const jsWatch      = './src/**/*.js';
const phpWatch     = './**/*.php';

const imgSRC 			 = './images/_src/**/*';


// Local Server
gulp.task( 'browser-sync', function() {
	browserSync( {
		//server: {
		//	baseDir: 'app'
		//},
		proxy: projectURL,
		notify: false,
		// online: false, // Work offline without internet connection
		// tunnel: true, tunnel: 'projectname', // Demonstration page: http://projectname.localtunnel.me
	} )
} );
function bsReload(done) { browserSync.reload(); done(); };

// Custom Styles
gulp.task('styles', function() {
	return gulp.src(styleSRC)
	.pipe(sass({ outputStyle: 'expanded' }))
	.pipe(concat('styles.min.css'))
	.pipe(autoprefixer({
		grid: true,
		overrideBrowserslist: ['last 10 versions']
	}))
	//.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Optional. Comment out when debugging
	.pipe(gulp.dest(styleURL))
	.pipe(browserSync.stream())
});

// Scripts & JS Libraries
gulp.task('scripts', function() {

	jsAll.map(function(_script){

		return gulp.src([
				// 'node_modules/jquery/dist/jquery.min.js', // Optional jQuery plug-in (npm i --save-dev jquery)
				//	'src/js/_lazy.js', // JS library plug-in example
				//	'src/js/_custom.js', // Custom scripts. Always at the end
				//jsForm,
				jsSRC + _script + '.js'
				])
			.pipe(concat(_script + '.min.js'))
			//.pipe(uglify()) // Minify js (opt.)
			.pipe(gulp.dest(jsURL))
			.pipe(browserSync.reload({ stream: true }))

	})
});

// Responsive Images
var quality = 95; // Responsive images quality

// Produce @1x images
gulp.task('img-responsive-1x', async function() {
	return gulp.src('images/_src/**/*.{png,jpg,jpeg,webp,raw}')
		.pipe(newer('images/@1x'))
		.pipe(responsive({
			'**/*': { width: '50%', quality: quality }
		})).on('error', function (e) { console.log(e) })
		.pipe(rename(function (path) {path.extname = path.extname.replace('jpeg', 'jpg')}))
		.pipe(gulp.dest('images/@1x'))
});
// Produce @2x images

gulp.task('img-responsive-2x', async function() {
	return gulp.src('images/_src/**/*.{png,jpg,jpeg,webp,raw}')
		.pipe(newer('images/@2x'))
		.pipe(responsive({
			'**/*': { width: '100%', quality: quality }
		})).on('error', function (e) { console.log(e) })
		.pipe(rename(function (path) {path.extname = path.extname.replace('jpeg', 'jpg')}))
		.pipe(gulp.dest('images/@2x'))
});

gulp.task('img', gulp.series('img-responsive-1x', 'img-responsive-2x', bsReload));

// Clean @*x IMG's
gulp.task('cleanimg', function() {
	return del(['images/@*/*'], { force: true })
});

// Code & Reload
gulp.task('code', function() {
	return gulp.src(phpWatch)
	.pipe(browserSync.reload({ stream: true }))
});

// Deploy
gulp.task('rsync', function() {
	return gulp.src('app/')
	.pipe( rsync( {
		root: '/',
		hostname: 'username@yousite.com',
		destination: 'yousite/public_html/',
		// include: ['*.htaccess'], // Included files
		exclude: ['**/Thumbs.db', '**/*.DS_Store'], // Excluded files
		recursive: true,
		archive: true,
		silent: false,
		compress: true
	} ) )
} );

gulp.task( 'watch', function() {
	gulp.watch( styleWatch, gulp.parallel( 'styles' ) );
	gulp.watch( jsWatch, gulp.parallel( 'scripts' ) );
	gulp.watch( phpWatch, gulp.parallel( 'code' ) );
	gulp.watch( imgSRC, gulp.parallel( 'img' ) );
});

gulp.task( 'default', gulp.parallel( 'cleanimg', 'img', 'styles', 'scripts', 'browser-sync', 'watch' ) );
