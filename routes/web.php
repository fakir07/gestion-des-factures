<?php

use Illuminate\Support\Facades\Route;

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

 Route::get('/', function () {
    return view('auth.login');
 });
 
//Auth::routes(['register' => false]);
Auth::routes(['register' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['middleware' => ['auth']], function() {
  

/***********  */
   

   Route::resource('invoices', 'InvoicesController');
   
   Route::resource('sectiones', 'SectionesController');
   
   Route::resource('produits', 'ProduitsController');
   
   Route::resource('invoicesAttachments', 'InvoicesAttachmentsController');
   
   Route::resource('archive_invoices', 'archiveController');
   
   
   //Route::resource('invoicesdetails', 'InvoicesDetailsController');
   
   
   
   /***route get prudact ajax */
   
   
   Route::get('section/{id}','InvoicesController@getproduit');
   
   Route::get('/invoicedetails/{id}','InvoicesDetailsController@show');
   
   Route::get('view_file/{invoice_number}/{file_name}','InvoicesDetailsController@open_file');
   
   Route::get('telecharger_file/{invoice_number}/{file_name}','InvoicesDetailsController@telecharger_file');
   
   Route::post('delete_file', 'InvoicesDetailsController@destroy')->name('delete_file');
   
   Route::get('/edit_invoice/{id}','InvoicesController@edit')->name('edit_invoice');
   
   Route::get('/show_upadte_status/{id}','InvoicesController@show')->name('show_upadte_status');
   
   Route::post('status_update/{id}', 'InvoicesController@update_status')->name('status_update');
   
   Route::get('factures_payees','InvoicesController@factures_payees')->name('factures_payees');
   Route::get('factures_impayees','InvoicesController@factures_impayees')->name('factures_impayees');
   Route::get('factures_partiellement_payees','InvoicesController@factures_partiellement_payees')->name('factures_partiellement_payees');
   Route::get('Print_invoice/{id}','InvoicesController@Print_invoice'); // ba9ii mklch cod U
   Route::get('Export_invoice', 'InvoicesController@export');
   
   // reports
    Route::get('reports_invoices','ReportsController@index');
    Route::post('Search_invoices','ReportsController@Search_invoices');
   
    Route::get('reports_invoices_cust','CustomersController@index')->name('reports_invoices_cust');
    Route::post('Search_invoices_cust','CustomersController@Search_invoices_cust');
   
   Route::post('import_files','InvoicesController@import_files')->name('import_files');
   
   





    Route::resource('roles','RoleController');
   Route::resource('users','UserController');
   
   
  
   });