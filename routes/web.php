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
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('categorias', 'CategoryController@view')->name('categorias');
Route::post('agregar-categoria', 'CategoryController@create')->name('agregar-categoria');
Route::get('eliminar-categoria/{id}', 'CategoryController@delete')->name('eliminar-categoria');

Route::get('categoria/{id}/etiquetas', 'TagController@view')->name('etiquetas');
Route::post('agregar-etiqueta', 'TagController@create')->name('agregar-etiqueta');
Route::get('eliminar-etiqueta/{id}', 'TagController@delete')->name('eliminar-etiqueta');


Route::get('preguntas', 'QuestionController@view')->name('preguntas');
Route::post('agregar-pregunta', 'QuestionController@create')->name('agregar-pregunta');
Route::get('eliminar-pregunta/{id}', 'QuestionController@delete')->name('eliminar-pregunta');

Route::get('pregunta/{id}/respuestas', 'AnswerController@view')->name('respuestas');
Route::post('agregar-respuesta', 'AnswerController@create')->name('agregar-respuesta');
Route::get('eliminar-respuesta/{id}', 'AnswerController@delete')->name('eliminar-respuesta');
