<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Geoposicionamiento de Usuario') }}
        </h2>
        @if ($errors->any())
            <div style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Selecciona tu ubicación en el mapa. El sistema guardará automáticamente tus coordenadas y dirección postal.") }}
        </p>
    </header>

    {{-- Formulario vinculado al perfil (Eloquent) --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- CAMPOS OCULTOS PARA PASAR LA VALIDACIÓN --}}
        <input type="hidden" name="name" value="{{ $user->name }}">
        <input type="hidden" name="email" value="{{ $user->email }}">

        {{-- Buscador de direcciones --}}
        <div>
            <x-input-label for="pac-input" value="Buscar dirección" />
            <x-text-input id="pac-input" class="mt-1 block w-full" type="text"
                placeholder="Empieza a escribir tu calle..." />
        </div>

        {{-- Contenedor del Mapa --}}
        <div id="map" style="height: 400px; width: 100%;" class="mt-4 rounded-md shadow-sm border border-gray-300">
        </div>

        {{-- Campos de Geoposicionamiento (Persistencia en BD) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="latitude" value="Latitud" />
                <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full bg-gray-100"
                    :value="old('latitude', $user->latitude)" readonly />
            </div>
            <div>
                <x-input-label for="longitude" value="Longitud" />
                <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full bg-gray-100"
                    :value="old('longitude', $user->longitude)" readonly />
            </div>
        </div>

        {{-- Geocodificación Inversa (Dirección postal) --}}
        <div>
            <x-input-label for="address" value="Dirección Postal Obtenida" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full bg-gray-50"
                :value="old('address', $user->address)" readonly />
            <p class="mt-1 text-xs text-gray-500">Esta dirección se actualiza automáticamente al mover el marcador.</p>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar Ubicación') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Ubicación guardada correctamente.') }}</p>
            @endif
        </div>
    </form>

    {{-- LÓGICA JAVASCRIPT: Debe ir antes de cargar la API de Google --}}
    <script>
        function initMap() {
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');
            const addrInput = document.getElementById('address');
            const searchInput = document.getElementById('pac-input');

            // Coordenadas iniciales (Cádiz por defecto o las del usuario)
            const initialPos = {
                lat: parseFloat(latInput.value) || 36.529,
                lng: parseFloat(lngInput.value) || -6.292
            };

            const map = new google.maps.Map(document.getElementById("map"), {
                center: initialPos,
                zoom: 15,
                mapId: "DEMO_MAP_ID" // Requerido para versiones modernas
            });

            const geocoder = new google.maps.Geocoder();

            // Marcador arrastrable para marcar ubicación [cite: 27]
            const marker = new google.maps.Marker({
                position: initialPos,
                map: map,
                draggable: true,
                title: "Arrastra para marcar tu ubicación"
            });

            // Autocompletado de búsqueda
            const autocomplete = new google.maps.places.Autocomplete(searchInput);
            autocomplete.bindTo("bounds", map);

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) return;

                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);
                updateFields(place.geometry.location, place.formatted_address);
            });

            // Evento al terminar de arrastrar el marcador (Geocodificación inversa) [cite: 28]
            marker.addListener('dragend', function () {
                const pos = marker.getPosition();

                geocoder.geocode({ location: pos }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        updateFields(pos, results[0].formatted_address);
                    }
                });
            });

            function updateFields(pos, address) {
                latInput.value = pos.lat().toFixed(8);
                lngInput.value = pos.lng().toFixed(8);
                addrInput.value = address || "Dirección no encontrada";
            }
        }
    </script>

    {{-- CARGA DE LA API: Usando el config/services.php que configuramos --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key') }}&libraries=places&callback=initMap"
        async defer></script>
</section>