<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use App\Models\ClientOffer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function create(Request $request)
    {
        $tid = $request->input('tid');
        $username = $request->input('username');

        $client = Client::where('tid', '=', $tid)->first();
        if (!$client) {
            $client = Client::create([
                'tid' => $tid,
                'username' => $username
            ]);
        }
        return $client;
    }

    public function get(int $tid)
    {
        $client = Client::where('tid', '=', $tid)->with(['offers', 'offers.offer', 'offers.offer.category', 'activeOffer', 'activeOffer.offer', 'activeOffer.offer.category'])->first();
        if ($client) return $client;
        return abort(404);
    }

    public function takeOffer(int $tid, int $offer_id)
    {
        $client = Client::where('tid', '=', $tid)->first()->load(['offers']);
        if ($client)
        {
            $client->offers()->create([
                'offer_id' => $offer_id,
                'state' => 0
            ]);
            return $client;
        }
        return abort(404);
    }

    public function setOfferState(int $tid, int $offer_id, Request $request)
    {
        $state = $request->input('state');
        $client = Client::where('tid', '=', $tid)->first();
        if ($client)
        {
            $offer = $client->offers()->where('id', '=', $offer_id)->first();
            $offer->state = $state;
            $offer->save();

            return $client;
        }
        return abort(404);
    }

    public function setOfferPhoto(int $tid, int $offer_id, Request $request)
    {
        $photo = $request->input('photo');
        $client = Client::where('tid', '=', $tid)->first();
        if ($client)
        {
            $offer = $client->offers()->where('id', '=', $offer_id)->first();
            $offer->photo = $photo;
            $offer->save();

            return $client;
        }
        return abort(404);
    }

    public function setOfferReport(int $tid, int $offer_id, Request $request)
    {
        $report = $request->input('report');
        $client = Client::where('tid', '=', $tid)->first();
        if ($client)
        {
            $offer = $client->offers()->where('id', '=', $offer_id)->first();
            $offer->report = $report;
            $offer->save();

            return $client;
        }
        return abort(404);
    }
}
