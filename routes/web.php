<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['verify' => true]);
Auth::routes(['register' => false]);
Auth::routes();

Route::get('/', 'pagesController@index')->name('pages');
Route::get('nosotros','pagesController@about')->name('about');
Route::get('barbosa','pagesController@barbosa')->name('barbosa');
Route::get('tiendas','pagesController@estate')->name('estate');
Route::get('tiendas/{id}','pagesController@estate_show')->name('estate.show');
Route::get('salon_eventos','pagesController@event_room')->name('event_room');
Route::get('locales','pagesController@local')->name('local');
Route::get('locales/{id}','pagesController@local_show')->name('local.show');
Route::get('espacios_publicitarios','pagesController@publicity_place')->name('publicity_place');

Route::get('admin/carrucel','admin_pages\sliderController@index')->name('admin_slider');
Route::get('admin/carrucel/crear','admin_pages\sliderController@create')->name('admin_slider.create');
Route::post('admin/carrucel','admin_pages\sliderController@store')->name('admin_slider.store');
Route::get('admin/carrucel/{id}','admin_pages\sliderController@edit')->name('admin_slider.edit');
Route::put('admin/carrucel/{id}','admin_pages\sliderController@update')->name('admin_slider.update');
Route::post('admin/carrucel/{id}','admin_pages\sliderController@destroy')->name('admin_slider.delete');

Route::get('admin/nosotros','admin_pages\aboutController@index')->name('admin_about');
Route::post('admin/nosotros','admin_pages\aboutController@store')->name('admin_about.store');

Route::get('admin/barbosa','admin_pages\BarbosaController@index')->name('admin_barbosa');
Route::post('admin/barbosa','admin_pages\BarbosaController@store')->name('admin_barbosa_store');

Route::get('admin/cualidades','admin_pages\CualidadesController@index')->name('admin_cualidades');
Route::post('admin/cualidades','admin_pages\CualidadesController@store')->name('admin_cualidades_store');

Route::get('admin/tiendas','admin_pages\estateController@estate')->name('admin_estate');

Route::get('profile','my\profileController@index')->name('my.profile');
Route::put('profile','my\profileController@update')->name('my.profile.update');
Route::get('setting','my\settingController@index')->name('my.setting');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('usuarios','userController@index')->name('users');
Route::post('usuarios','userController@store')->name('users.store');
Route::put('usuarios/{id}','userController@update')->name('users.update');
Route::post('usuarios/{id}','userController@destroy')->name('users.delete');

Route::get('roles','roleController@index')->name('roles');
Route::post('roles','roleController@store')->name('roles.store');
Route::put('roles/{id}','roleController@update')->name('roles.update');
Route::delete('roles/{id}','roleController@destroy')->name('roles.delete');

Route::get('admin/servicios/locales','localsController@index')->name('locals');
Route::get('admin/servicios/locales/crear','localsController@create')->name('locals.create');
Route::post('admin/servicios/locales','localsController@store')->name('locals.store');
Route::get('admin/servicios/locales/{id}','localsController@show')->name('locals.show');
Route::get('admin/servicios/locales/{id}/editar','localsController@edit')->name('locals.edit');
Route::put('admin/servicios/locales/{id}','localsController@update')->name('locals.update');
Route::get('admin/servicios/locales/{id}/add','localsController@add')->name('locals.add');
Route::patch('admin/servicios/locales/{id}','localsController@save')->name('locals.save');
Route::post('admin/servicios/locales/{id}','localsController@destroy')->name('locals.delete');

Route::post('files_load/{id}/{type}','filesController@upload')->name('files.upload');
Route::post('files_load','filesController@destroy')->name('files.delete');

Route::get('formularios','formsController@index')->name('forms')->middleware('auth')->middleware('verified');
Route::post('formularios','formsController@store')->name('forms.store');
Route::post('formularios/check/{id}','formsController@check')->name('forms.check');
Route::post('formularios/{id}','formsController@destroy')->name('forms.delete');

Route::get('admin/servicios/espacios_publicitarios','publicityPlaceController@index')->name('admin.publicity_place');
Route::get('admin/servicios/espacios_publicitarios/crear','publicityPlaceController@create')->name('admin.publicity_place.create');
Route::post('admin/servicios/espacios_publicitarios','publicityPlaceController@store')->name('admin.publicity_place.store');
Route::get('admin/servicios/espacios_publicitarios/{id}','publicityPlaceController@show')->name('admin.publicity_place.show');
Route::get('admin/servicios/espacios_publicitarios/{id}/editar','publicityPlaceController@edit')->name('admin.publicity_place.edit');
Route::put('admin/servicios/espacios_publicitarios/{id}','publicityPlaceController@update')->name('admin.publicity_place.update');
Route::get('admin/servicios/espacios_publicitarios/{id}/add','publicityPlaceController@add')->name('admin.publicity_place.add');
Route::patch('admin/servicios/espacios_publicitarios/{id}','publicityPlaceController@save')->name('admin.publicity_place.save');
Route::post('admin/servicios/espacios_publicitarios/{id}','publicityPlaceController@destroy')->name('admin.publicity_place.delete');

Route::get('admin/servicios/salon_eventos','eventRoomController@index')->name('admin.event_room');
Route::post('admin/servicios/salon_eventos','eventRoomController@store')->name('event_room_store');
Route::post('admin/servicios/salon_eventos/{id}/edit','eventRoomController@update')->name('admin.event_room.update');
Route::post('admin/servicios/salon_eventos/{id}','eventRoomController@destroy')->name('admin.event_room.delete');

Route::post('admin/servicios/salon_evento/categoria','eventRoomController@store_category')->name('admin.event_room.categpry.store');

Route::get('admin/rent','rentsController@index')->name('admin_rents');
Route::get('admin/rent/{id}','rentsController@show')->name('admin_rents.show');
Route::get('admin/rent/{id}/edit','rentsController@edit')->name('admin_rents.edit');
Route::put('admin/rent/{id}','rentsController@update')->name('admin_rents.update');
Route::patch('admin/rent/{id}','rentsController@sudadd')->name('admin_rents.sudadd');
Route::post('admin/rent/{id}','rentsController@destroy')->name('admin_rents.delete');

Route::get('my/locals','myLoclasController@index')->name('my.local');
Route::get('my/locals/{id}','myLoclasController@show')->name('my.local.show');
Route::get('my/locals/{id}/edit','myLoclasController@edit')->name('my.local.edit');
Route::put('my/locals/{id}','myLoclasController@update')->name('my.local.update');

Route::get('my/locals/{id}/product','myProdutsController@index')->name('my.local.product');
Route::get('my/locals/{id}/product/show/{item}','myProdutsController@show')->name('my.local.product.show');
Route::get('my/locals/{id}/product/create','myProdutsController@create')->name('my.local.product.create');
Route::post('my/locals/{id}/product','myProdutsController@store')->name('my.local.product.store');
Route::get('my/locals/{id}/product/{item}/edit','myProdutsController@edit')->name('my.local.product.edit');
Route::put('my/locals/{id}/product/{item}','myProdutsController@update')->name('my.local.product.update');
Route::post('my/locals/{id}/product/{item}','myProdutsController@destroy')->name('my.local.product.delete');
