<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PhoneNumber;

class ContactController extends Controller
{

    public function index(Request $request)
    {                        
        if($request->filled("search")) {
            $search = $request->get('search');
            $retrievedContacts = Contact::where("first_name", "like",  "%$search%")->get();
            return view("pages.home")->with("retrievedContacts", $retrievedContacts);            
        }

        $retrievedContacts = Contact::all();
        $successMessage = Session::get("successMessage");
        if(isset($successMessage)) {
            return view("pages.home", [
                "successMessage" => $successMessage,
                "retrievedContacts" => $retrievedContacts
            ]);
        }
        return view("pages.home")->with("retrievedContacts", $retrievedContacts);
    }

    public function store(StoreContactRequest $request)
    {   
        $validatedData = $request->validated();
        $createdContact = new Contact;
        $firstName = $validatedData["firstName"];
        $middleName = $validatedData["middleName"];
        $lastName = $validatedData["lastName"];
        $birthDate = $validatedData["birthDate"];
        $emailAddress = $validatedData["emailAddress"];

        $phoneNumbers = [            
            [                 
                "phone_number_type" => PhoneNumber::PHONE_HOME,
                "number" => $validatedData["homePhone"]
            ],
            [                 
                "phone_number_type" => PhoneNumber::PHONE_MOBILE,
                "number" => $validatedData["mobilePhone"]
            ],
            [
                "phone_number_type" => PhoneNumber::PHONE_WORK,
                "number" => $validatedData["workPhone"]
            ]             
        ];
        
        
        $filledPhoneNumbers = array_filter($phoneNumbers, function($phoneNumber) {
            return !is_null($phoneNumber["number"]);
        });    

        $time = strtotime($birthDate);
        $parsedDate = date("Y-m-d", $time);        

        $createdContact->first_name = $firstName;
        $createdContact->middle_name = $middleName;                
        $createdContact->last_name = $lastName;
        $createdContact->birth_date = $parsedDate;                
        $createdContact->email_address = $emailAddress;
        $createdContact->save();
        $createdContact->phoneNumbers()->createMany($filledPhoneNumbers);                

        return redirect()->route("contacts.index")->with("successMessage", "Contacto guardado correctamente");
    }

    public function edit($contactId)
    {           
        $retrievedContact = Contact::find($contactId);        
        return view("pages.create-contact")->with("retrievedContact", $retrievedContact);
    }

    public function update(StoreContactRequest $request, $contactId)
    {
        $validatedData = $request->validated();
        $retrievedContact = Contact::find($contactId);
        $firstName = $validatedData["firstName"];
        $middleName = $validatedData["middleName"];
        $lastName = $validatedData["lastName"];
        $birthDate = $validatedData["birthDate"];
        $emailAddress = $validatedData["emailAddress"];        
        $phoneNumbers = [            
            [                 
                "phone_number_type" => PhoneNumber::PHONE_HOME,
                "number" => $validatedData["homePhone"]
            ],
            [                 
                "phone_number_type" => PhoneNumber::PHONE_MOBILE,
                "number" => $validatedData["mobilePhone"]
            ],
            [
                "phone_number_type" => PhoneNumber::PHONE_WORK,
                "number" => $validatedData["workPhone"]
            ]             
        ];
        
        
        $filledPhoneNumbers = array_filter($phoneNumbers, function($phoneNumber) {
            return !is_null($phoneNumber["number"]);
        });



        $time = strtotime($birthDate);
        $parsedDate = date("Y-m-d", $time);        

        $retrievedContact->first_name = $firstName;
        $retrievedContact->middle_name = $middleName;                
        $retrievedContact->last_name = $lastName;
        $retrievedContact->birth_date = $parsedDate;                
        $retrievedContact->email_address = $emailAddress;        
        $retrievedContact->phoneNumbers()->createMany($filledPhoneNumbers);
        $retrievedContact->save();
        // $retrievedContact->phoneNumbers()->createMany($filledPhoneNumbers);
        return redirect()->route("contacts.index")->with("successMessage", "Contacto actualizado correctamente");
    }

    public function destroy($contactId)
    {
        $retrievedContact = Contact::find($contactId);
        $retrievedContact->delete();
        return redirect()->route("contacts.index")->with("successMessage", "Contacto correctamente eliminado");
    }
}
