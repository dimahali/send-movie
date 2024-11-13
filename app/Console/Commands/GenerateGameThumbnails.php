<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

class GenerateGameThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-game-thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $games = Movie::whereNotNull('cover_image')
            ->select(['id', 'cover_image', 'name'])
            ->get();

        $manager = new ImageManager(new Driver());

        $this->output->progressStart($games->count());

        foreach ($games as $game) {
            $coverImagePath = $game->cover_image;

            if (Storage::disk('public')->exists($coverImagePath)) {
                $imageForIcon = $manager->read(Storage::disk('public')->path($coverImagePath));
                $iconPath = 'games/icons/' . pathinfo($coverImagePath, PATHINFO_FILENAME) . '.webp';
                $iconImage = $this->createHighQualityIcon($imageForIcon);
                Storage::disk('public')->put($iconPath, $iconImage->toWebp(99)->toString());

                $imageForMedium = $manager->read(Storage::disk('public')->path($coverImagePath));
                $mediumPath = 'games/medium/' . pathinfo($coverImagePath, PATHINFO_FILENAME) . '.webp';
                $mediumImage = $this->createMediumImage($imageForMedium);
                Storage::disk('public')->put($mediumPath, $mediumImage->toWebp(99)->toString());
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info('Movie icons generated successfully!');
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
