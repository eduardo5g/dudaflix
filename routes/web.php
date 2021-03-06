<?php

use App\Http\Controllers\{
    PlayController
};
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
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

Route::get('/player', [PlayController::class,'index'])->name('player.index');
Route::get('/player', [PlayerController::class,'list'])->name('player.list');
Route::get('/play/register', [PlayController::class,'register'])->name('play.register');
Route::get('/play/list', [PlayController::class,'register'])->name('play.register');

Route::get('/catalog', function () {
    $users = User::all();
    $categories = Category::all();
    $_video = new Video();
    foreach($users as $user){
        $video= $_video->filter('user',$user->name);

        $videos[$user->name]=(object) $video;
    }
    return view('play.catalog',compact('users','categories','videos'));
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
