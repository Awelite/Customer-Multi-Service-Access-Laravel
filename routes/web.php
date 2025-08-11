<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Customer\ServiceRequestController as CustomerServiceRequestController;
use App\Http\Controllers\User\ServiceRequestController as UserServiceRequestController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\AdminProviderController;
use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\ProviderRequestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'customer':
                return redirect()->route('customer.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
                abort(403, 'Unauthorized role.');
        }
    }
    return redirect('/login');
});

// Admin Routes

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
Route::get('/requests', [ServiceRequestController::class, 'index'])->name('admin.requests.index');//
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Service Requests page
   // Route::get('/requests', [\App\Http\Controllers\Admin\ServiceRequestController::class, 'index'])->name('requests.index');//

    // Service Request Management
    Route::get('/service-requests', [ServiceRequestController::class, 'index'])->name('admin.service_requests.index');
    Route::get('/service-requests/{id}/edit', [ServiceRequestController::class, 'edit'])->name('admin.requests.edit');
    Route::put('/service-requests/{id}', [ServiceRequestController::class, 'update'])->name('admin.requests.update');
    Route::post('/service-requests/{id}/assign', [ServiceRequestController::class, 'assignStaff'])->name('admin.requests.assign');
    Route::resource('service-requests', ServiceRequestController::class)->names('admin.service-requests');

    Route::get('/customers', [AdminDashboardController::class, 'customersList'])->name('admin.customers');
    Route::get('/all-providers', [AdminDashboardController::class, 'providersList'])->name('admin.all_providers');
    Route::get('/all-requests', [AdminDashboardController::class, 'serviceRequests'])->name('admin.all_requests');

    Route::resource('services', AdminServiceController::class)->only(['index', 'create', 'store']);

    // Services CRUD
    Route::get('/services', [ServiceController::class, 'index'])->name('admin.services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

    // Admin Provider Management
    Route::get('/providers', [AdminProviderController::class, 'index'])->name('admin.providers.index');
    Route::get('/providers/{id}', [AdminProviderController::class, 'show'])->name('admin.providers.show');
    Route::post('/providers/{id}/approve', [AdminProviderController::class, 'approve'])->name('admin.providers.approve');
    Route::post('/providers/{id}/decline', [AdminProviderController::class, 'decline'])->name('admin.providers.decline');
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    Route::get('/request-service', [CustomerController::class, 'createRequest'])->name('service-requests.create');
    Route::post('/request-service', [CustomerController::class, 'storeRequest'])->name('service-requests.store');
    Route::get('/requests', [CustomerServiceRequestController::class, 'index'])->name('requests');

    // Booking Routes
    Route::get('/find-services', [CustomerBookingController::class, 'search'])->name('find.services');
    Route::post('/request-service/{providerId}', [CustomerBookingController::class, 'store'])->name('request.service');
});

// Provider Dashboard + Request Management
Route::middleware(['auth', 'role:provider', 'approved.provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderController::class, 'dashboard'])->name('dashboard');
    Route::get('/requests', [ProviderRequestController::class, 'index'])->name('requests');
    Route::post('/requests/{id}/accept', [ProviderRequestController::class, 'accept'])->name('requests.accept');
    Route::post('/requests/{id}/reject', [ProviderRequestController::class, 'reject'])->name('requests.reject');
});

// Provider Waiting Page
Route::get('/provider/waiting', function () {
    return view('provider.waiting');
})->name('provider.waiting');

// ✅ Provider Registration
Route::middleware(['auth', 'role:provider'])->group(function () {
    Route::get('/provider/register', [ProviderController::class, 'showRegisterForm'])->name('provider.register');
    Route::post('/provider/register', [ProviderController::class, 'store'])->name('provider.store');
});

// Staff Routes
Route::middleware(['auth', 'role:staff'])->prefix('staff')->group(function () {
    Route::get('/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
});

// User Routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/my-requests', [UserServiceRequestController::class, 'index'])->name('user.requests.index');
});

// Customer direct service request route (used in some forms)
Route::post('/customer/request-service/{provider}', [ServiceRequestController::class, 'store'])
    ->middleware(['auth', 'role:customer'])
    ->name('customer.request.service');

// Role Selection Page
Route::get('/register/choose', function () {
    return view('auth.choose_role');
})->name('register.choose');

// Laravel Breeze Auth Routes
require __DIR__.'/auth.php';
