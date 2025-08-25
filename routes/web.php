<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

// Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/cases', [FrontendController::class, 'cases'])->name('cases');
Route::get('/cases/{id}', [FrontendController::class, 'caseDetail'])->name('cases.detail');
Route::get('/news', [FrontendController::class, 'news'])->name('news');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'storeContact'])->name('contact.store');

// API Routes for AJAX
Route::get('/api/cases/{id}', [FrontendController::class, 'getCase']);
Route::get('/api/news/{id}', [FrontendController::class, 'getNews']);
