<?php

namespace App\View\Components\Contact;

use Illuminate\View\Component;

class CreateContactForm extends Component
{    
    public int $contactId;
    public String $firstNameValue;
    public String $middleNameValue;
    public String $lastNameValue;
    public String $birthDateValue;
    public String $emailAddressValue;
    public String $homePhone;
    public String $workPhone;
    public String $mobilePhone;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(String $firstNameValue,
        String $middleNameValue, String $lastNameValue,
        String $birthDateValue, String $emailAddressValue,
        String $homePhone, String $workPhone, String $mobilePhone, int $contactId = 0)
    {
        $this->contactId = $contactId;
        $this->firstNameValue = $firstNameValue;
        $this->middleNameValue = $middleNameValue;
        $this->lastNameValue = $lastNameValue;
        $this->birthDateValue = $birthDateValue;
        $this->emailAddressValue = $emailAddressValue;
        $this->homePhone = $homePhone;
        $this->workPhone = $workPhone;
        $this->mobilePhone = $mobilePhone;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {        
        return view('components.contact.create-contact-form');
    }
}
