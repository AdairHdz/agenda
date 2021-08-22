<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::name("events.")->group(function() {
    Route::get("/events", [EventController::class, "index"])
        ->name("index");

    Route::get("/events/create", [EventController::class, "create"])
        ->name("create");

    Route::get("/events/{eventId}/edit", [EventController::class, "edit"])
        ->name("edit")->whereNumber("eventId")->middleware("event_exists");

    Route::post("/events", [EventController::class, "store"])
        ->name("store");

    Route::get("/events/{eventId}", [EventController::class, "destroy"])
        ->name("destroy");

    Route::put("/events/{eventId}", [EventController::class, "update"])
        ->name("update");
});