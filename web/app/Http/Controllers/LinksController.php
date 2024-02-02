<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:255',
        'initial_link' => 'required|string|max:255'
    ];

    public function index()
    {
        return view('links.index', [
            'links' => Link::paginate(15)
        ]);
    }

    public function save(Request $request)
    {
        $request->validate($this->rules);

        $name = $request->input('name');
        $initial_link = $request->input('initial_link');
        $link = md5($initial_link);

        Link::create([
            'name' => $name,
            'initial_link' => $initial_link,
            'link' => $link,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('links');
    }

    public function edit(int $id)
    {        
        $link = Link::where('id', '=', $id)->first();
        if (!$link->isOwned()) {
            return abort(403);
        }
        if ($link) {
            return view('links.edit', [
                'link' => $link
            ]);
        }
        return abort(404);
    }

    public function update(Request $request)
    {
        $request->validate($this->rules);

        $initial_link = $request->input('initial_link');

        $link = Link::where('id', '=', $request->id)->first();
        $link->name = $request->input('name');
        if ($link->initial_link != $initial_link)
            $link->link = md5($initial_link);
        $link->initial_link = $initial_link;
        $link->save();

        return response()->view('links.edit', [
            'link' => $link,
            'edited' => true
        ]);
    }

    public function create()
    {
        return view('links.create');
    }

    public function redirect(string $url)
    {
        $link = Link::where('link', '=', $url)->first();
        if ($link)
            return redirect($link->initial_link);
        return abort(404);
    }

    public function delete(Request $request)
    {
        $link = Link::where('id', '=', $request->id)->first();
        if (!$link->isOwned()) {
            return abort(403);
        }
        $link->delete();

        return redirect()->route('links');
    }
}
