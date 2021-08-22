<?php

namespace App\View\Components\Contact;

use Illuminate\View\Component;

class ContactItemOverview extends Component
{
    public int $contactId;
    public String $contactName;
    public String $contactEmailAddress;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $contactId, String $contactName, String $contactEmailAddress)
    {
        $this->contactId = $contactId;
        $this->contactName = $contactName;
        $this->contactEmailAddress = $contactEmailAddress;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.contact.contact-item-overview');
    }
}
