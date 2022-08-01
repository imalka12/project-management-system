<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberImageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
});

Route::get('/get/clients', [ClientController::class, 'getAllClients'])
    ->name('get.all.clients');
Route::get('/get/project_by_client/{client_id}', [ClientController::class, 'getProjectsByClient'])
    ->name('get.projects');
Route::get('/get/payments_by_project/{project_id}', [PaymentController::class, 'getPaymentsByProject'])
    ->name('get.projects');


//members
Route::post('/create/members', [MemberController::class, 'createNewMember'])
    ->name('create.new.member');
Route::get('/get/members', [MemberController::class, 'getAllMembers'])
    ->name('create.all.member');
Route::post('/member/edit/{member}', [MemberController::class, 'updateSelectedMember'])
    ->name('edit.member');
Route::delete('/member/delete/{member}', [MemberController::class, 'deleteSelectedMember'])
    ->name('delete.member');
Route::get('/member/{member}', [MemberController::class, 'getMember'])
    ->name('get.member');

//clients
Route::post('/create/clients', [ClientController::class, 'createNewClient'])
    ->name('create.new.client');
Route::get('/get/clients', [ClientController::class, 'getAllClient'])
    ->name('get.all.client');
Route::delete('/client/delete/{client}', [ClientController::class, 'deleteSelectedClient'])
    ->name('delete.client');
Route::get('/client/{client}', [ClientController::class, 'getClient'])
    ->name('get.client');
Route::post('/client/edit/{client}', [ClientController::class, 'updateSelectedClient'])
    ->name('edit.client');


//payments
Route::get('/get/projects', [ProjectController::class, 'getAllProjects'])
    ->name('get.all.projects');
Route::post('/create/payments', [PaymentController::class, 'createNewPayment'])
    ->name('create.new.payment');
Route::get('/get/payments', [PaymentController::class, 'getAllPayments'])
    ->name('get.all.payments');
Route::delete('/payment/delete/{payment}', [PaymentController::class, 'deleteSelectedPayment'])
    ->name('delete.payment');
Route::get('/payment/{payment}', [PaymentController::class, 'getPaymentRecord'])
    ->name('get.payment');
Route::post('/payment/edit/{payment}', [PaymentController::class, 'updateSelectedPayment'])
    ->name('update.payment');

Route::post('/profile/image', [MemberImageController::class, 'saveProfileImage'])
    ->name('save.profile.image');
Route::delete('/profile/image/delete/{image}', [MemberImageController::class, 'deleteProfileImage'])
    ->name('delete.profile.image');



