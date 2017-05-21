<?php

use Illuminate\Support\Facades\Route;

Route::middleware(array_merge(['web', 'auth'], config('lang_file_manager.middleware')))
     ->prefix('admin/lang')
     ->namespace('GuidoCella')
     ->group(function () {
         Route::get('{locale}', 'LangFileManagerController@index');
         Route::get('{locale}/{group}', 'LangFileManagerController@edit');
         Route::post('{locale}/{group}', 'LangFileManagerController@update');
     });
