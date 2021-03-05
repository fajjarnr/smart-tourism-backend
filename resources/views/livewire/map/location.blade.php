@section('title')
Add Location
@endsection

@push('custom-css')
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
@endpush

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div wire:ignore id="map" style='width: 100%; height: 100vh; margin:0; padding:0;'></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header ">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Location</span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">latitude</label>
                                    <input wire:model="latitude" type="text" name="latitude" class="form-control"
                                        id="latitude">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">longitude</label>
                                    <input wire:model="longitude" type="text" name="longitude" class="form-control"
                                        id="longitude">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" cols="30"
                                rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-white">Image</label>
                            <div class="custom-file dark-input">
                                <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label dark-input" for="customFile">Choose file</label>
                            </div>
                            <label class="text-white">Picture of Location</label>
                            @error('image') <small class="text-danger">{{$message}}</small>@enderror
                            @if($image)
                            <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit Location</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-js')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>

<script>
    document.addEventListener('livewire:load',  ()  => {
        const pemalang = [109.38062960466476, -6.89032304565653];
        const coordinateInfo = document.getElementById('info');

        mapboxgl.accessToken = "{{env('MAPBOX_KEY')}}";
        let map = new mapboxgl.Map({
            container: "map",
            center: pemalang,
            zoom: 12.5,
            style: "mapbox://styles/mapbox/streets-v11"
        });

        //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
        const style = "streets-v11"
        map.setStyle(`mapbox://styles/mapbox/${style}`);

        map.addControl(new mapboxgl.NavigationControl());

        const loadGeoJSON = (geoJson) => {
            geoJson.features.forEach(function (marker) {
                const {geometry, properties} = marker
                const {icon, locationId, name, image, description} = properties

                let el = document.createElement('div');
                el.className = 'marker' + locationId;
                el.id = locationId;
                el.style.backgroundImage = 'url({{ asset("assets/marker.png") }})';
                el.style.backgroundSize = 'cover';
                el.style.width = icon[0] + 'px';
                el.style.height = icon[1] + 'px';

                const pictureLocation = '{{asset("/storage/images")}}' + '/' + image

                const content = `
                <div style="overflow-y: auto; max-height:400px;width:100%;">
                    <table class="table table-sm mt-2">
                         <tbody>
                            <tr>
                                <td>Title</td>
                                <td>${name}</td>
                            </tr>
                            <tr>
                                <td>Picture</td>
                                <td><img src="${image}" loading="lazy" class="img-fluid"/></td>
                            </tr>
                            <tr>
                                <td>Description</td>         
                                <td>${description}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `;

                let popup = new mapboxgl.Popup({ offset: 25 }).setHTML(content).setMaxWidth("400px")

                new mapboxgl.Marker(el)
                .setLngLat(geometry.coordinates)
                .setPopup(popup)
                .addTo(map);
            })
        }

        loadGeoJSON({!! $geoJson !!})

        map.on('click', (e) =>{
            const latitude = e.lngLat.lat
            const longitude = e.lngLat.lng

            @this.latitude = latitude
            @this.longitude = longitude
        })
    });
</script>
@endpush