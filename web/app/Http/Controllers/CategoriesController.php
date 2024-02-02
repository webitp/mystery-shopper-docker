<?php

namespace App\Http\Controllers;

use \Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:255',
        'report' => 'required|string|max:255'
    ];

    public function index()
    {
        $user = Auth::user();
        $canCreate = $user->isAdmin();
        return view('categories.index', [
            'categories' => Category::paginate(15),
            'canCreate' => $canCreate
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $canCreate = $user->isAdmin();
        return view('categories.create');
    }

    public function edit(int $id)
    {
        $category = Category::where('id', '=', $id)->first();

        if (!$category->isOwned()) {
            return abort(403);
        }

        if ($category) {
            return view('categories.edit', [
                'category' => $category
            ]);
        }
        return abort(404);
    }

    public function update(Request $request)
    {
        $request->validate($this->rules);

        $category = Category::where('id', '=', $request->id)->first();
        $category->name = $request->input('name');
        $category->report = $request->input('report');
        $category->save();

        return response()->view('categories.edit', [
            'category' => $category,
            'edited' => true
        ]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $canCreate = $user->isAdmin();
        
        $request->validate($this->rules);

        Category::create([
            'user_id' => Auth::user()->id,
            'name' => $request->input('name'),
            'report' => $request->input('report')
        ]);

        return redirect()->route('categories');
    }

    public function delete(Request $request)
    {
        $category = Category::where('id', '=', $request->id)->first();
        if (!$category->isOwned()) {
            return abort(403);
        }
        $category->delete();

        return redirect()->route('categories');
    }
}
