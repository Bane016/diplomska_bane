<?php

namespace App\Http\Controllers;

use App\Ad;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function allBids()
    {
        $all_ads = Ad::select('id', 'name', 'user_id', 'category', 'price', 'description', 'created_at', 'updated_at')
            ->with('users')->get()->toArray();
//dd($all_ads);
        return view('user/ads', compact('all_ads'));
    }

    public function myBids()
    {

        $my_bids = Ad::select('id', 'name', 'user_id', 'category', 'price', 'description', 'created_at', 'updated_at')
            ->where([
                ["user_id", "=", auth()->user()->id],
            ])->get()->toArray();

        return view('user/mybids', compact('my_bids'));
    }

    public function allAds()
    {
        $all_ads = Ad::select('id', 'name', 'user_id', 'category', 'price', 'description', 'created_at', 'updated_at')
            ->with('users')->get()->toArray();
        return view('/all_ads', compact('all_ads'));
    }
}
