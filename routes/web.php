<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\Admin\VolunteerController as AdminVolunteerController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;


Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| PROJETS - PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/projects', [
    ProjectController::class,
    'index'
])->name('projects.index');

Route::get('/projects/{slug}', [
    ProjectController::class,
    'show'
])->name('projects.show');


/*
|--------------------------------------------------------------------------
| DONS - PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/don', [
    DonationController::class,
    'create'
])->name('donations.create');

Route::post('/don', [
    DonationController::class,
    'store'
])->name('donations.store');

Route::get('/don/merci/{donation}', [
    DonationController::class,
    'success'
])->name('donations.success');


/*
|--------------------------------------------------------------------------
| ADMINISTRATION - AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [
    AuthController::class,
    'showLogin'
])->name('admin.login');

Route::post('/admin/login', [
    AuthController::class,
    'login'
])->name('admin.login.submit');

Route::get('/admin/register', [
    AuthController::class,
    'showRegister'
])->name('admin.register');

Route::post('/admin/register', [
    AuthController::class,
    'register'
])->name('admin.register.submit');

Route::post('/admin/logout', [
    AuthController::class,
    'logout'
])->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMINISTRATION
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin')
    ->group(function () {

        /*
        | Dashboard
        */

        Route::get('/', [
            DashboardController::class,
            'index'
        ])->name('dashboard');


        /*
        | Projets
        */

        Route::resource(
            'projets',
            AdminProjectController::class
        )
        ->except(['show'])
        ->names('projects');

        Route::patch('/projets/{project}/statut', [
            AdminProjectController::class,
            'toggleStatus'
        ])->name('projects.status');


        /*
        | Dons
        */

        Route::get('/dons', [
            AdminDonationController::class,
            'index'
        ])->name('donations.index');

        Route::get('/dons/{donation}', [
            AdminDonationController::class,
            'show'
        ])->name('donations.show');

        Route::patch('/dons/{donation}/confirmer', [
            AdminDonationController::class,
            'confirm'
        ])->name('donations.confirm');

        Route::patch('/dons/{donation}/annuler', [
            AdminDonationController::class,
            'cancel'
        ])->name('donations.cancel');


        /*
        | Actualités
        */

        Route::resource(
            'actualites',
            AdminNewsController::class
        )
        ->except(['show'])
        ->names('news');

        Route::patch('/actualites/{news}/statut', [
            AdminNewsController::class,
            'toggleStatus'
        ])->name('news.status');
Route::get('/benevoles', [
    AdminVolunteerController::class,
    'index'
])->name('volunteers.index');

Route::get('/benevoles/{volunteer}', [
    AdminVolunteerController::class,
    'show'
])->name('volunteers.show');

Route::patch('/benevoles/{volunteer}/accepter', [
    AdminVolunteerController::class,
    'accept'
])->name('volunteers.accept');

Route::patch('/benevoles/{volunteer}/refuser', [
    AdminVolunteerController::class,
    'reject'
])->name('volunteers.reject');

Route::delete('/benevoles/{volunteer}', [
    AdminVolunteerController::class,
    'destroy'
])->name('volunteers.destroy');
Route::get('/messages', [
    AdminContactController::class,
    'index'
])->name('contacts.index');

Route::get('/messages/{contact}', [
    AdminContactController::class,
    'show'
])->name('contacts.show');

Route::patch('/messages/{contact}/non-lu', [
    AdminContactController::class,
    'markAsUnread'
])->name('contacts.unread');

Route::delete('/messages/{contact}', [
    AdminContactController::class,
    'destroy'
])->name('contacts.destroy');

    });
Route::get('/actualites', [NewsController::class, 'index'])
    ->name('news.index');

Route::get('/actualites/{slug}', [NewsController::class, 'show'])
    ->name('news.show');


Route::get('/volontaire', [VolunteerController::class, 'create'])
    ->name('volunteers.create');

Route::post('/volontaire', [VolunteerController::class, 'store'])
    ->name('volunteers.store');

Route::get('/volontaire/merci', [VolunteerController::class, 'success'])
    ->name('volunteers.success');

Route::get('/contact', [ContactController::class, 'create'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/contact/merci', [ContactController::class, 'success'])
    ->name('contact.success');