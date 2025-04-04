<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl p-6">
    <h2 class="text-3xl font-semibold text-red-600 text-center"> Números de Emergencia </h2>

    <!-- Tabla de contacto -->
    <div class="overflow-x-auto mt-6 content-center">
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="py-4 px-8 text-center text-xl">Servicio</th>
                    <th class="py-4 px-8 text-center text-xl">Número</th>
                    <th class="py-4 px-8 text-center text-xl">Ubicación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr class="border-b hover:bg-gray-50 transition duration-300">
                        <td class="py-4 px-8 text-center text-lg font-medium text-gray-800">{{ $contact['name'] }}</td>
                        <td class="py-4 px-8 text-center text-lg">
                            <a href="tel:{{ $contact['phone'] }}" class="text-blue-600 font-semibold hover:underline">{{ $contact['phone'] }}</a>
                        </td>
                        <td class="py-4 px-8 text-center text-lg text-gray-400">{{ $contact['location'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h3 class="text-2xl font-semibold text-gray-700 mt-6 text-center">🏥 Hospitales Cercanos</h3>

    <div id="map" style="height: 350px; width: 100%;" class="mt-3"></div>
</div>

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
