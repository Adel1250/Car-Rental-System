<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    if (session()->has('username')) {
        if (session('userType') == "client") {
            return view('clientProfile');
        } else if (session('userType') == "admin") {
            return view('adminProfile');
        }
    }
    return view('login');
});

Route::get('/logout', function () {
    if (session()->has('username')) {
        session()->pull('username');
        session()->pull('userType');
        session()->pull('plate_id');
        session()->pull('ssn');
    }
    return redirect('login');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/clientProfile', function () {
    return view('clientProfile');
});

Route::get('/adminProfile', function () {
    return view('adminProfile');
});


Route::get('/carRegistration', function () {
    return view('carRegistration');
});

Route::get('/carUpdate', function () {
    return view('carUpdate');
});

Route::get('/searchResults', function () {
    return view('searchResults');
});

Route::get('/reserveForm', function () {
    return view('reserveForm');
});

Route::get('/pay', function () {
    return view('pay');
});

Route::get('/returnCar', function () {
    return view('returnCar');
});

Route::get('/myReservations', function () {
    return view('myReservations');
});

Route::get('/advancedSearchCar', function () {
    return view('advancedSearchCar');
});

Route::get('/advancedSearchClient', function () {
    return view('advancedSearchClient');
});

Route::get('/advancedSearchReservations', function () {
    return view('advancedSearchReservations');
});

Route::get('/resCar', function () {
    return view('resCar');
});

Route::get('/resClient', function () {
    return view('resClient');
});

Route::get('/resReserve', function () {
    return view('resReserve');
});

Route::get('/specificPeriod', function () {
    return view('specificPeriod');
});

Route::get('/specificCar', function () {
    return view('specificCar');
});

Route::get('/specificClient', function () {
    return view('specificClient');
});

Route::get('/report1', function () {
    return view('report1');
});

Route::get('/report2', function () {
    return view('report2');
});

Route::get('/report3', function () {
    return view('report3');
});

Route::get('/report4', function () {
    return view('report4');
});

Route::post('/getLoginInfo', [userController::class, 'getLoginInfo']);

Route::post('/getRegisterInfo', [userController::class, 'getRegisterInfo']);

Route::post('/getCarRegisterInfo', [userController::class, 'getCarRegisterInfo']);

Route::post('/getCarUpdateInfo', [userController::class, 'getCarUpdateInfo']);

Route::post('/getCarSearchInfo', [userController::class, 'getCarSearchInfo']);

Route::post('/reserve', [userController::class, 'reserve']);

Route::post('/confirmRegistration', [userController::class, 'confirmRegistration']);

Route::post('/payment', [userController::class, 'payment']);

Route::post('/carReturning', [userController::class, 'carReturning']);

Route::post('/carReturning', [userController::class, 'carReturning']);

Route::get('/reservations', [userController::class, 'reservations']);

Route::post('/advancedSearchCarHandle', [userController::class, 'advancedSearchCarHandle']);

Route::post('/advancedSearchClientHandle', [userController::class, 'advancedSearchClientHandle']);

Route::post('/advancedSearchReservationsHandle', [userController::class, 'advancedSearchReservationsHandle']);

Route::post('/repCon1', [userController::class, 'repCon1']);

Route::post('/repCon2', [userController::class, 'repCon2']);

Route::get('/repCon3', [userController::class, 'repCon3']);

Route::post('/repCon4', [userController::class, 'repCon4']);