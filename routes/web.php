<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Routing\RouteGroup;
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

/**
 * Public routes
 *
 * These routes are accessible to everyone without authentication.
 * Here we display the front page, list of posts, display single posts, and allow for comments.
 */
Route::get('/', [PostController::class, 'frontpage'])->name('frontpage');

Route::get('reading/{slug}', [PostController::class, 'single'])->name('post.single');

Route::get('tags/{tag}', [PostController::class, 'filter_by_tag'])->name('filter_by_tag');

Route::get('contact', [ContactController::class, 'show'])->name('contact');

Route::post('contact', [ContactController::class, 'store'])->name('contact.submit');


/**
 * Private routes
 *
 * You should put all protected sections of the blog here.
 */

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    /**
     * Show dashboard
     */
    Route::get('dashboard', [DashboardController::class, 'display'])->name('dashboard');

    /**
     * Show Posts
     */
    Route::get('posts', [PostController::class, 'index'])->name('posts');

    /**
     * Create post
     */
    Route::get('post/new', function () {
        return view('posts.create');
    })->name('post.create');

    /**
     * Save post
     */
    Route::post('post', [PostController::class, 'save'])->name('post.save');

    /**
     * Edit post
     */
    Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');

    /**
     * Publish post
     */
    Route::put('post/{post}/visibility', [PostController::class, 'visibility']);

    /**
     * Update post
     */
    Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');

    /**
     * Delete post
     */
    Route::delete('post/{post}/delete', [PostController::class, 'delete']);

    /**
     * Show Tags
     */
    Route::get('tags', [TagController::class, 'index'])->name('tags');

    /**
     * Create Tag
     */
    Route::get('tag/new', [TagController::class, 'create'])->name('tag.new');

    /**
     * Create Tag
     */
    Route::post('tag', [TagController::class, 'store'])->name('tag.save');

    /**
     * Delete Tag
     */
    Route::delete('tag/{tag}/delete', [TagController::class, 'delete'])->name('tag.delete');

    /**
     * View messages from blog's contact form
     */
    Route::get('messages', [ContactController::class, 'index'])->name('messages');

    /**
     * Vide message
     */
    Route::get('message/{message}', [ContactController::class, 'single'])->name('messages.show');

});







