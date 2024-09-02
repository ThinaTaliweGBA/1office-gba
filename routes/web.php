<?php
/**
 * Web routes for the application.
 *
 * PHP version 9
 *
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 *
 */

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\MyWelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MembershipsController;
use App\Http\Middleware\WelcomesNewUsers as MiddlewareWelcomesNewUsers;
use App\Models\User;
use Spatie\WelcomeNotification\WelcomeController;
use App\Http\Controllers\DependantsController;
use App\Http\Controllers\SalesTransactionController;
use App\Http\Controllers\CommissionRateController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Barryvdh\Debugbar\Facade as Debugbar;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LayoutController;
use App\Models\LayoutPreference;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\AmChartController;
use App\Http\Middleware\SecretCodeMiddleware;
use App\Http\Middleware\CheckMacAddress;
use App\Http\Controllers\MacAddressController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\WhatsAppWebhookController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\GbaController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\MembershipBankDetailController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\FuneralController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserBuController;
use App\Http\Controllers\FuneralChecklistController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\LaravelLoggerController;
use jeremykenedy\LaravelLogger\App\Models\Activity;

// to be deleted
use App\Http\Controllers\GbaFormsController;

// ---------------- Sanitizer -----------------------------------------
/* These Are For Mappings */
use App\Http\Controllers\MappingController;
/* These Are For Transfers */
use App\Http\Controllers\DataTransferController;
/* These Are For Presets */
use App\Http\Controllers\PresetController;
/* These Are For Presets */
use App\Http\Controllers\TransferLogController;

//--------------------------------- Start lededata Routes --------------------------------------------------------------------
Route::get('/member/growth-retention', [ReportController::class, 'membershipGrowthAndRetentionReport'])->name('lededata.growth');
Route::get('/member/profile', [ReportController::class, 'memberProfilesReport'])->name('lededata.profile');
Route::get('/member/demographic', [ReportController::class, 'demographicReport'])->name('lededata.demographics');

Route::get('/member/geographic', [ReportController::class, 'geographicReport'])->name('lededata.geographic');
Route::get('/member/financial', [ReportController::class, 'financialReport'])->name('lededata.finance');
Route::get('/member/lifecycle', [ReportController::class, 'lifecycleReport'])->name('lededata.lifecycle');

Route::get('/member/insurance-claims', [ReportController::class, 'insuranceClaimsReport'])->name('lededata.insurance');
Route::get('/member/communication', [ReportController::class, 'communicationReport'])->name('lededata.communication');
Route::get('/member/audit', [ReportController::class, 'auditReport'])->name('lededata.audit');

//--------------------------------- End lededata Routes --------------------------------------------------------------------

/* These Are For Mappings */
Route::get('/mapper', [MappingController::class, 'showMappingAndPreset'])->name('mapper.index');

Route::get('/tables/{connection}', [MappingController::class, 'getTables']);
Route::get('/columns/{connection}/{table}', [MappingController::class, 'getColumns']);
Route::post('/save-mapping', [MappingController::class, 'saveMapping']);

Route::get('/mappings', [MappingController::class, 'getMappings']);
Route::delete('/delete-mapping/{id}', [MappingController::class, 'deleteMapping']);

/* These Are For Transfers */
Route::match(['get', 'post'], '/transfer', [DataTransferController::class, 'showTransferForm']);//NEW
Route::get('/get-script-output', [DataTransferController::class, 'getScriptOutput']); //NEW
Route::get('/check-script-status', [DataTransferController::class, 'checkScriptStatus']);//NEW
Route::get('/get-latest-script-error', [DataTransferController::class, 'getLatestScriptError']);//NEW

// Route::post('/transfer', [DataTransferController::class, 'transferData']);
Route::post('/mappings', [DataTransferController::class, 'mappings']); //this used to be transfer

// Route::get('/get-mappings/{table}', [DataTransferController::class, 'getMappingsForTable']);
Route::get('/get-mappings/{mapping}', [DataTransferController::class, 'getMappingsForTable']);

Route::get('/get-databases', [DataTransferController::class, 'getDatabases']);
Route::get('/get-tables/{database}', [DataTransferController::class, 'getTablesForDatabase']);

