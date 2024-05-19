<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
});

Route::get('errors-403', function() {
    return view('errors.403');
});

Route::group(['namespace' => 'Admin'], function() {

    Route::group(['namespace' => 'Auth', 'prefix' => 'cms-admin'], function() {
        Route::get('/login', 'LoginController@login')->name('admin.login');
        Route::post('/login', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@getRegister')->name('admin.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('admin.forgot.password');
    });

    Route::group(['middleware' =>['auth'], 'prefix' => 'admin'], function() {
        Route::get('/home', 'HomeController@index')->name('admin.home')->middleware('permission:truy-cap-he-thong|toan-quyen-quan-ly');

        Route::group(['prefix' => 'group-permission'], function(){
            Route::get('/','GroupPermissionController@index')->name('group.permission.index');
            Route::get('/create','GroupPermissionController@create')->name('group.permission.create');
            Route::post('/create','GroupPermissionController@store');

            Route::get('/update/{id}','GroupPermissionController@edit')->name('group.permission.update');
            Route::post('/update/{id}','GroupPermissionController@update');

            Route::get('/delete/{id}','GroupPermissionController@destroy')->name('group.permission.delete');
        });

        Route::group(['prefix' => 'permission'], function(){
            Route::get('/','PermissionController@index')->name('permission.index');
            Route::get('/create','PermissionController@create')->name('permission.create');
            Route::post('/create','PermissionController@store');

            Route::get('/update/{id}','PermissionController@edit')->name('permission.update');
            Route::post('/update/{id}','PermissionController@update');

            Route::get('/delete/{id}','PermissionController@delete')->name('permission.delete');
        });

        Route::group(['prefix' => 'role'], function(){
            Route::get('/','RoleController@index')->name('role.index')->middleware('permission:danh-sach-vai-tro|toan-quyen-quan-ly');
            Route::get('/create','RoleController@create')->name('role.create')->middleware('permission:them-moi-vai-tro|toan-quyen-quan-ly');
            Route::post('/create','RoleController@store');

            Route::get('/update/{id}','RoleController@edit')->name('role.update')->middleware('permission:chinh-sua-vai-tro|toan-quyen-quan-ly');
            Route::post('/update/{id}','RoleController@update');

            Route::get('/delete/{id}','RoleController@delete')->name('role.delete')->middleware('permission:xoa-vai-tro|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/','UserController@index')->name('user.index')->middleware('permission:danh-sach-nguoi-dung|toan-quyen-quan-ly');
            Route::get('/create','UserController@create')->name('user.create')->middleware('permission:them-moi-nguoi-dung|toan-quyen-quan-ly');
            Route::post('/create','UserController@store');

            Route::get('/update/{id}','UserController@edit')->name('user.update')->middleware('permission:chinh-sua-nguoi-dung|toan-quyen-quan-ly');
            Route::post('/update/{id}','UserController@update');

            Route::get('/delete/{id}','UserController@delete')->name('user.delete')->middleware('permission:xoa-nguoi-dung|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'location'], function(){
            Route::get('/','LocationController@index')->name('location.index')->middleware('permission:danh-sach-dia-diem|toan-quyen-quan-ly');
            Route::get('/create','LocationController@create')->name('location.create')->middleware('permission:them-moi-dia-diem|toan-quyen-quan-ly');
            Route::post('/create','LocationController@store');

            Route::get('/update/{id}','LocationController@edit')->name('location.update')->middleware('permission:chinh-sua-dia-diem|toan-quyen-quan-ly');
            Route::post('/update/{id}','LocationController@update');

            Route::get('/delete/{id}','LocationController@delete')->name('location.delete')->middleware('permission:xoa-dia-diem|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'airport'], function(){
            Route::get('/','AirportController@index')->name('airport.index')->middleware('permission:danh-sach-san-bay|toan-quyen-quan-ly');
            Route::get('/create','AirportController@create')->name('airport.create')->middleware('permission:them-moi-san-bay|toan-quyen-quan-ly');
            Route::post('/create','AirportController@store');

            Route::get('/update/{id}','AirportController@edit')->name('airport.update')->middleware('permission:chinh-sua-san-bay|toan-quyen-quan-ly');
            Route::post('/update/{id}','AirportController@update');

            Route::get('/delete/{id}','AirportController@delete')->name('airport.delete')->middleware('permission:xoa-san-bay|toan-quyen-quan-ly');

            Route::post('get/by/location','AirportController@getByLocation')->name('get.by.location');
        });

        Route::group(['prefix' => 'airline-company'], function(){
            Route::get('/','AirlineCompanyController@index')->name('airline.company.index')->middleware('permission:danh-sach-hang-may-bay|toan-quyen-quan-ly');
            Route::get('/create','AirlineCompanyController@create')->name('airline.company.create')->middleware('permission:them-moi-hang-may-bay|toan-quyen-quan-ly');
            Route::post('/create','AirlineCompanyController@store');

            Route::get('/update/{id}','AirlineCompanyController@edit')->name('airline.company.update')->middleware('permission:chinh-sua-hang-may-bay|toan-quyen-quan-ly');
            Route::post('/update/{id}','AirlineCompanyController@update');

            Route::get('/delete/{id}','AirlineCompanyController@delete')->name('airline.company.delete')->middleware('permission:xoa-hang-may-bay|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'plane'], function(){
            Route::get('/','PlaneController@index')->name('plane.index')->middleware('permission:danh-sach-may-bay|toan-quyen-quan-ly');
            Route::get('/create','PlaneController@create')->name('plane.create')->middleware('permission:them-moi-may-bay|toan-quyen-quan-ly');
            Route::post('/create','PlaneController@store');

            Route::get('/update/{id}','PlaneController@edit')->name('plane.update')->middleware('permission:chinh-sua-may-bay|toan-quyen-quan-ly');
            Route::post('/update/{id}','PlaneController@update');

            Route::get('/delete/{id}','PlaneController@delete')->name('plane.delete')->middleware('permission:xoa-may-bay|toan-quyen-quan-ly');
        });


        Route::group(['prefix' => 'flight'], function(){
            Route::get('/','FlightController@index')->name('flight.index')->middleware('permission:danh-sach-chuyen-bay|toan-quyen-quan-ly');
            Route::get('/create','FlightController@create')->name('flight.create')->middleware('permission:them-moi-chuyen-bay|toan-quyen-quan-ly');
            Route::post('/create','FlightController@store');

            Route::get('/update/{id}','FlightController@edit')->name('flight.update')->middleware('permission:chinh-sua-chuyen-bay|toan-quyen-quan-ly');
            Route::post('/update/{id}','FlightController@update');

            Route::get('/delete/{id}','FlightController@delete')->name('flight.delete')->middleware('permission:xoa-chuyen-bay|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'profile'], function(){
            Route::get('/', 'ProfileController@index')->name('profile.index');
            Route::post('/update/{id}', 'ProfileController@update')->name('profile.update');
            Route::get('admin/change/password', 'ProfileController@changePassword')->name('admin.change.password');
            Route::post('admin/post/change/password', 'ProfileController@postChangePassword')->name('admin.post.change.password');
        });


        Route::group(['prefix' => 'category'], function(){
            Route::get('/','CategoryController@index')->name('category.index')->middleware('permission:danh-sach-danh-muc-tin-tuc|toan-quyen-quan-ly');
            Route::get('/create','CategoryController@create')->name('category.create')->middleware('permission:them-moi-danh-muc-tin-tuc|toan-quyen-quan-ly');
            Route::post('/create','CategoryController@store');

            Route::get('/update/{id}','CategoryController@edit')->name('category.update')->middleware('permission:chinh-sua-danh-muc-tin-tuc|toan-quyen-quan-ly');
            Route::post('/update/{id}','CategoryController@update');

            Route::get('/delete/{id}','CategoryController@delete')->name('category.delete')->middleware('permission:xoa-danh-muc-tin-tuc|toan-quyen-quan-ly');
        });


        Route::group(['prefix' => 'article'], function(){
            Route::get('/','ArticleContrller@index')->name('article.index')->middleware('permission:danh-sach-tin-tuc|toan-quyen-quan-ly');
            Route::get('/create','ArticleContrller@create')->name('article.create')->middleware('permission:them-moi-tin-tuc|toan-quyen-quan-ly');
            Route::post('/create','ArticleContrller@store');

            Route::get('/update/{id}','ArticleContrller@edit')->name('article.update')->middleware('permission:chinh-sua-tin-tuc|toan-quyen-quan-ly');
            Route::post('/update/{id}','ArticleContrller@update');

            Route::get('/delete/{id}','ArticleContrller@delete')->name('article.delete')->middleware('permission:xoa-tin-tuc|toan-quyen-quan-ly');
        });

        Route::group(['prefix' => 'transaction'], function(){
            Route::get('/','TransactionController@index')->name('transaction.index')->middleware('permission:danh-sach-dat-ve|toan-quyen-quan-ly');
            Route::get('/update/status/{status}/{id}', 'TransactionController@updateStatus')->name('transaction.update.status');
            Route::get('delete/{id}', 'TransactionController@delete')->name('transaction.delete')->middleware('permission:xoa-dat-ve|toan-quyen-quan-ly');
            Route::post('show/tickets/{id}', 'TransactionController@showTicket')->name('transaction.show.tickets');
        });
    });
});

Route::group(['namespace' => 'Page'], function() {

    Route::group(['namespace' => 'Auth', 'prefix' => 'account'], function() {
        Route::get('/login', 'LoginController@login')->name('user.page.login');
        Route::post('/login', 'LoginController@postLogin');
        Route::get('/register', 'RegisterController@register')->name('user.page.register');
        Route::post('/register', 'RegisterController@postRegister');
        Route::get('/logout', 'LoginController@logout')->name('user.page.logout');
        Route::get('/forgot/password', 'ForgotPasswordController@forgotPassword')->name('user.page.forgot.password');
        Route::post('/forgot/password', 'ForgotPasswordController@potForgotPassword')->name('post.user.forgot.password');
    });

    Route::group(['middleware' =>['user'], 'namespace' => 'Auth'], function() {
        Route::get('thong-tin-tai-khoan.html', 'AccountController@infoAccount')->name('info.account');
        Route::get('danh-sach-giao-dich.html', 'AccountController@transactionUser')->name('users.transactions');
        Route::post('/update/info/account', 'AccountController@updateInfoAccount')->name('update.info.account');
        Route::get('thay-doi-mat-khau', 'AccountController@changePassword')->name('change.password');
        Route::post('change/password', 'AccountController@postChangePassword')->name('post.change.password');

        Route::post('show/tickets/{id}', 'AccountController@showTicket')->name('show.tickets');
    });

    Route::get('/', 'HomeController@index')->name('user.home.index');

    Route::get('/tin-tuc.html', 'CategoryController@articles')->name('user.category.articles');
    Route::get('/tin-tuc/{id}/{slug}.html', 'CategoryController@index')->name('user.category.index');

    Route::get('/chi-tiet/{id}/{slug}.html', 'CategoryController@articleDetail')->name('user.article.detail');

    Route::group(['prefix' => 'flight'], function(){

        Route::get('/search', 'FlightController@search')->name('user.flight.search');
        Route::get('/book/ticket/{id}', 'FlightController@bookTicket')->name('flight.book.ticket');

        Route::post('plus/customer', 'FlightController@plusCustomer')->name('flight.plus.customer');
        Route::post('minus/customer', 'FlightController@minusCustomer')->name('flight.minus.customer');
        Route::post('change/baby/gender', 'FlightController@changeBabyGender')->name('flight.change.baby.gender');
        Route::post('transport', 'FlightController@transport')->name('flight.transport');

        Route::post('/book/ticket/{id}', 'FlightController@postBookTicket')->name('flight.book.ticket');

        Route::get('payment/{id}', 'FlightController@payment')->name('flight.payment');
        Route::post('post/payment/{id}', 'FlightController@postPayment')->name('flight.post.payment');

        Route::get('vnpay/return', 'FlightController@vnpayReturn')->name('flight.vnpay.return');
    });


    Route::group(['prefix' => 'airline-company'], function(){
        Route::get('/', 'AirlineCompanyController@index')->name('user.airline.company');
    });


});

