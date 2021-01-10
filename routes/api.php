<?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::middleware('auth:api')->get('/user', function(Request $request) {
        return $request->user();
    });

    Route::prefix('docusign')->group(function() {
        Route::post('/send', 'Helpers\Controllers\DocusignController@send');

        Route::post('/view', 'Helpers\Controllers\DocusignController@view');

        Route::post('/download', 'Helpers\Controllers\DocusignController@download');
    });

    Route::prefix('phone')->group(function() {

        Route::post('/validate', 'Helpers\Controllers\TwilioController@lookup');
    });
