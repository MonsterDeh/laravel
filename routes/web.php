<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TurnController;
use App\Http\Controllers\UserController;
use App\Models\MyUser;
use App\Models\Service;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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




// Route::get('/',function(){
//  return Service::withCount(['turn'=>function(Illuminate\Database\Eloquent\Builder $query){
//     $query->where('status', '=', 1);
//  }])->get();
// });


Route::get('/',[HomeController::class,'home'] )->name('home');

Route::get('/TakeTurn',[TurnController::class,'takeTurn'] )->name('TakeTurn');//inout form the go to user.show
Route::get('/TrackTurn',[TurnController::class,'trackTurn'] )->name('TrackTurn');
Route::post('/TrackTurn',[TurnController::class,'trackTurnPost'] )->name('TrackTurn');
Route::post('/CreateTurn',[TurnController::class,'createTurn'] )->name('CreateTurn');


Route::get('User/{User}/Worktime',[UserController::class,'worktime'])->name('User.worktime');
Route::resource('/User',UserController::class);

Route::get('Admin/',[AdminController::class,'dashboard'] )->name('AdminHome');

Route::post('Admin/{id}/Search',[SearchController::class,'AdminServiceSearcher'] )
    ->whereNumber('id')
;


Auth::routes();

// Route::get('/turn', function () {
//     return view('turn');
// });



