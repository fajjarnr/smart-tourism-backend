<?php

namespace App\Http\Livewire\Map;

use App\Models\Category;
use App\Models\Location as ModelsLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Location extends Component
{
    use WithFileUploads;

    public $count = 5;
    public $locationId, $longitude, $latitude, $name, $description, $image, $address, $phoneNumber, $price, $rate, $hours, $facilities;
    public $geoJson;
    public $category = null;
    public $category_id;
    public $imageUrl;
    public $isEdit = false;

    private function getLocations()
    {
        $locations = ModelsLocation::orderBy('created_at', 'desc')->get();

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
                    'image' => $location->image,
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

    public function store()
    {
        $this->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048|required',
        ]);

        $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();

        Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
        );

        ModelsLocation::create([
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
            'image' => $imageName,
            'category_id' => $this->category,
            'user_id' => Auth::id(),
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
        ]);

        $location = ModelsLocation::findOrFail($this->locationId);

        if ($this->image) {
            $imageName = md5($this->image . microtime()) . '.' . $this->image->extension();

            Storage::putFileAs(
                'public/images',
                $this->image,
                $imageName
            );

            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
                'image' => $imageName,
                'address' => $this->address,
                'price' => $this->price,
                'phoneNumber' => $this->phoneNumber,
                'rate' => $this->rate,
                'hours' => $this->hours,
                'facilities' => $this->facilities,
                'category_id' => $this->category,
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
                'category_id' => $this->category,
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
        $location = ModelsLocation::findOrFail($this->locationId);
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
        $this->image = '';
        $this->imageUrl = '';
        $this->address = '';
        $this->phoneNumber = '';
        $this->price = '';
        $this->rate = '';
        $this->hours = '';
        $this->facilities = '';
        $this->isEdit = false;
    }

    public function findLocationById($id)
    {
        $location = ModelsLocation::findOrFail($id);

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
        $this->category = $location->category;
        $this->isEdit = true;
        $this->imageUrl = $location->image;
    }
}
