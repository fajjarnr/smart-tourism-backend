<?php

namespace App\Http\Livewire\Map;

use App\Models\Location as ModelsLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Location extends Component
{
    use WithFileUploads;

    public $count = 5;
    public $locationId, $longitude, $latitude, $name, $description, $image;
    public $imageUrl;
    public $geoJson;
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
                    'message' => $location->description,
                    'iconSize' => [50, 50],
                    'locationId' => $location->id,
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

        // convert ke json
        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;
    }

    public function render()
    {
        $this->getLocations();
        return view('livewire.map.location');
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
            'longitude' => 'required',
            'latitude' => 'required',
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
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $imageName,
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
            'longitude' => 'required',
            'latitude' => 'required',
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
            ];
        } else {
            $updateData = [
                'name' => $this->name,
                'description' => $this->description,
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
        $this->longitude = '';
        $this->latitude = '';
        $this->name = '';
        $this->description = '';
        $this->image = '';
        $this->imageUrl = '';
        $this->isEdit = false;
    }

    public function findLocationById($id)
    {
        $location = ModelsLocation::findOrFail($id);

        $this->locationId = $id;
        $this->longitude = $location->longitude;
        $this->latitude = $location->latitude;
        $this->name = $location->name;
        $this->description = $location->description;
        $this->isEdit = true;
        $this->imageUrl = $location->image;
    }
}
