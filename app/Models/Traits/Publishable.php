<?php

namespace App\Models\Traits;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Publishable
{

    public function scopePublished( Builder $query )
    {

        return $query->where('published_at', '<=', Carbon::now())
                     ->whereNotNull('published_at');

    }


    public function scopeUnPublished( Builder $query )
    {

        return $query->where('published_at', '>', Carbon::now())
                     ->orWhereNull('published_at');

    }


    public function isPublished()
    {

        if ( is_null($this->published_at) ) {
            return false;
        }

        return $this->published_at->lte(Carbon::now());

    }


    public function isUnpublished()
    {
        return !$this->isPublished();
    }


    public function publish()
    {
        return $this->update([
            'published_at' => Carbon::now()->toDateTimeString(),
        ]);
    }


    public function unpublish()
    {
        return $this->update([
            'published_at' => NULL,
        ]);
    }

}
