<?php
use App\Http\Controllers\Admin\AdminPetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\PetTypeController;
use App\Http\Controllers\Admin\PetBreedController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionRequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PetController::class, 'approved'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Dashboard Route
    Route::get('/admin/dashboard',[AdminPetController::class, 'dashboard'], function () {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // User Dashboard Route
    // Route::get('/dashboard',[UserController::class, 'dashboard'], function () {
    //     if (Auth::user()->role !== 'user') {
    //         abort(403, 'Unauthorized action.');
    //     }
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth']) // optional: to ensure user is logged in
    ->name('dashboard');

    // Grouping Admin Routes
    Route::middleware('auth', 'verified')->group(function () {
        Route::resource('pet_types', PetTypeController::class);
        Route::resource('pet_breeds', PetBreedController::class);
        Route::get('/get-breeds/{type_Id}', [PetBreedController::class, 'getBreedsByType']);

        Route::get('/pet_breeds/export/pdf', [PetBreedController::class, 'exportPDF'])->name('pet_breeds.export_pdf');

    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/get-cities/{state_id}', [ProfileController::class, 'getCities']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pet Routes
    Route::resource('user.pets', PetController::class);
});

// Check Email Route
Route::post('/check-email', [CheckEmailController::class, 'checkEmail'])->name('check-email');
Route::post('/generate-report', [ReportController::class, 'generateReport']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/pets', [AdminPetController::class, 'index'])->name('admin.pets.index');    Route::get('/admin/pets/create', [AdminPetController::class, 'create'])->name('admin.pets.create');
    Route::post('/admin/pets', [AdminPetController::class, 'store'])->name('admin.pets.store');
    Route::get('/admin/pets/{pet}', [AdminPetController::class, 'show'])->name('admin.pets.show');
    Route::get('/admin/pets/{petId}/edit', [AdminPetController::class, 'edit'])->name('admin.pets.edit');
    Route::put('/admin/pets/{petId}', [AdminPetController::class, 'update'])->name('admin.pets.update');
    Route::delete('/admin/pets/{petId}', [AdminPetController::class, 'destroy'])->name('admin.pets.destroy');
    Route::get('/admin/pets', [AdminPetController::class, 'listAllPets'])->name('admin.pets.index');
    Route::get('/admin/pets/pending', [AdminPetController::class, 'listPendingPets'])->name('admin.pets.pending');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // User Pet Routes
    Route::resource('users', UserController::class);
    Route::prefix('user')->group(function () {
        Route::get('/pets', [PetController::class, 'index'])->name('user.pets.index'); // List all pets
        Route::get('/pets/create', [PetController::class, 'create'])->name('user.pets.create'); // Show create form
        Route::post('/pets', [PetController::class, 'store'])->name('user.pets.store'); // Store new pet
        Route::get('/pets/{pet}', [PetController::class, 'show'])->name('user.pets.show'); // Show single pet
        Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('user.pets.edit'); // Show edit form
        Route::put('/pets/{pet}', [PetController::class, 'update'])->name('user.pets.update'); // Update pet
        Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('user.pets.destroy'); // Delete pet
        Route::get('/pets/{pet}/details', [PetController::class, 'showDetails'])->name('pets.details');
        Route::get('/get-breeds/{pet_type_id}', [PetController::class, 'getBreeds'])->name('get.breeds');
    });
});

Route::get('/approved-pets', [PetController::class, 'approved'])->name('pets.approved');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('pets/pending', [AdminPetController::class, 'listPendingPets'])->name('admin.pets.pending');
    Route::post('pets/{pet}/approve', [PetController::class, 'approve'])->name('admin.pets.approve');
    Route::post('admin/pets/{pet}/reject', [PetController::class, 'reject'])->name('admin.pets.reject');
});

// Adoption Request Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Store adoption request
    Route::post('/adoption-request', [AdoptionRequestController::class, 'store'])->name('adoption-request.store');
    // Pet owner's adoption requests
    Route::get('/adoption-request', [AdoptionRequestController::class, 'index'])->name('adoption-request.index');
    // Update adoption request status (approve/reject)
    Route::put('/adoption-request/{adoptionRequest}', [AdoptionRequestController::class, 'update'])->name('adoption-request.update');
    // Admin adoption requests
    Route::get('/admin/adoption-requests', [AdoptionRequestController::class, 'adminindex'])->name('admin.adoption-requests.index');
    Route::post('/admin/adoption-requests/{adoptionRequest}', [AdoptionRequestController::class, 'adminupdate'])->name('admin.adoption-requests.update');
    Route::get('/adopted-pets', [PetController::class, 'adoptedPets'])->name('user.pets.adopted');

    Route::get('/admin/my-adoptions', [AdoptionRequestController::class, 'adopterIndexs'])->name('admin.adoptions.index');
    // Adopter's adoption requests
    Route::get('/my-adoptions', [AdoptionRequestController::class, 'adopterIndex'])->name('adopter.adoptions.index');
});
Route::get('/get-cities/{stateId}', [StateController::class, 'getCities']);
Route::get('/get-breeds/{typeId}', [PetTypeController::class, 'getBreeds']);

require __DIR__.'/auth.php';