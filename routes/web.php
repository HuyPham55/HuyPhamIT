<?php


use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('change_language');

Auth::routes(['register' => false, 'verify' => false]);

//Route::get('/sanctum/csrf-cookie', function (Request $request) {
//    /** @see \Laravel\Sanctum\Http\Controllers\CsrfCookieController::show()
//     * @name 'sanctum.csrf-cookie'
//     * @usage No longer needed to call this route explicitly in the frontend, sanctum handles it automatically
//     * */
//    # https://laravel.com/docs/10.x/sanctum#csrf-protection
//    // return redirect()->route('sanctum.csrf-cookie');
//});


