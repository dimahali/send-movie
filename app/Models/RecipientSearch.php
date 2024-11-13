<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipientSearch extends Model
{
    public function scopeForTerm( $query, $search_term )
    {
        return $query->where('search_term', $search_term);
    }
}
