<?php

namespace PHPHub;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];

    public function votable()
    {
        return $this->morphTo();
    }

    public function votes()
    {
        return $this->morphMany(self::class, 'votable');
    }
}
