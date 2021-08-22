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

require_once "contacts/contacts-routes.php";
require_once "events/events-routes.php";

Route::get("/", function() {
    return redirect()->route("contacts.index");
});