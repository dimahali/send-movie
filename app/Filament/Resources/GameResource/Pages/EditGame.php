<?php

namespace App\Filament\Resources\GameResource\Pages;

use App\Filament\Resources\GameResource;
use App\Models\Movie;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

class EditGame extends EditRecord
{
    protected static string $resource = GameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        /** @var Movie $game */
        $game = $this->record;
        $coverImagePath = $game->cover_image;

        if ($coverImagePath && Storage::disk('public')->exists($coverImagePath)) {
            $manager = new ImageManager(new Driver());

            $imageForIcon = $manager->read(Storage::disk('public')->path($coverImagePath));
            $iconPath = 'games/icons/' . pathinfo($coverImagePath, PATHINFO_FILENAME) . '.webp';
            $iconImage = $this->createHighQualityIcon($imageForIcon);
            Storage::disk('public')->put($iconPath, $iconImage->toWebp(99)->toString());

            $imageForMedium = $manager->read(Storage::disk('public')->path($coverImagePath));
            $mediumPath = 'games/medium/' . pathinfo($coverImagePath, PATHINFO_FILENAME) . '.webp';
            $mediumImage = $this->createMediumImage($imageForMedium);
            Storage::disk('public')->put($mediumPath, $mediumImage->toWebp(99)->toString());
        }
    }

    private function createHighQualityIcon(ImageInterface $image): ImageInterface
    {
        return $image->cover(200, 200)
            ->sharpen();
    }

    private function createMediumImage(ImageInterface $image): ImageInterface
    {
        $targetWidth = 300;
        $targetHeight = 300;

        $width = $image->width();

        if ($width <= $targetWidth) {
            return $image->sharpen();
        }

        return $image->resizeDown($targetWidth, $targetHeight)
            ->sharpen();
    }
}
