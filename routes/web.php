<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StoreAnalytic;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmailTemplateController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MainStandardController;
use App\Http\Controllers\SubStandardController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;



require __DIR__ . '/auth.php';


// Route::get('/login/{lang?}', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
// Route::get('/register/{ref_id?}/{lang?}', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
// Route::get('/password/forgot/{lang?}', [AuthenticatedSessionController::class, 'showLinkRequestForm'])->name('change.langPass');


Route::get('/', function () {
    return redirect()->route('dashboard');
})->middleware('XSS');

Route::group(['middleware' => ['verified']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'XSS'])->name('dashboard');
    Route::middleware(['auth', 'XSS'])->group(function () {
        Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->name('change.language')->middleware(['auth', 'XSS']);
        Route::get('manage-language/{languages}', [LanguageController::class, 'manageLanguage'])->name('manage.language')->middleware(['auth', 'XSS']);
        Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data')->middleware(['auth', 'XSS']);
        Route::post('disable-language', [LanguageController::class, 'disableLang'])->name('disablelanguage')->middleware(['auth', 'XSS']);
        Route::get('create-language', [LanguageController::class, 'createLanguage'])->name('create.language')->middleware(['auth', 'XSS']);
        Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language')->middleware(['auth', 'XSS']);
        Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->name('lang.destroy')->middleware(['auth', 'XSS']);
    });


    Route::get('/change/mode', [DashboardController::class, 'changeMode'])->name('change.mode');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile')->middleware(['auth', 'XSS']);


    Route::put('change-password', [DashboardController::class, 'updatePassword'])->name('update.password');
    Route::put('edit-profile', [DashboardController::class, 'editprofile'])->name('update.account')->middleware(['auth', 'XSS']);


    Route::middleware(['auth', 'XSS'])->group(function () {
        Route::post('business-setting', [SettingController::class, 'saveBusinessSettings'])->name('business.setting');
        Route::post('company-setting', [SettingController::class, 'saveFacilitySettings'])->name('Facility.setting');
        Route::post('email-setting', [SettingController::class, 'saveEmailSettings'])->name('email.setting');
        Route::post('system-setting', [SettingController::class, 'saveSystemSettings'])->name('system.setting');
        Route::post('pusher-setting', [SettingController::class, 'savePusherSettings'])->name('pusher.setting');
        Route::get('test-mail', [SettingController::class, 'testMail'])->name('test.mail')->middleware(['auth', 'XSS']);
        Route::post('test-mail/send', [SettingController::class, 'testSendMail'])->name('test.send.mail')->middleware(['auth', 'XSS']);
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('upload.image');
    });



    Route::get('/config-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        return redirect()->back()->with('success', 'Clear Cache successfully.');
    });



    Route::get('email_template_lang/{lang?}', [EmailTemplateController::class, 'emailTemplate'])->name('email_template')->middleware('auth', 'XSS');
    Route::get('email_template_lang/{id}/{lang?}', [EmailTemplateController::class, 'manageEmailLang'])->name('manage.email.language')->middleware('auth', 'XSS');
    Route::put('email_template_lang/{id}/', [EmailTemplateController::class, 'updateEmailSettings'])->name('updateEmail.settings')->middleware('auth');
    Route::put('email_template_store/{pid}', [EmailTemplateController::class, 'storeEmailLang'])->name('store.email.language')->middleware('auth', 'XSS');
    Route::put('email_template_status/{id}', [EmailTemplateController::class, 'updateStatus'])->name('status.email.language')->middleware('auth', 'XSS');
    Route::put('email_template_status/{id}', [EmailTemplateController::class, 'updateStatus'])->name('email_template.update')->middleware('auth', 'XSS');



    Route::any('user-reset-password/{id}', [StoreController::class, 'userPassword'])->name('user.reset');
    Route::post('user-reset-password/{id}', [StoreController::class, 'userPasswordReset'])->name('user.password.update');
    Route::get('user-login/{id}', [StoreController::class, 'LoginManage'])->name('users.login');



    Route::resource('roles', RoleController::class)->middleware(['auth', 'XSS']);
    Route::resource('users', UserController::class)->middleware(['auth', 'XSS']);
    Route::get('users/reset/{id}', [UserController::class, 'reset'])->name('users.reset')->middleware(['auth', 'XSS']);
    Route::post('users/reset/{id}', [UserController::class, 'updatePassword'])->name('users.resetpassword')->middleware(['auth', 'XSS']);
    Route::get('owner-user-login/{id}', [UserController::class, 'UserLoginManage'])->name('owner.users.login');
    Route::resource('permissions', PermissionController::class)->middleware(['auth', 'XSS',]);

        Route::middleware(['auth', 'XSS'])->group(function () {
            // Main Standards
            Route::resource('main-standards', MainStandardController::class);
            Route::resource('sub-standards', SubStandardController::class);
            Route::resource('criteria', CriterionController::class);
            // // Sub Standards
            // Route::post('sub-standards', [SubStandardController::class, 'store'])->name('sub-standards.store');
            // Route::put('sub-standards/{subStandard}', [SubStandardController::class, 'update'])->name('sub-standards.update');
            // Route::delete('sub-standards/{subStandard}', [SubStandardController::class, 'destroy'])->name('sub-standards.destroy');

            // // Criteria
            // Route::post('criteria', [CriterionController::class, 'store'])->name('criteria.store');
            // Route::put('criteria/{criterion}', [CriterionController::class, 'update'])->name('criteria.update');
            // Route::delete('criteria/{criterion}', [CriterionController::class, 'destroy'])->name('criteria.destroy');
        });
        
});

Route::get('api/standards', function (\Illuminate\Http\Request $request) {
    $main_standard_id = $request->input('main_standard_id');
    return \App\Models\SubStandard::where('main_standard_id', $main_standard_id)->get();
})->name('api.standards');
