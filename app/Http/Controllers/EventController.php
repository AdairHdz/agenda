<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $queryParameters = $request->all();        
        
        $queryParameters = array_filter($queryParameters, function($param) {
            return !is_null($param) && !empty($param);
        });

        $retrievedEvents = [];

        if(empty($queryParameters))
        {
            $retrievedEvents = Event::all();
        }
        else
        {
            $retrievedEvents = Event::where($queryParameters)->get();            
        }
                        

        $successMessage = Session::get("successMessage");
        if(isset($successMessage)) {
            return view("pages.index-events", [
                "successMessage" => $successMessage,
                "retrievedEvents" => $retrievedEvents
            ]);
        }        

        return view("pages.index-events")
            ->with("retrievedEvents", $retrievedEvents);
    }
    
    public function create()
    {
        return view("pages.create-event");
    }

    public function store(StoreEventRequest $request)
    {        
        $validatedData = $request->validated();                                                        
        
        $createdEvent = new Event;
        $createdEvent->title= $validatedData["eventName"];
        $createdEvent->description = $validatedData["eventDescription"];        
        $createdEvent->starting_date = date("Y-m-d", strtotime($validatedData["eventStartingDate"]));
        $createdEvent->starting_time = date("H:i", strtotime($validatedData["eventStartingTime"]));        
        $createdEvent->status = $validatedData["eventStatus"];
        $createdEvent->save();
        
        $eventParticipants = $validatedData["eventParticipants"];

        foreach($eventParticipants as $eventParticipant)
        {
            $contact = Contact::find($eventParticipant);
            $createdEvent->contacts()->save($contact);
        }

        return redirect()->route("events.index")->with("successMessage", "Evento correctamente registrado");
    }

    public function edit($eventId)
    {
        $retrievedEvent = Event::find($eventId);        
        return view("pages.create-event")->with("retrievedEvent", $retrievedEvent);
    }

    public function update(StoreEventRequest $request, $eventId)
    {        
        $validatedData = $request->validated();                                                        
        
        $retrievedEvent = Event::find($eventId);
        $retrievedEvent->title= $validatedData["eventName"];
        $retrievedEvent->description = $validatedData["eventDescription"];        
        $retrievedEvent->starting_date = date("Y-m-d", strtotime($validatedData["eventStartingDate"]));
        $retrievedEvent->starting_time = date("H:i", strtotime($validatedData["eventStartingTime"]));        
        $retrievedEvent->status = $validatedData["eventStatus"];
        
        $eventParticipants = $validatedData["eventParticipants"];        
        $retrievedEvent->contacts()->syncWithoutDetaching($eventParticipants);
        $retrievedEvent->save();
        return redirect()->route("events.index")->with("successMessage", "Evento correctamente actualizado");
    }

    public function destroy($eventId)
    {
        $eventToDelete = Event::find($eventId);
        $eventToDelete->delete();
        return redirect()->route("events.index")->with("successMessage", "Evento correctamente eliminado");;
    }
}
