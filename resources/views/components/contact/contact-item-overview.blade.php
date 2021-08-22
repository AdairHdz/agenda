<div class="row border bg-white">
    <div class="col flex flex-column flex-md-row justify-around p-5">
        <div class="flex flex-grow-1">
            <div class="d-none d-md-flex justify-center align-items-center rounded-circle text-white text-center bg-primary mr-3 h3" style="height:80px; width:80px;">
                {{ substr($contactName, 0, 1) }}
            </div>
            <div class="align-self-center">
                <strong class="fw-bolder mb-0"> {{ $contactName }} </strong>
                <p class="fst-italic mb-0"> {{ $contactEmailAddress }} </p>
                <input type="hidden" name="contactId" value="{{ $contactId }}">
            </div>
        </div>
        <div class="flex align-items-end ml-md-5">
            <a href="{{ route('contacts.edit', $contactId) }}" class="btn btn-primary mr-3">Detalles</a>
            <a href="{{ route('contacts.destroy', $contactId) }}" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
</div>