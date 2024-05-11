<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\HotelsController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\DiscountsController;
use App\Http\Controllers\Api\AssistantsController;
use App\Http\Controllers\Api\CountrysController;
use App\Http\Controllers\Api\TaxRegimesController;
use App\Http\Controllers\Api\CfdiController;
use App\Http\Controllers\Api\PaymentTypesController;
use App\Http\Controllers\Api\AvailableCategoriesController;
use App\Http\Controllers\Api\ExcelController;
use App\Http\Controllers\Api\PaymentProofsController;
use App\Http\Controllers\Api\PlanTypesController;
use App\Http\Controllers\Api\RoomsByHotelsController;
use App\Http\Controllers\Api\LandingController;
use App\Http\Controllers\Api\LandingEventosController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\ReportRoomingListController;
use App\Http\Controllers\Api\ReservationsFormWebController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\ReservationsController;
use App\Http\Controllers\Api\WebhookSiteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas públicas (sin autenticación)
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');   
    Route::post('logout', 'logout');    
    // Route::post('register', 'store');
    // Route::post('refresh', 'AuthController@refresh'); 
});

Route::controller(WebhookSiteController::class)->group(function () {
    Route::post('webhook', 'webhook');
});


Route::controller(RegisterController::class)->group(function () {
    Route::post('/register', 'store');
});

Route::controller(LandingController::class)->group(function() {
    Route::get('/public/landing', 'getLanding');
});

// Routes of landing eventos
Route::controller(LandingEventosController::class)->group(function () {
    Route::get('/public/landing-evento/{slug}', 'getLandingEventoBySlug');
    Route::post('/public/download/program', 'downloadProgram');
});

// Routes of country
Route::controller(CountrysController::class)->group(function () {
    Route::get('/public/paises', 'obtenerListaPaises');
});

// Routes of cfdi
Route::controller(CfdiController::class)->group(function () {
    Route::get('/public/cfdi', 'obtenerLista');
});

// Routes of tax regimes
Route::controller(TaxRegimesController::class)->group(function () {
    Route::get('/public/tax-regimes', 'obtenerLista');
});

// Routes of payment type
Route::controller(PaymentTypesController::class)->group(function () {
    Route::get('/public/payment-type', 'obtenerLista');
});

// Routes of assistants
Route::controller(AssistantsController::class)->group(function () {
    Route::post('/public/assistant', 'guardarAsistente'); 
});

// Routes of discounts
Route::controller(DiscountsController::class)->group(function () {        
    Route::post('/public/discount/porcentaje', 'getDiscount');
});

// Routes of ReservationsFormWeb
Route::controller(ReservationsFormWebController::class)->group(function () {
    Route::get('/public/reservation/landing-evento/{slug}', 'getLandingEventoBySlug');
    Route::get('/public/plan-types', 'getPlanTypes');
    Route::post('/public/save/reservation', 'saveReservation');
});

Route::controller(ResetPasswordController::class)->group(function() {
    Route::post('/auth/forgot-password', 'forgotPassword');
    Route::post('/auth/reset-password', 'resetPassword');
});

Route::controller(ExcelController::class)->group(function() {
    Route::post('/export-rooming-list', 'exportRoomingList');
});

