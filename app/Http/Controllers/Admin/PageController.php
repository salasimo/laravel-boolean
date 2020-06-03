<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Category;
use App\Tag;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('updated_at', 'DESC')->paginate(25);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();

        return view('admin.pages.create', compact('categories', 'tags', 'photos'));
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

        if (!isset($data['visible'])) {
            $data['visible'] = 0;
        } else {
            $data['visible'] = 1;
        }

        $data['user_id'] = Auth::id();
        $page = new Page;
        $page->fill($data);
        $saved = $page->save();

        if (!$saved) {
            return redirect()->back();
        }

        if (isset($data['tags'])) {
            $page->tags()->attach($data['tags']);
        }

        if (isset($data['photos'])) {
            $page->photos()->attach($data['photos']);
        }

        return redirect()->route('admin.pages.show', $page->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = Auth::id();
        $page = Page::findOrFail($id);
        if ($userId != $page->user_id) {
            abort('404');
        }
        $categories = Category::all();
        $tags = Tag::all();
        $photos = Photo::all();

        return view('admin.pages.edit', compact('page', 'categories', 'tags', 'photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userId = Auth::id();
        $page = Page::findOrFail($id);
        if ($userId != $page->user_id) {
            abort('404');
        }
        $data = $request->all();
        $page->fill($data);
        $page->update();

        $arrayTags = [];
        if (is_array($data['tags'])) {
            foreach ($data['tags'] as $tag) {
                $thisTag = Tag::find($tag);
                if ($thisTag) {
                    $arrayTags[] = $tag;
                }
            }
        }
        $page->tags()->sync($arrayTags);
        return redirect()->route('admin.pages.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::id();
        $page = Page::findOrFail($id);
        if ($userId != $page->user_id) {
            abort('404');
        }

        $page->tags()->detach();
        $page->photos()->detach();

        $page->delete();

        return redirect()->back();
    }
}
