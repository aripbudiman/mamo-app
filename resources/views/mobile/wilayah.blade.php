@extends('mobile.app')
@section('mobile')
<main class="absolute inset-x-0 pb-20 overflow-y-auto">
    <div id="map" class="w-full h-[500px] border-2 border-gray-200"></div>
    <section class="my-5">
        <form action="{{ route('roadmap.store') }}" method="post">
            @csrf
            <div class="flex gap-x-2 item-center">
                <label class="block" for="latlng">Latlng</label>
                <input type="text" name="latlng" id="latlng" placeholder="latitude" readonly>
            </div>
            <div class="flex gap-x-2 item-center">
                <label for="kecamatan">Kecamatan</label>
                <select name="kecamatan" id="kecamatan">
                    <option>--Pilih Kecamatan--</option>
                    <option value="manonjaya">Manonjaya</option>
                    <option value="cineam">Cineam</option>
                    <option value="gunung tanjung">Gunung Tanjung</option>
                </select>
            </div>
            <div class="flex gap-x-2 item-center">
                <label for="desa">Desa</label>
                <select name="desa" id="desa">

                </select>
            </div>
            <div class="flex gap-x-2 item-center">
                <label for="majelis">Majelis</label>
                <select name="majelis" id="majelis">
                </select>
            </div>
            <div>
                <!-- Component: Large primary basic button -->
                <button type="submit"
                    class="inline-flex items-center justify-center h-12 gap-2 px-6 text-sm font-medium tracking-wide text-white transition duration-300 rounded focus-visible:outline-none whitespace-nowrap bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300 disabled:shadow-none">
                    <span>Add to Map</span>
                </button>
                <!-- End Large primary basic button -->
            </div>
        </form>
    </section>
</main>

@include('mobile.footer')
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        var customIcon = L.icon({
            iconUrl: 'images/home.png',
            iconSize: [25, 25], // ukuran gambar marker
            iconAnchor: [0, 10], // titik anchor pada gambar (setengah dari lebar, penuh dari tinggi)
            popupAnchor: [0, -32] // titik di mana popup akan muncul terkait anchor
        });
        fetch("/get_road_maps")
            .then(response => response.json())
            .then(data => {
                data.forEach(data => {
                    L.marker([data.latitude, data.longitude], {
                        icon: customIcon
                    }).addTo(map).bindPopup(data.majelis)
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });


    $('#kecamatan').change(function () {
        var token = $('meta[name="csrf-token"]').attr('content');
        const kecamatan = $(this).val();
        $.ajax({
            type: "post",
            url: "{{ route('road_map.select_kecamatan') }}",
            data: {
                _token: token,
                kecamatan: kecamatan
            },
            dataType: "JSON",
            success: function (response) {
                $('#desa').html(response);
                var desa = $('#desa').val();
                var token = $('meta[name="csrf-token"]').attr(
                    'content');
                $.ajax({
                    type: "post",
                    url: "{{ route('road_map.select_desa') }}",
                    data: {
                        _token: token,
                        desa: desa
                    },
                    dataType: "JSON",
                    success: function (response) {
                        $('#majelis').html(response);
                    }
                });
            }
        });
    });

    $('#desa').change(function () {
        var token = $('meta[name="csrf-token"]').attr('content');
        const desa = $(this).val();
        $.ajax({
            type: "post",
            url: "{{ route('road_map.select_desa') }}",
            data: {
                _token: token,
                desa: desa
            },
            dataType: "JSON",
            success: function (response) {
                $('#majelis').html(response);
            }
        });
    });

    var map = L.map('map').setView([-7.349119, 108.307265], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'aripbudiman',
    }).addTo(map);
    var customIcon = L.icon({
        iconUrl: 'images/bank.png',
        iconSize: [25, 25], // ukuran gambar marker
        iconAnchor: [0, 10], // titik anchor pada gambar (setengah dari lebar, penuh dari tinggi)
        popupAnchor: [0, -32] // titik di mana popup akan muncul terkait anchor
    });
    L.marker([-7.349119, 108.307265], {
        icon: customIcon
    }).addTo(map).bindPopup('Kantor Manonjaya');

    var currentMarker;

    function getCurrentLocation() {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }

                currentMarker = L.marker([lat, lng], {
                    icon: L.icon({
                        iconUrl: 'images/pin.png',
                        iconSize: [25, 25],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    })
                }).addTo(map);
                map.setView([lat, lng], 17);
                $('#latlng').val(lat + '|' + lng);
            });
        } else {
            alert('Geolocation is not available');
        }
    }
    var CustomControl = L.Control.extend({
        options: {
            position: 'bottomright'
        },

        onAdd: function (map) {
            var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            container.innerHTML =
                '<div class="flex flex-col gap-1"><button onclick="getCurrentLocation()" class="bg-white w-10 h-10 rounded-full" id="myLocationButton"><i class="text-2xl text-green-2 fa-solid fa-location-crosshairs"></i></button><button onclick="" class="bg-white w-10 h-10 rounded-full" id="myLocationButton"><i class="fa-solid text-2xl text-green-2 fa-map-location-dot"></i></button></div>';
            return container;
        }
    });
    map.addControl(new CustomControl());

</script>
@endpush