/* These Are For Presets */
Route::post('/save-preset', [PresetController::class, 'store']);
Route::get('/preset/{id}', [PresetController::class, 'show']);
Route::get('/presets', function () {
    return App\Models\Preset::all();
});
Route::delete('/presets/{preset}', [PresetController::class, 'destroy']);

// These are for Fixer aka TransferLog fixes

Route::get('/fixer', [TransferLogController::class, 'index'])->name('fixer.index');
Route::post('/fixer/fix_missing', [TransferLogController::class, 'fixMissingValues']);
Route::post('/fixer/fix_unmatched', [TransferLogController::class, 'fixUnmatchedValues']);

Route::get('modules', [TransferLogController::class, 'getModules']);
Route::get('modules/{module}/components', [TransferLogController::class, 'getComponents']);

Route::get('/modules/{module}/components/{component}/logs', [TransferLogController::class, 'getLogs']);

Route::post('/fixer/fix_log/{log}', [TransferLogController::class, 'fixLog']);

// ---------------- Sanitizer -----------------------------------------

Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}', [ReportsController::class, 'show'])->name('reports.show');
Route::post('/reports', [ReportsController::class, 'store'])->name('reports.store');

Route::get('/reports/{report}/export/csv', [ReportsController::class, 'exportCsv'])->name('reports.export.csv');
Route::get('/reports/{report}/export/pdf', [ReportsController::class, 'exportPdf'])->name('reports.export.pdf');

Route::get('/chart', [ChartController::class, 'show'])->name('chart');
Route::post('/generate-pdf', [ChartController::class, 'generatePdf'])->name('generate-pdf');

Route::get('/get-chart-data', [ChartController::class, 'getData']);

Route::get('/report', [ChartController::class, 'index'])->name('report.index');
Route::get('/person', [ChartController::class, 'personIndex'])->name('report.person');

// Route::get('/home', 'LayoutController@show')->name('home');
Route::get('/home', [LayoutController::class, 'show'])->name('home');
Route::post('/home', [LayoutController::class, 'store'])->name('home.store');

Route::get('/admin', [LayoutController::class, 'show'])->name('home');
// Route::post('/selectLayout', 'LayoutController@selectLayout')->middleware('role')->name('selectLayout');
Route::post('/selectLayout', [LayoutController::class, 'selectLayout'])
    ->middleware('role')
    ->name('selectLayout');
Route::post('/set-layout', function (Request $request) {
    // Save the selected layout index to the session
    $request->session()->put('selectedLayoutIndex', $request->selectedLayoutIndex);
    return back();
});

Route::get('/reporting', [ReportsController::class, 'getReport'])->name('reporting');
Route::get('users/export', [UsersController::class, 'export']);

// Route::get('recentlyAddedPersons', 'ChartController@recentlyAddedPersons');
Route::get('/person', [ChartController::class, 'personIndex'])->name('report.person');

