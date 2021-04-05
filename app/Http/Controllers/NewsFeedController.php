<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsFeedRequest;
use App\Models\NewsFeed;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = NewsFeed::all();
        return view('news.index', [
            'news' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsFeedRequest $request)
    {
        $data = $request->all();

        $data['image'] = $request->file('image')->store('images/news', 'public');

        NewsFeed::create($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('news.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsFeed $newsFeed)
    {
        $data = $request->all();

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('images/news', 'public');
        }

        $newsFeed->update($data);

        return redirect()->route('news.index')->with('success', 'Berita berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsFeed $newsFeed)
    {
        $newsFeed->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil di hapus');
    }
}
