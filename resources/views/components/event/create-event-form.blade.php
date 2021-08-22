<form class="bg-white p-3 p-md-5 shadow-sm" id="eventForm" action=" {{ request()->routeIs('events.create') ? route('events.store') : route('events.update', $eventId) }} " name="eventForm" method="POST">
    @csrf
    @if (request()->routeIs('events.edit'))
    @method("PUT")
    @endif
    <p class="font-weight-bold text-center h4 mb-3">
        Datos del evento
    </p>
    <div class="col-12">
        <div class="row mb-3">
            <div class="col">
                <label for="">Nombre del evento</label>
                <input type="text" name="eventName" id="eventName" value="{{ $eventName }}" class="form-control">
                @error("eventName")
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <label for="">Descripción del evento</label>
                <textarea name="eventDescription" id="eventDescription" cols="30" rows="5" value="{{ $eventDescription }}" class="form-control">{{$eventDescription}}</textarea>
                @error("eventDescription")
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-6">
                <label for="">Fecha de inicio</label>
                <input type="date" name="eventStartingDate" id="eventStartingDate" value="{{ $eventStartingDate }}" class="form-control">
                @error("eventStartingDate")
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <label for="">Hora de inicio</label>
                <input type="time" name="eventStartingTime" id="eventStartingTime" value="{{ $eventStartingTime }}" class="form-control">
                @error("eventStartingTime")
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
        </div>
    </div>
    <div class="col">
        <div class="row mb-3 position-relative">
            <div class="col-12">
                <label for="status">Status</label>
                <select name="eventStatus" id="status" class="form-control">
                    <option value="1">Por ocurrir</option>
                    <option value="2">Concluido</option>
                    <option value="3">Cancelado</option>
                </select>
            </div>
            <div class="col-12">
                <label for="">Participantes</label>
                <input type="search" name="" id="contactSearchInput" class="form-control">
                @error("eventParticipants")
                <p class="text-danger">
                    {{$message}}
                </p>
                @enderror
            </div>
            <div class="position-absolute p-5 border bg-white" style="width:100%; top:100%; z-index:10; display:none;" id="retrievedContactsContainer"></div>
            <div class="col-12">
                <div class="row" id="participantsContainer">
                    @foreach ($eventParticipants as $participant)
                    <div class="col-12" id="{{ $participant['id'] }}" onClick="removeParticipant(event)">
                        <p class="font-weight-bold"> {{ $participant["first_name"] }} {{ $participant["middle_name"] }} {{ $participant["last_name"] }}</p>
                        <input type='hidden' name='id' value="{{ $participant['id'] }}" />
                        <input type='hidden' name='fullName' value="{{ $participant['first_name'] }} {{ $participant['middle_name'] }} {{ $participant['last_name'] }}" />
                        <input type="hidden" name="eventParticipants[]" value="{{ $participant['id'] }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col col-md-6 offset-md-3">
            <button class="btn btn-success btn-block">
                Registrar
            </button>
        </div>
    </div>
</form>

<script>
    const contactSearchInput = document.getElementById("contactSearchInput")
    const retrievedContactsContainer = document.getElementById("retrievedContactsContainer")
    const participantsContainer = document.getElementById("participantsContainer")

    const removeParticipant = (event) => {
        console.log(event.target)
    }

    contactSearchInput.addEventListener("input", async (event) => {

        if (event.target.value === "") {
            retrievedContactsContainer.style.display = "none"
            return
        }

        retrievedContactsContainer.style.display = "block"
        const fetchedContacts = await fetchContacts(event.target.value)
        fillFetchedContactsContainer(fetchedContacts)
    })

    const fillFetchedContactsContainer = (fetchedContacts) => {
        retrievedContactsContainer.innerHTML = ""
        const fragment = document.createDocumentFragment()
        if (fetchedContacts !== undefined && fetchedContacts !== null) {
            fetchedContacts.forEach((fetchedContact) => {
                const container = document.createElement("div")
                container.className = "border-bottom mb-2"
                container.style.cursor = "pointer"
                container.innerHTML = `
                    <p class="text-primary mb-0">
                        <input type='hidden' name='id' value=${fetchedContact.id} />
                        <input type='hidden' name='fullName' value="${fetchedContact.first_name} ${fetchedContact.middle_name} ${fetchedContact.last_name}" />
                        ${fetchedContact.first_name} ${fetchedContact.middle_name} ${fetchedContact.last_name}
                    </p>
                `

                var inputEvent = new Event('input', {
                    bubbles: true,
                    cancelable: true,
                });

                container.addEventListener("click", () => {
                    contactSearchInput.value = ""
                    contactSearchInput.dispatchEvent(inputEvent)

                    const hiddenInput = document.createElement("input")
                    hiddenInput.type = "hidden"
                    hiddenInput.name = "eventParticipants[]"
                    const contactIdInput = container.querySelector("input[name='id']")
                    const contactWithGivenId = document.getElementById(`${contactIdInput.value}`)
                    if (contactWithGivenId) {
                        return
                    }
                    const contactFullNameInput = container.querySelector("input[name='fullName']")


                    hiddenInput.value = contactIdInput.value

                    const contactOverview = document.createElement("div")
                    contactOverview.id = contactIdInput.value
                    contactOverview.className = "col-12"
                    contactOverview.innerHTML = `
                        <p class="font-weight-bold"> ${contactFullNameInput.value} </p>
                    `

                    contactOverview.addEventListener("click", () => {
                        participantsContainer.removeChild(hiddenInput)
                        participantsContainer.removeChild(contactOverview)
                    })

                    participantsContainer.appendChild(hiddenInput)
                    participantsContainer.appendChild(contactOverview)
                })

                fragment.appendChild(container)
            })
            retrievedContactsContainer.appendChild(fragment)
        }
    }

    const fetchContacts = async (firstName) => {
        let request
        if (firstName !== undefined && firstName !== null) {
            request = await fetch(`/contacts/search?firstName=${firstName}`)
        } else {
            request = await fetch(`/contacts/search`)
        }
        const data = await request.json()
        return data
    }

    fetchContacts()

    const eventForm = document.getElementById("eventForm")
    eventForm.addEventListener("submit", (event) => {
        event.preventDefault();
        eventForm.submit();
    })
</script>