Route::group(['middleware' => ['web']], function () {
    /**
     * Route for displaying the login view.
     */
    Route::get('/login', function () {
        return View('auth.login');
    })->name('login');

    /**
     * Route for displaying the register view.
     */
    Route::get('/register', function () {
        return View('auth.register');
    })->name('register');

    /**
     * Route for registering a user.
     */
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');

    /**
     * Route for user authentication.
     */
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

/**/ //////////////////////  Start Mac Address Middleware Access /////////////////////////////////////*/

Route::get('/tts', function () {
    return view('authorize');
})->middleware('checkMacAddress');

Route::get('/get-mac-address', [MacAddressController::class, 'getMacAddress']);

/**/ //////////////////////  End Mac Address Middleware Access ///////////////////////////////////*/

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth'])
    ->name('home');

/**
 * Route for displaying the homepage.
 */
Route::get('/admin/edit-account-info', function () {
    return view('user.show');
})
    ->middleware(['auth'])
    ->name('usershow');

Route::post('/direction-switch', function () {
    request()->validate([
        'direction' => 'required|in:ltr,rtl',
    ]);
    Session::put('appdirection', request('direction'));

    return back();
})->name('direction.switch');

Route::post('/language-switch', function () {
    request()->validate([
        'language' => 'required|in:en,af',
    ]);

    Session::put('applocale', request('language'));

    return back();
})->name('language.switch');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');

Route::get('/testingview', function () {
    return view('main2');
})->name('testingview');

// ----------------Start Sales commissions------------------------
Route::get('commissions', [CommissionRateController::class, 'index'])->name('commission.index');
Route::get('sales', [SalesTransactionController::class, 'index'])->name('sales.index');
Route::get('sales/report', [SalesTransactionController::class, 'generateReport'])->name('sales.report');

Route::get('sales/create', [SalesTransactionController::class, 'create'])->name('sales.create');
Route::post('sales/store', [SalesTransactionController::class, 'store'])->name('sales.store');

Route::get('commission/create', [CommissionRateController::class, 'create'])->name('commission.create');
Route::post('commission/store', [CommissionRateController::class, 'store'])->name('commission.store');
// ----------------End Sales commissions----------------------------

Route::get('/user/{user}', [App\Http\Controllers\UserController::class, 'show']);

Route::post('/save-styles', [App\Http\Controllers\UserController::class, 'saveStyles']);

Route::get('/customize', [App\Http\Controllers\UserController::class, 'index'])->name('customize');

Route::get('/dynamic_styles', [App\Http\Controllers\UserController::class, 'index2'])->name('dynamic_styles');

// ------------------------ Start WhatsApp Routes ----------------------------------------------

Route::get('/whatsapp', [WhatsAppController::class, 'showForm'])->name('whatsapp');
Route::post('/whatsapp/send', [WhatsAppController::class, 'sendMessage'])->name('sendWhatsAppMessage');

Route::get('/whatsapp/webhook', [WhatsAppController::class, 'receiveMessage']);
Route::get('/whatsapp/messages', [WhatsAppController::class, 'showMessages'])->name('whatsappMessages');

// ------------------------  End WhatsApp Routes ---------------------------------------------

Route::get('/settings', function () {
    return view('settings');
})
    ->middleware(['auth'])
    ->name('settings');

/**
 * Route for displaying the homepage.
 */
Route::get('/contact', function () {
    return view('user-settings');
})
    ->middleware(['auth'])
    ->name('user-settings');

/**
 * Route for displaying the member view.
 */
Route::get('/member', function () {
    return view('view-member');
})->middleware(['auth']);

/**
 * Routes for Spatie Welcome Notification.
 */
Route::group(['middleware' => ['web', MiddlewareWelcomesNewUsers::class]], function () {
    /**
     * Route for displaying the welcome form.
     */
    Route::get('welcome/{user}', [MyWelcomeController::class, 'showWelcomeForm'])->name('welcome');

    /**
     * Route for saving the user's password.
     */
    Route::post('welcome/{user}', [UserController::class, 'savePassword'])->name('savePassword');
});

/**
 * Route for saving user information.
 */
Route::post('onboarding/{user}', [MyWelcomeController::class, 'saveUserInfo'])
    ->middleware(['auth'])
    ->name('save-user-info');

/**
 * Route for displaying the add user info form.
 */
Route::get('onboarding/{user}', [MyWelcomeController::class, 'showAddUserInfoForm'])
    ->middleware(['auth'])
    ->name('onboarding');

/**
 * Routes for memberships.
 */
Route::get('/memberships', 'App\Http\Controllers\MembershipsController@index')
    ->middleware(['auth'])
    ->name('memberships');

Route::controller(MembershipsController::class)->group(function () {
    /**
     * Route for displaying the membership index.
     */
    Route::get('/memberships', 'index')
        ->middleware(['auth'])
        ->name('memberships');

        Route::get('/membershipsData', 'getData')
        ->middleware(['auth'])
        ->name('membershipsData');


    /**
     * Route for displaying a member.
     */
    Route::get('/view-member/{id}', 'show')
        ->middleware(['auth'])
        ->name('view-member');

    /**
     * Route for editing a member.
     */
    Route::get('/edit-member/{id}', 'edit')
        ->middleware(['auth'])
        ->name('edit-member');


     /**
     * Route for updating a member. This handles the form submission from the edit page.
     */
    Route::put('/update-member/{id}', 'update') // Using PUT method as it's for updating resources
    ->middleware(['auth'])
    ->name('update-member');



    /**
     * Route for cancelling a member.
     */
    Route::get('/cancel-member/{id}', 'delete')
        ->middleware(['auth'])
        ->name('cancel-member');

    /**
     * Route for adding a member.
     */
    Route::get('/add-member', 'create')
        ->middleware(['auth'])
        ->name('add-member');
    Route::post('/add-member', 'store')->name('add-member.store');
    Route::get('/members/{id}', 'show')->name('members.show');
});


Route::post('/bypass-access', [UserController::class, 'bypassAccess'])->name('bypass.access');

//**----------------------------- Logs Routes ----------------------------*\

Route::get('/logs', [LogController::class, 'show'])->name('logs.show');
Route::get('/logs-table', [LogController::class, 'showtable'])->name('logs.showtable');


Route::get('/dependants', [DependantsController::class, 'index']);
Route::get('/dependantsData', [DependantsController::class, 'indexx'])->name('dependantsData');

// Define the route for fetching address data
Route::get('/addressData', [AddressController::class, 'data'])->name('addressData');


//**----------------------------- Logs Routes ----------------------------*\

/**
 * Routes for dependants.
 */
Route::get('/dependants', 'App\Http\Controllers\DependantsController@index')->middleware(['auth'])->name('dependants');
Route::middleware('auth')->group(function () {
    Route::get('/dependants', [DependantsController::class, 'index'])->name('dependants');
});

/**
 * Route for adding a dependant.
 */
//Route::post('/add-dependant', 'App\Http\Controllers\DependantsController@store')->name('add-dependant.store');
Route::post('/add-dependant', [DependantsController::class, 'store'])->name('add-dependant.store');

/**
 * Route for removing a dependant.
 */
Route::get('/remove-dependant/{id}', 'App\Http\Controllers\DependantsController@delete')
    ->middleware(['auth'])
    ->name('remove-dependant');


Route::delete('/delete-address/{id}', [MembershipsController::class, 'deleteAddress']);
Route::delete('/delete-billing/{id}', [MembershipsController::class, 'deleteBilling']);


//**----------------------- Resolution Hub Routes --------------------------------------------------**/

Route::get('/resolutionhub', [GbaController::class, 'showGroupedRecords'])->name('resolutionhub');

Route::post('/handle-main-record-action', [GbaController::class, 'handleMainRecordAction'])->name('handleMainRecordAction');

// Error records
Route::post('/process-record-action', [GbaController::class, 'processRecordAction'])->name('process.record.action');

// Dependents section
// Routes for dependent actions
// Route::post('/mark-dependent-complete/{dependentId}', [GbaController::class, 'markAsComplete'])->name('dependent.markAsComplete');
Route::post('/remove-dependent/{dependentId}', [GbaController::class, 'removeDependent'])->name('dependent.remove');

/**--------------------------------------- Start Pivot Reports --------------------------------------------------------------------------*/
Route::get('/pivotGrid', [ReportsController::class, 'pivotGrid'])->name('pivotGrid');
Route::get('/dependantsGrid', [ReportsController::class, 'dependantsGrid'])->name('dependantsGrid');
/**---------------------------------------- End Pivot Reports ----------------------------------------------------------------------------*/

    /**
     * Route for user authentication.
     */
    Route::post('/add-address', [AddressController::class, 'store'])->name('address.store');

/**------------------------------------------------------------------------------------------*/
use App\Http\Controllers\PaymentController;

Route::get('/payments', [PaymentController::class, 'index'])->name('payments');

use App\Http\Controllers\MembershipHasAddressController;

Route::get('/memberAddressData', [MembershipHasAddressController::class, 'index'])->name('memberAddressData');
Route::delete('/deleteMemberAddress/{itemId}', [MembershipHasAddressController::class, 'delete']);

/**-------------------------------------------------------------------------------------------*/


Route::get('/memberships/search', [PaymentController::class, 'search'])->name('payments');
Route::post('/save-bank-details', [MembershipBankDetailController::class, 'saveBankDetails'])->name('saveBankDetails');
Route::post('/save-cash-details', [MembershipBankDetailController::class, 'saveCashPaymentDetails'])->name('saveCashPaymentDetails');
Route::post('/save-data-via-details', [MembershipBankDetailController::class, 'saveDataViaDetails'])->name('saveDataViaDetails');
Route::post('/save-EFTdetails', [MembershipBankDetailController::class, 'saveEFTDetails'])->name('saveEFTDetails');


//Deaths Routes
Route::resource('deaths', DeathController::class);
Route::get('/person-details/{id}', [DeathController::class, 'getPersonDetails'])->name('person.details.ajax');
Route::get('/search/persons', [DeathController::class, 'searchPersons'])->name('search.persons');


//Funerals Routes
Route::resource('funerals', FuneralController::class);
Route::get('funerals/create/{id}', [FuneralController::class, 'create'])->name('funerals.create');
Route::get('funerals/edit/{id}', [FuneralController::class, 'edit'])->name('funerals.edit');

Route::post('/handle-funeral-action', [FuneralController::class, 'handleFuneralAction'])->name('handleFuneralAction');
Route::post('/store-funeral-costs', [FuneralController::class, 'StoreFuneralCosts'])->name('StoreFuneralCosts');
Route::post('/add-funeral-cost', [FuneralController::class, 'AddFuneralCost'])->name('AddFuneralCost');
Route::post('/store-funeral-address', [FuneralController::class, 'StoreFuneralAddress'])->name('StoreFuneralAddress');
Route::post('/store-funeral-beneficiary', [FuneralController::class, 'StoreFuneralBeneficiary'])->name('StoreFuneralBeneficiary');
Route::post('/edit-funeral-beneficiary', [FuneralController::class, 'EditFuneralBeneficiary'])->name('EditFuneralBeneficiary');
Route::post('/remove-funeral-beneficiary', [FuneralController::class, 'removeFuneralBeneficiary'])->name('RemoveFuneralBeneficiary');
Route::post('/store-funeral-shortfall', [FuneralController::class, 'StoreFuneralShortfall'])->name('StoreFuneralShortfall');
Route::post('/remove-shortfall-payment', [FuneralController::class, 'removeShortfallPayment'])->name('RemoveShortfallPayment');

Route::post('/update-funeral-required', [FuneralController::class, 'updateFuneralRequired'])->name('updateFuneralRequired');


Route::post('/funeral/checklist/{id}', [FuneralController::class, 'updateChecklistItem']);

// Route to handle AJAX form submission to store a new checklist item
Route::post('/checklist/store', [FuneralChecklistController::class, 'store'])->name('checklist.store');

// Route to fetch the updated checklist items
Route::get('/funerals/{id}/checklist-items', [FuneralController::class, 'fetchChecklistItems'])->name('funerals.fetchChecklistItems');


// These are for testing the gba forms if they can be displayed - to be deleted
Route::get('/gba-forms', [GbaFormsController::class, 'index'])->name('gba-forms.index');
Route::get('/gba-forms/{id}', [GbaFormsController::class, 'show'])->name('gba-forms.show');


//Used this to set/get current bu
Route::post('/update-current-bu', [UserBuController::class, 'updateCurrentBu'])->name('update.current.bu');

//Person Routes
Route::post('/person/store', [PersonController::class, 'store'])->name('person.store');

Route::get('/api/rowdetails', [DataController::class, 'getRowDetails'])->name('api.rowdetails');

use App\Http\Controllers\CommentController;


Route::delete('/notifications/{notification}', [MembershipsController::class, 'deleteNotification'])->name('notifications.delete');

// use App\Http\Controllers\BoardingController;

// Route::get('boarding/create', [BoardingController::class, 'create'])->name('boarding.create');
// Route::post('boarding', [BoardingController::class, 'store'])->name('boarding.store');

use App\Http\Controllers\TestController;
// Resource route for the Test model
/** This sets up routes for index, create, store, show, edit, update, and destroy methods in the TestController.*/
Route::resource('tests', TestController::class)->withTrashed();
Route::put('/comments/{id}', [CommentController::class, 'update']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('comments/{id}/edit', [CommentController::class, 'edit']);
Route::put('comments/{id}', [CommentController::class, 'update']);

Route::get('/chart-data', [HomeController::class, 'getChartData']);
Route::get('/chart-data2', [HomeController::class, 'getChartData2']);

Route::get('/dependant/{id}/main-member', [DependantsController::class, 'mainMember'])->name('dependant.main-member');



Route::get('/activity-logs', function () {
    //$activities = Activity::orderBy('created_at', 'desc')->get();
        $activities = Activity::orderBy('created_at', 'desc')->take(8)->get();

    return response()->json($activities);
});


require __DIR__ . '/auth.php';
