@extends( 'layouts.base' )

@section( 'extra-css' )
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd-BMx-EbtrAy7Rhsq7byAOvarXHIXgq8"></script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
@endsection
@section( 'content' )
    @include( 'includes.header' )

    <div class="max-w-screen-xl mx-auto mt-3">
        @if( empty( $contact->lat ) || empty( $contact->long ) )
            <div class="border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex align-middle justify-between">
                    <div class="w-full">
                        <p class="font-bold">Info</p>
                        <p class="text-sm">There is no address details for this contact.</p>
                    </div>
                    <a href="{{ route( 'edit-contact', [ 'id' => $contact->id ] ) }}" class="inline-flex whitespace-nowrap mr-auto items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit now</a>
                </div>
            </div>

        @else
            <div id="map" style="height: 500px;"></div>
        @endif
    </div>

@endsection

@section( 'extra-js' )
    <script>
        function initMap() {
            // Create the map
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: {{ $contact->lat }}, lng: {{ $contact->long }}},
                zoom: 5
            });

            // Define the markers and add them to a marker clusterer
            var markers = [
                new google.maps.Marker({position: {lat: {{ $contact->lat }}, lng: {{ $contact->long }}}}),
            ];

            var markerCluster = new MarkerClusterer(map, markers, {
                imagePath: 'https://icons-for-free.com/download-icon-marker+icon-1320191246732365563_256.png'
            });
        }

        // Call the initMap function when the page is loaded
        window.onload = initMap;


    </script>
@endsection
