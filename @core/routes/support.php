<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix'=>'support','middleware'=>['auth','support','setlang','globalVariable']],function(){
    
    Route::get('/dashboard', 'SupportController@index')->name('support.dashboard');
    
    // إدارة الطلبات
    Route::get('/orders', 'SupportController@orders')->name('support.orders');
    Route::get('/orders/{id}', 'SupportController@show')->name('support.orders.show');
    Route::post('/orders/{id}/status', 'SupportController@updateStatus')->name('support.orders.update.status');
    Route::post('/orders/{id}/assign', 'SupportController@assignTechnician')->name('support.orders.assign');
    Route::post('/orders/{id}/auto-assign', 'SupportController@autoAssignTechnician')->name('support.orders.auto.assign');
    
    // الفواتير والشهادات
    Route::get('/orders/{id}/invoice', 'InvoiceController@generateInvoice')->name('support.orders.invoice');
    Route::get('/orders/{id}/invoice/view', 'InvoiceController@viewInvoice')->name('support.orders.invoice.view');
    Route::get('/orders/{id}/invoice/download', 'InvoiceController@downloadInvoice')->name('support.orders.invoice.download');
    
    Route::get('/orders/{id}/warranty', 'WarrantyController@generateWarranty')->name('support.orders.warranty');
    Route::get('/orders/{id}/warranty/view', 'WarrantyController@viewWarranty')->name('support.orders.warranty.view');
    Route::get('/orders/{id}/warranty/download', 'WarrantyController@downloadWarranty')->name('support.orders.warranty.download');
    
    // بيانات العملاء
    Route::get('/customers', 'SupportController@customers')->name('support.customers');
    Route::get('/customers/{id}', 'SupportController@customerDetails')->name('support.customers.show');
    Route::post('/orders/{id}/note', 'SupportController@addNote')->name('support.orders.add.note');
    Route::post('/orders/{id}/region', 'SupportController@updateRegion')->name('support.orders.update.region');
    
    // تصدير البيانات
    Route::get('/export', 'SupportController@exportCSV')->name('support.export');
    
    // الملف الشخصي
    Route::get('/profile', 'SupportController@profile')->name('support.profile');
    Route::post('/profile', 'SupportController@updateProfile')->name('support.profile.update');
    
    // Logout
    Route::get('/logout', function() {
        Auth::guard('web')->logout();
        return redirect()->route('support.login')->with('success', __('Logged out successfully'));
    })->name('support.logout');
});