// Rutas protegidas por JWT (requieren autenticación)
Route::middleware('jwt.auth')->group(function () {
    // Routes of user
    Route::controller(UserController::class)->group(function () {
        Route::post('/users', 'store');
        Route::post('/update/user/admin', 'updateAdmin');
        Route::post('/update/user/assistant', 'updateAssistant');
        Route::get('/obtener/usuario/{id}', 'getUserById');
    });

    // Routes of roles
    Route::controller(RolesController::class)->group(function () {
        Route::post('/roles', 'store');
    });

    // Routes of categories
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/categories', 'index');
        Route::get('/getCategories', 'getCategories');
        Route::post('/categories', 'store');
        Route::get('/category/{id}', 'edit');
        Route::post('/category/update', 'update');
        Route::post('/category/delete', 'delete');
    });

    // Routes of hotels
    Route::controller(HotelsController::class)->group(function () {
        Route::get('/hotels', 'index');
        Route::get('/getHotels', 'getHotels');
        Route::post('/hotel', 'store');
        Route::get('/hotel/{id}', 'edit');
        Route::patch('/hotel/update/{id}', 'update');
        Route::delete('/hotel/delete/{id}', 'delete');
        Route::post('/hotel/{id}/imagen', 'addImagen');
        Route::delete('/hotel/{id}/eliminar-imagen/{idImagen}', 'deleteImagen');
    });

    // Routes of events
    Route::controller(EventsController::class)->group(function () {
        Route::get('/events', 'index');
        Route::post('/event', 'store');        
        Route::patch('/event/update/{id}', 'update');
        Route::delete('/event/delete/{id}', 'delete'); 
        Route::get('/getEvents', 'getEvents');  
        Route::post('/getEvent', 'getEvent');       
        Route::get('/by-category', 'getByCategory');
        Route::get('/v2/getEvent', 'getEventV2'); 
        Route::get('/v3/getEvent', 'getEventV3'); 
        // Route::post('/v2/getEvent', 'getEventV2'); 
        Route::get('/events-with-categories', 'getEventsWithCategories');
    });

    // Routes of discounts
    Route::controller(DiscountsController::class)->group(function () {
        Route::get('/discounts', 'index');
        Route::post('/discount', 'store');        
        Route::patch('/discount/update/{id}', 'update');
        Route::delete('/discount/delete/{id}', 'delete');        
        Route::post('/discount/porcentaje', 'porcentaje'); // Cambiado el nombre de la ruta
    });

    // Routes of assistants
    Route::controller(AssistantsController::class)->group(function () {
        Route::get('/assistants', 'index');
        Route::post('/assistant', 'store');                
        Route::patch('/assistant/update/{id}', 'update');
        Route::delete('/assistant/delete/{id}', 'delete'); 
        Route::get('/my-assistants/{id}', 'listById');       
    });

    // Routes of country
    Route::controller(CountrysController::class)->group(function () {
        Route::get('/getCountrys', 'getCountrys');
    });

    // Routes of tax regimes
    Route::controller(TaxRegimesController::class)->group(function () {
        Route::get('/tax-regimes', 'index');
    });

    // Routes of cfdi
    Route::controller(CfdiController::class)->group(function () {
        Route::get('/cfdi', 'index');
    });

    // Routes of payment type
    Route::controller(PaymentTypesController::class)->group(function () {
        Route::get('/payment-type', 'index');
    });    

    // Routes of available categories
    Route::controller(AvailableCategoriesController::class)->group(function () {
        Route::post('/available-categories/{id}', 'obtenerCategory');
    });   
    
    // Routes of available payment proofs
    Route::controller(PaymentProofsController::class)->group(function () {
        Route::get('/payment-proofs', 'index');
    });

    Route::controller(LandingController::class)->group(function() {
        Route::get('/landings', 'index');
        Route::post('/landing', 'store');
    });


    // Routes of plan types
    Route::controller(PlanTypesController::class)->group(function () {
        Route::get('/plan-types', 'index');
    }); 
    
    
    // Routes of rooms by hotels
    Route::controller(RoomsByHotelsController::class)->group(function () {
        Route::get('/rooms-by-hotels', 'index');
        Route::post('/rooms-by-hotel', 'store');                
        Route::patch('/rooms-by-hotel/update/{id}', 'update');
        Route::delete('/rooms-by-hotel/delete/{id}', 'delete');        
    });

    // Routes of landing eventos
    Route::controller(LandingEventosController::class)->group(function () {
        Route::get('/landing-eventos', 'index');
        Route::get('/get-eventos', 'getEventos');
        Route::post('/landing-eventos', 'store');
        Route::delete('/landing-eventos/delete/{id}', 'destroy');
        Route::patch('/landing-eventos/update/{id}', 'update');
    });

    Route::controller(ReportRoomingListController::class)->group(function () {
        Route::get('/list/events', 'getListEvents');
        Route::get('/list/plan-types', 'getListPlanTypes');
    });

    // Routes of reservations
    Route::controller(ReservationsController::class)->group(function () {
        Route::get('/reservations', 'index');
        Route::post('/reservations', 'store');
        Route::patch('/reservations/update/{id}', 'update');
        // Route::post('/reservations-verify', 'ReservationsController@reservationsVerify')->name('reservations-verify');
        Route::post('/reservations-verify', 'getVerify');
        // Route::delete('/rooms-by-hotel/delete/{id}', 'delete');        
    });
    

    Route::controller(ReservationsFormWebController::class)->group(function () {
        Route::get('/my-reservations/{id}', 'listById');
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('menu/resumen', 'resumen');
    });

});