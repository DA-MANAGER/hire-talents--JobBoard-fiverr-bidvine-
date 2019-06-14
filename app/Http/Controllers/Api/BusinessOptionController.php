<?php

namespace App\Http\Controllers\Api;

use App\Business;
use App\Http\Controllers\Controller;
use App\Http\Resources\OptionResource;
use App\Option;
use App\Constants\BusinessPermissionError;
use App\Exceptions\NoPermissionException;
use Illuminate\Http\Request;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class BusinessOptionController extends Controller
{
    public function destroy(Request $request, $business_id) {
        $business = Business::with(['options', 'owners'])->findOrFail($business_id);

        if (! $business->isMasterOwnedBy(auth()->user)) {
            throw new NoPermissionException(BusinessPermissionError::UPDATE);
        }

        $data = $request->validate([
            'key'   => 'required|string',
        ]);

        $owns = $business->options->contains('key', $data['key']);

        if ($owns) {
            $business->options()->where('key', $data['key'])->delete();
        }

        return response('', 200);
    }

    public function index($business_id) {
        $business = Business::with(['options'])->findOrFail($business_id);

        return OptionResource::collection($business->options);
    }

    public function store(Request $request, $business_id) {
        $business = Business::with(['options', 'owners'])->findOrFail($business_id);

        if (! $business->isMasterOwnedBy(auth()->user())) {
            throw new NoPermissionException(BusinessPermissionError::UPDATE);
        }

        $data = $request->validate([
            'key'   => 'required|string',
            'value' => 'required'
        ]);

        $data['value'] = json_encode($data['value']);
        $owns = $business->options->contains('key', $data['key']);

        $owns ?
            $business->options()->where('key', $data['key'])->update($data):
            $business->options()->create($data);

        return response('', 200);
    }
}
