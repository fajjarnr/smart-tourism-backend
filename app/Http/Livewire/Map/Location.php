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

    public $locationId, $longitude, $latitude, $name, $description, $image;
    public $geoJson;

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
        return view('livewire.map.location');
    }
}
