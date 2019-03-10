<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'isbn', 'authors', 'number_of_pages', 'publisher', 'country', 'release_date',
    ];

    /**
     * Scope a query to filter records by release date (year).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $year
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeReleaseYear($query, $year)
    {
        return $query->whereRaw('YEAR(release_date) = '.$year);
    }
}
