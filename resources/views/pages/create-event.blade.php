<x-layout.layout>
    <div class="row mb-5">
        <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 p-0">
            @if (isset($retrievedEvent))
                <x-event.create-event-form
                    eventId="{{ $retrievedEvent->id }}"                    
                    eventName="{{ $retrievedEvent->title }}"
                    eventDescription="{{ $retrievedEvent->description }}"
                    eventStartingDate="{{ $retrievedEvent->starting_date }}"
                    eventStartingTime="{{ $retrievedEvent->starting_time }}"
                    eventEndingDate="{{ $retrievedEvent->ending_date }}"
                    eventEndingTime="{{ $retrievedEvent->ending_time }}"
                    :eventParticipants="$retrievedEvent->contacts->toArray()" />
            @else
                <x-event.create-event-form
                    eventName="{{ old('eventName') }}"                    
                    eventDescription="{{ old('eventDescription') }}"
                    eventStartingDate="{{ old('eventStartingDate') }}"
                    eventStartingTime="{{ old('eventStartingTime') }}"
                    eventEndingDate="{{ old('eventEndingDate') }}"
                    eventEndingTime="{{ old('eventEndingTime') }}"
                    :eventParticipants="[]" />
            @endif         
        </div>
    </div>
</x-layout.layout>