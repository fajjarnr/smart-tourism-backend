@section('title')
Destinasi
@endsection

@push('custom-css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
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
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        @if($isEdit)
                        <button wire:click="clearForm" class="btn btn-success btn-block active">New Location</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form @if($isEdit) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif
                        enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">latitude</label>
                                    <input wire:model="latitude" type="text" name="latitude" class="form-control"
                                        id="latitude" autocomplete="off" {{$isEdit ? 'disabled' : null}} />
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">longitude</label>
                                    <input wire:model="longitude" type="text" name="longitude" class="form-control"
                                        id="longitude" autocomplete="off" {{$isEdit ? 'disabled' : null}} />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input wire:model="name" type="text" class="form-control" name="name" id="name"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea wire:model="description" name="description" class="form-control" id="description"
                                cols="30" rows="5" autocomplete="off"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="col-form-label">Kategori</div>

                            <select wire:model="category_id" name="category_id" class="js-example-basic-single col">

                                <option value="">Select a Category</option>

                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <input wire:model="address" type="text" class="form-control" name="address" id="address"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="phone">No Telepon</label>
                            <input wire:model="phone" type="number" class="form-control" name="phone" id="phone"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="rate">Rating</label>
                            <input wire:model="rate" type="number" class="form-control" name="rate" max="5" min="1"
                                id="rate" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="price">Harga Tiket</label>
                            <input wire:model="price" type="number" class="form-control" name="price" id="price"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="hours">Jam Operasional</label>
                            <input wire:model="hours" type="text" class="form-control" name="hours" id="hours"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="facilities">Fasilitas</label>
                            <input wire:model="facilities" type="text" class="form-control" name="facilities"
                                id="facilities" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="types">Tipe</label>
                            <p class="text-gray-600 text-xs italic">Dipisahkan dengan koma, contoh:
                                recommended,popular,new</p>
                            <input wire:model="types" type="text" class="form-control" name="types" id="types"
                                autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label class="text-white">Image</label>

                            <div class="custom-file">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                            </div>

                            <label class="text-white">Picture of Location</label>
                            <br>

                            @error('image') <small class="text-danger">{{$message}}</small>@enderror

                            @if($image)
                            <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                            @endif

                            @if($imageUrl && !$image)
                            <img src="{{asset('/storage/images/destinations'.$imageUrl)}}" class="img-fluid"
                                alt="Preview Image">
                            @endif

                        </div>

                        <div class="form-group">
                            <button type="submit"
                                class="btn active btn-{{$isEdit ? 'success text-white' : 'primary'}} btn-block">{{$isEdit ? 'Update Location' : 'Submit Location'}}</button>

                            @if($isEdit)
                            <button wire:click="deleteLocationById" type="button"
                                class="btn btn-danger active btn-block">Delete Location</button>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('custom-js')
<script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('assets/js/form-validation-custom.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>

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
                const {icon, locationId, name, image, description, address, phone, rate} = properties

                let el = document.createElement('div');
                el.className = 'marker' + locationId;
                el.id = locationId;
                el.style.backgroundImage = 'url({{ asset("assets/marker.png") }})';
                el.style.backgroundSize = 'cover';
                el.style.width = icon[0] + 'px';
                el.style.height = icon[1] + 'px';

                const pictureLocation = '{{asset("/storage/images/destinations")}}' + '/' + image

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
                                <td><img src="${pictureLocation}" loading="lazy" class="img-fluid"/></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>         
                                <td>${address}</td>
                            </tr>
                            <tr>
                                <td>No Telp</td>         
                                <td>${phone}</td>
                            </tr>
                            <tr>
                                <td>Rating</td>         
                                <td>${rate}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                `;
                
                el.addEventListener('click', (e) => {   
                    const locationId = e.toElement.id        
                    @this.findLocationById(locationId)
                }); 

                let popup = new mapboxgl.Popup({ offset: 25 }).setHTML(content).setMaxWidth("400px")

                new mapboxgl.Marker(el)
                .setLngLat(geometry.coordinates)
                .setPopup(popup)
                .addTo(map);
            })
        }

        loadGeoJSON({!! $geoJson !!})

        window.addEventListener('locationAdded', (e) => {           
            swal({
                title: "Location Added!",
                text: "Your location has been save sucessfully!",
                icon: "success",
                button: "Ok",
            }).then((value) => {
                loadGeoJSON(JSON.parse(e.detail))
            });
        }) 
        
        window.addEventListener('deleteLocation', (e) => {  
            console.log(e.detail);         
            swal({
                title: "Location Delete!",
                text: "Your location deleted sucessfully!",
                icon: "success",
                button: "Ok",
            }).then((value) => {
               $('.marker' + e.detail).remove();
               $('.mapboxgl-popup').remove();
            });
        })

        window.addEventListener('updateLocation', (e) => {  
            console.log(e.detail);         
            swal({
                title: "Location Update!",
                text: "Your location updated sucessfully!",
                icon: "success",
                button: "Ok",
            }).then((value) => {
               loadGeoJSON(JSON.parse(e.detail))
               $('.mapboxgl-popup').remove();
            });
        })

        const getLongLatByMarker = () => {
            const lngLat = marker.getLngLat();           
            return 'Latitude: ' + lngLat.lat + '<br /> Longitude: ' + lngLat.lng;
        }

        map.on('click', (e) =>{
            const latitude = e.lngLat.lat
            const longitude = e.lngLat.lng

            @this.latitude = latitude
            @this.longitude = longitude
        })
    });
</script>
@endpush