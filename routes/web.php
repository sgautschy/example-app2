<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\AvatarController;
use App\Models\User;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::post('/profile/avatar/ai', [AvatarController::class, 'generate'])->name('profile.avatar.ai');
});

require __DIR__.'/auth.php';


// Route::get('/openai', function(){
    

//     $result = OpenAI::images()->create([
//         "model" => "dall-e-3",
//         "prompt" => "create single avatar for user in tech world with cool animated style with the name ".auth()->user()->name." without any words in the image",
//         "n" => 1,
//         "size" => "1024x1024",
//         "quality" => "standard",

//     ]);
    
//     return response(['url' => $result->data[0]->url]);

// });

// Route::get('/auth/redirect', function () {
//     return Socialite::driver('github')->redirect();
// });

// Route::get('/auth/callback', function () {
//     $user = Socialite::driver('github')->user();
//     dd($user);
//     // $user->token
// });