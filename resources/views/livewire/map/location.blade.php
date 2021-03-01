@section('title')
Map
@endsection

@push('custom-css')
<link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
@endpush

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div wire:ignore id="map" style='width: 100%; height: 100vh;'></div>
                <!-- <pre wire:ignore id="info"></pre> -->
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header ">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Location</span>
                        @if($isEdit)
                        <button wire:click="clearForm" class="btn btn-success active">New Location</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form @if($isEdit) wire:submit.prevent="update" @else wire:submit.prevent="store" @endif>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" wire:model="lat" class="form-control"
                                        {{$isEdit ? 'disabled' : null}} placeholder="latitude" />
                                    @error('lat') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" wire:model="long" class="form-control"
                                        {{$isEdit ? 'disabled' : null}} placeholder="longitude" />
                                    @error('long') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" wire:model="title" class="form-control" placeholder="Name of location" />
                            @error('title') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <textarea wire:model="description" class="form-control"
                                placeholder="Location Description"></textarea>
                            @error('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input wire:model="image" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose Image</label>
                            </div>
                            @error('image') <small class="text-danger">{{$message}}</small>@enderror
                            @if($image)
                            <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                            @endif
                            @if($imageUrl && !$image)
                            <img src="{{asset('/storage/images/'.$imageUrl)}}" class="img-fluid" alt="Preview Image">
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit"
                                class="btn active btn-{{$isEdit ? 'success ' : 'primary'}} btn-block">{{$isEdit ? 'Update Location' : 'Submit Location'}}</button>
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
<script>
    document.addEventListener('livewire:load',  ()  => {
        
      const defaultLocation = [109.38125146611975, -6.889835946033301]
      
      const coordinateInfo = document.getElementById('info');

      mapboxgl.accessToken = "{{env('MAPBOX_KEY')}}";
      let map = new mapboxgl.Map({
          container: "map",
          center: defaultLocation,
          zoom: 11.15,
          style: "mapbox://styles/mapbox/streets-v11"
      });      

      //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
      const style = "streets-v11"
      map.setStyle(`mapbox://styles/mapbox/${style}`);

      map.on('click', (e) => {
          const latitude = e.lngLat.lat;
          const longitude = e.lngLat.lng;

          console.log(latitude, longitude)

          @this.lat = latitude;
          @this.long = longitude;
      });  
  })
</script>
@endpush