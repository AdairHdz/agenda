@php    
    if(isset($retrievedContact)) {
        $phoneHome;
        $phoneMobile;
        $phoneWork;

        $contactPhoneNumbers = $retrievedContact->phoneNumbers;
        foreach($contactPhoneNumbers as $phoneNumber)
        {
            if($phoneNumber->phone_number_type == 0)
            {
                $phoneHome = $phoneNumber->number;
            }
            else if($phoneNumber->phone_number_type == 1)
            {
                $phoneWork = $phoneNumber->number;
            }
            else
            {
                $phoneMobile = $phoneNumber->number;
            }
        }
    }    
@endphp

<x-layout.layout>
    <div class="row mb-5">
        <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 p-0">                        
            @if (isset($retrievedContact))                
                <x-contact.create-contact-form
                    contactId="{{ $retrievedContact->id }}"
                    firstNameValue="{{ $retrievedContact->first_name }}"
                    middleNameValue="{{ isset($retrievedContact->middle_name) ? $retrievedContact->middle_name : '' }}"
                    lastNameValue="{{ $retrievedContact->last_name }}"
                    birthDateValue="{{ $retrievedContact->birth_date }}"
                    emailAddressValue="{{ $retrievedContact->email_address }}"
                    homePhone="{{ isset($phoneHome) ? $phoneHome : '' }}"
                    workPhone="{{ isset($phoneWork) ? $phoneWork : '' }}"
                    mobilePhone="{{ isset($phoneMobile) ? $phoneMobile : '' }}"
                     />
            @else
                <x-contact.create-contact-form
                    firstNameValue="{{ old('firstName') }}"
                    middleNameValue="{{ old('middleName') }}"
                    lastNameValue="{{ old('lastName') }}"
                    birthDateValue="{{ old('birthDate') }}"
                    emailAddressValue="{{ old('emailAddress') }}"
                    homePhone="{{ old('homePhone') }}"
                    workPhone="{{ old('workPhone') }}"
                    mobilePhone="{{ old('mobilePhone') }}"
                     />
            @endif
            
            
        </div>
    </div>
</x-layout.layout>