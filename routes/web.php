<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPaymentController;
use App\Http\Controllers\UserController;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get('/home', function () {
//     return view('welcome');
// });

// Route::get('/' , function(){
//     return view('add-projects');
// });

// login
Route::get('/', [AuthController::class, 'adminLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/projects', [ProjectController::class, 'showCreateProject'])
        ->name('create-project');
    Route::post('/projects', [ProjectController::class, 'addProject'])
        ->name('add-project');
    Route::delete('project/delete/{project}', [ProjectController::class, 'deleteProject'])
        ->name('delete-project');
    Route::get('project/edit/{project}', [ProjectController::class, 'editProject'])
        ->name('edit-project');
    Route::post('project/edit/{project}', [ProjectController::class, 'updateProject'])
        ->name('update-project');

    Route::get('/clients', [ClientController::class, 'showCreateClient'])
        ->name('create-client');
    Route::post('/clients', [ClientController::class, 'addClient'])
        ->name('add-client');
    Route::post('client/delete/{client}', [ClientController::class, 'deleteClient'])
        ->name('delete-client');
    Route::get('client/edit/{client}', [ClientController::class, 'editClient'])
        ->name('edit-client');
    Route::post('client/edit/{client}', [ClientController::class, 'updateClient'])
        ->name('update-client');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin-dashboard');


    Route::get('/members', [MemberController::class, 'showCreateMembers'])
        ->name('create-member');
    Route::post('/members', [MemberController::class, 'addMember'])
        ->name('add-member');
    Route::post('member/delete/{member}', [MemberController::class, 'deleteMember'])
        ->name('delete-member');
    Route::get('member/edit/{member}', [MemberController::class, 'editMember'])
        ->name('edit-member');
    Route::post('member/edit/{member}', [MemberController::class, 'updateMember'])
        ->name('update-member');


    Route::get('/users', [UserController::class, 'showCreateUsers'])
        ->name('create-users');
    Route::post('/users', [UserController::class, 'addUser'])
        ->name('add-user');
    Route::get('/user/edit/{user}', [UserController::class, 'editUser'])
        ->name('edit-user');
    Route::post('/user/edit/{user}', [UserController::class, 'updateUser'])
        ->name('update-user');
    Route::post('/user/delete/{user}', [UserController::class, 'deleteUser'])
        ->name('delete-user');


    Route::get('/payments', [PaymentController::class, 'showCreatePayments'])
        ->name('create-payment');
    Route::post('/payments', [PaymentController::class, 'addPayment'])
        ->name('add-payment');
    Route::post('payment/delete/{payment}', [PaymentController::class, 'deletePayment'])
        ->name('delete-payment');
    Route::get('payment/edit/{payment}', [PaymentController::class, 'editPayment'])
        ->name('edit-payment');
    Route::post('payment/edit/{payment}', [PaymentController::class, 'updatePayment'])
        ->name('update-payment');

    Route::get('/project/payments', [ProjectPaymentController::class, 'showProjectPayments'])
        ->name('create-project-payment');

    Route::get('/payments/reports', [PaymentController::class, 'paymentsReport'])
        ->name('payment-report');
    Route::post('payment/reports', [PaymentController::class, 'paymentReportGenerate'])
        ->name('payment-report-generate');

    Route::get('/selectors', [ClientController::class, 'showSelectorPage'])
        ->name('project-client');
    Route::get('/members_js', [MemberController::class, 'showMembersPage'])
        ->name('members.j');
    Route::get('/clients_js', [ClientController::class, 'showClientsPage'])
        ->name('clients.j');
    Route::get('/payments_js', [PaymentController::class, 'showPaymentsPage'])
        ->name('payments.j');


    Route::get('/member/profile', [MemberController::class, 'showMemberProfilePage'])
        ->name('member.profile');

    #new member
    Route::get('/payments-details', [PaymentController::class, 'getPaymentDetailsView'])
        ->name('show.payments.details');

    Route::post('/payments-details', [PaymentController::class, 'getPayemtnsByDate'])
        ->name('get.payments.by.date');

    Route::post('/view/payment/{payment}', [PaymentController::class, 'viewPayementDetails'])
        ->name('view.payment.details');

    //letters
    Route::get('/letter', [LetterController::class, 'viewLetter'])->name('view.letter');
    Route::post('/letter', [LetterController::class, 'createLetter'])->name('create.letter');
});
