<?php




use App\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserlistController;
use App\Http\Controllers\User\UserController;


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



//login, register

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');//loginPage is from url
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::get('/clear',function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('key:generate');
    return 'Cleared!';

});

Route::get('/reset',function(){
    Artisan::call('migrate:fresh --seed');
    return "reset success!";
});

Route::middleware(['auth'])->group(function () {
    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //admin
    Route::middleware(['admin_auth'])->group(function(){

        Route::prefix('order')->group(function(){
            //orderList
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('ajax/status',[OrderController::class,'orderStatus'])->name('admin#orderStatus');
            Route::get('ajax/statusChange',[OrderController::class,'statusChange'])->name('admin#orderStatusChange');
            Route::get('orderInfo/{orderCode}',[OrderController::class,'orderInfo'])->name('order#orderInfo');
        });
    //category
        Route::prefix('category')->group(function(){
                Route::get('list',[CategoryController::class,'list'])->name('category#list');
                Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
                Route::post('create',[CategoryController::class,'create'])->name('category#create');
                Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
                Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
                Route::get('update/{id}',[CategoryController::class,'update'])->name('category#update');
            });
        // Route::group(['middleware'=>'admin_auth','prefix'=>'adminn'],function(){
        //     Route::get('password/change',[AuthController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        // });
        Route::prefix('adminn')->group(function(){
            //adminlist
            Route::get('/list',[AdminController::class,'list'])->name('admin#list');
            Route::get('/delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('role/chagePage/{id}',[AdminController::class,'roleChangePage'])->name('admin#changePage');
            //roleChange Ajax
            Route::get('ajax/change/role',[AdminController::class,'changeRole']);
            Route::post('role/update/{id}',[AdminController::class,'updateRole'])->name('admin#roleUpdate');



            //password
            Route::get('/password/change',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('/passwordChange',[AdminController::class,'passwordChange'])->name('admin#passwordChange');
            //account
            Route::get('/details',[AdminController::class,'details'])->name('admin#details');
            Route::get('/edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('/update/{id}',[AdminController::class,'update'])->name("admin#update");
            // Route::get('account')


        });
        Route::prefix('product')->group(function(){
            Route::get('/list',[ProductController::class,'list'])->name('product#list');
            Route::get('/createPage',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('/create',[ProductController::class,'create'])->name('product#create');
            Route::get('/delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('/details/{id}',[ProductController::class,'details'])->name('product#details');
            Route::get('/edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::post('/update',[ProductController::class,'update'])->name('product#update');
        });
        Route::prefix('user')->group(function(){
            Route::get('/list',[UserlistController::class,'list'])->name('admin#userList');
            Route::get('/ajax/change/role',[UserlistController::class,'userChangeRole'])->name('admin#userChangeRole');
            Route::get('/delete/{id}',[UserlistController::class,'userDelete'])->name('admin#userDelete');
            Route::get('/edit/{id}',[UserlistController::class,'userEditPage'])->name('admin#userEditPage');
            Route::post('/update/{id}',[UserlistController::class,'userUpdate'])->name('admin#userUpdate');
        });


    });


    //user
    //home
    Route::group( ['prefix'=>'user','middleware'=>'user_auth'] ,function () {
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('contact',[UserController::class,'contact'])->name('user#contact');
        Route::post('contact/request',[UserController::class,'contactRequest'])->name('user#contactRequest');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');
        Route::view('account/detail','user.main.account')->name('user#accountDetail');

        Route::view('account/edit','user.main.edit')->name('user#edit');
        Route::post('account/update/{id}',[UserController::class,'update'])->name('user#update');
        Route::prefix('password')->group(function(){
            Route::view('changePage','user.main.changePassword')->name('user#changePage');
            Route::post('changePassword',[UserController::class,'changePassword'])->name("user#changePassword");
        });
        Route::get('details/{id}',[UserController::class,'details'])->name('user#details');
        Route::get('cart',[UserController::class,'cart'])->name('user#cart');
        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('pizza#list');
            Route::get('addCart',[AjaxController::class,'addCart'])->name('add#cart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('clear/specificProduct',[AjaxController::class,'clearSpecificProduct'])->name('ajax#clearSpecificProduct');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');
        });
        Route::get('home/addCart/{id}',[UserController::class,'addCartHome'])->name('user#addCartHome');

    });

});
