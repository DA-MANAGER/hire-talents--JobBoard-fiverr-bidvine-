<?php

namespace App\Http\Controllers\Api;

use App\Constants\MediaPermissionError;
use App\Contracts\HasMasterOwner;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Media;
use App\Rules\ModelType;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'id'   => 'required|int',
            'type' => [
                'required',
                'string',
                new ModelType,
            ]
        ]);

        $model = Relation::getMorphedModel($data['type']);
        $owner = (new $model)->with('media')->findOrFail($data['id']);

        return MediaResource::collection($owner->media);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id'    => 'required|int',
            'media' => 'required|file',
            'type'  => [
                'required',
                'string',
                new ModelType,
            ]
        ]);

        $model = Relation::getMorphedModel($data['type']);
        $owner = (new $model)->findOrFail($data['id']);

        $user  = auth()->user();

        if ($owner instanceof HasMasterOwner && ! $owner->isMasterOwnedBy($user)) {
            throw new NoPermissionException(MediaPermissionError::STORE);
        }

        $media = Media::store($request->file('media'), $owner);

        return new MediaResource($media);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $media = Media::with('owner')->findOrFail($id);
        $user  = auth()->user();

        if ($media->owner instanceof HasMasterOwner && ! $media->owner->isMasterOwnedBy($user)) {
            throw new NoPermissionException(MediaPermissionError::DELETE);
        }

        $media->delete();

        return response('', 200);
    }
}
