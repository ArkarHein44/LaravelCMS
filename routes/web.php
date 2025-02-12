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
    Route::delete('/announcementsbulkdeletes', [AnnouncementsController::class,'bulkdeletes'])->name("announcements.bulkdeletes");

    Route::resource('/categories', CategoriesController::class);
    Route::delete('/categoriesbulkdeletes', [CategoriesController::class,'bulkdeletes'])->name("categories.bulkdeletes");

    Route::resource('/contacts', ContactsController::class);
    Route::delete('/contactsbulkdeletes', [ContactsController::class,'bulkdeletes'])->name("contacts.bulkdeletes");

    Route::resource('/days', DaysController::class); 
    Route::delete('/daysbulkdeletes', [DaysController::class,'bulkdeletes'])->name("days.bulkdeletes");

    Route::resource('/genders', GendersController::class); 
    Route::delete('/gendersbulkdeletes', [GendersController::class,'bulkdeletes'])->name("genders.bulkdeletes");

    Route::resource('/leaves', LeavesController::class); 
    Route::put('/leaves/{id}/updatestage',[LeavesController::class, 'updatestage'])->name('leaves.updatestage');
    Route::delete('/leavesbulkdeletes', [LeavesController::class,'bulkdeletes'])->name("leaves.bulkdeletes");    

    Route::resource('/paymenttypes', PaymenttypesController::class);   
    Route::delete('/paymenttypesbulkdeletes', [PaymenttypesController::class,'bulkdeletes'])->name("paymenttypes.bulkdeletes");

    Route::resource('/posts', PostsController::class); 
    Route::delete('/postsbulkdeletes', [PostsController::class,'bulkdeletes'])->name("posts.bulkdeletes");

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/relatives', RelativesController::class);
    Route::delete('/relativesbulkdeletes', [RelativesController::class,'bulkdeletes'])->name("relatives.bulkdeletes");

    Route::resource('/religions', ReligionsController::class);
    Route::delete('/religionsbulkdeletes', [ReligionsController::class,'bulkdeletes'])->name("religions.bulkdeletes");

    Route::resource('/roles', RolesController::class);
    Route::delete('/rolesbulkdeletes', [RolesController::class,'bulkdeletes'])->name("roles.bulkdeletes");

    Route::resource('/stages', StagesController::class);
    Route::delete('/stagesbulkdeletes', [StagesController::class,'bulkdeletes'])->name("stages.bulkdeletes");

    Route::resource('/statuses',StatusesController::class);
    Route::delete('/statusesbulkdeletes', [StatusesController::class,'bulkdeletes'])->name("statuses.bulkdeletes");

    Route::resource('/tags', TagsController::class);
    Route::delete('/tagsbulkdeletes', [TagsController::class,'bulkdeletes'])->name("tags.bulkdeletes");

    Route::resource('/types',TypesController::class);
    Route::delete('/typesbulkdeletes', [TypesController::class,'bulkdeletes'])->name("types.bulkdeletes");
   
    Route::resource('/warehouses', WarehouseController::class);
    Route::delete('/warehousesbulkdeletes', [WarehouseController::class,'bulkdeletes'])->name("warehouses.bulkdeletes");

});
 


require __DIR__.'/auth.php';
