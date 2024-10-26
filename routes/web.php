<?php


use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\UserHomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;

// Redirect to login as the default route
Route::get('/', function () {
    return view('auth.login');
});


// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authentication routes
Auth::routes();
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Define the users.home route
Route::get('users/home', [UserHomeController::class, 'index'])->name('users.home');

// Admin routes with middleware
Route::middleware([AdminMiddleware::class])->group(function () {
    // Define the admin.home route
    Route::get('admin/home', [AdminHomeController::class, 'index'])->name('admin.home');

    // Resource routes for user management (for admin)
    Route::resource('admin/users', UserController::class);
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');

    // Resource routes for Category
    Route::resource('categories', CategoryController::class);
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

    // Resource routes for Supplier
    Route::resource('suppliers', SupplierController::class);

    // Resource routes for Product
    Route::resource('admin/products', ProductController::class);
    Route::prefix('admin')->name('admin.')->group(function () {
        // Route to display the list of products
        Route::get('admin/products', [ProductController::class, 'index'])->name('products.index');
    
        // Route to show the form for creating a new product
        Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
    
        // Route to store a newly created product
        Route::post('admin/products', [ProductController::class, 'store'])->name('products.store');
    
        // Route to show the form for editing a product
        Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    
        // Route to update an existing product
        Route::put('admin/products/{product}', [ProductController::class, 'update'])->name('products.update');
    
        // Route to delete a product
        Route::delete('admin/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
    
});

// User-specific routes with middleware
Route::middleware([UserMiddleware::class])->group(function () {
    // Redirect /home to users.home
    Route::get('/home', [UserHomeController::class, 'index'])->name('users.home');
});

Route::get('/users/products', [UserProductController::class, 'index'])->name('users.products.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('users.profile.index');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('users.profile.update');
    Route::put('/profile/change-password', [UserProfileController::class, 'changePassword'])->name('users.profile.changePassword');
    Route::delete('/profile', [UserProfileController::class, 'delete'])->name('users.profile.delete');
});

Route::middleware([AdminMiddleware::class])->group(function () {
Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});