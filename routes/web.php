<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AiDemandsController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\RecipeMenuCostingController;
use App\Http\Controllers\WasteManagementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Settings\UserRolesController;
use App\Http\Controllers\Settings\AccessControlController;
use App\Http\Controllers\StorageLocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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
    Route::get('/users', [UsersController::class, 'viewData'])->name('users.viewData');
    Route::any('/add-user', [UsersController::class, 'addData'])->name('users.add-user');
    Route::any('/edit-user/{id}', [UsersController::class, 'editData'])->name('users.edit-user');
    Route::any('/add-inventory', [InventoryController::class, 'addData'])->name('inventory.addData');
    Route::any('/edit-inventory/{id}', [InventoryController::class, 'editData'])->name('inventory.edit-inventory');
    Route::any('/inventory', [InventoryController::class, 'viewData'])->name('inventory.viewData');
    Route::any('/ai-demands', [AiDemandsController::class, 'viewData'])->name('ai-demands.viewData');
    Route::any('/procurements', [ProcurementController::class, 'viewData'])->name('procurements.viewData');
    Route::any('/add-procurement', [ProcurementController::class, 'addData'])->name('procurements.addData');
    Route::any('/suppliers', [SuppliersController::class, 'viewData'])->name('suppliers.viewData');
    Route::any('/add-supplier', [SuppliersController::class, 'addData'])->name('suppliers.addData');
    Route::any('/access-list', [SettingController::class, 'viewData'])->name('access-list.viewData');
    Route::any('/recipe-menucosting', [RecipeMenuCostingController::class, 'viewData'])->name('recipe-menucosting.viewData');
    Route::any('/add-recipe', [RecipeMenuCostingController::class, 'addData'])->name('recipe-menucosting.addData');
    Route::any('/waste-management', [WasteManagementController::class, 'viewData'])->name('waste-management.viewData');
    Route::any('/add-waste', [WasteManagementController::class, 'addData'])->name('waste-management.addData');
    Route::any('/categories', [CategoryController::class, 'viewData'])->name('categories.viewData');
    Route::any('/add-category', [CategoryController::class, 'addData'])->name('categories.addData');
    Route::any('/edit-category/{id}', [CategoryController::class, 'editData'])->name('categories.editData');
    Route::any('/storage-locations', [StorageLocationController::class, 'viewData'])->name('storage-locations.viewData');
    Route::any('/add-storage-location', [StorageLocationController::class, 'addData'])->name('storage-locations.addData');
    Route::any('/edit-storage-location/{id}', [StorageLocationController::class, 'editData'])->name('storage-locations.editData');
    Route::any('/user-roles', [UserRolesController::class, 'viewData'])->name('user-roles.viewData');
    Route::any('/add-user-role', [UserRolesController::class, 'addData'])->name('user-roles.addData');
    Route::any('/edit-user-role/{id}', [UserRolesController::class, 'editData'])->name('user-roles.editData');
    Route::any('/access-control', [AccessControlController::class, 'viewData'])->name('access-control.viewData');
    Route::post('/access/save', [AccessControlController::class, 'save'])->name('access.save');
    Route::any('/edit-supplier/{id}', [SuppliersController::class, 'editData'])->name('suppliers.edit-supplier');
    Route::any('/chat', [ChatController::class, 'send']);
    Route::get('/demo', [ChatController::class, 'index'])->name('chat.index');
  
    });

  
require __DIR__.'/auth.php';
