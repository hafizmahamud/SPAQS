<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\TermsController;
use App\Domains\Auth\Http\Controllers\Frontend\Auth\LoginController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [DashboardController::class, 'index'])
    ->name('index');

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });
