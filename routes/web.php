<?php

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

Route::get('/', function () {
    return view('landing');
});

Auth::routes(["register" => false]);

Route::group(['middleware' => ['role:user']], function () {
    Route::get('crear-examen', 'TestController@createTest')->name('crear-examen')->middleware('auth');
    Route::post('new-test', 'TestController@newTest')->name('new-test');
    Route::get('mi-perfil', 'UserController@myProfile')->name('mi-perfil');
    Route::get('test/{id}', 'TestController@testView')->name('examen');
    Route::post('save-test', 'TestController@saveTest')->name('save-test');
});
//Route::post('ajax-search-tags-list', 'TagController@ajaxSearchTagsList');
Route::post('ajax-search-tags-list', 'SubcategoryController@ajaxSearchSubcategoriesList');
Route::get('ajax-search-questions', 'TestController@searchQuestions');


//Rutas anteriores

Route::group(['middleware' => ['role:administrator']], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('categorias', 'CategoryController@view')->name('categorias');
    Route::post('agregar-categoria', 'CategoryController@create')->name('agregar-categoria');
    Route::get('eliminar-categoria/{id}', 'CategoryController@delete')->name('eliminar-categoria');
    Route::post('actualizar-categoria', 'CategoryController@updateCategory')->name('actualizar-categoria');

    Route::get('categoria/{id}/subcategorias', 'SubcategoryController@view')->name('subcategorias');
    Route::post('agregar-subcategoria', 'SubcategoryController@create')->name('agregar-subcategoria');
    Route::get('eliminar-subcategoria/{id}', 'SubcategoryController@delete')->name('eliminar-subcategoria');
    Route::post('actualizar-subcategoria', 'SubcategoryController@updateSubcategory')->name('actualizar-subcategoria');

    Route::get('subcategoria/{id}/etiquetas', 'TagController@view')->name('etiquetas');
    Route::post('agregar-etiqueta', 'TagController@create')->name('agregar-etiqueta');
    Route::get('eliminar-etiqueta/{id}', 'TagController@delete')->name('eliminar-etiqueta');
    Route::post('actualizar-etiqueta', 'TagController@updateTag')->name('actualizar-etiqueta');

    Route::get('preguntas', 'QuestionController@view')->name('preguntas');
    Route::post('agregar-pregunta', 'QuestionController@create')->name('agregar-pregunta');
    Route::get('eliminar-pregunta/{id}', 'QuestionController@delete')->name('eliminar-pregunta');
    Route::post('actualizar-pregunta', 'QuestionController@updateQuestion')->name('actualizar-pregunta');

    Route::get('pregunta/{id}/respuestas', 'AnswerController@view')->name('respuestas');
    Route::post('agregar-respuesta', 'AnswerController@create')->name('agregar-respuesta');
    Route::get('eliminar-respuesta/{id}', 'AnswerController@delete')->name('eliminar-respuesta');
    Route::post('actualizar-respuesta', 'AnswerController@updateAnswer')->name('actualizar-respuesta');

    Route::get('pregunta/{id}/etiquetas', 'QuestionController@tags')->name('preguntas-etiquetas');
    Route::post('agregar-etiqueta-pregunta', 'QuestionController@createTag')->name('agregar-etiqueta-pregunta');

    Route::get('usuarios', 'UserController@administrators')->name('administrators');
    Route::post('crear-administrador', 'UserController@createAdministrator')->name('crear-administrador');
    Route::post('crear-usuario', 'UserController@createUser')->name('crear-usuario');
    Route::get('eliminar-usuario/{id}', 'UserController@delete')->name('eliminar-usuario');

    Route::get('test-list/{id}', 'TestController@adminView')->name('test-list');

    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return "Cache is cleared";
    });

});





Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');
