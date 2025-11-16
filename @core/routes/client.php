<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix'=>'client','middleware'=>['auth','client','setlang','globalVariable']],function(){
    
    Route::get('/dashboard', 'ClientController@dashboard')->name('client.dashboard');
    
    // إدارة الطلبات
    Route::get('/orders', 'ClientController@orders')->name('client.orders');
    Route::get('/new-request', 'ClientController@createRequest')->name('client.orders.create');
    Route::post('/new-request', 'ClientController@storeRequest')->name('client.orders.store');
    Route::get('/track/{code}', 'ClientController@trackOrder')->name('client.track');
    
    // الفواتير والضمانات
    Route::get('/invoice/{id}', 'ClientController@invoice')->name('client.invoice');
    Route::get('/warranty/{id}', 'ClientController@warranty')->name('client.warranty');
    
    // الملف الشخصي
    Route::get('/profile', 'ClientController@profile')->name('client.profile');
    Route::post('/profile', 'ClientController@updateProfile')->name('client.profile.update');
    
    // Logout
    Route::get('/logout', function() {
        Auth::guard('web')->logout();
        return redirect()->route('client.login')->with('success', __('Logged out successfully'));
    })->name('client.logout');
});

