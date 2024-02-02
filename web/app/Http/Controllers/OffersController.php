<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:255',
        'reward' => 'required|integer|min:1|max:10000',
        'text_actions' => 'required|string',
        'text_step_1' => 'required|string',
        'text_step_2' => 'required|string'
    ];

    public function index()
    {
        return view('offers.index', [
            'offers' => Offer::paginate(15)
        ]);
    }

    public function create()
    {
        return view('offers.create', [
            'categories' => Category::all(),
            'links' => Link::all()
        ]);
    }

    public function edit(int $id)
    {
        $offer = Offer::where('id', '=', $id)->first();

        if (!$offer->isOwned()) {
            return abort(403);
        }

        if ($offer) {
            return view('offers.edit', [
                'offer' => $offer,
                'categories' => Category::all(),
                'links' => Link::all()
            ]);
        }
        return abort(404);
    }

    public function update(Request $request)
    {
        $request->validate($this->rules);

        error_log(1 / 0);

        $offer = Offer::where('id', '=', $request->id)->first();
        $offer->category_id = $request->input('category_id');
        $offer->link_id = $request->input('link_id');
        $offer->name = $request->input('name');
        $offer->reward = $request->input('reward');
        $offer->text_actions = $request->input('text_actions');
        $offer->text_step_1 = $request->input('text_step_1');
        $offer->text_step_2 = $request->input('text_step_2');
        $offer->is_test = $request->has('is_test');
        $offer->save();

        return response()->view('offers.edit', [
            'offer' => $offer,
            'categories' => Category::all(),
            'links' => Link::all(),
            'edited' => true
        ]);
    }

    public function save(Request $request)
    {
        $request->validate($this->rules);

        Offer::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->input('category_id'),
            'link_id' => $request->input('link_id'),
            'name' => $request->input('name'),
            'reward' => $request->input('reward'),
            'text_actions' => $request->input('text_actions'),
            'text_step_1' => $request->input('text_step_1'),
            'text_step_2' => $request->input('text_step_2'),
            'is_test' => $request->input('is_test')
        ]);

        return redirect()->route('offers');
    }

    public function delete(Request $request)
    {
        $offer = Offer::where('id', '=', $request->id)->first();

        if (!$offer->isOwned()) {
            return abort(403);
        }

        $offer->delete();

        return redirect()->route('offers');
    }
}
