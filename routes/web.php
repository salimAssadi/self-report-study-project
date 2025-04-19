<?php

// use App\Http\Controllers\Auth\VerifyEmailController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\AuthPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\IsoSpecificationItemController;
use App\Http\Controllers\IsoSystemController;
use App\Http\Controllers\MainStandardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\StandardController;
use App\Http\Controllers\SubStandardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// require __DIR__ . '/auth.php';
Route::middleware(['XSS'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
$prefix = 'admin';
Route::middleware(['auth', 'XSS'])->group(function () {
   
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
        
        // Resources
        Route::resource('users', UserController::class);
        Route::resource('role', RoleController::class);
        Route::resource('standards', StandardController::class);
        Route::resource('criteria', CriterionController::class);
        
        // API routes
        Route::get('api/standards', [CriterionController::class, 'getStandard'])->name('api.standards');
        Route::get('/api/standards/children', [StandardController::class, 'getChildren'])->name('api.standards.children');
        
        // Settings
        Route::controller(SettingController::class)->prefix('settings')->name('setting.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('facility-Info', 'facilityInfo')->name('facilityInfo');
            Route::post('facility-Info', 'savefacilityInfo')->name('savefacilityInfo');
            Route::post('self-report', 'saveSelfReport')->name('saveSelfReport');
            Route::post('account', 'accountData')->name('account');
            Route::delete('account/delete', 'accountDelete')->name('account.delete');
            Route::post('password', 'passwordData')->name('password');
            Route::post('general', 'generalData')->name('general');
            Route::post('smtp', 'smtpData')->name('smtp');
            Route::get('smtp-test', 'smtpTest')->name('smtp.test');
            Route::post('smtp-test', 'smtpTestMailSend')->name('smtp.testing');
            Route::post('payment', 'paymentData')->name('payment');
            Route::post('site-seo', 'siteSEOData')->name('site.seo');
            Route::post('google-recaptcha', 'googleRecaptchaData')->name('google.recaptcha');
            Route::post('company', 'companyData')->name('company');
            Route::post('2fa', 'twofaEnable')->name('twofa.enable');
            Route::get('footer-setting', 'footerSetting')->name('footerSetting');
            Route::post('footer', 'footerData')->name('footer');
            Route::get('language/{lang}', 'lanquageChange')->name('language.change');
            Route::post('theme/settings', 'themeSettings')->name('theme.settings');
        });


        Route::get('report', [ReportController::class, 'index'])->name('report.show');
        Route::get('allComments', [CommentController::class, 'allComments'])->name('comments.all');
        Route::get('comments/create', [CommentController::class, 'create'])->name('comments.create');
        Route::get('criterion/{criterion}/comments', [CommentController::class, 'index'])->name('criterion.comments.index');
        Route::post('criterion/{criterion}/comments', [CommentController::class, 'store'])->name('criterion.comments.store');
        Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
        Route::get('comments/attachments/{attachment}/download', [CommentController::class, 'downloadAttachment'])
            ->name('comments.attachment.download');

        // File Manager
        Route::get('/file-manager', [FileManagerController::class, 'index'])->name('filemanager');
        
       
    });

  


//-------------------------------FAQ-------------------------------------------
Route::resource('FAQ', FAQController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------Home Page-------------------------------------------
Route::resource('homepage', HomePageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);
//-------------------------------FAQ-------------------------------------------
Route::resource('pages', PageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);

//-------------------------------FAQ-------------------------------------------
Route::resource('authPage', AuthPageController::class)->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('page/{slug}', [PageController::class, 'page'])->name('page');
//-------------------------------FAQ-------------------------------------------
Route::impersonate();
