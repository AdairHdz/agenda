<?php

namespace App\View\Components\Event;

use DateTime;
use Illuminate\View\Component;

class EventItemOverview extends Component
{
    public int $eventId;
    public String $eventName;
    public String $eventStartingDate;
    public String $eventEndingDate;
    public int $eventStatus;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $eventId, String $eventName, String $eventStartingDate, String $eventEndingDate, int $eventStatus)
    {
        $this->eventId = $eventId;
        $this->eventName = $eventName;
        $this->eventStartingDate = $eventStartingDate;
        $this->eventEndingDate = $eventEndingDate;
        $this->eventStatus = $eventStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.event.event-item-overview');
    }
}
