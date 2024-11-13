<?php

namespace App\Observers;

use App\Models\Movie;
use Storage;

class GameObserver
{
    public function updated(Movie $game): void
    {
        if ($game->isDirty('cover_image')) {
            $originalCoverImage = $game->getOriginal('cover_image');

            if ($originalCoverImage) {
                $this->removeRelatedImages($originalCoverImage);
            }
        }
    }

    public function deleted(Movie $game): void
    {
        if (!is_null($game->cover_image)) {
            $this->removeRelatedImages($game->cover_image);
        }
    }

    private function removeRelatedImages(string $coverImagePath): void
    {
        $disk = Storage::disk('public');

        if ($disk->exists($coverImagePath)) {
            $disk->delete($coverImagePath);
        }

        $filename = pathinfo($coverImagePath, PATHINFO_FILENAME);

        $iconPath = 'games/icons/' . $filename . '.webp';
        if ($disk->exists($iconPath)) {
            $disk->delete($iconPath);
        }

        $mediumPath = 'games/medium/' . $filename . '.webp';
        if ($disk->exists($mediumPath)) {
            $disk->delete($mediumPath);
        }
    }
}
