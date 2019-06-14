<?php

namespace App\Http\Controllers\Api;

use App\Bid;
use App\Http\Controllers\Controller;
use App\Http\Resources\BidResource;
use Illuminate\Http\Request;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class BidController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'business_id' => 'required|exists:businesses,id',
        ]);

        $bids = Bid::where('business_id', $request->input('business_id'))->paginate();

        return BidResource::collection($bids);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'amount' => 'required|string',
            'business_id' => 'required|exists:businesses,id',
            'description' => 'required|string',
            'media.*'     => 'image',
            'service_request_id' => 'required|exists:service_requests,id',
        ]);

        $bid = Bid::create($data);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                Media::store($media, $bid);
            }
        }

        return new BidResource($bid);
    }
}
