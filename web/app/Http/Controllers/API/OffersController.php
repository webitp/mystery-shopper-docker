<?php

namespace App\Http\Controllers\API;

use App\Models\Offer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function list()
    {
        return Offer::all();
    }

    public function get(int $id)
    {
        $offer = Offer::where('id', '=', $id)->with(['link'])->first();
        if ($offer) return $offer;
        return abort(404);
    }
}
