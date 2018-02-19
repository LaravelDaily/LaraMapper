@extends ('layouts.appClient')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-body">
                <div class="panel-body">
                    {!! Form::open(['method' => 'GET', 'route' => ['client.index']]) !!}
                    <div class="row">
                        <div class="col-md-10">
                            <div class="col-xs-4 form-group">
                                {!! Form::label('city_id', trans('quickadmin.stores.fields.city').'', ['class' => 'control-label    ']) !!}
                                {!! Form::select('city_id', $cities, null, ['class' => 'form-control select2']) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('category_id', trans('quickadmin.stores.fields.categories').'', ['class' => 'control-label']) !!}
                                {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2']) !!}
                            </div>
                            <div class="col-xs-4 form-group">
                                {!! Form::label('store_name', trans('quickadmin.stores.fields.name').'', ['class' => 'control-label']) !!}
                                {!! Form::text('store_name', null, ['class' => 'form-control', 'id' => 'store']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="margin-top: 5px;">
                                <label class="control-label"></label>
                                {!! Form::submit('Search', ['class' => 'btn btn-danger btn-block']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <p>
                                <b>{{count($stores)}} results found</b>
                            </p>
                        </div>
                    </div>
                    <div id="address-map-container" style="width: 100%; height: 600px;">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                        <script>
                            var map;
                            var markers = {!! $stores !!};
                            var default_center_latitude = {!! $default_center_latitude !!};
                            var default_center_longitude = {!! $default_center_longitude !!};
                            var default_zoom = {!! $default_zoom !!};
                            var infoWindow;

                            function initMap() {
                                var center = new google.maps.LatLng(
                                    default_center_latitude,
                                    default_center_longitude);
                                var mapOptions = {
                                    zoom: default_zoom,
                                    center: center
                                };
                                map = new google.maps.Map(document.getElementById('address-map'), mapOptions);

                                for (var i = 0; i < markers.length; i++) {
                                    addMarker(markers[i]);
                                }

                                function addMarker(marker) {
                                    var categories = marker.categories.map(function (cats) {
                                        return cats.name
                                    });
                                    var name = marker.name;
                                    var description = marker.description;
                                    var address = marker.address_address;
                                    var phone = marker.phone;
                                    var markerLatLng = new google.maps.LatLng(
                                        parseFloat(marker.address_latitude),
                                        parseFloat(marker.address_longitude));
                                    var getUrl = '{!! env('APP_URL') !!}';
                                    if (marker.media[0]) {
                                        var image = '<div class="col-md-3"><img alt="Image cannot be shown." width="140" height="150" src=' + getUrl + '/public/storage/' + marker.media[0].id + '/' + marker.media[0].file_name + '></div>';
                                    } else {
                                        var image = '';
                                    }

                                    var html = '<div class="container" style="width: auto; height: auto;" ><div class="row"><div class="col-md-9"><b>' + name + '</b><br/> Address: ' + address + '<br/>' + 'Phone: ' + phone + '<br/>'
                                        + 'Categories: ' + categories + '<br/>' + description + '</div>' + image + '</div></div>';

                                    var icon = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
                                    mark = new google.maps.Marker({
                                        map: map,
                                        position: markerLatLng,
                                        icon: icon,
                                        infowindow: html
                                    });
                                    infoWindow = new google.maps.InfoWindow({});
                                    google.maps.event.addListener(mark, 'click', function () {
                                        if (infoWindow) {
                                            infoWindow.close();
                                        }
                                        infoWindow = new google.maps.InfoWindow();
                                        infoWindow.setContent(this.infowindow);
                                        infoWindow.open(map, this);
                                    });
                                    google.maps.event.addListener(map, "click", function () {
                                        infoWindow.close();
                                    });
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
            async defer></script>
@stop
