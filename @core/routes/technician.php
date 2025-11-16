<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'technician','middleware'=>['auth','technician','setlang','globalVariable']],function(){
    
    Route::get('/dashboard', 'TechnicianController@dashboard')->name('technician.dashboard');
    
    // إدارة الطلبات
    Route::get('/orders', 'TechnicianController@orders')->name('technician.orders');
    Route::get('/orders/{id}', 'TechnicianController@orderDetails')->name('technician.orders.show');
    Route::post('/orders/{id}/accept', 'TechnicianController@acceptOrder')->name('technician.orders.accept');
    Route::post('/orders/{id}/reject', 'TechnicianController@rejectOrder')->name('technician.orders.reject');
    Route::post('/orders/{id}/status', 'TechnicianController@updateStatus')->name('technician.orders.update.status');
    
    // رفع صور العطل
    Route::post('/orders/{id}/upload-images', 'TechnicianController@uploadIssueImages')->name('technician.orders.upload.images');
    Route::delete('/orders/{id}/delete-image', 'TechnicianController@deleteIssueImage')->name('technician.orders.delete.image');
    
    // الفواتير والشهادات
    Route::get('/orders/{id}/invoice', 'InvoiceController@generateInvoice')->name('technician.orders.invoice');
    Route::get('/orders/{id}/invoice/view', 'InvoiceController@viewInvoice')->name('technician.orders.invoice.view');
    Route::get('/orders/{id}/invoice/download', 'InvoiceController@downloadInvoice')->name('technician.orders.invoice.download');
    
    Route::get('/orders/{id}/warranty', 'WarrantyController@generateWarranty')->name('technician.orders.warranty');
    Route::get('/orders/{id}/warranty/view', 'WarrantyController@viewWarranty')->name('technician.orders.warranty.view');
    Route::get('/orders/{id}/warranty/download', 'WarrantyController@downloadWarranty')->name('technician.orders.warranty.download');
    
    // الملف الشخصي
    Route::get('/profile', 'TechnicianController@profile')->name('technician.profile');
    Route::post('/profile', 'TechnicianController@updateProfile')->name('technician.profile.update');
    
    // Logout
    Route::get('/logout', function() {
        Auth::guard('web')->logout();
        return redirect()->route('technician.login')->with('success', __('Logged out successfully'));
    })->name('technician.logout');
});

