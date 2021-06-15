<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsFeedRequest;
use App\Models\Category;
use App\Models\NewsFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // $data = $request->all();

        $request->validate([
            'title' => 'required|max:255|string',
            'content' => 'required|max:255|string',
            'picturePath' => 'required|image|mimes:png,jpg'
        ]);

        $image = $request->file('picturePath')->store('images/news', 'public');

        NewsFeed::create([
            'title' => $request->title,
            'content' => $request->content,
            'picturePath' => $image,
            'user_id' => Auth::user()->id,
        ]);

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
    public function edit(NewsFeed $newsFeed)
    {
        return view('news.edit', [
            'item' => $newsFeed,
        ]);
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

        if ($request->file('picturePath')) {
            $data['picturePath'] = $request->file('picturePath')->store('images/news', 'public');
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
