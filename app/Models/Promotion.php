<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\MediaCollection;

class Promotion extends Model implements HasMedia
{
    const MEDIA_COLLECTION_IMAGE = 'image';

    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Media::class, 'model');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::MEDIA_COLLECTION_IMAGE);
    }

}
