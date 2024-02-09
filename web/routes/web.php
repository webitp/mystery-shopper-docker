<?php

use Illuminate\Support\Facades\Route;
use App\Models\Log;

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

// Route::get('/', function () {
//     return view('welcome');
// });

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

class Metrics {
    public static $registry;

    public static $counter;

    public static $gauge;

    public static function init() {
        if (!self::$registry) {
            self::$registry = new CollectorRegistry(new InMemory());
            self::$counter = self::$registry->registerCounter('requests_total', 'all', 'count');
            self::$gauge = self::$registry->registerGauge('active_users', 'current', 'now');
        }
    }
}

class MetricsMiddleware
{
    // Создание и регистрация метрик

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $registry = new CollectorRegistry(new InMemory());
        $counter = $registry->registerCounter('requests_total', 'all', 'count');
        $gauge = $registry->registerGauge('active_users', 'current', 'now');

        $counter->set($count);
        $gauge->set(time());

        return $response;
    }
}

Auth::routes();

Route::get('/metrics', function () {

    $registry = new CollectorRegistry(new InMemory());
    $counter = $registry->registerCounter('requests_total', 'all', 'count');
    $gauge = $registry->registerGauge('active_users', 'current', 'now');

    $counter->inc();
    $gauge->set(time());

    $renderer = new RenderTextFormat();
    header('Content-type: ' . RenderTextFormat::MIME_TYPE);
    echo $renderer->render($registry->getMetricFamilySamples());
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['admin.only']], function () {
        Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('users');
    });
    Route::get('/offers', [App\Http\Controllers\OffersController::class, 'index'])->name('offers');
    Route::get('/offers/create', [App\Http\Controllers\OffersController::class, 'create'])->name('offers-create');

    Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients');
    Route::get('/clients/{id}', [App\Http\Controllers\ClientsController::class, 'show'])->name('client');
    Route::post('/clients/{id}', [App\Http\Controllers\ClientsController::class, 'edit'])->name('client');

    Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('categories');
    Route::get('/categories/create', [App\Http\Controllers\CategoriesController::class, 'create'])->name('categories-create');
    Route::post('/categories/create', [App\Http\Controllers\CategoriesController::class, 'save'])->name('categories-create');
    Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('categories-edit');
    Route::post('/categories/edit/{id}', [App\Http\Controllers\CategoriesController::class, 'update'])->name('categories-edit');
    Route::post('/categories/delete', [App\Http\Controllers\CategoriesController::class, 'delete'])->name('categories-delete');

    Route::get('/links', [App\Http\Controllers\LinksController::class, 'index'])->name('links');
    Route::get('/links/create', [App\Http\Controllers\LinksController::class, 'create'])->name('links-create');
    Route::post('/links/create', [App\Http\Controllers\LinksController::class, 'save'])->name('links-create');
    Route::get('/links/edit/{id}', [App\Http\Controllers\LinksController::class, 'edit'])->name('links-edit');
    Route::post('/links/edit/{id}', [App\Http\Controllers\LinksController::class, 'update'])->name('links-edit');
    Route::post('/links/delete', [App\Http\Controllers\LinksController::class, 'delete'])->name('links-delete');

    Route::get('/offers', [App\Http\Controllers\OffersController::class, 'index'])->name('offers');
    Route::get('/offers/create', [App\Http\Controllers\OffersController::class, 'create'])->name('offers-create');
    Route::post('/offers/create', [App\Http\Controllers\OffersController::class, 'save'])->name('offers-create');
    Route::get('/offers/edit/{id}', [App\Http\Controllers\OffersController::class, 'edit'])->name('offers-edit');
    Route::post('/offers/edit/{id}', [App\Http\Controllers\OffersController::class, 'update'])->name('offers-edit');
    Route::post('/offers/delete', [App\Http\Controllers\OffersController::class, 'delete'])->name('offers-delete');
});

Route::get('/{url}', [App\Http\Controllers\LinksController::class, 'redirect'])->name('redirect');