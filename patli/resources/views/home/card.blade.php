<div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-4">
    <h2 class="text-xl font-semibold text-red-600 text-center"> Números de Emergencia   </h2>
    <ul class="mt-4 space-y-4">
        @foreach ($contacts as $contact)
            <li class="flex items-center gap-4 p-3 border rounded-lg shadow-sm bg-gray-100">
                <div class="flex-1">
                    <p class="text-lg font-medium">{{ $contact['name'] }}</p>
                    <p class="text-gray-500 flex items-center gap-1">
                        📞 <a href="tel:{{ $contact['phone'] }}" class="text-blue-600 hover:underline">{{ $contact['phone'] }}</a>
                    </p>
                    <p class="text-gray-400 flex items-center gap-1">
                        📍 {{ $contact['location'] }}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>

    <h3 class="text-lg font-semibold text-gray-700 mt-4">🏥 Hospitales Cercanos</h3>
    <div id="map" style="height: 300px; width: 100%;" class="mt-3"></div>
</div>

<script>
    async function getLocationAndHospitals() {
        try {
            let response = await fetch('https://ipapi.co/json/');
            let data = await response.json();
            let lat = data.latitude;
            let lng = data.longitude;
            
            // Cargar el mapa con la ubicación del usuario
            let map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: lat, lng: lng },
                zoom: 15
            });

            // Buscar hospitales cercanos
            let service = new google.maps.places.PlacesService(map);
            service.nearbySearch({
                location: { lat: lat, lng: lng },
                radius: 5000,
                type: ['hospital']
            }, function(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    results.forEach(place => {
                        new google.maps.Marker({
                            position: place.geometry.location,
                            map: map,
                            title: place.name
                        });
                    });
                }
            });
        } catch (error) {
            console.error('Error al obtener la ubicación:', error);
        }
    }

    // Cargar el mapa cuando la página se haya cargado
    window.onload = getLocationAndHospitals;
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places"></script>
