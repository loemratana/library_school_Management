<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublisherController;
use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('home');
Route::get('/catalog', [\App\Http\Controllers\FrontendController::class, 'catalog'])->name('catalog');
Route::get('/book/{id}', [\App\Http\Controllers\FrontendController::class, 'bookDetails'])->name('book.details');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/users', [AdminController::class, 'UserManagement'])->name('admin.user.management');
    Route::post('/users/store', [AdminController::class, 'UserStore'])->name('admin.user.store');
    Route::get('/users/{id}', [AdminController::class, 'UserDelete'])->name('admin.user.delete');

    Route::post('/users/{id}', [AdminController::class, 'UserUpdate'])->name('admin.user.update');
    Route::get('/users/view/{id}', [AdminController::class, 'UserView'])->name('admin.user.view');
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('admin.reports');
});
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category', 'index')->name('admin.category');
    Route::post('/category/store', 'store')->name('category.store');
    Route::post('/category/update', 'update')->name('category.update');
    Route::get('/category/delete/{id}', 'destroy')->name('category.delete');
});

Route::controller(AuthorController::class)->group(function () {
    Route::get('/admin/authors', 'index')->name('admin.author');
    Route::post('/admin/authors/store', 'store')->name('author.store');
    Route::post('/admin/authors/update', 'update')->name('author.update');
    Route::get('/admin/authors/delete/{id}', 'destroy')->name('author.delete');
});

Route::controller(PublisherController::class)->group(function () {
    Route::get('/admin/publishers', 'index')->name('admin.publisher');
    Route::post('/admin/publishers/store', 'store')->name('publisher.store');
    Route::post('/admin/publishers/update', 'update')->name('publisher.update');
    Route::get('/admin/publishers/delete/{id}', 'destroy')->name('publisher.delete');
});

Route::controller(App\Http\Controllers\BookController::class)->group(function () {
    Route::get('/admin/books', 'index')->name('admin.book');
    Route::get('/admin/books/collection', 'collection')->name('admin.book.collection');
    Route::post('/admin/books/store', 'store')->name('book.store');
    Route::post('/admin/books/update', 'update')->name('book.update');
    Route::get('/admin/books/delete/{id}', 'destroy')->name('book.delete');
    Route::get('/admin/books/qr/{id}', 'generateQr')->name('book.qr');
});

Route::controller(App\Http\Controllers\BorrowController::class)->group(function () {
    Route::get('/admin/borrows', 'index')->name('admin.borrows');
    Route::get('/admin/borrows/books', 'booksCollection')->name('admin.borrows.books');
    Route::post('/admin/borrows/store', 'store')->name('borrow.store');
    Route::post('/admin/borrows/return/{id}', 'returnBook')->name('borrow.return');
    Route::post('/admin/borrows/renew/{id}', 'renewBook')->name('borrow.renew');
    Route::post('/admin/borrows/fine-paid/{id}', 'markFinePaid')->name('borrow.fine.paid');
    Route::get('/admin/reservations', 'reservations')->name('admin.reservations');
});

// Admin Review Routes
Route::middleware(['auth', 'role:admin'])->controller(App\Http\Controllers\ReviewController::class)->group(function () {
    Route::get('/admin/reviews', 'index')->name('admin.reviews');
    Route::post('/admin/reviews/toggle/{id}', 'toggleApproval')->name('admin.review.toggle');
    Route::get('/admin/reviews/delete/{id}', 'destroy')->name('admin.review.delete');
});

// Admin System Settings Routes
Route::middleware(['auth', 'role:admin'])->controller(App\Http\Controllers\LibrarySettingController::class)->group(function () {
    Route::get('/admin/settings', 'index')->name('admin.settings');
    Route::post('/admin/settings/update', 'update')->name('admin.settings.update');
});

// Member Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/member/dashboard', [\App\Http\Controllers\MemberDashboardController::class, 'index'])->name('member.dashboard');
    
    // Reservations
    Route::post('/reserve/{book_id}', [\App\Http\Controllers\ReservationController::class, 'store'])->name('reserve.store');
    Route::post('/reserve/{id}/cancel', [\App\Http\Controllers\ReservationController::class, 'cancel'])->name('reserve.cancel');

    // Reviews
    Route::post('/review/{book_id}', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
});
