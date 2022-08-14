<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DAGController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\HOSController;
use App\Http\Controllers\PeerController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TaskController;

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

;



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store'])->name('login.action');
	// Route::get('/login/forgot-password', [ResetController::class, 'create']);
	// Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	// Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	// Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});


Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', [SessionsController::class, 'destroy']);

    //users routes
    Route::post('/create-user', [UserController::class, 'createUser'])->name('create-user');
    Route::get('/user-suspend/{id}', [UserController::class, 'suspendUser'])->name('suspend.user');
    Route::get('/user-activate/{id}', [UserController::class, 'activateUser'])->name('activate.user');
    Route::get('/user-delete/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
    Route::get('/user-view/{id}', [UserController::class, 'viewUser'])->name('view.user');
    Route::get('/user-profile/{id}', [UserController::class, 'userProfile'])->name('user.profile');
    Route::get('/user-edit', [UserController::class, 'userEdit'])->name('user.edit');
    Route::post('/edit-profile-image', [UserController::class, 'editProfileImage'])->name('edit.profile.image');
    Route::post('/edit-profile-password', [UserController::class, 'editProfilePassword'])->name('edit.profile.password');
    Route::post('/edit-profile-information', [UserController::class, 'editProfileInformation'])->name('edit.profile.information');



    //Dashboard Routes
    Route::get('/home',[DashboardController::class, 'index'])->name('home');

    //Admin Routes
    Route::get('/list-admin', [AdminController::class, 'listAdmin'])->name('list-admin');


    //DAG Routes
    Route::get('/list-DAG', [DAGController::class, 'listDAG'])->name('list-DAG');



    //HOS Routes
    Route::get('/list-HOS', [HOSController::class, 'listHOS'])->name('list-HOS');


    //Personnel Routes
    Route::get('/list-Personnel', [PersonnelController::class, 'listPersonnel'])->name('list-Personnel');


    //Trash routes
    Route::get('/deleted-users-list', [TrashController::class, 'deletedUsersList'])->name('deleted.users.list');
    Route::get('/restore-user/{id}', [TrashController::class, 'restoreUser'])->name('restore.user');


    //video Routes
    Route::get('/peer-video', [PeerController::class, 'index'])->name('peer-video');
    Route::get('/peer-video/{type}/{room_id}', [PeerController::class, 'start'])->name('peer-video-start');
    Route::post('/create-peer', [PeerController::class, 'createPeer'])->name('create-peer');
    Route::get('/delete-peer/{id}', [PeerController::class, 'deletePeer'])->name('delete-peer');

    Route::get('/conference-video', [ConferenceController::class, 'index'])->name('conference-video');
    Route::post('/create-conference', [ConferenceController::class, 'createConference'])->name('create-conference');
    Route::get('/delete-conference/{id}', [ConferenceController::class, 'deleteConference'])->name('delete-conference');
    Route::get('/conference-view/{id}', [ConferenceController::class, 'viewConference'])->name('conference-view');
    Route::post('/add-users-conference/{id}', [ConferenceController::class, 'addUserConference'])->name('add-users-conference');
    Route::get('/delete-users-conference/{conference_id}/{user_id}', [ConferenceController::class, 'deleteUserConference'])->name('delete-users-conference');

    //Department Routes
    Route::post('/create-department', [DepartmentController::class, 'createDepartment'])->name('create-department');
    Route::get('/list-department', [DepartmentController::class, 'index'])->name('list-department');
    Route::get('/view-department/{id}', [DepartmentController::class, 'viewDepartment'])->name('view-department');
    Route::get('/delete-department/{department_id}', [DepartmentController::class, 'deleteDepartment'])->name('delete-department');
    Route::get('/update-status-department/{status}/{department_id}', [DepartmentController::class, 'updateDepartmentStatus'])->name('update-status-department');
    Route::post('/add-personnel-department/{id}', [DepartmentController::class, 'addUserDepartment'])->name('add-personnel-department');
    Route::post('/remove-personnel-department/{id}', [DepartmentController::class, 'removeUserDepartment'])->name('remove-personnel-department');

    //Task routes
    Route::get('/list-task', [TaskController::class, 'index'])->name('list-task');
    Route::post('/create-task', [TaskController::class, 'createTask'])->name('create-task');
    Route::post('/add-personnel-task/{id}', [TaskController::class, 'addPersonnelTask'])->name('add-personnel-task');
    Route::post('/remove-personnel-task/{id}', [TaskController::class, 'removePersonnelTask'])->name('remove-personnel-task');
    Route::get('/view-task/{id}', [TaskController::class, 'viewTask'])->name('view-task');


    //pdf Routes

    Route::get('/getAllUsers/{task_id}', [PDFController::class, 'getAllUsers'])->name('getAllUsers');
    Route::get('/getPdf/{task_id}', [PDFController::class, 'downloadPDF'])->name('downloadPDF');
});


