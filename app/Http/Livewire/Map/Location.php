<?php

namespace App\Http\Livewire\Map;

use App\Http\Requests\LocationRequest;
use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Location extends Component
{
    use WithFileUploads;

    public $count = 5;
    public $locationId, $longitude, $latitude, $name, $description, $address, $phoneNumber, $price, $rate, $hours, $facilities, $types;
    public $geoJson;
    public $category;
    public $category_id;
    public $picturePath = [];
    public $picturePathUrl;
    public $isEdit = false;

    protected $rules = [
        'category' => 'required',
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
                    'icon' => [25, 25],
                    'name' => $location->name,
                    'picturePath' => $location->picturePath,
                    'description' => $location->description
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
            'picturePath' => 'max:2048|required',
        ]);

        foreach ($this->picturePath as $picturePath) {
            $picturePath->store('images/destinations', 'public');
        };

        Destination::create([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'price' => $this->price,
            'phoneNumber' => $this->phoneNumber,
            'rate' => $this->rate,
            'hours' => $this->hours,
            'facilities' => $this->facilities,
            'picturePath' => $picturePath,
            'category_id' => $this->category,
        ]);

        session()->flash('info', 'Product Created Successfully');
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

        if ($this->picturePath) {
            foreach ($this->picturePath as $picturePath) {
                $picturePath->store('images/destinations', 'public');
            };

            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
                'picturePath' => $picturePath,
                'address' => $this->address,
                'price' => $this->price,
                'phoneNumber' => $this->phoneNumber,
                'rate' => $this->rate,
                'hours' => $this->hours,
                'facilities' => $this->facilities,
                'category_id' => $this->category_id,
            ];
        } else {
            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
                'address' => $this->address,
                'price' => $this->price,
                'phoneNumber' => $this->phoneNumber,
                'rate' => $this->rate,
                'hours' => $this->hours,
                'facilities' => $this->facilities,
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
        $this->address = '';
        $this->phoneNumber = '';
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
        $this->phoneNumber = $location->phoneNumber;
        $this->price = $location->price;
        $this->rate = $location->rate;
        $this->hours = $location->hours;
        $this->facilities = $location->facilities;
        $this->category_id = $location->category_id;
        $this->isEdit = true;
        $this->types = $location->types;
        $this->picturePathUrl = $location->picturePath;
    }
}
