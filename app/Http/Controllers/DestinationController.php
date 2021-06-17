<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destination = Destination::with(['category'])->get();
        return view('destination.index', [
            'destination' => $destination
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('destination.create', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'name' => 'required',
            'description' => 'required',
            'picturePath' => 'max:2048|required',
        ]);

        $picturePath = $request->file('picturePath')->store('images/destination', 'public');

        Destination::create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->price,
            'phoneNumber' => $request->phoneNumber,
            'rate' => $request->rate,
            'hours' => $request->hours,
            'facilities' => $request->facilities,
            'picturePath' => $picturePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('destination.index')->with('success', 'Data~ berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $category = Category::all();
        return view('destination.edit', [
            'item' => $destination,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'name' => 'required',
            'description' => 'required',
            'picturePath' => 'max:2048|required',
        ]);

        $destination = Destination::findOrFail($id);

        if ($request->hasFile('picturePath')) {
            $picturePath = $request->file('picturePath')->store('images/destination', 'public');

            $updateData = [
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'price' => $request->price,
                'phoneNumber' => $request->phoneNumber,
                'rate' => $request->rate,
                'hours' => $request->hours,
                'facilities' => $request->facilities,
                'category_id' => $request->category_id,
                'picturePath' => $picturePath,
            ];
        } else {
            $updateData = [
                'name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'price' => $request->price,
                'phoneNumber' => $request->phoneNumber,
                'rate' => $request->rate,
                'hours' => $request->hours,
                'facilities' => $request->facilities,
                'category_id' => $request->category_id,
            ];
        }

        $destination->update($updateData);

        return redirect()->route('destination.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        $destination->delete();

        return redirect()->route('destination.index')->with('success', 'Data berhasil di hapus');
    }
}
