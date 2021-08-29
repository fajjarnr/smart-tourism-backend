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
            'title' => 'required|string',
            'content' => 'required|string',
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
    public function edit($id)
    {
        $news = NewsFeed::findOrFail($id);
        return view('news.edit', [
            'item' => $news,
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
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $news = NewsFeed::findorfail($id);

        if ($request->has('picturePath')) {
            $image = $request->file('picturePath')->store('images/news', 'public');

            $data_update = [
                'title'     => $request->title,
                'content'   => $request->content,
                'picturePath' => $image,
                'user_id' => Auth::user()->id,
            ];
        } else {
            $data_update = [
                'title'     => $request->title,
                'content'   => $request->content,
                'user_id' => Auth::user()->id,
            ];
        }

        $news->update($data_update);

        return redirect()->route('news.index')->with('success', 'Berita berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsFeed $newsFeed, $id)
    {
        $news = NewsFeed::find($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil di hapus');
    }
}
