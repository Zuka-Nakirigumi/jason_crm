<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware(['auth'])->group(function(){
    Route::get('/', function(){ return redirect()->route('leads.index'); });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::resource('leads', LeadController::class);          // leads index/create/edit/show
    Route::resource('services', ServiceController::class);    // product master

    // projects with approval routes
    Route::resource('projects', ProjectController::class);
    Route::post('projects/{project}/approve', [ProjectController::class,'approve'])->name('projects.approve');
    Route::post('projects/{project}/reject', [ProjectController::class,'reject'])->name('projects.reject');

    // subscriptions (already subscribed customers)
    Route::get('subscriptions', [SubscriptionController::class,'index'])->name('subscriptions.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

});


require __DIR__.'/auth.php';
