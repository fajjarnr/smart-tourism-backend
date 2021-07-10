<?php

namespace App\Http\Livewire\Map;

use App\Http\Requests\LocationRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Galery;
use App\Models\Location as ModelsLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Location extends Component
{
    use WithFileUploads;

    public $count = 5;
    public $locationId, $longitude, $latitude, $image, $name, $description, $address, $phone, $price, $rate, $hours, $facilities, $types;
    public $geoJson;
    public $category;
    public $category_id;
    public $picturePath;
    public $picturePathUrl;
    public $imageUrl;
    public $isEdit = false;
    public $galeries = [];

    protected $rules = [
        'category_id' => 'required',
    ];

    private function getLocations()
    {
        $locations = Destination::orderBy('created_at', 'desc')->get();

        $customLocation = [];

        foreach ($locations as $location) {
            $customLocation[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [
                        $location->longitude, $location->latitude
                    ],
                    'type' => 'Point'
                ],
                'properties' => [
                    'locationId' => $location->id,
                    'icon' => [30, 30],
                    'name' => $location->name,
                    'image' => $location->image,
                    'description' => $location->description,
                    'address' => $location->address,
                    'phone' => $location->phone,
                    'rate' => $location->rate,
                ]
            ];
        };

        $geoLocations = [
            'type' => 'FeatureCollection',
            'features' => $customLocation
        ];

        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;
    }

    public function render()
    {
        $this->getLocations();
        return view('livewire.map.location', [
            'categories' => Category::all(),
        ]);
    }

    public function previewImage()
    {
        if (!$isEdit) {
            $this->validate([
                'image' => 'image|max:2048'
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);

        $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();

        Storage::putFileAs(
            'public/images/destinations',
            $this->image,
            $imageName
        );

        Destination::create([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'price' => $this->price,
            'phone' => $this->phone,
            'rate' => $this->rate,
            'hours' => $this->hours,
            'facilities' => $this->facilities,
            'category_id' => $this->category_id,
            'types' => $this->types,
            'image' => $imageName,
        ]);

        // foreach ($this->galeries as $galery) {
        //     $galery->store('images/galeries', 'public');
        // }

        // Galery::create([
        //     'image_url' => $galery,
        // ]);

        session()->flash('info', 'Location Created Successfully');
        $this->clearForm();
        $this->getLocations();
        $this->dispatchBrowserEvent('locationAdded', $this->geoJson);
    }

    public function update()
    {
        $this->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'name' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);

        $location = Destination::findOrFail($this->locationId);

        if ($this->image) {
            $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();

            Storage::putFileAs(
                'public/images/destinations',
                $this->image,
                $imageName
            );

            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imageName,
                'address' => $this->address,
                'price' => $this->price,
                'phone' => $this->phone,
                'rate' => $this->rate,
                'hours' => $this->hours,
                'facilities' => $this->facilities,
                'types' => $this->types,
                'category_id' => $this->category_id,
            ];
        } else {
            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
                'address' => $this->address,
                'price' => $this->price,
                'phone' => $this->phone,
                'rate' => $this->rate,
                'hours' => $this->hours,
                'facilities' => $this->facilities,
                'types' => $this->types,
                'category_id' => $this->category_id,
            ];
        }

        $location->update($updateData);

        session()->flash('info', 'Product Updated Successfully');

        $this->clearForm();
        $this->getLocations();
        $this->dispatchBrowserEvent('updateLocation', $this->geoJson);
    }

    public function deleteLocationById()
    {
        $location = Destination::findOrFail($this->locationId);
        $location->delete();

        $this->clearForm();
        $this->dispatchBrowserEvent('deleteLocation', $location->id);
    }

    public function clearForm()
    {
        $this->latitude = '';
        $this->longitude = '';
        $this->name = '';
        $this->description = '';
        $this->picturePath = '';
        $this->picturePathUrl = '';
        $this->image = '';
        $this->imageUrl = '';
        $this->address = '';
        $this->phone = '';
        $this->price = '';
        $this->rate = '';
        $this->hours = '';
        $this->facilities = '';
        $this->types = '';
        $this->isEdit = false;
        $this->category_id = '';
    }

    public function findLocationById($id)
    {
        $location = Destination::findOrFail($id);

        $this->locationId = $id;
        $this->latitude = $location->latitude;
        $this->longitude = $location->longitude;
        $this->name = $location->name;
        $this->description = $location->description;
        $this->address = $location->address;
        $this->phone = $location->phone;
        $this->price = $location->price;
        $this->rate = $location->rate;
        $this->hours = $location->hours;
        $this->facilities = $location->facilities;
        $this->category_id = $location->category_id;
        $this->isEdit = true;
        $this->types = $location->types;
        $this->picturePathUrl = $location->picturePathUrl;
        $this->imageUrl = $location->image;
    }
}
