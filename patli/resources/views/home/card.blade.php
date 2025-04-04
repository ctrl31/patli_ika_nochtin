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

<script>
    function initMap() {
        // Ubicación por defecto (CDMX) en caso de error
        let defaultLocation = { lat: 19.432608, lng: -99.133209 };

        // Crear el mapa con la ubicación por defecto
        let map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 14
        });

        let marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            title: "Ubicación por defecto"
        });

        // Intentar obtener la ubicación del usuario
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    let userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Mover el mapa a la ubicación del usuario
                    map.setCenter(userLocation);
                    marker.setPosition(userLocation);
                    marker.setTitle("Tu ubicación");

                    console.log("Ubicación obtenida:", userLocation);
                },
                function (error) {
                    console.error("Error en la geolocalización:", error);
                }
            );
        } else {
            console.warn("Geolocalización no soportada en este navegador.");
        }
    }
</script>

<!-- Cargar Google Maps con la clave API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvXuSL9A7DnZhdyS7VhyJNE3OTeR0GnsM&callback=initMap"></script>
