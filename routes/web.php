<?php

use GuidoCella\LangFileManagerController;
use Illuminate\Support\Facades\Route;

Route::middleware(array_merge(['web', 'auth'], config('lang_file_manager.middleware')))
    ->prefix('admin/lang')
    ->group(function () {
        Route::get('', [LangFileManagerController::class, 'index']);
        Route::get('{locale}/{group}', [LangFileManagerController::class, 'edit']);
        Route::post('{locale}/{group}', [LangFileManagerController::class, 'update']);
    })
;
