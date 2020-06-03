<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $path = Storage::disk('public')->put('images', $data['path']);

        $data['user_id'] = Auth::id();
        $photo = new Photo;
        $photo->fill($data);
        $saved = $photo->save();

        if (!$saved) {
            return redirect()->back();
        }

        redirect('admin.photos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $photo = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $photo = Photo::findOrFail($id);

        $data = $request->all();

        if (isset($data['path'])) {
            Storage::disk('public')->delete($photo['path']);
        }

        $photo->fill($data);
        $photo->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::id();
        $photo = Photo::findOrFail($id);
        if ($userId != $photo->user_id) {
            abort('404');
        }

        $photo->pages()->detach();

        $photo->delete();

        return redirect()->back();
    }
}
