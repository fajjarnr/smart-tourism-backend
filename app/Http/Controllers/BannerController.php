<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use App\Models\Destination;
use App\Models\NewsFeed;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::with(['news'])->get();
        return view('banner.index', [
            'banner' => $banner
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $news = NewsFeed::all();
        return view('banner.create', [
            'news' => $news
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {

        $data = $request->all();

        $data['picturePath'] = $request->file('picturePath')->store('images/banner', 'public');

        Banner::create($data);

        return redirect()->route('banner.index')->with('success', 'banner berhasil dibuat');
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
    public function edit(Banner $banner)
    {
        $banner = Banner::with(['news'])->get();
        return view('banner.edit', [
            'item' =>  $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $data = $request->all();

        if ($request->file('picturePath')) {
            $data['picturePath'] = $request->file('picturePath')->store('images/banner', 'public');
        }

        $banner->update($data);

        return redirect()->route('banner.index')->with('success', 'Banner berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->route('banner.index')->with('success', 'banner berhasil di delete');
    }
}
