<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mime_type',
        'path',
    ];

    /**
     * Returns the owner of the media.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner() {
        return $this->morphTo();
    }

    /**
     * Stores and attaches the media file to the owner.
     *
     * @param  \Illuminate\Http\UploadedFile|string $file
     * @param  Model $owner
     *
     * @return Model
     */
    public static function store($file, Model $owner) {
        $file  = is_string($file) ? new File($file) : $file;
        $path  = $file->hashName('media');
        $image = Image::make($file);

        // We'll resize the media file before storing it for the sake of
        // performance while maintaining the aspect ratio of the image to
        // prevent quality being dropped or the image being cropped.
        $image->fit(600, 600, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('public')->put($path, (string) $image->encode());

        $data = [
            'mime_type' => $image->mime,
            'path'      => Storage::url($path),
        ];

        $media = new static;
        $media = $media->create($data);
        $media = $media->owner()->associate($owner);

        $media->save();

        return $media;
    }
}
