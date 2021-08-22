<?php

namespace App\View\Components\Event;

use Illuminate\View\Component;

class CreateEventForm extends Component
{
    public int $eventId;
    public String $eventName;
    public String $eventDescription;
    public String $eventStartingDate;
    public String $eventStartingTime;
    public String $eventEndingDate;
    public String $eventEndingTime;
    public array $eventParticipants;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $eventName, String $eventDescription,
        String $eventStartingDate, String $eventStartingTime,
        String $eventEndingDate, String $eventEndingTime, array $eventParticipants, int $eventId = 0)
    {
        $this->eventId = $eventId;
        $this->eventName = $eventName;
        $this->eventDescription = $eventDescription;
        $this->eventStartingDate = $eventStartingDate;
        $this->eventStartingTime = $eventStartingTime;
        $this->eventEndingDate = $eventEndingDate;
        $this->eventEndingTime = $eventEndingTime;
        $this->eventParticipants = $eventParticipants;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event.create-event-form');
    }
}
