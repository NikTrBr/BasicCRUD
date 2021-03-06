<?php

// use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\sharkController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [CategoryController::class,'get']);
// Route::group(['prefix'=>'/Category','controller'=>CategoryController::class],function()
// {
//      Route::post('/save','save')->name('category.save');
//      Route::post('/update/{category}','update')->name('category.update');
//      Route::post('/delete/{category}','delete')->name('category.delete');

// });


Route::get('/', [PostController::class, 'index'])->middleware('auth')->name('post.index');

Route::group(['prefix' => '/Home', 'controller' => App\Http\Controllers\HomeController::class], function () {
    Route::get('/', 'index')->name('index');
});

Route::group(['prefix' => '/Post', 'controller' => PostController::class], function () {
    Route::name('post.')->group(function () {
        Route::get('/list', 'list')->name('list');
        Route::group(['middleware' => 'auth'], function () {
            Route::post('/save', 'store')->name('save');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'delete');
        });
    });
});

Route::group(['prefix' => '/User', 'controller' => PostController::class], function () {
    Route::name('user.')->group(function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/index', 'userIndex')->name('index');
            Route::get('/posts', 'userPosts')->name('posts');

        });
    });
});

Route::group(['prefix' => '/Auth', 'controller' => App\Http\Controllers\Auth\AuthController::class], function () {
    Route::get('/login', 'loginView')->name('login'); //->url:('/Auth/login')
    Route::get('/register', 'registerView')->name('register');

    route::post('/login', 'login')->name('login');
    route::post('/register', 'register')->name('register');

    route::get('/logout', 'logout')->name('logout');
});

Route::group(['prefix' => '/person', 'middleware' => 'auth', 'controller' => sharkController::class], function () {
    Route::name('person.')->group(function () {
        Route::get('/vue', 'vue')->name('vue');
        Route::get('/create', 'create')->name('create'); //->name('person.create')
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{person}', 'edit')->name('edit');
        Route::post('/update/{person}', 'update')->name('update');
        Route::post('/delete/{person}', 'destroy')->name('destroy');
    });
});













// Route::get('/sharks',sharkController::class);


// Route::view('/', 'welcome')->name('index');

// Route::get('/user/{name?}',[UserController::class,'index']);

// Route::get('/two',[UserController::class,'redirect']);

// Route::redirect('/here', 'there');

// Route::get('/test/{name}/age/{age}', function ($name,$age) {
//     return 'Name: '. $name. ' Age: '. $age;
// })->where(['name'=>'[A-Za-z]+']);
// // App/providers/RouteServiceProvider -> Route::pattern('age','[0-9]+');

// Route::get('/test2/{name}/age/{age}', function ($name,$age) {
//     return 'Name: '. $name. ' Age: '. $age;
// })->whereAlpha('name');

// Route::get('/search/{search}', function ($search){
//     return $search;
// })->where('search','.*');

// // Route::resource('p', UserController::class)->names('tests');

// Route::name('admin.')->group(function(){
//     Route::get('/users', function () {
//         return view('test');
//     })->name('admin.show');
// });

// // Middlewares
// Route::group(['middleware'=>['auth']],function (){
//     // user/photo, user/photo/create
//     Route::group(['middleware'=>'user','prefix'=>'user'],function (){
//         Route::resource('photo', PhotoController::class)->except(['destroy']);
//         // ->only(['index','create','store']);
//     });


//     // admin/user
//     Route::group(['middleware'=>'admin','prefix'=>'admin'],function (){
//         Route::resource('user', UserController::class);
//     });
// });
