<div class="row border bg-white">
    <div class="col flex flex-column flex-md-row justify-around p-5">
        <div>
            <strong class="fw-bolder mb-0"> {{ $eventName }} </strong>
            <p class="fst-italic mb-0"> Fecha de inicio: {{ $eventStartingDate }} </p>            
            <input type="hidden" name="contactId" value="{{ $eventId }}">
        </div>
        <div class="flex align-items-end ml-md-5">
            <a href="{{ route('events.edit', $eventId) }}" class="btn btn-primary mr-3">Detalles</a>
            <a href="{{ route('events.destroy', $eventId) }}" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
</div>