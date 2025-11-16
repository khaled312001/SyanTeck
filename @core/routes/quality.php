<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix'=>'quality','middleware'=>['auth','quality','setlang','globalVariable']],function(){
    
    Route::get('/dashboard', 'QualityController@dashboard')->name('quality.dashboard');
    
    Route::get('/followups', 'QualityController@followups')->name('quality.followups');
    Route::get('/followups/create/{order_id}', 'QualityController@create')->name('quality.followups.create');
    Route::post('/followups', 'QualityController@store')->name('quality.followups.store');
    Route::get('/followups/{id}', 'QualityController@show')->name('quality.followups.show');
    Route::post('/followups/{id}', 'QualityController@update')->name('quality.followups.update');
    
    // الملف الشخصي
    Route::get('/profile', 'QualityController@profile')->name('quality.profile');
    Route::post('/profile', 'QualityController@updateProfile')->name('quality.profile.update');
    
    // Logout
    Route::get('/logout', function() {
        Auth::guard('web')->logout();
        return redirect()->route('quality.login')->with('success', __('Logged out successfully'));
    })->name('quality.logout');
});

