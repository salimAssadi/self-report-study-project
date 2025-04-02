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

Route::get('/', function () {
    return redirect()->route('admin.home');
})->middleware('XSS');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware(
    [

        'XSS',
    ]
);


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


Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');


// Group all ISO_DIC routes under a common prefix
Route::prefix('admin')->middleware(['XSS'])->name('admin.')->group(function () {

    // Home and Login Routes
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Authenticated Routes (Middleware: iso_dic_auth)
    Route::middleware(['auth'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('role', RoleController::class);
        Route::resource('standards', StandardController::class);
        // Route::resource('sub-standards', SubStandardController::class);
        Route::resource('criteria', CriterionController::class);
        Route::get('api/standards',[CriterionController::class, 'getStandard'])->name('api.standards');
        
        // Resourceful Routes
        // Route::resources([
        //     'iso_systems' => IsoSystemController::class,
        //     'specification_items' => IsoSpecificationItemController::class,
        //     'attachments' => IsoAttachmentController::class,
        //     'document' => DocumentController::class,
        //     'procedures' => ProcedureController::class,
        //     'samples' => SampleController::class,
        //     'category' => CategoryController::class,
        //     'sub-category' => SubCategoryController::class,
        //     'tag' => TagController::class,
        // ]);

        // Route::controller(IsoSystemController::class)
        // ->prefix('iso_systems')
        // ->name('iso_systems.')
        // ->group(function () {
        //     Route::get('{cid}/procedure/create', 'addProcedure')->name('procedure.create');
        //     Route::get('procedure/{id}/preview', 'preview')->name('procedure.preview');
        //     Route::get('procedure/{id}/download', 'download')->name('procedure.download');
        //     Route::post('procedure/save', 'saveProcedure')->name('procedure.save');
        //     Route::delete('procedure/{id}/delete', 'deleteProcedure')->name('procedure.delete');
        //     Route::get('{cid}/sample/create', 'addSample')->name('sample.create');
           
        // });

        // Route::controller(IsoSystemController::class)
        // ->prefix('iso_systems')
        // ->name('iso_systems.')
        // ->group(function () {
            
        //     // Route::get('{cid}/attachment/create', 'addAttachment')->name('attachment.create');
        //     // Route::get('attachment/{id}/preview', 'preview')->name('attachment.preview');
        //     // Route::get('attachment/{id}/download', 'download')->name('attachment.download');
        // });
        // Document Controller Routes
        // Route::controller(DocumentController::class)->prefix('document')->name('document.')->group(function () {
        //     Route::get('history', 'history')->name('history');
        //     Route::resource('document', DocumentController::class);
        //     Route::get('my-document', 'myDocument')->name('my-document');
        //     Route::get('{id}/comment', 'comment')->name('comment');
        //     Route::get('{id}/reminder', 'reminder')->name('reminder');
        //     Route::get('{id}/add-reminder', 'addReminder')->name('add.reminder');
        //     Route::get('{id}/version-history', 'versionHistory')->name('version.history');
        //     Route::post('{id}/version-history', 'newVersion')->name('new.version');
        //     Route::get('{id}/add-share', 'addshareDocumentData')->name('add.share');
        //     Route::post('{id}/share', 'shareDocumentData')->name('share');
        //     Route::delete('{id}/share/destroy', 'shareDocumentDelete')->name('share.destroy');
        //     Route::get('{id}/send-email', 'sendEmail')->name('send.email');
        //     Route::get('logged/history', 'loggedHistory')->name('logged.history');
        //     Route::get('logged/{id}/history/show', 'loggedHistoryShow')->name('logged.history.show');
        //     Route::delete('logged/{id}/history', 'loggedHistoryDestroy')->name('logged.history.destroy');
        // });

        Route::get('/api/standards/children', [StandardController::class, 'getChildren'])->name('api.standards.children');
        // Settings Controller Routes
        Route::controller(SettingController::class)->prefix('settings')->name('setting.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('facility-Info', 'facilityInfo')->name('facilityInfo');
            Route::post('facility-Info', 'savefacilityInfo')->name('savefacilityInfo');
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

        // File Manager Route
        Route::get('/file-manager', [FileManagerController::class, 'index'])->name('filemanager');

        // Additional Routes for Procedures
        // Route::controller(ProcedureController::class)->prefix('procedures')->name('procedures.')->group(function () {
        //     Route::get('all', 'all')->name('all');
        //     Route::post('save/{id?}', 'save')->name('save');
        //     Route::get('configure/{id}', 'configure')->name('configure');
        //     Route::post('configure/{id}/save', 'saveConfigure')->name('saveConfigure');;
        //     Route::post('configure/{id}', 'saveTemplatePath')->name('saveTemplatePath');
        //     Route::post('status/{id}', 'status')->name('status');
        // });

        // Route::controller(SampleController::class)->prefix('samples')->name('samples.')->group(function () {
        //     Route::get('all', 'all')->name('all');
        //     Route::post('save/{id?}', 'save')->name('save');
        //     Route::get('configure/{id}', 'configure')->name('configure');
        //     Route::post('configure/{id}/save', 'saveConfigure')->name('saveConfigure');;
        //     Route::post('configure/{id}', 'saveTemplatePath')->name('saveTemplatePath');
        //     Route::post('status/{id}', 'status')->name('status');
        //     Route::get('{id}/preview', 'preview')->name('sample.preview');
        //     Route::get('{id}/download', 'download')->name('sample.download');
        // });

        // // ISO Tree Data and Widget Update
        // Route::get('/iso-tree-data', [IsoSpecificationItemController::class, 'getTreeData'])->name('tree.data');
        // Route::get('/updateWidegit', [IsoSpecificationItemController::class, 'updateWidegit'])->name('specification_items.updateWidegit');

        // Route::get('/convert-to-html', [DocController::class, 'convertToHtml'])->name('convert.to.html');

        // Route::get('view_sample',function(){
        //     return view('procedure-template.first-template');
        // });
        
        // Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate.pdf');
    });
});
