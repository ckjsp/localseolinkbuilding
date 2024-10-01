<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdvertiserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', 'AdminController@index')->middleware('checkUserRole:admin');

Auth::routes(['verify' => true]);

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/logout', [LoginController::class, 'logout']);
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
        Route::post('/change-password', 'changePassword')->name('password.change.update');
        Route::get('/user/profile', 'userProfile')->name('user.profile');
        Route::post('/user/update/{id}', 'userUpdate')->name('user.update');
    });

    Route::middleware(['firstLogin', 'redirectMiddleware'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('/publisher', [PublisherController::class, 'index'])->name('publisher');

        Route::controller(WebsiteController::class)->group(function () {
            Route::get('/publisher/website', 'index')->name('publisher.website');
            Route::get('/publisher/website/create', 'create')->name('publisher.website.create');
            Route::post('/publisher/website/add', 'store')->name('publisher.website.store');
            Route::get('/publisher/website/{id}/edit', 'edit')->name('publisher.website.edit');
            Route::put('/publisher/website/{id}', 'update')->name('publisher.website.update');
            Route::get('/publisher/website/{id}/delete', 'destroy')->name('publisher.website.delete');
            Route::post('/website/filter', 'filterData')->name('website.filter');
            Route::get('/publisher/sales', 'index')->name('publisher.sales');
        });

        Route::controller(OrdersController::class)->group(function () {
            Route::get('/publisher/orders', 'index')->name('publisher.orders');
            Route::get('/publisher/orders/create', 'create')->name('publisher.orders.create');
            Route::get('/publisher/blog/{id}', 'checkArticle')->name('publisher.blog');
            Route::get('/advertiser/orders', 'index')->name('advertiser.orders');
            Route::post('/advertiser/orders/add', 'store')->name('advertiser.orders.store');
        });

        Route::controller(PaymentController::class)->group(function () {
            Route::get('/advertiser/payment', 'index')->name('advertiser.payment');
            Route::get('/publisher/payment', 'index')->name('publisher.payment');
        });
    });

    Route::controller(AdvertiserController::class)->group(function () {
        Route::get('/advertiser/marketplace', 'marketplace')->name('advertiser.marketplace');
        Route::get('/advertiser/cart', 'cart')->name('advertiser.cart');
        Route::get('/advertiser/{page?}', 'index')->name('advertiser');
        Route::get('/advertiser/{page?}', 'index')->name('advertiser');
        Route::get('/check-url', 'checkUrl')->name('check.url');

        Route::get('/competitors/{project_id}', 'getCompetitorsByProjectId')->name('competitors.get');
        Route::post('/add-competitor', 'addCompetitor')->name('addcompetitor');
        Route::post('/competitors/{projectId}/remove', 'removeCompetitor')->name('removeCompetitor');
        //Route::get('/advertiser/projects', 'projects')->name('advertiser.projects');
        //Route::get('/advertiser/projects', 'projects')->name('advertiser.projects');

        Route::get('/advertiser/projects', 'projectCreate')->name('advertiser.projects.create');
        Route::post('/advertiser/projects', 'projectStore')->name('advertiser.projects.store');
        Route::put('/advertiser/projects/{id}', 'projectUpdate')->name('advertiser.projects.update');
        Route::get('/advertiser/projects/edit/{id}', 'projectEdit')->name('advertiser.projects.edit');
        Route::post('/advertiser/menu', 'showMenu')->name('advertiser.menu');
        Route::delete('/advertiser/delete-project/{id}', 'projectDestroy')->name('advertiser.delete');
        Route::get('/advertiser/project/name', 'getProjectName')->name('advertiser.project.name');
        Route::post('/advertiser/set-selected-project', 'setSelectedProject')->name('advertiser.set.selected.project');
    });


    Route::controller(OrdersController::class)->group(function () {
        Route::get('/order/info/{id}', 'orderInfo')->name('order.info');
        Route::post('/order/update-status/{id}', 'updateStatus')->name('order.update.status');
        // Route::post('/publisher/orders/add', 'store')->name('publisher.orders.store');
        // Route::get('/publisher/orders/{id}/edit', 'edit')->name('publisher.orders.edit');
        // Route::put('/publisher/orders/{id}', 'update')->name('publisher.orders.update');
        // Route::get('/publisher/orders/{id}/delete', 'destroy')->name('publisher.orders.delete');
    });

    Route::post('charge', [StripePaymentController::class, 'charge'])->name('stripe.charge');
});

Route::controller(AdminController::class)->group(function () {
    Route::middleware(['AdminAuth', 'redirectMiddleware'])->group(function () {
        Route::get('/lslb-admin', 'index')->name('lslbadmin.dashboard');
        Route::get('/lslb-admin/websites', 'getWebsites')->name('lslbadmin.websites');
        Route::get('/lslb-admin/users', 'getUsers')->name('lslbadmin.users');
        Route::get('/lslb-admin/orders', 'getOrders')->name('lslbadmin.orders');
        Route::post('/lslb-admin/website-status-update/{id}', 'updateStatus')->name('lslbadmin.website.update.status');

        Route::get('/lslb-admin/website/{id}/edit', 'webEdit')->name('lslbadmin.website.edit');
        Route::put('/lslb-admin/website/{id}', 'webUpdate')->name('lslbadmin.website.update');
        Route::get('/lslb-admin/website/{id}/delete', 'webDestroy')->name('lslbadmin.website.delete');

        Route::get('/lslb-admin/user/{id}/edit', 'userEdit')->name('lslbadmin.user.edit');
        Route::post('/lslb-admin/user/{id}', 'userUpdate')->name('lslbadmin.user.update');
        Route::get('/lslb-admin/user/{id}/delete', 'userDestroy')->name('lslbadmin.user.delete');
    });
});



Route::get('/lslb-admin/login', function () {
    return view('lslbadmin.login');
})->name('lslbadmin.login');

// Auth::routes(['verify' => true]);
// Route::get('auth/redirect/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
// Route::get('/callback', [GoogleController::class, 'handleGoogleCallback']);
// Route::get('/link-google', function () {
//     return view('auth.link-google');
// })->name('link-google');
// Route::post('/link-google', [GoogleController::class, 'linkGoogleAccount'])->name('link-google.post');

// Route::get('/dashboard', 'DashboardController@index')->middleware('auth');
// Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
// Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
// Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
// Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
// Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout');
// Route::post('/charge', [PaymentController::class, 'charge'])->name('charge');
// Route::get('/checkout',         [PaymentController::class, 'index']);
// Route::post('/payment', [PaymentController::class, 'payment']);
