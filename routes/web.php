<?php

use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

//Accounting
use App\Http\Controllers\Accounting\DashboardController as AccountingDashboardController;
use App\Http\Controllers\Accounting\ElementController;
use App\Http\Controllers\Accounting\AccountController;
use App\Http\Controllers\Accounting\GroupController;
use App\Http\Controllers\Accounting\TemplateController;
use App\Http\Controllers\Accounting\BankController;
use App\Http\Controllers\Accounting\BankAccountController;
use App\Http\Controllers\Accounting\ContactController;
use App\Http\Controllers\Accounting\JournalController;

// Reports
use App\Http\Controllers\Accounting\Reports\LedgerController;
use App\Http\Controllers\Accounting\Reports\TrialBalanceController;
use App\Http\Controllers\Accounting\Reports\BalanceSheetController;
use App\Http\Controllers\Accounting\Reports\IncomeStatementController;
use App\Http\Controllers\Accounting\Reports\OwnersEquityController;
use App\Http\Controllers\Tailor\AdvancedSalaryController;

//Tailor
use App\Http\Controllers\Tailor\DashboardController as TailorDashboardController;
use App\Http\Controllers\Tailor\CustomerController;
use App\Http\Controllers\Tailor\CustomerOrderController;
use App\Http\Controllers\Tailor\DesignContoller;
use App\Http\Controllers\Tailor\DistributionController;
use App\Http\Controllers\Tailor\DuePaymentController;
use App\Http\Controllers\Tailor\EmployeeContoller;
use App\Http\Controllers\Tailor\EmployeeSalaryController;
use App\Http\Controllers\Tailor\ExpenseCategoryController;
use App\Http\Controllers\Tailor\ExpenseController;
use App\Http\Controllers\Tailor\ExpenseSubCategoryController;
use App\Http\Controllers\Tailor\FittingController;
use App\Http\Controllers\Tailor\ImageController;
use App\Http\Controllers\Tailor\ItemsController;
use App\Http\Controllers\Tailor\PaymentTypeController;
use App\Http\Controllers\Tailor\Report\LedgerReportController;
use App\Http\Controllers\Tailor\WorkerController;
use App\Http\Controllers\Tailor\WorkerSalaryController;
use App\Http\Controllers\Tailor\CashController;
use App\Http\Controllers\Tailor\LoanController;
use App\Http\Controllers\Tailor\LoanInstallmentController;
use App\Http\Controllers\Tailor\Sms\SmsController;
use App\Http\Controllers\Tailor\VoucherController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return view('auth.login');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // Services controller
    // Route::get('/', [ServicesController::class, 'index'])->name('services');

    // Developer area
    // Route::prefix('developer')->group(function() {
    //     Route::get('/', [DashboardController::class, 'index'])->name('developer');
    //     Route::resource('menu', MenuController::class);
    // });

    // dashboard route
    Route::prefix('dashboard')->group(function () {
        // Dashboard controller
        // Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');


    });

    // accounting route
    Route::prefix('accounting')->group(function () {
        // dashboard
        Route::get('/', [AccountingDashboardController::class, 'index'])->name('accounting.dashboard');

        // all the resource route
        Route::resources([
            'elements' => ElementController::class,

        ]);

        // Account routes
        Route::resource('accounts', AccountController::class);
        Route::get('/account-trash', [AccountController::class, 'trash'])->name('accounts.trash');
        Route::post('/account-trash', [AccountController::class, 'restoreOrDelete'])->name('accounts.trash');
        Route::get('/account-restore/{id}', [AccountController::class, 'restore'])->name('accounts.restore');
        Route::get('/account-permanentDelete/{id}', [AccountController::class, 'permanentDelete'])->name('accounts.permanentDelete');

        // Group routes
        Route::resource('group', GroupController::class);
        Route::get('/group-trash', [GroupController::class, 'trash'])->name('group.trash');
        Route::post('/group-trash', [GroupController::class, 'restoreOrDelete'])->name('group.trash');
        Route::get('/group-restore/{id}', [GroupController::class, 'restore'])->name('group.restore');
        Route::get('/group-permanentDelete/{id}', [GroupController::class, 'permanentDelete'])->name('group.permanentDelete');

        // Template routes
        Route::resource('template', TemplateController::class);
        Route::get('/template-trash', [TemplateController::class, 'trash'])->name('template.trash');
        Route::post('/template-trash', [TemplateController::class, 'restoreOrDelete'])->name('template.trash');
        Route::get('/template-restore/{id}', [TemplateController::class, 'restore'])->name('template.restore');
        Route::get('/template-permanentDelete/{id}', [TemplateController::class, 'permanentDelete'])->name('template.permanentDelete');

        // Bank Routes
        Route::resource('bank', BankController::class);
        Route::get('/bank-trash', [BankController::class, 'trash'])->name('bank.trash');
        Route::post('/bank-trash', [BankController::class, 'restoreOrDelete'])->name('bank.trash');
        Route::get('/bank-restore/{id}', [BankController::class, 'restore'])->name('bank.restore');
        Route::get('/bank-permanentDelete/{id}', [BankController::class, 'permanentDelete'])->name('bank.permanentDelete');

        // Bank-Account Routes
        Route::resource('bankAccount', BankAccountController::class);
        Route::get('/bankAccount-trash', [BankAccountController::class, 'trash'])->name('bankAccount.trash');
        Route::post('/bankAccount-trash', [BankAccountController::class, 'restoreOrDelete'])->name('bankAccount.trash');
        Route::get('/bankAccount-restore/{id}', [BankAccountController::class, 'restore'])->name('bankAccount.restore');
        Route::get('/bankAccount-permanentDelete/{id}', [BankAccountController::class, 'permanentDelete'])->name('bankAccount.permanentDelete');

        // Contact
        Route::resource('contact', ContactController::class);
        Route::get('/contact-trash', [ContactController::class, 'trash'])->name('contact.trash');
        Route::post('/contact-trash', [ContactController::class, 'restoreOrDelete'])->name('contact.trash');
        Route::get('/contact-restore/{id}', [ContactController::class, 'restore'])->name('contact.restore');
        Route::get('/contact-permanentDelete/{id}', [ContactController::class, 'permanentDelete'])->name('contact.permanentDelete');

        // Journal
        Route::resource('journal', JournalController::class);
        Route::get('/journal-trash', [JournalController::class, 'trash'])->name('journal.trash');
        Route::post('/journal-trash', [JournalController::class, 'restoreOrDelete'])->name('journal.trash');
        Route::get('/journal-restore/{id}', [JournalController::class, 'restore'])->name('journal.restore');
        Route::get('/journal-permanentDelete/{id}', [JournalController::class, 'permanentDelete'])->name('journal.permanentDelete');

        // Reports route
        Route::get('/ledger', [LedgerController::class, 'index'])->name('reports.ledger');
        Route::get('/trialBalance', [TrialBalanceController::class, 'index'])->name('reports.trialBalance');
        Route::get('/balanceSheet', [BalanceSheetController::class, 'index'])->name('reports.balanceSheet');
        Route::get('/incomeStatement', [IncomeStatementController::class, 'index'])->name('reports.incomeStatement');
        Route::get('/ownersEquity', [OwnersEquityController::class, 'index'])->name('reports.ownersEquity');
    });


    // accounting route
    Route::prefix('tailor')->group(function () {
        // dashboard
        Route::get('/', [TailorDashboardController::class, 'index'])->name('tailor.dashboard');

        // all the resource route
        Route::resources([
            'customer'              => CustomerController::class,
            'customer-order'        => CustomerOrderController::class,
            'items'                 => ItemsController::class,
            'design'                => DesignContoller::class,
            'fitting'               => FittingController::class,
            'expense'               => ExpenseController::class,
            'expense-category'      => ExpenseCategoryController::class,
            'expense-subcategory'   => ExpenseSubCategoryController::class,
            'due-payments'          => DuePaymentController::class,
            'payment-type'          => PaymentTypeController::class,
            'worker'                => WorkerController::class,
            'distribution'          => DistributionController::class,
            'image'                 => ImageController::class,
            'employee'              => EmployeeContoller::class,
            'employee-salary'       => EmployeeSalaryController::class,
            'worker-salary'         => WorkerSalaryController::class,
            'advanced-salary'       => AdvancedSalaryController::class,
            'cash'                  => CashController::class,
            'voucher'               => VoucherController::class,
            'loan'                  => LoanController::class,
            'loan-installment'      => LoanInstallmentController::class,
        ]);

        Route::get('/password', [PasswordController::class, 'create'])->name('password.reset');
        Route::post('/password', [PasswordController::class, 'update'])->name('password.update');

        Route::get('/payment-receive/{id}', [DuePaymentController::class, 'paymentReceive'])->name('paymentReceive.create');
        Route::get('/distribution-status/{id}', [DistributionController::class, 'statusChangeToComplete'])->name('distribution.status');
        Route::get('/cutomerOrder-status/{id}', [CustomerOrderController::class, 'statusChangeToDelivery'])->name('customerOrder.status');

        //Payroll
        Route::get('salaryPay/{id}', [EmployeeSalaryController::class, 'salaryPay'])->name('employee-salary.salaryPay');
        Route::post('get-salary-details', [EmployeeSalaryController::class, 'salaryDetails']);

        // Report controllers
        Route::get('/customer-ledger', [LedgerReportController::class, 'customerLedger'])->name('ledger-report.customer');
        Route::get('/worker-ledger', [LedgerReportController::class, 'workerLedger'])->name('ledger-report.worker');

        Route::get('loan-paid/{id}', [LoanController::class, 'loanPaid'])->name('loan.paid');

        //SMS routes
        Route::get('/group-sms', [SmsController::class, 'groupSms'])->name('sms.groupSms');
        Route::post('/group-sms', [SmsController::class, 'groupSmsSend']);

        Route::get('/custom-sms', [SmsController::class, 'customSms'])->name('sms.customSms');
        Route::post('/custom-sms', [SmsController::class, 'customSmsSend']);

    });

    // axios route
    Route::prefix('axios')->group(function () {
        Route::post('/getTemplatesByGroupId', [TemplateController::class, 'getTemplatesByGroupId']);
        Route::post('/getTemplateDetailsByTemplateId', [TemplateController::class, 'getTemplateDetailsByTemplateId']);

        // expense
        Route::post('/getSubcategoriesById', [ExpenseSubCategoryController::class, 'getSubcategoriesById']);

        Route::post('/recieveAllData', [CustomerOrderController::class, 'store']);
        Route::post('/updatedAllData/{id}', [CustomerOrderController::class, 'update']);
        Route::post('/getAllWorkerCost', [WorkerController::class, 'getAllWorkerCost']);

        Route::post('/getItemsCostbyId', [WorkerSalaryController::class, 'getItemsCostbyId']);
        Route::post('/getDistributeCompleteData', [WorkerSalaryController::class, 'getDistributeCompleteData']);

        Route::post('/getEmployeeDetailsbyId', [EmployeeSalaryController::class, 'getEmployeeDetailsbyId']);

        Route::post('/getDesignByItemId', [DesignContoller::class, 'getDesignByItemId']);

        Route::post('/getVouchernumberOrname', [VoucherController::class, 'getVouchernumberOrname']);

        Route::post('/getPreviousOrderByCustomerId', [CustomerOrderController::class, 'getPreviousOrderByCustomerId']);

    });
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return "Storage link create successfully";
});

