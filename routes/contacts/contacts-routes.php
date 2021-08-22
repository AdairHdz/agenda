<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Contact;

Route::get("/contacts/search", function(Request $request) {
    $retrievedContactsWithGivenFirstName = [];

    if($request->filled("firstName"))
    {
        $firstName = $request->input("firstName");
        $retrievedContactsWithGivenFirstName = Contact::where("first_name", "like", "%$firstName%")->get();        
    }
    else
    {
        $retrievedContactsWithGivenFirstName = Contact::all();
    }    
    return response()->json($retrievedContactsWithGivenFirstName);
});

Route::name("contacts.")->group(function() {
    Route::get("/contacts", [ContactController::class, "index"])
        ->name("index");

    Route::view("/contacts/create", "pages.create-contact")
        ->name("create");

    Route::get("/contacts/{contactId}/edit", [ContactController::class, "edit"])
        ->name("edit")->whereNumber("contactId");

    Route::post("/contacts", [ContactController::class, "store"])
        ->name("store");

    Route::put("/contacts/{contactId}", [ContactController::class, "update"])
        ->name("update");

    Route::get("/contacts/{contactId}", [ContactController::class, "destroy"])
        ->name("destroy");
});

