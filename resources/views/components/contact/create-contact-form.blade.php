<form
    class="bg-white p-3 p-md-5 shadow-sm"
    action="{{ request()->routeIs('contacts.create') ? route('contacts.store') : route('contacts.update', $contactId) }}"
    method="POST">                
    @csrf
    @if (request()->routeIs('contacts.edit'))        
        @method("PUT")
    @endif        
    <p class="font-weight-bold text-center h4 mb-3">
        Datos del contacto
    </p>
    <x-u-i.delimiter title="Datos generales" styleClasses="mb-5">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col">
                    <label for="firstName">Nombre(s)</label>
                    <input type="text" name="firstName" id="firstName" value="{{ $firstNameValue }}" class="form-control">
                    @error("firstName")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <label for="middleName">Apellido paterno</label>
                    <input type="text" name="middleName" id="middleName" value="{{ $middleNameValue }}" class="form-control">
                    @error("middleName")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="lastName">Apellido materno</label>
                    <input type="text" name="lastName" id="lastName" value="{{ $lastNameValue }}" class="form-control">
                    @error("lastName")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <label for="birthDate">Fecha de nacimiento</label>
                    <input type="date" name="birthDate" id="birthDate" value="{{ $birthDateValue }}" class="form-control">
                    @error("birthDate")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label for="emailAddress">Correo electrónico</label>
                    <input type="email" name="emailAddress" id="emailAddress" value="{{ $emailAddressValue }}" class="form-control">
                    @error("emailAddress")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
        </div>
    </x-u-i.delimiter>
    <x-u-i.delimiter title="Teléfonos de contacto">
        <div class="col">
            <div class="row mb-3 p-3">
                <div class="col-12">
                    <label for="">Teléfono de casa</label>
                    <input type="tel" name="homePhone" id="homePhone" value="{{ $homePhone }}" class="form-control">
                    @error("homePhone")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col-12">
                    <label for="">Teléfono de trabajo</label>
                    <input type="tel" name="workPhone" id="workPhone" value="{{ $workPhone }}" class="form-control">
                    @error("workPhone")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row mb-3 p-3">
                <div class="col-12">
                    <label for="">Teléfono celular</label>
                    <input type="tel" name="mobilePhone"  id="mobilePhone" value="{{ $mobilePhone }}" class="form-control">
                    @error("mobilePhone")
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
        </div>
    </x-u-i.delimiter>
    <div class="row mt-5">
        <div class="col col-md-6 offset-md-3">
            <button class="btn btn-success btn-block">
                {{ request()->routeIs("contacts.create") ? "Registrar" : "Editar" }}
            </button>
        </div>
    </div>
</form>