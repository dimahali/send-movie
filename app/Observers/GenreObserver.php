<?php

namespace App\Observers;

use App\Models\Genre;
use Storage;

class GenreObserver
{
    public function updated(Genre $genre): void
    {
        if ($genre->isDirty('featured_image')) {
            $originalFeaturedImage = $genre->getOriginal('featured_image');

            if ($originalFeaturedImage && Storage::disk('public')->exists($originalFeaturedImage)) {
                Storage::disk('public')->delete($originalFeaturedImage);
            }
        }
    }

    public function deleted(Genre $genre): void
    {
        if (!is_null($genre->featured_image) && Storage::disk('public')->exists($genre->featured_image)) {
            Storage::disk('public')->delete($genre->featured_image);
        }
    }
}
