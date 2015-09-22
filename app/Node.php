<?php

namespace App;

use App\Presenters\NodePresenter;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\PresenterInterface;

class Node extends Model implements PresenterInterface
{
    public static $includable = [];
    protected $fillable       = [];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    /**
     * Prepare data to present.
     *
     * @param $data
     *
     * @return mixed
     */
    public function present($data)
    {
        return NodePresenter::class;
    }
}
