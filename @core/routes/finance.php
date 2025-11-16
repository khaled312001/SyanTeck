<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix'=>'finance','middleware'=>['auth','finance','setlang','globalVariable']],function(){
    
    Route::get('/dashboard', 'FinanceController@dashboard')->name('finance.dashboard');
    
    Route::get('/invoices', 'FinanceController@invoices')->name('finance.invoices');
    Route::post('/invoices/{id}/payment-status', 'FinanceController@updatePaymentStatus')->name('finance.invoices.update.payment.status');
    Route::get('/reports', 'FinanceController@reports')->name('finance.reports');
    Route::get('/statistics', 'FinanceController@statistics')->name('finance.statistics');
    
    // الملف الشخصي
    Route::get('/profile', 'FinanceController@profile')->name('finance.profile');
    Route::post('/profile', 'FinanceController@updateProfile')->name('finance.profile.update');
    
    // Logout
    Route::get('/logout', function() {
        Auth::guard('web')->logout();
        return redirect()->route('finance.login')->with('success', __('Logged out successfully'));
    })->name('finance.logout');
});

