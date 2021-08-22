<x-layout.layout>
    @isset($successMessage)
    <div class="alert alert-primary" role="alert" id="alertMessage">
        {{ $successMessage }}
    </div>
    @endisset
    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 p-0">
        <form class="row bg-white mb-5 p-5" method="" action="">
            <div class="row">
                <div class="col-12">
                    <label for="status">Mostrar</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Todos</option>
                        <option value="1">Por ocurrir</option>
                        <option value="2">Concluidos</option>
                        <option value="3">Cancelados</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-12">
                            <label for="starting_date">Fecha de inicio</label>
                            <input type="date" name="starting_date" id="starting_date" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-12 flex">
                    <input type="search" name="title" id="title" placeholder="Nombre del evento..." class="form-control flex-grow-1">
                    <button class="btn bg-white text-primary shadow-sm border">Buscar</button>
                </div>
            </div>

        </form>
    </div>
    <section class="row mb-5">
        <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 position-relative">
            @isset($retrievedEvents)
            @forelse ($retrievedEvents as $event)
            <x-event.event-item-overview eventId="{{$event->id}}" eventName="{{ $event->title }}" eventStartingDate="{{ $event->starting_date }} {{ $event->starting_time }}" eventEndingDate="{{ $event->ending_date }} {{ $event->ending_time }}" eventStatus="{{ $event->status }}" />
            @empty
            <p>No hay eventos</p>
            @endforelse
            @endisset
            <x-u-i.floating-button href="{{ route('events.create') }}" />
        </div>
    </section>

    <script>
        const alertMessage = document.getElementById("alertMessage")
        const vanishTimeout = setTimeout(() => {
            if (alertMessage !== null) {
                alertMessage.style.display = "none"
            }
            clearTimeout(vanishTimeout)
        }, 3000)
    </script>
</x-layout.layout>