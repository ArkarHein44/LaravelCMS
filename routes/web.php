<?php
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymenttypesController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\ReligionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\WarehouseController;

use Illuminate\Support\Facades\Route;

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

    Route::resource('/announcements', AnnouncementsController::class);

    Route::resource('/categories', CategoriesController::class);
    Route::resource('/contacts', ContactsController::class);
    Route::delete('/contactsbulkdeletes', [ContactsController::class,'bulkdeletes'])->name("contacts.bulkdeletes");

    Route::resource('/days', DaysController::class); 

    Route::resource('/genders', GendersController::class); 

    Route::resource('/leaves', LeavesController::class); 
    Route::put('/leaves/{id}/updatestage',[LeavesController::class, 'updatestage'])->name('leaves.updatestage');

    Route::resource('/paymenttypes', PaymenttypesController::class);   
    Route::resource('/posts', PostsController::class); 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/relatives', RelativesController::class);
    Route::resource('/religions', ReligionsController::class);
    Route::resource('/roles', RolesController::class);

    Route::resource('/stages', StagesController::class);
    Route::resource('/statuses',StatusesController::class);

    Route::resource('/tags', TagsController::class); 
    Route::resource('/types',TypesController::class);
   
    Route::resource('/warehouses', WarehouseController::class);

});
 


require __DIR__.'/auth.php';
