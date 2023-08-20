@extends('layouts.main')
@section('main')
<div class="w-full px-4 lg:pl-64">
    <main>
        <div id="map" class="w-full h-screen border-2 border-gray-200"></div>
    </main>
</div>
@endsection
@push('scripts')
<script>
    const apiKey =
        "AAPKd3cca4d6ca6d4c8a906b439f7edf41283zitjshK5TBCeBhGuw-7nSGQXXVzurx0O_64tH-bkfbyaxqX_GfxeyI1eoEwPEu7";
    var map = L.map('map').setView([-7.349119, 108.307265], 17);
    L.esri.Vector.vectorBasemapLayer("arcgis/imagery", {
        apikey: apiKey,
        attribution: 'arip budiman'
    }).addTo(map);
    L.marker([-7.349119, 108.307265], {
        icon: L.icon({
            iconUrl: 'images/bank.png',
            iconSize: [20, 20],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        })
    }).addTo(map).bindPopup('Kantor Manonjaya');

    fetch("/get_road_maps")
        .then(response => response.json())
        .then(data => {
            data.forEach(data => {
                L.marker([data.latitude, data.longitude], {
                    icon: L.icon({
                        iconUrl: 'images/home2.png',
                        iconSize: [20, 20],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    })
                }).addTo(map).bindPopup(data.majelis);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

</script>
@endpush
