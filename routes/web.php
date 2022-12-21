<?php

use App\Http\Controllers\CategoryLibraryController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\EnrollController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScholarController;
use App\Http\Controllers\TdocsController;
use App\Http\Controllers\TplanController;
use App\Http\Controllers\UserController;
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
Route::prefix('admin')->group(function(){
    Auth::routes();
}); 

// ------------------------ព័ត៌មាន-----------------------//
// ---------------------------
// ប្រភេទព័ត៌មាន:->categories_news
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function(){
    Route::get('/', [HomepageController::class, 'index'])->name('index');
    // ------------------------ព័ត៌មាន-----------------------//
    // ---------------------------
    // ប្រភេទព័ត៌មាន:->categories_news
    Route::prefix('category')->name('category.')->group(function(){
        Route::get('/',[CategoryNewsController::class, 'index'])->name('index');
        Route::get('/table', [CategoryNewsController::class,'newsDatatable'])->name('newsDatatable');
        Route::get('/create', [CategoryNewsController::class, 'create'])->name('create');
        Route::get('/edit/{id}',[CategoryNewsController::class, 'edit'])->name('edit');
        Route::post('/add', [CategoryNewsController::class, 'store'])->name(name:'store');
        Route::patch('/update/{id}', [CategoryNewsController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryNewsController::class, 'destroy'])->name('destroy');
    });
    // ---------------------------
    // ព័ត៌មាន:->news
    Route::prefix('news')->name('news.')->group(function(){
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/view/{id}', [NewsController::class, 'show'])->name('show');
        Route::get('/table',[NewsController::class, 'datatable'])->name('datatable');
        Route::get('/ed/{id}', [NewsController::class, 'edit'])->name('edit');
        Route::get('/create',[NewsController::class, 'create'])->name('create');
        Route::put('/update/{id}', [NewsController::class, 'update'])->name('update');
        Route::post('/add',[NewsController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [NewsController::class, 'destroy'])->name('destroy');
    });
    // -------------------------------------------------//
    // --------------------ការងារបណ្តុះបណ្តាល-----------------------------//
    //ផែនការបណ្តុះបណ្តាល:->tplan
    Route::prefix('tplan')->name('tplan.')->group(function(){
        Route::get('/', [TplanController::class, 'index'])->name('index');
        Route::get('/table', [TplanController::class, 'newsDatatable'])->name('newsDatatable');
        Route::get('/create', [TplanController::class, 'create'])->name('create');
        Route::get('/edit/{id}',[TplanController::class, 'edit'])->name('edit');
        Route::post('/store', [TplanController::class, 'store'])->name('store');
        Route::put('/update/{id}', [TplanController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [TplanController::class, 'destroy'])->name('destroy');
    });
    //​​ឯកសារបណ្តុះបណ្តាល:->tdocs
    Route::prefix('tdocs')->name('tdocs.')->group(function(){
        Route::get('/', [TdocsController::class, 'index'])->name('index');
        Route::get('/table', [TdocsController::class, 'newsDatatable'])->name('newsDatatable');
        Route::get('/create', [TdocsController::class, 'create'])->name('create');
        Route::get('/edit/{id}',[TdocsController::class, 'edit'])->name('edit');
        Route::put('/update/{id}',[TdocsController::class, 'update'])->name('update');
        Route::post('/store', [TdocsController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}',[TdocsController::class, 'destroy'])->name('destroy');
    });
    //ចុះឈ្មោះចូលរៀ​ន:-> enroll
    Route::prefix('enroll')->name('enroll.')->group(function(){
        Route::get('/', [EnrollController::class, 'index'])->name('index');
        Route::get('/table', [EnrollController::class, 'datatable'])->name('newDatatable');
        Route::get('/create', [EnrollController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [EnrollController::class, 'edit'])->name('edit');
        Route::post('/store', [EnrollController::class, 'store'])->name('store');
        Route::put('/update/{id}', [EnrollController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [EnrollController::class, 'destroy'])->name('destroy');
    });
    // -------------------------------------------------//
    // --------------------បណ្ណាល័យ-----------------------------//
    // --------------------ប្រភេទបណ្ណាល័យ-----------------------------//
    Route::prefix('catelibrary')->name('catelibrary.')->group(function(){
        Route::get('/', [CategoryLibraryController::class, 'index'])->name('index');
        Route::get('/table', [ CategoryLibraryController::class, 'Datatable'])->name('Datatable');
        Route::get('/create', [CategoryLibraryController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [CategoryLibraryController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CategoryLibraryController::class, 'update'])->name('update');
        Route::post('/store', [CategoryLibraryController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}', [CategoryLibraryController::class, 'destroy'])->name('destroy');
    });
    // --------------------បណ្ណាល័យ-----------------------------//
    Route::prefix('library')->name('library.')->group(function(){
        Route::get('/', [LibraryController::class, 'index'])->name('index');
        Route::get('/table', [LibraryController::class, 'Datatables'])->name('Datatable');
        Route::get('/create', [LibraryController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [LibraryController::class, 'edit'])->name('edit');
        Route::post('/store', [LibraryController::class, 'store'])->name('store');
        Route::put('/update/{id}',[LibraryController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [LibraryController::class, 'destroy'])->name('destroy');
        Route::get('/file/{file}', [LibraryController::class, 'download'])->name('download');
    });
    // ---------------------------------------------------//
    // --------------------អាហារូបករណ៍-----------------------------//
    Route::prefix('scholarship')->name('scholarship.')->group(function(){
        Route::get('/', [ScholarController::class, 'index'])->name('index');
        Route::get('/table', [ScholarController::class, 'Datatable'])->name('Datatable');
        Route::get('/create', [ScholarController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [ScholarController::class, 'edit'])->name('edit');
        Route::post('/store', [ScholarController::class, 'store'])->name('store');
        Route::put('/update/{id}', [ScholarController::class, 'update'])->name('update');
    });
    //---------------------------------------------------//
    //-------------------- User -------------------------//
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/table', [UserController::class, 'Datatable'])->name('Datatable');
    });
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
