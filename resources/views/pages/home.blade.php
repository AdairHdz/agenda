<x-layout.layout>
  @isset($successMessage)
  <div class="alert alert-primary" role="alert" id="alertMessage">
    {{ $successMessage }}
  </div>
  @endisset
  <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 p-0">
    <form class="row">
      <div class="flex col-12">
      <input type="search" name="search" id="search" placeholder="Buscar..." class="form-control flex-grow-1">
      <button class="btn bg-white text-primary shadow-sm border">Buscar</button>
      </div>
    </form>
  </div>
  <section class="row mb-5">
    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 position-relative">
      @isset($retrievedContacts)
      @forelse ($retrievedContacts as $contact)
      <x-contact.contact-item-overview contactId="{{ $contact->id }}" contactName="{{ $contact->first_name . ' ' . $contact->middle_name . ' ' . $contact->last_name; }}" contactEmailAddress="{{ $contact->email_address }}" />
      @empty
      <p>No hay contactos</p>
      @endforelse
      @endisset
      <x-u-i.floating-button href="{{ route('contacts.create') }}" />
    </div>
  </section>
</x-layout.layout>

<script>
  const alertMessage = document.getElementById("alertMessage")
  const vanishTimeout = setTimeout(() => {
    if (alertMessage !== null) {
      alertMessage.style.display = "none"
    }
    clearTimeout(vanishTimeout)
  }, 3000)
</script>